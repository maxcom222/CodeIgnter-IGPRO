<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include("page-title.php") ?>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <SCRIPT>
        var hashtable;
        $(document).ready(function () {
            hashtable = $('#hashtable').DataTable( {
                "processing": false,
                "search": false,
                "sortable": false,
                "ajax": {
                    "url": "<?php base_url()?>gethashtags?hashtag=",
                    "dataSrc": "data"
                },
                "columns": [
                    {
                    },
                    {
                        "data": "vchHashTags",
                        "sortable": false,
                        "render": function ( data ) {
                            return data.substring(1, data.length);
                        }
                    },
                    {
                        "data": "intPostCount",
                        "sortable": false,
                        "render": function ( data ) {
                            return data==0?'':data;
                        }
                    },
                    {
                        "data": "intDAPC",
                        "sortable": false,
                        "render": function ( data ) {
                            return data==0?'':data;
                        }
                    },
                    {
                        "data": "intMinLike9Top",
                        "sortable": false,
                        "render": function ( data ) {
                            var content;
                            content = number_format(data / 100, 2)==0.00?'':number_format(data / 100, 2);
                            return content;
                        }
                    },
                    {
                        "data": "intMaxLike9Top",
                        "sortable": false,
                        "render": function ( data ) {
                            return data==0?'':data;
                        }
                    },
                    {
                        "data": "intMinLike9Top",
                        "sortable": false,
                        "render": function ( data ) {
                            return data==0?'':data;
                        }
                    },
                    {
                        "data": "intAverageLike",
                        "sortable": false,
                        "render": function ( data ) {
                            return data==0?'':data;
                        }
                    },
                    {
                        "data": "intPostLikePerHour",
                        "sortable": false,
                        "render": function ( data ) {
                            return data==0?'':data;
                        }
                    },
                    {
                        "data": "intMinPostLikePerHour",
                        "sortable": false,
                        "render": function ( data ) {
                            return data==0?'':data;
                        }
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
                                '<a class="dropdown-item" href="javascript:;" onclick="deleteRow('+row.intID+','+1+')"><i class="icon-close"></i>&nbsp;&nbsp;Delete</a>\n' +
                                '</div>\n' +
                                '</div>';
                            return content;
                        }
                    }
                ]
            } );
            $('#hashtable_filter').children().children('input.form-control.form-control-sm').remove();
            $('#hashtable_filter').children().remove();
            $('#hashtable_filter').html(
                '<div class="row">' +
                '<div class="col-sm-12 col-md-6">' +
                '<div class="input-group">\n' +
                '<input type="text" class="form-control form-control-sm" id="hashsearch" placeholder="Search...">\n' +
                '</div>' +
                '</div>' +
                '<div class="col-sm-12 col-md-6">' +
                '<button type="button" onclick="addHashTag()" class="btn btn-primary form-control-sm btn-sm waves-effect waves-light">Add Hashtag</button>' +
                '</div>' +
                '</div>');
            $("#hashsearch").keyup(function(e) {
                if (e.keyCode == 13)
                {
                    var filter = $('#hashsearch').val();
                    hashtable.ajax.url("<?php base_url()?>gethashtags?hashtag=" + filter).load();
                }
            });
        });
    </SCRIPT>
