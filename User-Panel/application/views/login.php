<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Igpro</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?=base_url()?>template/vendors/iconfonts/mdi/font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?=base_url()?>template/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?=base_url()?>template/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?=base_url()?>template/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?=base_url()?>assets/images/logo-sm.png" />
    <style>
        .auth-form-transparent .brand-logo img {
            width: 100%;
            max-width: 100%;
            height: calc(100%/2.3);
            margin: auto;
            vertical-align: middle;
        }
    </style>
</head>

<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
            <div class="row flex-grow">
                <div class="col-lg-6 d-flex align-items-center justify-content-center">
                    <div class="auth-form-transparent text-left p-3">
                        <div class="brand-logo">
                            <img src="<?=base_url()?>assets/images/igpro-logo.png" alt="logo">
                        </div>
                        <h4>Welcome back!</h4>
                        <h6 class="font-weight-light">Happy to see you again!</h6>
                        <p class="text-muted mb-4 mt-3">
                            <?php
                            if ($error == 1) { echo "Too Many Login Attempts"; }
                            if ($error == 2) { echo "Invalid Login Credentials."; }
                            ?>
                        </p>
                        <form class="pt-3" action="<?=base_url()?>login" method="POST">
                            <div class="form-group">
                                <label for="user_email">Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                      <span class="input-group-text bg-transparent border-right-0">
                                        <i class="mdi mdi-account-outline text-primary"></i>
                                      </span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg border-left-0" id="user_email" name="user_email" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_password">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                      <span class="input-group-text bg-transparent border-right-0">
                                        <i class="mdi mdi-lock-outline text-primary"></i>
                                      </span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg border-left-0" id="user_password" name="user_password" placeholder="Password">
                                </div>
                            </div>
                            <div class="my-2 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input">
                                        Keep me signed in
                                    </label>
                                </div>
                                <a href="#" class="auth-link text-black">Forgot password?</a>
                            </div>
                            <div class="my-3">
                                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">LOGIN</button>
                            </div>
                            <div class="mb-2 d-flex">
                                <button type="button" class="btn btn-facebook auth-form-btn flex-grow mr-1">
                                    <i class="mdi mdi-facebook mr-2"></i>Facebook
                                </button>
                                <button type="button" class="btn btn-google auth-form-btn flex-grow ml-1">
                                    <i class="mdi mdi-google mr-2"></i>Google
                                </button>
                            </div>
                            <div class="text-center mt-4 font-weight-light">
                                Don't have an account? <a href="<?=base_url().'register'?>" class="text-primary">Create</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 login-half-bg d-flex flex-row">
                    <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2019  All rights reserved.</p>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="<?=base_url()?>template/vendors/js/vendor.bundle.base.js"></script>
<script src="<?=base_url()?>template/vendors/js/vendor.bundle.addons.js"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="<?=base_url()?>template/js/off-canvas.js"></script>
<script src="<?=base_url()?>template/js/hoverable-collapse.js"></script>
<script src="<?=base_url()?>template/js/template.js"></script>
<script src="<?=base_url()?>template/js/settings.js"></script>
<script src="<?=base_url()?>template/js/todolist.js"></script>
<!-- endinject -->
</body>

</html>
