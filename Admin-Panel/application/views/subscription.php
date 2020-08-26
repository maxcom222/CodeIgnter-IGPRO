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
                    "url": "<?php base_url()?>getSubscriptions?username=",
                    "dataSrc": "data"
                },
                "columns": [
                    {
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "item_name"
                    },
                    {
                        "data": "paid_amount",
                        "render": function ( data ) {
                            return "$ " + data;
                        }
                    },
                    {
                        "data": "created"
                    },
                    {
                        "data": "dt_expirydate"
                    }
                ],
                "columnDefs": [
                    {
                        "targets": 0,
                        "data": "user_name",
                        "sortable": false,
                        "render": function ( data, type, row, meta ) {
                            var content;
                            content = '<div class="btn-group">\n' +
                                '<button type="button" class="btn btn-blue btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="mdi mdi-chevron-down"></i></button>\n' +
                                '<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);">\n' +
                                '<a class="dropdown-item" href="javascript:;" onclick="openModal('+row.id+')"><i class="icon-pencil"></i>&nbsp;&nbsp;Edit</a>\n' +
                                '<a class="dropdown-item" href="javascript:;" onclick="deleteRow('+row.id+','+1+')"><i class="icon-close"></i>&nbsp;&nbsp;Delete</a>\n' +
                                '</div>\n' +
                                '</div>';
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
                // '<button type="button" onclick="addUser()" class="btn form-control-sm btn-primary btn-sm waves-effect waves-light">Add Subscription</button>' +
                '</div>' +
                '</div>');
            $("#usersearch").keyup(function(e) {
                if (e.keyCode == 13)
                {
                    var filter = $('#usersearch').val();
                    datatable.ajax.url("<?php base_url()?>getSubscriptions?username=" + filter).load();
                }
            });
            $("#datetime-datepicker").flatpickr({
                enableTime: !0,
                dateFormat: "Y-m-d H:i"
            });
        });
    </SCRIPT>
</head>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Subscriptions</h4>
                <p class="text-muted font-13 mb-4">
                </p>
                <table id="example" class="table dt-responsive nowrap table-hover" style="width:100%; font-size: 16px">
                    <thead>
                    <tr>
                        <th>Action</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Plan Name</th>
                        <th>Price</th>
                        <th>Start Date</th>
                        <th>Expiry Date</th>
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
                        <div class="form-group mb-3">
                            <label>Date &amp; Time</label>
                            <input type="text" id="datetime-datepicker" class="form-control flatpickr-input active" placeholder="Date and Time" readonly="readonly">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" onclick="Custombox.modal.close();">Close</button>
                <button type="button" id="btnsave" class="btn btn-info waves-effect waves-light" onclick="saveExpiry()">Save ExpiryDate</button>
            </div>
            <input type="hidden" class="form-control" id="id">
        </div>
    </div>
</div>

        <!-- Plugins js-->
        <script src="assets/libs/flatpickr/flatpickr.min.js"></script>
        <script src="assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
        <script src="assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>

        <!-- Init js-->

<script>
    function deleteRow(id, curindex){
        var request = $.ajax({
            url: "deleteSubscription",
            type: "POST",
            data: {id : id},
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
    function openModal(id){
        $('.modal-title').html("Edit ExpiryDate");
        $('#alert_container').hide();
        var request = $.ajax({
            url: "Subscription/getExpiryDate",
            type: "POST",
            data: {id : id},
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
            $('#datetime-datepicker').val(msg.dt_expirydate);
            $('#id').val(id);
            $("#datetime-datepicker").flatpickr({
                enableTime: !0,
                dateFormat: "Y-m-d H:i",
                defaultDate : msg.dt_expirydate
            });
            modal.open();
        });
        request.fail(function(jqXHR, textStatus) {
            showNotify("Oh snap!", "error", "Change a few things up and try submitting again.");
        });
    }
    function saveExpiry() {
        var dttime = $('#datetime-datepicker').val();
        var id = $('#id').val();
        var request = $.ajax({
            url: "Subscription/saveExpiryDate",
            type: "POST",
            data: {dt_expirydate : dttime, id : id},
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
</script>