<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include("page-title.php") ?>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <SCRIPT>
        var datatable;
        $(document).ready(function () {
        });
    </SCRIPT>
    <style type="text/css">
        .file {
            position: relative;
            overflow: hidden;
            padding: 0.45rem 0.9rem;
            font-size: 0.875rem;
        }
        .inputfile {
            position: absolute;
            opacity: 0;
            right: 0;
            top: 0;
        }
    </style>
</head>
<div class="row">
    <div class="col-md-6 col-xl-6">
        <div class="card-box">
            <ul class="nav nav-pills navtab-bg nav-justified">
                <li class="nav-item">
                    <a href="#profile" data-toggle="tab" aria-expanded="false" class="nav-link active show">
                        My Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#change" data-toggle="tab" aria-expanded="true" class="nav-link">
                        Password
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show" id="profile">
                    <form action="<?=base_url()?>chageProfile" method="post" enctype="multipart/form-data" class="comment-area-box mt-2 mb-3">
                        <div class="form-group text-center">
                            <img src="<?=$imagePath?>" id="myphoto" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                            <h4 class="mb-0"><?=$name?></h4>
                        </div>
                        <div class="form-group col-8 offset-2">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?=$email?>" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">Please enter your email</small>
                        </div>
                        <div class="form-group col-8 offset-2">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?=$name?>" placeholder="Enter name">
                        </div>
                        <div class="form-group col-8 offset-2">
                            <div class="file btn btn-lg btn-primary">
                                Change photo
                                <input type="file" class="inputfile" onchange="previewImage(this)" name="file"/>
                            </div>
                        </div>
                        <div class="form-group row col-4 offset-6">
                            <button type="submit" class="btn btn-primary waves-effect waves-light col-12">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="change">
                    <form action="<?=base_url()?>changePassword" method="post" enctype="multipart/form-data" class="comment-area-box mt-2 mb-3">
                        <div class="form-group col-8 offset-2">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp" placeholder="Enter password">
                        </div>
                        <div class="form-group col-8 offset-2">
                            <label for="confirm">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm" name="confirm" aria-describedby="emailHelp" placeholder="Confirm password">
                        </div>
                        <div class="form-group row col-4 offset-6">
                            <button type="button" onclick="savePassword()" class="btn btn-primary waves-effect waves-light col-12">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(e)
        {
            document.querySelector("#myphoto").src = e.target.result;

            Session("reload") = "yes";
        }
        reader.readAsDataURL(event.files[0]);
    }
    function savePassword() {
        if ($('#password').val() != $('#confirm').val())
        {
            showNotify("Warning", "warning", "Please enter correct confirm password");
            return;
        }
        var request = $.ajax({
            url: "<?=base_url()?>chagePassword",
            type: "POST",
            data: {password : $('#password').val()},
            dataType: "html"
        });

        request.done(function(msg) {
            if(msg == "success"){
                showNotify("Well Done!", "success", "Operation successful");
            }else{
                showNotify("Oh snap!", "error", "Change a few things up and try submitting again.");
            }
        });
        request.fail(function(jqXHR, textStatus) {
            showNotify("Oh snap!", "error", "Change a few things up and try submitting again.");
        });
    }
</script>