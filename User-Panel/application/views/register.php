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
                        <h4>New here?</h4>
                        <h6 class="font-weight-light">Join us today! It takes only few steps</h6>
                        <?php if (isset($error)){ ?>
                            <div class="alert alert-danger" role="alert">
                                <i class="mdi mdi-block-helper mr-2"></i>
                                <?php
                                if ($error == 1) echo "please enter your name";
                                if ($error == 2) echo "please enter your password";
                                if ($error == 3) echo "please enter your email";
                                if ($error == 4) echo "already have account";
                                if ($error == 5) echo "the password doesn't match";
                                ?>
                            </div>
                        <?php } ?>
                        <form class="pt-3" action="<?=base_url().'register/new'?>" method="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                      <span class="input-group-text bg-transparent border-right-0">
                                        <i class="mdi mdi-account-outline text-primary"></i>
                                      </span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg border-left-0" id="user_name" name="user_name" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                      <span class="input-group-text bg-transparent border-right-0">
                                        <i class="mdi mdi-email-outline text-primary"></i>
                                      </span>
                                    </div>
                                    <input type="email" id="user_email" name="user_email" class="form-control form-control-lg border-left-0" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                      <span class="input-group-text bg-transparent border-right-0">
                                        <i class="mdi mdi-lock-outline text-primary"></i>
                                      </span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg border-left-0" id="user_password" name="user_password" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                      <span class="input-group-text bg-transparent border-right-0">
                                        <i class="mdi mdi-lock-outline text-primary"></i>
                                      </span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg border-left-0" id="user_confirm" name="user_confirm" placeholder="Password">
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input">
                                        I agree to all Terms & Conditions
                                    </label>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                            </div>
                            <div class="text-center mt-4 font-weight-light">
                                Already have an account? <a href="<?=base_url()?>login" class="text-primary">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 register-half-bg d-flex flex-row">
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