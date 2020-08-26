<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.table-top').DataTable({
                    "aLengthMenu": [
                        [5, 10, 25, 50, 100, -1],
                        [5, 10, 25, 50, 100, "All"]
                    ],
                    "iDisplayLength": 10,
                    "language": {
                        search: ""
                    },
                    "aaSorting": [[ 1, "desc" ]]
                });
                $('.table-top').each(function() {
                    var datatable = $(this);
                    // SEARCH - Add the placeholder for Search and Turn this into in-line form control
                    var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
                    search_input.attr('placeholder', 'Search');
                    search_input.removeClass('form-control-sm');
                    // LENGTH - Inline-Form control
                    var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
                    length_sel.removeClass('form-control-sm');
                });
            });
        </script>

    </head>

<?php
if (isset($total) && sizeof($total) > 0)
{
    ?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3 mt-0">Top Hashtags</h4>
                    <p class="card-description mb-0">
                        Explore top performing and most popular hashtags
                    </p>
                    <div class="dropdown-divider mb-3"></div>
                    <div class="col-12">
                        <div class="row">
                            <div class="table-responsive">
                                <table id="order-listing" class="table table-top table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="min-width: 242px;">Hashtag</th>
                                        <th style="min-width: 80px;">Post Count</th>
                                        <th style="min-width: 92px;">APPD</th>
                                        <th style="min-width: 79px;">Score</th>
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
                                        $minlike9top = $row->intMinLike9Top;
                                        echo "<tr>";
                                        echo "<td>".$onehashtag."</td>";
                                        echo "<td>".number_format($postcount)."</td>";
                                        echo "<td>".number_format($appd)."</td>";
                                        $score = 0;
                                        if($appd != 0) $score = number_format(($dailypostcount / $appd), 2);
                                        echo "<td>" . $score . "</td>";
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