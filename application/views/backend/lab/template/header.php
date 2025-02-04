<?php
$url = $this->uri->segment(2);
$url2 = $this->router->fetch_method();
$user = $this->session->userdata('logged_in_lab')['profile'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Curis Data System</title>

    <link rel="shortcut icon" href="<?php echo base_url('backend/assets/img/favicon.png'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('backend/assets/css/bootstrap.min.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('backend/assets/plugins/fontawesome/css/fontawesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('backend/assets/plugins/fontawesome/css/all.min.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('backend/assets/css/feather.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('backend/assets/plugins/select2/css/select2.min.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('backend/assets/plugins/owl-carousel/owl.carousel.min.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('backend/assets/plugins/daterangepicker/daterangepicker.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('backend/assets/css/style.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('backend/assets/plugins/datatables/datatables.min.css'); ?>">
    <link rel="stylesheet" href="<?php  echo base_url('backend/assets/code/css/jquery.ccpicker.css'); ?>">
    <style>
        .user-menu.nav > li > a {
            font-size: 15px;
            line-height: 60px;
        }
    </style>
</head>

<body>

    <div class="main-wrapper">

        <div class="header">

            <div class="header-left">
                <a href="<?php echo base_url('lab/Dashboard'); ?>" class="logo">
                    <img src="<?php echo base_url('backend/assets/img/logo.png'); ?>" alt="Logo">
                </a>
                <a href="<?php echo base_url('lab/Dashboard'); ?>" class="logo logo-small">
                    <img src="<?php echo base_url('backend/assets/img/logo-small.png'); ?>" alt="Logo" width="30" height="30">
                </a>
                <a href="javascript:void(0);" id="toggle_btn">
                    <i class="feather-chevrons-left"></i>
                </a>
            </div>


            <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a>


            <ul class="nav nav-tabs user-menu">

				<h6>Let Local Live</h6>
                <!-- <li class="nav-item dropdown noti-nav">
                    <a href="javascript:void(0)" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <i class="feather-bell"></i> <span class="badge"></span>
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            <a href="javascript:void(0)" class="clear-noti"><i class="feather-more-vertical"></i></a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="javascript:void(0)">
                                        <div class="media d-flex">
                                            <span class="avatar">
                                                <img class="avatar-img" alt="" src="<?php echo base_url('backend/assets/img/profiles/avatar-02.jpg'); ?>">
                                            </span>
                                            <div class="media-body">
                                                <h6>Travis Tremble <span class="notification-time">18.30 PM</span></h6>
                                                <p class="noti-details">Sent a amount of $210 for his Appointment <span
                                                        class="noti-title">Dr.Ruby perin </span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="javascript:void(0)">
                                        <div class="media d-flex">
                                            <span class="avatar">
                                                <img class="avatar-img" alt="" src="<?php echo base_url('backend/assets/img/profiles/avatar-05.jpg'); ?>">
                                            </span>
                                            <div class="media-body">
                                                <h6>Travis Tremble <span class="notification-time">12 Min Ago</span>
                                                </h6>
                                                <p class="noti-details"> has booked her appointment to <span
                                                        class="noti-title">Dr. Hendry Watt</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="javascript:void(0)">
                                        <div class="media d-flex">
                                            <div class="avatar">
                                                <img class="avatar-img" alt="" src="<?php echo base_url('backend/assets/img/profiles/avatar-03.jpg'); ?>">
                                            </div>
                                            <div class="media-body">
                                                <h6>Travis Tremble <span class="notification-time">6 Min Ago</span></h6>
                                                <p class="noti-details"> Sent a amount $210 for his Appointment <span
                                                        class="noti-title">Dr.Maria Dyen</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="javascript:void(0)">
                                        <div class="media d-flex">
                                            <div class="avatar avatar-sm">
                                                <img class="avatar-img" alt="" src="<?php echo base_url('backend/assets/img/profiles/avatar-06.jpg'); ?>">
                                            </div>
                                            <div class="media-body">
                                                <h6>Travis Tremble <span class="notification-time">8.30 AM</span></h6>
                                                <p class="noti-details"> Send a message to his doctor</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li> -->


                <li class="nav-item dropdown main-drop">
                    <a href="javascript:void(0)" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <img src="<?php echo base_url('uploads/user-icon.png'); ?>" alt="">
                            <span class="status online"></span>
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="avatar avatar-sm">
                                <img src="<?php echo base_url('uploads/user-icon.png'); ?>" alt="User Image"
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="user-text">
                                <h6> <?php echo ucwords($user->name);?></h6>
                                <p class="text-muted mb-0"><?php echo $user->email; ?></p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="<?php echo base_url('lab/Auth/edit_profile'); ?>"><i class="feather-edit me-1"></i> Edit Profile</a>
                        <a class="dropdown-item" href="<?php echo base_url('lab/Auth/logout'); ?>"><i class="feather-log-out me-1"></i> Logout</a>
                    </div>
                </li>

            </ul>

        </div>


        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="<?php if ($url=='Dashboard' && ($url2=='index' || $url2 == 'add_walkin_order' || $url2 == 'schedule_order_list' || $url2 == 'add_order')) { echo 'active'; } ?>">
                            <a href="<?php echo base_url('lab/Dashboard'); ?>"><i class="feather-grid"></i> <span>Dashboard</span></a>
                        </li>
                        <!-- <li class="<?php if (($url=='Order') && ($url2=='new_order' || $url2=='add_order_step_one' || $url2=='add_order_step_two')) { echo "active";} ?>">
                            <a href="<?php echo base_url('lab/Order/new_order'); ?>">
                                <i class="feather-user-plus"></i>
                                <span>New Order</span></a>
                        </li> -->
                        <li class="<?php if (($url=='Order') && ($url2=='schedule_patient' || $url2=='view_order')) { echo "active";} ?>">
                            <a href="<?php echo base_url('lab/Order/schedule_patient'); ?>"><i class="feather-package"></i> <span>Schedule Patient</span></a>
                        </li>
                        <li class="<?php if (($url=='Order') && ($url2=='payment_pending_patient' || $url2=='view_payment_pending_patient_order')) { echo "active";} ?>">
                            <a href="<?php echo base_url('lab/Order/payment_pending_patient'); ?>"><i class="feather-package"></i> <span>Payment Pending Patient</span></a>
                        </li>
                        <li class="<?php if (($url=='Order') && ($url2=='pending_patient' || $url2=='view_pending_order')) { echo "active";} ?>">
                            <a href="<?php echo base_url('lab/Order/pending_patient'); ?>"><i class="feather-package"></i> <span>Processing Patient</span></a>
                        </li>
                        <li class="<?php if (($url=='Order') && ($url2=='complete_patient' || $url2=='view_complete_order')) { echo "active";} ?>">
                            <a href="<?php echo base_url('lab/Order/complete_patient'); ?>"><i class="feather-users"></i> <span>Complete Patient</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>