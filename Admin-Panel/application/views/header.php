<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Igpro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?=base_url()?>assets/images/logo-sm.png">

    <!-- Plugins css -->
    <link href="<?=base_url()?>assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="<?=base_url()?>assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/css/app.min.css" rel="stylesheet" type="text/css" />


    <!-- datatable css -->
    <link href="<?=base_url()?>assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
    <!-- datatable css end -->
    <link href="assets/libs/jquery-toast/jquery.toast.min.css" rel="stylesheet" type="text/css" />

    <!-- Custom box css -->
    <link href="assets/libs/custombox/custombox.min.css" rel="stylesheet">
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
<body class="left-side-menu-dark">

<!-- Begin page -->
<div id="wrapper">

    <?php include("navbar-custom.php") ?>
    <?php include("left-sidebar.php") ?>
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                