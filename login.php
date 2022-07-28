<!DOCTYPE html>
<html lang="en">
  
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <!-- <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="DashForge">
    <meta name="twitter:description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="twitter:image" content="../../img/dashforge-social.html">

     --><!-- Facebook -->
    <!-- <meta property="og:url" content="http://themepixels.me/dashforge">
    <meta property="og:title" content="DashForge">
    <meta property="og:description" content="Responsive Bootstrap 4 Dashboard Template">

    <meta property="og:image" content="../../img/dashforge-social.html">
    <meta property="og:image:secure_url" content="../../img/dashforge-social.html">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">
 -->
    <!-- Meta -->
    <!-- <meta name="author" content="ThemePixels">
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
 -->
    <!-- Favicon -->
    <!-- <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>/assets/img/favicon.png"> -->

    <title>Orange38 Litigation System</title>

    <!-- vendor css -->
    <link href="<?php echo base_url(); ?>/assets/fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/assets/ionicons/css/ionicons.min.css" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/dashforge.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/dashforge.auth.css">
  </head>
  <body>

    <!-- navbar -->

    <div class="content content-fixed content-auth">
      <div class="container">
        <div class="media align-items-stretch justify-content-center ht-100p pos-relative">
          <div class="media-body align-items-center d-none d-lg-flex">
            <div class="mx-wd-600">
              <img src="<?php echo base_url('uploads/logo_vendor.jpg'); ?>" class="img-fluid" alt="">
              <!-- <img style="height:100px;" src=""> -->
            </div>
          </div><!-- media-body -->
          <div class="sign-wrapper mg-lg-l-50 mg-xl-l-60">
            <div class="wd-100p">
              <h3 class="tx-color-01 mg-b-5">Admin | Sign In</h3>
              <p class="tx-color-03 tx-16 mg-b-40">Welcome back! Please signin to continue.</p>
              <form action="<?php echo base_url('admin/Auth/check_login'); ?>" method="post" autocomplete="off">
              <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control" name="email" placeholder="yourname@yourmail.com">
              </div>
              <div class="form-group">
                <div class="d-flex justify-content-between mg-b-5">
                  <label class="mg-b-0-f">Password</label>
                  <a href="javascript:void(0)" class="tx-13">Forgot password?</a>
                </div>
                <input type="password" class="form-control" name="password" placeholder="Enter your password">
              </div>
              <div class="form-check form-check-flat form-check-primary">
                <p style="color: red;"><?php if (form_error('password')) { echo form_error('password'); } ?></p>
                <p style="color: red;"><?php if (form_error('check_database')) { echo form_error('check_database'); } ?></p>
                <hr>
              </div>
              <button class="btn btn-brand-02 btn-block" type="submit">Sign In</button>
              </form>
              <!-- <div class="divider-text">or</div>
              <button class="btn btn-outline-facebook btn-block">Sign In With Facebook</button>
              <button class="btn btn-outline-twitter btn-block">Sign In With Twitter</button>
              <div class="tx-13 mg-t-20 tx-center">Don't have an account? <a href="page-signup.html">Create an Account</a></div> -->
            </div>
          </div><!-- sign-wrapper -->
        </div><!-- media -->
      </div><!-- container -->
    </div><!-- content -->

    <footer class="footer">
      <div>
        <span>&copy; 2021 Orange38 v1.0.0. </span>
      </div>
    </footer>

    <script src="<?php echo base_url(); ?>/assets/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/feather-icons/feather.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="<?php echo base_url(); ?>/assets/js/dashforge.js"></script>

    <!-- append theme customizer -->
    <script src="<?php echo base_url(); ?>/assets/js-cookie/js.cookie.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/dashforge.settings.js"></script>

  </body>

</html>
