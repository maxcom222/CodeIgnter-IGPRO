<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Topbar Start -->
<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="<?php
                $imagePath = "assets/images/users/admin_" . $this->session->userdata("admin_id") . ".jpg";
                if (!file_exists($imagePath))
                    $imagePath = "assets/images/users/user.png";
                echo $imagePath;
                ?>" alt="user-image" class="rounded-circle">
                <span class="pro-user-name ml-1">
                    <?=$this->session->userdata("username")?> <i class="mdi mdi-chevron-down"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome !</h6>
                </div>

                <!-- item-->
                <a href="profile" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>My Profile</span>
                </a>

                <!-- item-->
                <a href="<?=base_url().'logout'?>" class="dropdown-item notify-item">
                    <i class="fe-log-out"></i>
                    <span>Logout</span>
                </a>

            </div>
        </li>

    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="<?=base_url()?>" class="logo text-center">
            <span class="logo-lg">
                <img src="assets/images/dashboard-logoadmin.png" alt="" height="40">
                <!-- <span class="logo-lg-text-light">UBold</span> -->
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile waves-effect waves-light">
                <i class="fe-menu"></i>
            </button>
        </li>
    </ul>
</div>
<!-- end Topbar -->

