<?php

ini_set('max_execution_time','3600');
error_reporting(0);
$link = mysqli_connect('localhost','id9770142_caribou','webexpert555','id9770142_hashtags');
$date = date('Y-m-d');

$sqlSelectDate = "UPDATE hashtags SET enumStatus='N' WHERE DATE(dt_CronRunDate) < DATE('".$date."')";
$result = mysqli_query($link, $sqlSelectDate);
if(mysqli_num_rows($result) < 1)
{
    $sqlSelectDate = "UPDATE hashtags SET enumStatus='N' WHERE intPostCount = 0 OR intDailyPostCount = 0 OR intDAPC = 0";
    $result = mysqli_query($link, $sqlSelectDate);
}

$sql = "SELECT * FROM hashtags WHERE enumStatus='N' ORDER BY intID ASC LIMIT 0, 100";
$result = mysqli_query($link, $sql);

$today              = strtotime($hour . ':00:00');
$yesterday          = strtotime('0 day', $today);
$dayBeforeYesterday = strtotime('-1 hour');

while($data = mysqli_fetch_array($result))
{
    $hashtags=str_replace('#', '', $data['vchHashTags']);
    $intId = $data['intID'];
    $intPostCount = $data['intPostCount'];
    $intPostLikePerHour = $data['intAverageLike'];

    $insta_source = file_get_contents('https://www.instagram.com/explore/tags/'.$hashtags.'/?1_all'); // instagrame tag url
    $shards = explode('window._sharedData = ', $insta_source );
    $insta_json = explode(';</script>', $shards[1]);
    $insta_array = json_decode($insta_json[0], TRUE);
    $results_array = $insta_array;

    $postcount = $results_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['count'];
    $dailypostcount = ($postcount - $intPostCount);
    if ($dailypostcount < 1) continue;
    $j = 0;
    $limit = 100; // provide the limit thats important because one page only give some images.
    $image_arra1y = array(); // array to store images.
    $likeArray = array();
    $postlikemax = array();
    $postlikeperhours = array();
    $count = 0;
    $countinfo = 0;


    for ($i=0; $i < $limit; $i++) {

        $latest_array = $results_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'][$i]['node']['edge_liked_by']['count'] ;
        $likeCnt=$results_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_top_posts']['edges'][$i]['node']['edge_liked_by']['count'];
        $timestamp=$results_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'][$i]['node']['taken_at_timestamp'];
        if($i < 9){
            array_push($likeArray, $likeCnt);
            array_push($postlikemax, $latest_array);
        }
        if($timestamp >= $dayBeforeYesterday)
        {
            array_push($postlikeperhours, $results_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_top_posts']['edges'][$j]['node']['edge_liked_by']['count']);
            $j++;
        }
    }
    $sql = "SELECT SUM(intDailyPostCount) AS sumDaily FROM hashtags_log WHERE intHashTagID='" . $intId . "'";
    $tempResult = mysqli_query($link, $sql);
    $fetchRow = mysql_fetch_row($tempResult);
    $sum = $fetchRow[0];

    $sql = "SELECT COUNT(id) AS cnt FROM hashtags_log WHERE intHashTagID='" . $intId . "'";
    $tempResult = mysqli_query($link, $sql);
    $fetchRow = mysql_fetch_row($tempResult);
    $tempCnt = $fetchRow[0];

    $DAPC = $sum / $tempCnt;

    $maxLike = max($likeArray);
    $minLike = min($likeArray);
    $sum = array_sum($likeArray);
    $post = array_sum($postlikemax);
    $avgPost = $post / 9;
    $avgLike = $sum / 9;
    $intPostLikePerHour1 = ($maxLike - $intPostLikePerHour);
    $intMinPostLikePerHour = min($postlikeperhours);

    $sqlUpdate = "UPDATE hashtags  SET intPostCount='".$postcount."', intDailyPostCount='".$DAPC
        ."', intDAPC='".$DAPC."', intMaxLike9Top='".$maxLike."', intMinLike9Top='".$minLike
        ."', intAverageLike='".$avgLike."', intLikeCount='".$sum."', intPostLikePerHour='".$avgPost
        ."', intMinPostLikePerHour='".$intMinPostLikePerHour."' WHERE intID='".$intId."'";
    mysqli_query($link, $sqlUpdate);

    $date = date('m-d-Y');
    $sqlCount = "SELECT * FROM hashtags_log WHERE DATE(dt_Date)=DATE('".$date."') AND intHashTagID='".$intId."'";
    $resultCount = mysqli_query($link,$sqlCount);
    $num = mysqli_num_rows($resultCount);

    if($num > 0)
    {
        $res = mysqli_fetch_array($resultCount);
        $id = $res['intID'];
        $sqlInsertLog = "UPDATE hashtags_log SET intPostCount='".$postcount."', intDailyPostCount='".$DAPC."', intDAPC='".$DAPC."', dt_Date=now() WHERE intID='".$id."'";
        mysqli_query($link,$sqlInsertLog);
    }else{
        $sqlInsertLog="INSERT INTO hashtags_log SET intHashTagID='".$intId."', intPostCount='".$postcount."', intDailyPostCount='".$DAPC."', intDAPC='".$DAPC."', dt_Date=now()";
        mysqli_query($link,$sqlInsertLog);
    }
    echo $update="UPDATE hashtags SET enumStatus='Y', dt_CronRunDate=now() WHERE intID='".$intId."'";
    mysqli_query($link,$update);

}
?>