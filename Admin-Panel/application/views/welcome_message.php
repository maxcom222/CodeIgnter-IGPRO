<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include("page-title.php") ?>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <SCRIPT>
        var datatable;
        $(document).ready(function () {
            datatable = $('#example').DataTable( {
                "processing": false,
                "search": false,
                "ajax": {
                    "url": "<?php base_url()?>getUsers?username=",
                    "dataSrc": "data"
                },
                "columns": [
                    {
                        "data": "status"
                    },
                    {
                        "data": "user_name"
                    },
                    {
                        "data": "user_email"
                    },
                    {
                        "width": "20%"
                    },
                    {
                        "data": "created_at"
                    }
                ],
                "columnDefs": [
                    {
                        "targets": 3,
                        "data": "user_name",
                        "render": function ( data, type, row, meta ) {
                            var content;
                            if (row.status == 1)
                            {
                                content = '<div id="div_'+row.user_id+'"><span class="badge badge-success"> Approved </span></div>';
                            }else if (row.status == 2)
                            {
                                content = '<div id="div_'+row.user_id+'"><span class="badge badge-danger">Suspended </span></div>';
                            }else
                            {
                                content = '<div id="div_'+row.user_id+'"><span class="badge badge-warning"> Pending </span></div>';
                            }
                            return content;
                        }
                    },
                    {
                        "targets": 0,
                        "data": "user_name",
                        "sortable": false,
                        "render": function ( data, type, row, meta ) {
                            var content;
                            if (row.status == 1)
                            {
                                content = '<div class="btn-group">\n' +
                                    '<button type="button" class="btn btn-blue btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="mdi mdi-chevron-down"></i></button>\n' +
                                    '<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);">\n' +
                                    '<a class="dropdown-item" href="javascript:;" onclick="changeStatus('+row.user_id+','+1+')"><i class="icon-like"></i>&nbsp;&nbsp;Approve</a>\n' +
                                    '<a class="dropdown-item" href="javascript:;" onclick="changeStatus('+row.user_id+','+2+')"><i class="icon-ban"></i>&nbsp;&nbsp;Suspend</a>\n' +
                                    '</div>\n' +
                                    '</div>';
                            }else if (row.status == 2)
                            {
                                content = '<div class="btn-group">\n' +
                                    '<button type="button" class="btn btn-blue btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="mdi mdi-chevron-down"></i></button>\n' +
                                    '<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);">\n' +
                                    '<a class="dropdown-item" href="javascript:;" onclick="changeStatus('+row.user_id+','+1+')"><i class="icon-like"></i>&nbsp;&nbsp;Approve</a>\n' +
                                    '<a class="dropdown-item" href="javascript:;" onclick="changeStatus('+row.user_id+','+2+')"><i class="icon-ban"></i>&nbsp;&nbsp;Suspend</a>\n' +
                                    '</div>\n' +
                                    '</div>';
                            }else
                            {
                                content = '<div class="btn-group">\n' +
                                    '<button type="button" class="btn btn-blue btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="mdi mdi-chevron-down"></i></button>\n' +
                                    '<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);">\n' +
                                    '<a class="dropdown-item" href="javascript:;" onclick="changeStatus('+row.user_id+','+1+')"><i class="icon-like"></i>&nbsp;&nbsp;Approve</a>\n' +
                                    '<a class="dropdown-item" href="javascript:;" onclick="changeStatus('+row.user_id+','+2+')"><i class="icon-ban"></i>&nbsp;&nbsp;Suspend</a>\n' +
                                    '</div>\n' +
                                    '</div>';
                            }
                            return content;
                        }
                    }
                ]
            } );
            $('#example_filter').children().children('input.form-control.form-control-sm').remove();
            $('#example_filter').children().remove();
            $('#example_filter').html(
                '<div class="row">' +
                '<div class="col-sm-12 col-md-6">' +
                '<div class="input-group">\n' +
                '<input type="text" class="form-control form-control-sm" id="usersearch" value="" placeholder="Search...">\n' +
                '</div>' +
                '</div>' +
                '</div>');
            $("#usersearch").keyup(function(e) {
                if (e.keyCode == 13)
                {
                    var filter = $('#usersearch').val();
                    datatable.ajax.url("<?php base_url()?>getUsers?username=" + filter).load();
                }
            });
        });
    </SCRIPT>
</head>
<div class="row">
    <div class="col-md-6 col-xl-4">
        <a href="/mngusers">
        <div class="widget-rounded-circle card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                        <i class="fe-user font-22 avatar-title text-primary"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="mt-1"><span data-plugin="counterup"><?=number_format($cntUser)?></span></h3>
                        <p class="text-muted mb-1 text-truncate">Registered Users</p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
        </a>
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-4">
        <a href="/mnghashtags">
        <div class="widget-rounded-circle card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                        <i class="fe-hash font-22 avatar-title text-success"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="mt-1"><span data-plugin="counterup"><?=number_format($cntHash)?></span></h3>
                        <p class="text-muted mb-1 text-truncate">Total Hashtags</p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
        </a>
    </div> <!-- end col-->

</div>

<div class="row">
    <div class="col-md-6 col-xl-8">
        <div class="card">
            <div class="card-body">


                <h4 class="header-title">Users</h4>
                <p class="text-muted font-13 mb-4">
                </p>
                <table id="example" class="table dt-responsive nowrap table-hover" style="width:100%; font-size: 16px">
                    <thead>
                    <tr>
                        <th>Action</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Date Registered</th>
                    </tr>
                    </thead>

                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div> <!-- end col-->
</div>


<script>
    function changeStatus(id, curVal){
        var request = $.ajax({
            url: "changUserStatus",
            type: "POST",
            data: {user_id : id, curval : curVal},
            dataType: "html",
        });
        var content;
        if (curVal == 1)
        {
            content = '<span class="badge badge-success"> Approved </span>';
        }else if (curVal == 2)
        {
            content = '<span class="badge badge-danger">Suspended </span>';
        }else
        {
            content = '<span class="badge badge-warning"> Pending </span>';
        }
        request.done(function(msg) {
            showNotify("Well Done!", "success", "Operation successful");
            $('#div_' + id).html(content);
        });
        request.fail(function(jqXHR, textStatus) {
            showNotify("Oh snap!", "error", "Change a few things up and try submitting again.");
        });
    }

</script>