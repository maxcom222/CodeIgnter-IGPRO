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
    <link rel="stylesheet" href="<?=base_url()?>template/vendors/iconfonts/simple-line-icon/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?=base_url()?>template/vendors/iconfonts/font-awesome/css/font-awesome.min.css" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?=base_url()?>template/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?=base_url()?>assets/images/logo-sm.png">


</head>
<script>
    function showNotify(heading, type, text){
        var icon, loaderBg;
        if (type == "success")
            loaderBg = "#5ba035";
        else if (type == "warning")
            loaderBg = "#da8609";
        else if (type == "error")
            loaderBg = "#bf441d";
        else if (type == "info")
            loaderBg = "#3b98b5";
        var p = {
            heading: heading,
            text: text,
            position: "top-right",
            loaderBg: loaderBg,
            icon: type,
            hideAfter: 3000,
            stack: 1
        };
        window.jQuery.toast().reset("all");
        window.jQuery.toast(p);
    }
</script>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include("navbar-custom.php") ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->

        <?php include("left-sidebar.php") ?>
        <!-- partial:partials/_sidebar.html -->

        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

                <!-- container-scroller -->


