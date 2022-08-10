<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Curis - Patient Login</title>

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('backend/assets/img/favicon.png'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('backend/assets/css/bootstrap.min.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('backend/assets/css/feather.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('backend/assets/css/style.css'); ?>">

</head>

<body>

    <div class="main-wrapper">
        <div class="header d-none">

            <ul class="nav nav-tabs user-menu">

                <li class="nav-item">
                    <a href="#" id="dark-mode-toggle" class="dark-mode-toggle">
                        <i class="feather-sun light-mode"></i><i class="feather-moon dark-mode"></i>
                    </a>
                </li>

            </ul>

        </div>
        <div class="row">

            <div class="col-md-6 login-bg">
                <div class="login-banner"></div>
            </div>

            <div class="col-md-6 login-wrap-bg">

                <div class="login-wrapper">
                    <div class="loginbox">
                        <div class="row">
                            <div class="img-logo col-md-6">
                                <img src="<?php echo base_url('backend/assets/img/logo.png'); ?>" class="img-fluid" alt="Logo">
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="<?php echo base_url(); ?>" class="btn btn-primary " ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg> Back To Home </a>
                            </div>
                        </div>
                        <h3>Patient Login</h3>
                        <p class="account-subtitle">login to your account to continue</p>
                        <form action="<?php echo base_url('patient/Auth/check_login'); ?>" autocomplete="off" method="post">
                            <div class="form-group form-focus">
                                <input type="email" class="form-control floating" name="email" required>
                                <label class="focus-label">Enter Email</label>
                            </div>
                            <div class="form-group form-focus">
                                <input type="password" class="form-control floating" name="password" required>
                                <label class="focus-label">Enter Password</label>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        
                                    </div>
                                    <div class="col-6 text-end">
                                        <a class="forgot-link" href="<?php echo base_url('patient/Auth/forgot_password'); ?>">Forgot Password ?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-check form-check-flat form-check-primary">
                                <p style="color: red;"><?php if (form_error('password')) { echo form_error('password'); } ?></p>
                                <p style="color: red;"><?php if (form_error('check_database')) { echo form_error('check_database'); } ?></p>
                                <hr>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary" type="submit">Login</button>
                            </div>
                            <div class="dont-have">Don't have an account? <a href="<?php echo base_url('patient/Auth/register'); ?>">Sign up</a></div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script src="<?php echo base_url('backend/assets/js/jquery-3.6.0.min.js'); ?>"></script>

    <script src="<?php echo base_url('backend/assets/js/bootstrap.bundle.min.js'); ?>"></script>

    <script src="<?php echo base_url('backend/assets/js/script.js'); ?>"></script>
</body>

</html>