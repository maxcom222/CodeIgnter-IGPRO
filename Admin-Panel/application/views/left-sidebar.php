<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="<?=base_url()?>">
                        <i class="fe-airplay"></i>
                        <span class="badge badge-success badge-pill float-right"></span>
                        <span> Dashboards </span>
                    </a>
                </li>

                <li>
                    <a href="<?=base_url().'mngusers'?>">
                        <i class="icon-people"></i>
                        <span> Users </span>
                    </a>
                </li>

                <li>
                    <a href="<?=base_url().'mnghashtags'?>">
                        <i class="fe-hash"></i>
                        <span> Hashtags </span>
                    </a>
                </li>

                <li>
                    <a href="<?=base_url().'subscriptions'?>">
                        <i class="fe-briefcase"></i>
                        <span> Subscriptions </span>
                    </a>
                </li>


            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
