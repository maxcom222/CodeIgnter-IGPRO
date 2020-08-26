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
                                    '<a class="dropdown-item" href="javascript:;" onclick="openModal('+row.user_id+')"><i class="icon-pencil"></i>&nbsp;&nbsp;Edit</a>\n' +
                                    '<a class="dropdown-item" href="javascript:;" onclick="deleteRow('+row.user_id+','+1+')"><i class="icon-close"></i>&nbsp;&nbsp;Delete</a>\n' +
                                    '<div class="dropdown-divider"></div>\n' +
                                    '<a class="dropdown-item" href="javascript:;" onclick="changeStatus('+row.user_id+','+1+')"><i class="icon-like"></i>&nbsp;&nbsp;Approve</a>\n' +
                                    '<a class="dropdown-item" href="javascript:;" onclick="changeStatus('+row.user_id+','+2+')"><i class="icon-ban"></i>&nbsp;&nbsp;Suspend</a>\n' +
                                    '</div>\n' +
                                    '</div>';
                            }else if (row.status == 2)
                            {
                                content = '<div class="btn-group">\n' +
                                    '<button type="button" class="btn btn-blue btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="mdi mdi-chevron-down"></i></button>\n' +
                                    '<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);">\n' +
                                    '<a class="dropdown-item" href="javascript:;" onclick="openModal('+row.user_id+')"><i class="icon-pencil"></i>&nbsp;&nbsp;Edit</a>\n' +
                                    '<a class="dropdown-item" href="javascript:;" onclick="deleteRow('+row.user_id+','+1+')"><i class="icon-close"></i>&nbsp;&nbsp;Delete</a>\n' +
                                    '<div class="dropdown-divider"></div>\n' +
                                    '<a class="dropdown-item" href="javascript:;" onclick="changeStatus('+row.user_id+','+1+')"><i class="icon-like"></i>&nbsp;&nbsp;Approve</a>\n' +
                                    '<a class="dropdown-item" href="javascript:;" onclick="changeStatus('+row.user_id+','+2+')"><i class="icon-ban"></i>&nbsp;&nbsp;Suspend</a>\n' +
                                    '</div>\n' +
                                    '</div>';
                            }else
                            {
                                content = '<div class="btn-group">\n' +
                                    '<button type="button" class="btn btn-blue btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="mdi mdi-chevron-down"></i></button>\n' +
                                    '<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);">\n' +
                                    '<a class="dropdown-item" href="javascript:;" onclick="openModal('+row.user_id+')"><i class="icon-pencil"></i>&nbsp;&nbsp;Edit</a>\n' +
                                    '<a class="dropdown-item" href="javascript:;" onclick="deleteRow('+row.user_id+','+1+')"><i class="icon-close"></i>&nbsp;&nbsp;Delete</a>\n' +
                                    '<div class="dropdown-divider"></div>\n' +
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
                '<div class="col-sm-12 col-md-6">' +
                '<button type="button" onclick="addUser()" class="btn form-control-sm btn-primary btn-sm waves-effect waves-light">Add User</button>' +
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
    <div class="col-12">
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
    </div><!-- end col-->
</div>
<div id="custom-modal" class="modal-demo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">User Management</h4>
                <button type="button" class="close" data-dismiss="modal" onclick="Custombox.modal.close();" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger" id="alert_container" style="display: none" role="alert">
                            <i class="mdi mdi-block-helper mr-2"></i> <span id="alert_content"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name" class="control-label">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="John">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email" class="control-label">Email</label>
                            <input type="Email" class="form-control" id="email" value="" required="true" placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" id="div_password">
                            <label for="password" class="control-label">Pssword</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="dtreg" class="control-label">Date Registered</label>
                            <input type="text" readonly class="form-control" id="dtreg" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="status" class="control-label">Status</label>
                            <select class="custom-select" id="user_status">
                                <option value="0">pending</option>
                                <option value="1">approve</option>
                                <option value="2">suspend</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" onclick="Custombox.modal.close();">Close</button>
                <button type="button" id="btnsave" class="btn btn-info waves-effect waves-light" onclick="saveUser()"></button>
            </div>
            <input type="hidden" class="form-control" id="user_id">
        </div>
    </div>
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

    function deleteRow(id, curindex){
        var request = $.ajax({
            url: "deleteUser",
            type: "POST",
            data: {user_id : id},
            dataType: "html",
        });
        request.done(function(msg) {
            showNotify("Well Done!", "success", "Operation successful");
            datatable.ajax.reload();
        });
        request.fail(function(jqXHR, textStatus) {
            showNotify("Oh snap!", "error", "Change a few things up and try submitting again.");
        });
    }
    function saveUser() {
        var user_id = $('#user_id').val();
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var dtreg = $('#dtreg').val();
        var status = $('#user_status').val();
        if (name == "")
        {
            $('#alert_content').html("Please enter name");
            $('#alert_container').show();
            $('#name').focus();
            return;
        }
        if (!validateEmail(email))
        {
            $('#alert_content').html("Please enter correct email");
            $('#alert_container').show();
            $('#email').focus();
            return;
        }
        if (user_id == 0 && password == "")
        {
            $('#alert_content').html("Please enter password");
            $('#alert_container').show();
            $('#password').focus();
            return;
        }
        var request = $.ajax({
            url: "saveUser",
            type: "POST",
            data: {user_id : user_id, name : name, email : email, password : password, dtreg : dtreg, status : status},
            dataType: "html"
        });
        request.done(function(msg) {
            showNotify("Well Done!", "success", "Operation successful");
            datatable.ajax.reload();
        });
        request.fail(function(jqXHR, textStatus) {
            showNotify("Oh snap!", "error", "Change a few things up and try submitting again.");
        });
        Custombox.modal.close();
    }
    function addUser() {
        $('#alert_container').hide();
        $('.modal-title').html("Ass User");
        var modal = new Custombox.modal({
            content: {
                effect: 'fadein',
                delay:0,
                target: '#custom-modal'
            }
        });
        $('#div_password').show();
        $('#user_id').val(0);
        $('#name').val('');
        $('#email').val('');
        $('#password').val('');
        $('#dtreg').val('<?=date('Y-m-d h:i:s')?>');
        $('#user_status').val(1);
        $('#btnsave').html("Add User");
        modal.open();
        $('#email').val('');
        $('#password').val('');
    }
    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
    function openModal(id){
        $('.modal-title').html("Edit User");
        $('#alert_container').hide();
        var request = $.ajax({
            url: "oneUser",
            type: "POST",
            data: {user_id : id},
            dataType: "json"
        });
        request.done(function(msg) {
            var modal = new Custombox.modal({
                content: {
                    effect: 'fadein',
                    delay:0,
                    target: '#custom-modal'
                }
            });
            $('#div_password').hide();
            $('#user_id').val(msg.user_id);
            $('#name').val(msg.user_name);
            $('#email').val(msg.user_email);
            $('#dtreg').val(msg.created_at);
            $('#user_status').val(msg.status);
            $('#btnsave').html("Save Changes");
            modal.open();
        });
        request.fail(function(jqXHR, textStatus) {
            showNotify("Oh snap!", "error", "Change a few things up and try submitting again.");
        });
    }
</script>