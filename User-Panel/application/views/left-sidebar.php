<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <span class="menu-group" style="padding:0.75rem 1.25rem 0.75rem 1.25rem">You</span>
            <!--            <a class="nav-link" data-toggle="collapse" href="#ui-you" aria-expanded="true" aria-controls="ui-you">-->
            <!--                <span class="menu-title">You</span>-->
            <!--                <i class="menu-arrow"></i>-->
            <!--            </a>-->
            <div class="collapse show" id="ui-you">
                <ul class="nav flex-column sub-menu" style="padding: 0.25rem 0 0 1.75rem">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url()?>">
                            <i class="mdi mdi-view-dashboard-outline menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url()?>account">
                            <i class="mdi mdi-airplay menu-icon"></i>
                            <span class="menu-title">Account Plan</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <span class="menu-group" style="padding:0.75rem 1.25rem 0.75rem 1.25rem">Tags</span>
            <div class="collapse show" id="ui-tags">
                <ul class="nav flex-column sub-menu" style="padding: 0.25rem 0 0 1.75rem">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url()?>search">
                            <i class="fa fa-search menu-icon" style="color: grey"></i>
                            <span class="menu-title">Search</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url()?>mass">
                            <i class="fa fa-search-plus menu-icon" style="color: grey"></i>
                            <span class="menu-title">Mass Search</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url()?>tophashtags">
                            <i class="fa fa-flash text-center menu-icon" style="width:18px;color: grey"></i>
                            <span class="menu-title">Top Hashtags</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
