<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link type="image/x-icon" href="<?php echo base_url('frontend/assets/img/favicon.png'); ?>" rel="icon">

    <link rel="stylesheet" href="<?php echo base_url('frontend/assets/css/bootstrap.min.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('frontend/assets/plugins/fontawesome/css/fontawesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('frontend/assets/plugins/fontawesome/css/all.min.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('frontend/assets/css/feather.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('frontend/assets/css/aos.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('frontend/assets/css/style.css'); ?>">

<style> {
}
.img-fluid-dev {
    max-width: 70% !important;
    height: auto;
}
</style>
</head>
<body>
    <div class="main-wrapper">
        <div class="home-one-banner">
            <div class="bg-shapes">
                <img src="<?php echo base_url('frontend/assets/img/shapes/shape-10.png'); ?>" class="shape-01 aos" alt="img" data-aos="fade-right">
                <img src="<?php echo base_url('frontend/assets/img/shapes/shape-8.png'); ?>" class="shape-04 aos" alt="img" data-aos="fade-left">
                
            </div>
            <div class="container">

                <header class="header">
                    <div class="nav-bg">
                        <nav class="navbar navbar-expand-lg header-nav nav-transparent header-nav-one">
                            <div class="navbar-header">
                                <a id="mobile_btn" href="javascript:void(0);">
                                    <span class="bar-icon blue-bar">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </span>
                                </a>
                                <a href="<?php echo base_url('Home'); ?>" class="navbar-brand logo">
                                    <img src="<?php echo base_url('frontend/assets/img/logo-one.png'); ?>" class="img-fluid" alt="Logo">
                                </a>
                            </div>
                            <div class="main-menu-wrapper">
                                <div class="menu-header">
                                    <a href="<?php echo base_url('Home'); ?>" class="menu-logo">
                                        <img src="<?php echo base_url('frontend/assets/img/logo-one.png'); ?>" class="img-fluid" alt="Logo">
                                    </a>
                                    <a id="menu_close" class="menu-close" href="javascript:void(0);"> <i
                                            class="fas fa-times"></i>
                                    </a>
                                </div>
                                <ul class="main-nav black-font">
                                    <li><a href="<?php echo base_url('Home'); ?>" target="_blank">Home</a>
                                    </li>
                                    <li><a href="<?php echo base_url('About'); ?>" target="_blank">About</a>
                                    </li>
                                    <li><a href="<?php echo base_url('Contact'); ?>" target="_blank">Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </header>

                <div class="row">
                    <div class="col-lg-6 col-md-12 banner-left aos" data-aos="fade-up">
                        <div class="banner-info">
							<h2><span>Mera Parivaar,</span></h2>
                            <h2><span>Meri Sehat,</span></h2>
							<h2><span>Meri Khushi.</span></h2>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 aos" data-aos="fade-up">
                        <img src="<?php echo base_url('frontend/assets/img/dr-removebg-preview.png'); ?>" class="img-fluid-dev dr-img" alt="">
                    </div>
                </div>
            </div>
        </div>

        <section class="looking-section-three">
            <div class="container">
                <div class="row justify-content-center aos" data-aos="fade-up">
                    <div class="col-lg-3 col-md-6 d-flex">
                        <div class="looking-box w-100 hvr-bounce-to-bottom">
                            <div class="looking-icon">
                                <div class="icon-inner">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <div class="looking-info">
                                <span class="looking-link">Patient</span>
                            </div>
                            <div class="looking-btn">
                                <a href="<?php echo base_url('patient/Auth/login'); ?>" target="_blank" class="btn btn-one w-100"><span>Login Now</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex">
                        <div class="looking-box w-100 hvr-bounce-to-bottom">
                            <div class="looking-icon">
                                <div class="icon-inner">
                                    <i class="fas fa-user-md"></i>
                                </div>
                            </div>
                            <div class="looking-info">
                                <span class="looking-link">Doctor</span>
                            </div>
                            <div class="looking-btn">
                                <a href="<?php echo base_url('doctor/Auth/login'); ?>" target="_blank" class="btn btn-one w-100"><span>Login Now</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex">
                        <div class="looking-box w-100 hvr-bounce-to-bottom">
                            <div class="looking-icon">
                                <div class="icon-inner">
                                    <i class="fas fa-tablets"></i>
                                </div>
                            </div>
                            <div class="looking-info">
                                <span class="looking-link">Pharmacy</span>
                            </div>
                            <div class="looking-btn">
                                <a href="<?php echo base_url('pharmacy/Auth/login'); ?>" target="_blank" class="btn btn-one w-100"><span>Login Now</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex">
                        <div class="looking-box w-100 hvr-bounce-to-bottom">
                            <div class="looking-icon">
                                <div class="icon-inner">
                                    <i class="fas fa-vial"></i>
                                </div>
                            </div>
                            <div class="looking-info">
                                <span class="looking-link">Lab</span>
                            </div>
                            <div class="looking-btn">
                                <a href="<?php echo base_url('lab/Auth/login'); ?>" target="_blank" class="btn btn-one w-100"><span>Login Now</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    <footer class="footer footer-one">

    <div class="footer-top aos" data-aos="fade-up">
        <div class="container">
            <div class="row">

                <div class="col-lg-2 col-md-6">

                    <div class="footer-widget footer-menu">
                        <h2 class="footer-title">Know Us</h2>
                        <ul>
                            <li><a href="<?php echo base_url('About'); ?>" target="_blank">About</a>
                            </li>
                            <li><a href="<?php echo base_url('Contact'); ?>" target="_blank">Contact</a>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="col-lg-2 col-md-6">

                    <div class="footer-widget footer-menu">
                        <h2 class="footer-title">For Patients</h2>
                        <ul>
                            <li><a href="<?php echo base_url('patient/Auth/login'); ?>" target="_blank">Login</a>
                            </li>
                            <li><a href="<?php echo base_url('patient/Auth/register'); ?>" target="_blank">Register</a>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="col-lg-2 col-md-6">

                    <div class="footer-widget footer-menu">
                        <h2 class="footer-title">For Doctors</h2>
                        <ul>
                            <li><a href="<?php echo base_url('doctor/Auth/login'); ?>" target="_blank">Login</a>
                            </li>
                            <li><a href="<?php echo base_url('doctor/Auth/register'); ?>" target="_blank">Register</a>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="col-lg-2 col-md-6">

                    <div class="footer-widget footer-menu">
                        <h2 class="footer-title">For Pharmacy</h2>
                        <ul>
                            <li><a href="<?php echo base_url('pharmacy/Auth/login'); ?>" target="_blank">Login</a>
                            </li>
                            <li><a href="<?php echo base_url('pharmacy/Auth/register'); ?>" target="_blank">Register</a>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="col-lg-2 col-md-6">

                    <div class="footer-widget footer-menu">
                        <h2 class="footer-title">For Lab</h2>
                        <ul>
                            <li><a href="<?php echo base_url('lab/Auth/login'); ?>" target="_blank">Login</a>
                            </li>
                            <li><a href="<?php echo base_url('lab/Auth/register'); ?>" target="_blank">Register</a>
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="col-lg-2 col-md-6">

                    <div class="footer-widget footer-menu">
                        <h2 class="footer-title">Connect</h2>
                        <div class="social-icon">
                            <ul>
                                <li><a href="javascript:void(0)" target="_blank"><i class="fab fa-facebook"></i> </a>
                                </li>
                                <li><a href="javascript:void(0)" target="_blank"><i class="fab fa-linkedin"></i></a>
                                </li>
                                <li><a href="javascript:void(0)" target="_blank"><i class="fab fa-instagram"></i></a>
                                </li>
                                <li><a href="javascript:void(0)" target="_blank"><i class="fab fa-twitter"></i> </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="footer-bottom">
        <div class="container">

            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="copyright-text">
                            <p class="mb-0">&copy; 2022 Curis. All rights reserved.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">

                        <div class="copyright-menu">
                            <ul class="policy-menu">
                                <li><a href="<?php echo base_url('uploads/Terms and Conditions.pdf'); ?>" target=”_blank”>Terms and Conditions</a>
                                </li>

                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    </footer>
    
    </div>

    <script data-cfasync="false"
        src="https://Curis-html.dreamguystech.com/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="<?php echo base_url('frontend/assets/js/jquery-3.6.0.min.js'); ?>"></script>

    <script src="<?php echo base_url('frontend/assets/js/bootstrap.bundle.min.js'); ?>"></script>

    <script src="<?php echo base_url('frontend/assets/js/feather.min.js'); ?>"></script>

    <script src="<?php echo base_url('frontend/assets/plugins/select2/js/select2.min.js'); ?>"></script>

    <script src="<?php echo base_url('frontend/assets/js/slick.js'); ?>"></script>

    <script src="<?php echo base_url('frontend/assets/js/aos.js'); ?>"></script>

    <script src="<?php echo base_url('frontend/assets/js/script.js'); ?>"></script>
</body>
</html>