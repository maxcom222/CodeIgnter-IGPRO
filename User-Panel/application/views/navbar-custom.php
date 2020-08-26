<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<head>
    <style>
        .navbar .navbar-brand-wrapper .navbar-brand img {
            width: calc(255px - 130px);
            max-width: 100%;
            height: calc(calc(255px - 130px)/2.3);
            margin: auto;
            vertical-align: middle;
        }
        .navbar .navbar-brand-wrapper .navbar-brand.brand-logo-mini img {
            width: 34px;
            max-width: 100%;
            height: 30px;
            margin: auto;
            vertical-align: middle;
        }
        @media (min-width: 992px) {
            .sidebar-icon-only .navbar .navbar-brand-wrapper {
                width: 0px;
            }

            .sidebar-icon-only .navbar .navbar-brand-wrapper .brand-logo {
                display: none;
            }

            .sidebar-icon-only .navbar .navbar-brand-wrapper .brand-logo-mini {
                display: inline-block;
            }

            .sidebar-icon-only .navbar .navbar-menu-wrapper {
                width: 100%;
            }

            .sidebar-icon-only .sidebar {
                width: 0px;
                display: none;
            }

            .sidebar-icon-only .sidebar .nav {
                width: 0px;
                display: none;
            }

            .sidebar-icon-only .main-panel {
                width: 100%;
            }
        }
    </style>
</head>
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="<?=base_url()?>"><img src="<?=base_url()?>assets/images/igpro-logo.png"/></a>
        <!--        <a class="navbar-brand brand-logo-mini" href="--><?//=base_url()?><!--"><img src="--><?//=base_url()?><!--assets/images/logo-sm.png" alt="logo"/></a>-->
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <img src="<?php
                    $imagePath = base_url()."assets/images/users/user_" . $this->session->userdata("user_id") . ".jpg";
                    //                    if (!file_exists($imagePath)){
                    //                        $imagePath = base_url()."assets/images/users/user.png";
                    //                    }
                    echo $imagePath;
                    ?>" alt="profile"/>
                    <span class="pro-user-name ml-1">
                        <?=$this->session->userdata("user_name")?> <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a href="<?=base_url()?>profile" class="dropdown-item">
                        <i class="mdi mdi-settings text-primary"></i>
                        My Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="<?=base_url().'logout'?>" class="dropdown-item">
                        <i class="mdi mdi-logout text-primary"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
<!-- end Topbar -->
