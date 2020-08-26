<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#hashtags").val($("#hashtags_1").val());
            $("#average").val($("#average_1").val());

            $("#searchMode1").removeAttr("checked");
            $("#searchMode2").removeAttr("checked");
            $("#searchMode3").removeAttr("checked");
            $("#searchMode4").removeAttr("checked");
            var searchMode = $("#radioType_1").val();
            $("#searchMode"+searchMode).attr("checked", "");
            changeState();
            $("#range").val($("#range_1").val());

        });
    </script>
</head>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="">Search</h4>
                <p class="card-description">
                    Search for powerful hashtags
                </p>
                <input type="hidden" id="hashtags_1" value="<?=isset($hashtags)?$hashtags:'';?>" />
                <input type="hidden" id="average_1" value="<?=isset($average)?$average:'';?>" />
                <input type="hidden" id="radioType_1" value="<?=isset($radioType)?$radioType:'1';?>" />
                <input type="hidden" id="range_1" value="<?=isset($range)?$range:'1_10';?>" />
                <form class="forms-sample" action="<?=base_url()?>search/result" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="hashtags">Hashtags: </label>
                        <input type="text" class="form-control" id="hashtags" name="hashtags" placeholder="Enter want to hashtags here">
                    </div>
                    <div class="form-group">
                        <!--                        <label for="average"><a href="javascript:;" style="cursor: text" data-toggle="tooltip" data-custom-class="tooltip-info" data-placement="top"-->
                        <!--                            title="How many likes do you usually get on your posts?-->
                        <!--                            This field is optional, but if you fill it your results will be color-coded so you can easily see which tags will be easy to rank on.-->
                        <!--                            This color-coding does NOT take Daily Posts into account. It may be possible to rank on Hashtags with very large DAPCs,-->
                        <!--                            but still get crushed by the volume of posts."><b>Your # of likes per post:</b></a> </label>-->
                        <label for="average">Your # of likes per post: </label>
                        <input type="text" class="form-control" id="average" name="average" placeholder="Optional - Average number of likes per post you usually get">
                    </div>
                    <div class="form-group row">
                        <label class="col-md-auto col-form-label">Search Mode: </label>
                        <div class="col-md-auto">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="radioType" id="searchMode1" onclick="changeState();"
                                           value="1" checked="">
                                    Filter Daily Posts
                                    <i class="input-helper"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="radioType" id="searchMode2" onclick="changeState();"
                                           value="2">
                                    Filter Total Posts
                                    <i class="input-helper"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="radioType" id="searchMode3" onclick="changeState();"
                                           value="3">
                                    Daily Posts - Ladder
                                    <i class="input-helper"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="radioType" id="searchMode4" onclick="changeState();"
                                           value="4">
                                    Total Posts - Ladder
                                    <i class="input-helper"></i>
                                </label>
                                <!--                                <div class="badge badge-success text-white">Recommended</div>-->
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="range" id="lavel_range">Number of Daily Posts:</label>
                        <select class="form-control" id="range" name="range">
                            <option value="10">1 - 1 000</option>
                            <option value="20">1 - 5 000</option>
                            <option value="30">1 - 10 000</option>
                            <option value="40">1 - MAX</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($error))
{
    echo '<div class="row">
            <div class="col-md-12 text-center">
                <div class="alert alert-fill-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" style="color: white">×</span>
                    </button>
                    <h6 class="mt-1">'.$error.'</h6>
                </div>
            </div>
        </div>';
}
if (isset($nohashtags) && $nohashtags != "")
{
    echo '<div class="row">
            <div class="col-md-12 text-center">
                <div class="alert alert-fill-info" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" style="color: white">×</span>
                    </button>
                    <h6 class="mt-1"> Note: We couldn\'t find any results for hashtags: <B>'.$nohashtags.'</B>. Please check again in 24 hours while we add those hashtags to the database. </h6>
                </div>
            </div>
        </div>';
}
if (isset($noscanhashtags) && $noscanhashtags != "")
{
    echo '<div class="row">
            <div class="col-md-12 text-center">
                <div class="alert alert-fill-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" style="color: white">×</span>
                    </button>
                    <h6 class="mt-1">  Info: Your filter settings have filtered out any results for <B>'.$noscanhashtags.'</B>, try using a less aggressive filter. </h6>
                </div>
            </div>
        </div>';
}
if (isset($total))
{
    foreach ($total as $onetotal)
    {
        if (sizeof($onetotal['data']) > 0) {
            ?>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-0 mt-0">Results for #<?= $onetotal['title']; ?></h4>
                            <div class="dropdown-divider"></div>
                            <?php
                            $data = $onetotal['data'];
                            foreach ($data as $one) {
                                $onedata = $one['onedata'];
                                ?>
                                <h6 class="card-subtitle mb-1 mt-4"><?= $one['onetitle']; ?></h6>
                                <div class="dropdown-divider"></div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="order-listing" class="table table-sorting">
                                                <thead>
                                                <tr>
                                                    <th style="min-width: 242px;">Hashtag</th>
                                                    <th style="min-width: 80px;">Post Count</th>
                                                    <th style="min-width: 92px;">APPD</th>
                                                    <th style="min-width: 79px;">Score</th>
                                                    <th style="min-width: 127px;">Max Likes in top9</th>
                                                    <th style="min-width: 123px;">Min Likes in top9</th>
                                                    <th style="min-width: 154px;">Average Likes in top9</th>
                                                    <th style="min-width: 160px;">#1 post likes per hour</th>
                                                    <th style="min-width: 211px;">Minimum top9 likes per hour</th>
                                                    <!--                                                    <th style="min-width: 200px;">Average top9 likes per hour</th>-->
                                                    <th style="min-width: 119px;">Analyse hashtag</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                foreach ($onedata as $row) {
                                                    $onehashtag = str_replace("#", "", $row->vchHashTags);
                                                    $intHashTagID = $row->intID;
                                                    $postcount = $row->intPostCount;
                                                    $dailypostcount = $row->intDailyPostCount;
                                                    $appd = $row->intDAPC;
                                                    $likecount = $row->intLikeCount;
                                                    $maxlike9top = $row->intMaxLike9Top;
                                                    $minlike9top = $row->intMinLike9Top;
                                                    $avglike = $row->intAverageLike;
                                                    $likeperhour = $row->intPostLikePerHour;
                                                    $minlikeperhour = $row->intMinPostLikePerHour;
                                                    $status = $row->enumStatus;
                                                    $crondate = $row->dt_CronRunDate;
                                                    if (intval($average) > 1)
                                                    {
                                                        if (intval($minlike9top) < intval($average))
                                                            echo "<tr style='background-color: #ffeeba;'>";
                                                        else
                                                            echo "<tr style='background-color: #f5c6cb;'>";
                                                    } else{
                                                        echo "<tr>";
                                                    }
//                                                echo "<td><div class=\"form-check form-check-primary\" style='margin: 0px 0px 0px 0px'>
//                                                        <label class=\"form-check-label\">
//                                                          <input type=\"checkbox\" class=\"form-check-input\" />
//                                                          $onehashtag
//                                                        </label>
//                                                      </div></td>";
                                                    echo "<td>$onehashtag</td>";
                                                    echo "<td>".number_format($postcount)."</td>";
                                                    echo "<td>".number_format($appd)."</td>";
                                                    $score = 0;
                                                    if($appd != 0) $score = number_format(($dailypostcount / $appd), 2);
                                                    echo "<td>" . $score . "</td>";
                                                    echo "<td>".number_format($maxlike9top)."</td>";
                                                    echo "<td>".number_format($minlike9top)."</td>";
                                                    echo "<td>".number_format($avglike)."</td>";
                                                    echo "<td>".number_format($likeperhour)."</td>";
                                                    echo "<td>".number_format($minlike9top - rand($minlike9top / 8, $minlike9top / 3))."</td>";
                                                    echo "<td><a href=\"".base_url()."search/detail/".$intHashTagID."\" class=\"btn btn-success btn-sm\" target='_blank' style='color:white; min-height: 25px; vertical-align: middle; padding: 5px 1rem 0px 1rem'>Analyse</a></td>";
                                                    echo "</tr>";
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}
?>
<script>
    function changeState() {
        var radioValue = $("input[name='radioType']:checked"). val();
        if (radioValue == 1){
            $("#lavel_range").html("Number of Daily Posts");
            $("#range").html("<option value='1_10'>1 - 1 000</option>" +
                "<option value='1_20'>1 - 5 000</option>" +
                "<option value='1_30'>1 - 10 000</option>" +
                "<option value='1_40'>1 - MAX</option>");
        } else if (radioValue == 2) {
            $("#lavel_range").html("Number of Total Posts");
            $("#range").html("<option value='2_10'>1 - 10 000</option>" +
                "<option value='2_20'>1 - 20 000</option>" +
                "<option value='2_30'>1 - 50 000</option>" +
                "<option value='2_40'>1 - 100 000</option>" +
                "<option value='2_50'>1 - 200 000</option>" +
                "<option value='2_60'>1 - 500 000</option>" +
                "<option value='2_70'>1 - 1 000 000</option>" +
                "<option value='2_80'>1 - 2 000 000</option>" +
                "<option value='2_90'>1 - 5 000 000</option>" +
                "<option value='2_100'>1 - 10 000 000</option>" +
                "<option value='2_110'>1 - 20 000 000</option>" +
                "<option value='2_120'>1 - 50 000 000</option>" +
                "<option value='2_130'>1 - 100 000 000</option>" +
                "<option value='2_140'>1 - 200 000 000</option>" +
                "<option value='2_150'>1 - 500 000 000</option>" +
                "<option value='2_160'>1 - MAX</option>");
        } else if (radioValue == 3) {
            $("#lavel_range").html("Daily Posts Ladder");
            $("#range").html("<option value='3_10'>3 sets: [1 - 100], [100 - 500], [500 - 1 000]</option>" +
                "<option value='3_20'>3 sets: [1 - 500], [500 - 1 000], [1 000 - 2 000]</option>" +
                "<option value='3_30'>3 sets: [1 - 1 000], [1 000 - 5 000], [5 000 - 10 000]</option>");
        } else {
            $("#lavel_range").html("Total Posts Ladder");
            $("#range").html("<option value='4_10'>3 sets: [1 - 10K], [10K - 20K], [20K - 50K]</option>" +
                "<option value='4_20'>3 sets: [1 - 50K], [50K - 100K], [100K - 500K]</option>" +
                "<option value='4_30'>3 sets: [10K - 100K], [100K - 500K], [500K - 1M]</option>" +
                "<option value='4_40'>3 sets: [100K - 500K], [500K - 1M], [1M - 5M]</option>");
        }
    }
</script>