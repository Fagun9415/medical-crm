<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Curis - Lab Login</title>

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
                        <div class="img-logo">
                            <img src="<?php echo base_url('backend/assets/img/logo.png'); ?>" class="img-fluid" alt="Logo">
                        </div>
                        <h3>Lab Login</h3>
                        <p class="account-subtitle">login to your account to continue</p>
                        <form action="<?php echo base_url('lab/Auth/check_login'); ?>" method="post" autocomplete="off">
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
                                        <!-- <label class="custom_check mr-2 mb-0 d-inline-flex"> Remember me
                                            <input type="checkbox" name="radio">
                                            <span class="checkmark"></span>
                                        </label> -->
                                    </div>
                                    <div class="col-6 text-end">
                                        <a class="forgot-link" href="<?php echo base_url('lab/Auth/forgot_password'); ?>">Forgot Password ?</a>
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
                            <div class="dont-have">Don't have an account? <a href="<?php echo base_url('lab/Auth/register'); ?>">Sign up</a></div>

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