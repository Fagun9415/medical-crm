<?php
$url = $this->uri->segment(2);
$url2 = $this->router->fetch_method();
$user = $this->session->userdata('logged_in_patient')['profile'];
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
                <a href="<?php echo base_url('patient/Dashboard'); ?>" class="logo">
                    <img src="<?php echo base_url('backend/assets/img/logo.png'); ?>" alt="Logo">
                </a>
                <a href="<?php echo base_url('patient/Dashboard'); ?>" class="logo logo-small">
                    <img src="<?php echo base_url('backend/assets/img/logo-small.png'); ?>" alt="Logo" width="30" height="30">
                </a>
                <?php if ($url2 == "family_list") { } else { ?>
                <a href="javascript:void(0);" id="toggle_btn">
                    <i class="feather-chevrons-left"></i>
                </a>
                <?php } ?>
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
                                    <a href="#">
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
                                    <a href="#">
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
                                    <a href="#">
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
                                    <a href="#">
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
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
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
                        <a class="dropdown-item" href="<?php echo base_url('patient/Auth/edit_profile'); ?>"><i class="feather-edit me-1"></i> Edit Profile</a>
                        <a class="dropdown-item" href="<?php echo base_url('patient/Auth/logout'); ?>"><i class="feather-log-out me-1"></i> Logout</a>
                    </div>
                </li>

            </ul>

        </div>

        <?php if ($url2 == "family_list") { } else { ?>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="<?php if ($url=='Dashboard' && $url2=='family_list') { echo 'active'; } ?>">
                            <a href="<?php echo base_url('patient/Dashboard/family_list'); ?>"><i class="feather-users"></i> <span>Change Profile</span></a>
                        </li>
                        <li class="<?php if ($url=='Dashboard' && $url2=='index') { echo 'active'; } ?>">
                            <a href="<?php echo base_url('patient/Dashboard'); ?>"><i class="feather-grid"></i> <span>Dashboard</span></a>
                        </li>
                        <li class="<?php if (($url=='Order') && ($url2=='lab_order_alert' || $url2=='add_lab_order' || $url2=='active_lab_order_detail')) { echo "active";} ?>">
                            <a href="<?php echo base_url('patient/Order/lab_order_alert'); ?>"><i class="feather-user-plus"></i> <span>Lab Order Alert</span></a>
                        </li>
                        <li class="<?php if (($url=='Order') && ($url2=='pharmacy_order_alert' || $url2=='add_pharmacy_order' || $url2=='pharmacy_order_alert_detail')) { echo "active";} ?>">
                            <a href="<?php echo base_url('patient/Order/pharmacy_order_alert'); ?>"><i class="feather-package"></i> <span>Pharmacy Order Alert</span></a>
                        </li>
                        <li class="<?php if (($url=='Order') && ($url2=='onprocess_lab_order_alert' || $url2=='onprocess_lab_order_detail' )) { echo "active";} ?>">
                            <a href="<?php echo base_url('patient/Order/onprocess_lab_order_alert'); ?>"><i class="feather-user-plus"></i> <span>OnProcess Lab Order</span></a>
                        </li>
                        <li class="<?php if (($url=='Order') && ($url2=='onprocess_pharmacy_order_alert' || $url2=='onprocess_pharmacy_order_detail' )) { echo "active";} ?>">
                            <a href="<?php echo base_url('patient/Order/onprocess_pharmacy_order_alert'); ?>"><i class="feather-package"></i> <span>OnProcess Pharmacy Order</span></a>
                        </li>
                        <li class="<?php if (($url=='Order') && ($url2=='active_doctor_order' || $url2=='doctor_encounter_detail')) { echo "active";} ?>">
                            <a href="<?php echo base_url('patient/Order/active_doctor_order'); ?>"><i class="feather-calendar"></i>
                                <span>Active Doctor Orders</span></a>
                        </li>
                        <li class="<?php if (($url=='Order') && ($url2=='past_doctor_order' || $url2=='past_doctor_encounter_detail')) { echo "active";} ?>">
                            <a href="<?php echo base_url('patient/Order/past_doctor_order'); ?>"><i class="feather-calendar"></i>
                                <span>Past Doctor Orders</span></a>
                        </li>
                        <li class="<?php if (($url=='Order') && ($url2=='past_pharmacy_order' || $url2=='pharmacy_order_detail')) { echo "active";} ?>">
                            <a href="<?php echo base_url('patient/Order/past_pharmacy_order'); ?>"><i class="feather-package"></i> <span>Past Pharmacy Orders</span></a>
                        </li>
                        <li class="<?php if (($url=='Order') && ($url2=='past_lab_order' || $url2=='lab_order_detail')) { echo "active";} ?>"> 
                            <a href="<?php echo base_url('patient/Order/past_lab_order'); ?>"><i class="feather-user-plus"></i> <span>Past Labs Orders</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php } ?>