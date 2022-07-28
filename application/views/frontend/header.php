<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Curis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <link href="<?php echo base_url('frontend/assets/img/favicon.png'); ?>" rel="icon">

    <link rel="stylesheet" href="<?php echo base_url('frontend/assets/css/bootstrap.min.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('frontend/assets/plugins/fontawesome/css/fontawesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('frontend/assets/plugins/fontawesome/css/all.min.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('frontend/assets/css/feather.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('frontend/assets/css/aos.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('frontend/assets/css/style.css'); ?>">
</head>

<body class="about-page">

    <div class="main-wrapper">

    <header class="header">
        <nav class="navbar navbar-expand-lg header-nav">
            <div class="navbar-header">
                <a id="mobile_btn" href="javascript:void(0);">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>
                <a href="<?php echo base_url('Home'); ?>" class="navbar-brand logo">
                    <img src="<?php echo base_url('frontend/assets/img/logo.png'); ?>" class="img-fluid" alt="Logo">
                </a>
            </div>
            <div class="main-menu-wrapper">
                <div class="menu-header">
                    <a href="<?php echo base_url('Home'); ?>" class="menu-logo">
                        <img src="<?php echo base_url('frontend/assets/img/logo.png'); ?>" class="img-fluid" alt="Logo">
                    </a>
                    <a id="menu_close" class="menu-close" href="javascript:void(0);">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
                <ul class="main-nav">
                    <li><a href="<?php echo base_url('Home'); ?>">Home</a>
                    </li>
                    <li><a href="<?php echo base_url('About'); ?>" >About</a>
                    </li>
                    <li><a href="<?php echo base_url('Contact'); ?>">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>