</head>
<div class="row">
    <div class="col-12">
        <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" id="alert_maincontainer" style="display: none" role="alert">
            <button type="button" class="close" onclick="$('#alert_maincontainer').hide();" >
                <span aria-hidden="true">×</span>
            </button>
            <span id="alert_maincontent"></span>
        </div>
        <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" id="alert_maincontainer_danger" style="display: none" role="alert">
            <button type="button" class="close" onclick="$('#alert_maincontainer_danger').hide();" >
                <span aria-hidden="true">×</span>
            </button>
            <span id="alert_maincontent_danger"></span>
        </div>
        <div class="alert alert-warning alert-dismissible bg-warning text-white border-0 fade show" id="alert_maincontainer_warning" style="display: none" role="alert">
            <button type="button" class="close" onclick="$('#alert_maincontainer_warning').hide();" >
                <span aria-hidden="true">×</span>
            </button>
            <span id="alert_maincontent_warning"></span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Hashtags</h4>
                <p class="text-muted font-13 mb-4">
                </p>
                <table id="hashtable" class="table dt-responsive table-hover" style="width:100%; font-size: 16px">
                    <thead>
                    <tr>
                        <th>Action</th>
                        <th>Hashtag</th>
                        <th>Total Posts</th>
                        <th>APPD</th>
                        <th>Score Prediction</th>
                        <th>Max Like<br> In top9</th>
                        <th>Min Like<br> In top9</th>
                        <th>Average Likes<br> In top9</th>
                        <th>Post Likes<br> Per Hour</th>
                        <th>Minimum top9 likes<br> per hour</th>
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
                            <label for="name" class="control-label">Hashtag</label>
                            <input type="text" class="form-control" id="hashtag" placeholder="ex. instagram, love, ...">
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" onclick="Custombox.modal.close();">Close</button>
                <button type="button" id="btnsave" class="btn btn-info waves-effect waves-light" onclick="saveHashtag()"></button>
            </div>
        </div>
    </div>
</div>
<script>

    function deleteRow(id, curindex){
        var request = $.ajax({
            url: "deleteHashtag",
            type: "POST",
            data: {intID : id},
            dataType: "html",
        });
        request.done(function(msg) {
            showNotify("Well Done!", "success", "Operation successful");
            hashtable.ajax.reload();
        });
        request.fail(function(jqXHR, textStatus) {
            showNotify("Oh snap!", "error", "Change a few things up and try submitting again.");
        });
    }
    function saveHashtag() {
        var hashtag = $('#hashtag').val().replace(' ', '');
        var temp = hashtag.replace(',', '');
        if (temp == "")
        {
            $('#alert_content').html("Please enter hashtag");
            $('#alert_container').show();
            $('#hashtag').val('');
            $('#hashtag').focus();
            return;
        }
        var request = $.ajax({
            url: "addHashTags",
            type: "POST",
            data: {hashid : 0, hashtag : hashtag},
            dataType: "json"
        });
        request.done(function(msg) {
            Custombox.modal.close();
            if (msg.exists != "")
            {
                $('#alert_maincontent_warning').html("Already exists: <B>" + msg.exists + "</B>.");
                $('#alert_maincontainer_warning').show();
            }
            if (msg.created != "")
            {
                $('#alert_maincontent').html("Note: We couldn't find any results for hashtags: <B>"
                    + msg.created + "</B>. Please check again in 15 minutes while we add those hashtags to the database. ");
                $('#alert_maincontainer').show();
            }
            if (msg.error != "")
            {
                $('#alert_maincontent_danger').html("Error: <B>" + msg.error + "</B>.");
                $('#alert_maincontainer_danger').show();
            }
            hashtable.ajax.reload();
        });
        request.fail(function(jqXHR, textStatus) {
            $('#alert_content').html("Change a few things up and try submitting again");
            $('#alert_container').show();
            Custombox.modal.close();
        });
    }
    function addHashTag() {
        $('#alert_container').hide();
        $('.modal-title').html("Add Hashtag");
        var modal = new Custombox.modal({
            content: {
                effect: 'fadein',
                delay:0,
                target: '#custom-modal'
            }
        });
        $('#div_password').show();
        $('#hashtag').val('');
        $('#btnsave').html('Save Hashtag');
        modal.open();
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
    function number_format (number, decimals, decPoint, thousandsSep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
        var n = !isFinite(+number) ? 0 : +number
        var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
        var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
        var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
        var s = ''

        var toFixedFix = function (n, prec) {
            if (('' + n).indexOf('e') === -1) {
                return +(Math.round(n + 'e+' + prec) + 'e-' + prec)
            } else {
                var arr = ('' + n).split('e')
                var sig = ''
                if (+arr[1] + prec > 0) {
                    sig = '+'
                }
                return (+(Math.round(+arr[0] + 'e' + sig + (+arr[1] + prec)) + 'e-' + prec)).toFixed(prec)
            }
        }

        // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec).toString() : '' + Math.round(n)).split('.')
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || ''
            s[1] += new Array(prec - s[1].length + 1).join('0')
        }

        return s.join(dec)
    }
</script>