<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- start page title -->
<div class="d-flex flex-row align-items-lg-center" style="margin-bottom: 10px;">
    <!--    <div style="font-size: 60px; background-color: #4BF2C9; color: white; border-radius: 5px; box-shadow: 5px 5px 5px #B3B3B3;-->
    <!--         max-width: 58px;max-height: 65px; padding: 0px 0px 0px 0px;">-->
    <!--        <i class="mdi mdi-view-dashboard-outline"></i>-->
    <!--    </div>-->
    <div class="ml-3">
        <h1 class=""  style="font-size: 30px;"><?php echo $page_title; ?></h1>
        <p class="mt-2 text-muted card-text">Hi, <B><?=$this->session->userdata("user_name")?></B>. Welcome back to the IGPRO Dashboard!</p>
    </div>
</div>
<!-- end page title -->