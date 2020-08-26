<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#hashtags").val($("#hashtags_1").val());
                $("#average").val($("#average_1").val());
            });
        </script>
    </head>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="">Mass Search</h4>
                    <p class="card-description">
                        Search for up to 30 hashtags at once
                    </p>
                    <input type="hidden" id="hashtags_1" value="<?=isset($hashtags)?$hashtags:'';?>" />
                    <input type="hidden" id="average_1" value="<?=isset($average)?$average:'';?>" />
                    <form class="forms-sample" action="<?=base_url()?>mass/result" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="hashtags">Hashtags: </label>
                            <textarea rows="5" cols="5" class="form-control" id="hashtags" name="hashtags" placeholder="Enter the hashtags you want to query here, seperated by spaces"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="average">Your # of likes per post: </label>
                            <input type="text" class="form-control" id="average" name="average" placeholder="Optional - Average number of likes per post you usually get">
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
if (isset($total) && sizeof($total) > 0)
{
    ?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-0 mt-0">Displaying <?=sizeof($total)?> results</h4>
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
                                    foreach ($total as $row) {
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
                                        echo "<td>".$score. "</td>";
                                        echo "<td>".number_format($maxlike9top). "</td>";
                                        echo "<td>".number_format($minlike9top). "</td>";
                                        echo "<td>".number_format($avglike). "</td>";
                                        echo "<td>".number_format($likeperhour). "</td>";
                                        echo "<td>".number_format($minlike9top - rand($minlike9top / 8, $minlike9top / 3)). "</td>";
                                        echo "<td><a href=\"".base_url()."search/detail/".$intHashTagID."\" class=\"btn btn-success btn-sm\" target='_blank' style='color:white; min-height: 25px; vertical-align: middle; padding: 5px 1rem 0px 1rem'>Analyse</a></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>