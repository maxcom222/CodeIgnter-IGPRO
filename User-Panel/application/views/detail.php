<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            var label = $("#label").val();
            var data = $("#data").val();
            var arr_label = label.split("@@");
            var arr_data = data.split("@@");
            var arr_correct = new Array();
            var arr_correct_label = new Array();
            for (var i = arr_data.length; i > 0; i--)
            {
                arr_correct_label.push(arr_label[i - 1]);
                arr_correct.push(arr_data[i - 1]);
            }
            var areaData = {
                labels: arr_correct_label,
                datasets: [{
                    label: 'Count',
                    data: arr_correct,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)'
                    ],
                    borderWidth: 1,
                    fill: true, // 3: no fill
                }]
            };

            var areaOptions = {
                plugins: {
                    filler: {
                        propagate: true
                    }
                },
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true,
                        }
                    }]
                }
            }
            if ($("#areaChart").length) {
                var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
                var areaChart = new Chart(areaChartCanvas, {
                    type: 'line',
                    data: areaData,
                    options: areaOptions
                });
            }
        });
    </script>
</head>
<!--<div class="row">-->
<!--    <div class="col-md-12 text-right">-->
<!--        <a href="javascript:;" onclick="back();" class="btn btn-success btn-sm mb-3" target='_self' style='color:white; min-height: 25px; vertical-align: middle; padding: 5px 1rem 0px 1rem'>Back to Search</a>-->
<!--    </div>-->
<!--</div>-->
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="">Returning search results for <?=$rows[0]->vchHashTags?></h4>
                <div class="dropdown-divider mb-4"></div>
                <div class="table-responsive">
                    <table id="order-listing" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th style="min-width: 190px;">Date</th>
                            <th style="min-width: 130px;">Count</th>
                            <th style="min-width: 92px;">APPD</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $array_label = "";
                        $array_data = "";
                        foreach ($rows as $row) {
                            $date = $row->dt_Date;
                            $count = $row->intPostCount;
                            $appd = $row->intDAPC;
                            echo "<tr>";
                            echo "<td>".explode(" ", $date)[0]."</td>";
                            echo "<td>".number_format($count)."</td>";
                            echo "<td>$appd</td>";
                            echo "</tr>";
                            $array_label .= $array_label==""?explode(" ", $date)[0]:"@@".explode(" ", $date)[0];
                            $array_data .= $array_data==""?($count):"@@".($count);
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
    echo '<input type="hidden" id = "label" value="'.$array_label.'" />';
    echo '<input type="hidden" id = "data" value="'.$array_data.'" />';
    ?>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="">Hashtag progression</h4>
                <div class="dropdown-divider mb-4"></div>
                <canvas id="areaChart"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
    function back() {
        // document.write(document.referrer);
        // window.history.back();
        // alert(window.history.previous.href);
        // history.go(-1);
    }
</script>