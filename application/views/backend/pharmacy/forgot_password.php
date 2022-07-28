<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Quris - Pharmacy Forgot Password</title>

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('backend/assets/img/favicon.png'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('backend/assets/css/bootstrap.min.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('backend/assets/css/feather.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('backend/assets/css/style.css'); ?>">
</head>

<body>

    <div class="main-wrapper">
        <!-- <div class="header d-none">

            <ul class="nav nav-tabs user-menu">

                <li class="nav-item">
                    <a href="#" id="dark-mode-toggle" class="dark-mode-toggle">
                        <i class="feather-sun light-mode"></i><i class="feather-moon dark-mode"></i>
                    </a>
                </li>

            </ul>

        </div> -->
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
                        <h3>Restart Password</h3>
                        <p class="account-subtitle">Enter your email to get a password reset link</p>
                        <form action="javascript:void(0)" id="signupform">
                        <input type="hidden" name="loginType" value="pharmacy">
                            <div class="form-group form-focus">
                                <input type="email" name="email" class="form-control floating">
                                <label class="focus-label">Enter Email</label>
                            </div>
                            <div class="text-center">
                                <div class="ajax-load1 text-center" style="display:none;">
                                      <img src="<?php echo base_url('uploads/loader.gif');?>">
                                  </div>
                                   <div id="alert_message" style="color:red;"></div>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary" type="submit">Forgot Password</button>
                            </div>
                            <div class="dont-have">Remember your password? <a href="<?php echo base_url('pharmacy/Auth/login'); ?>">Login</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script src="<?php echo base_url('backend/assets/js/jquery-3.6.0.min.js'); ?>"></script>

    <script src="<?php echo base_url('backend/assets/js/bootstrap.bundle.min.js'); ?>"></script>

    <script src="<?php echo base_url('backend/assets/js/script.js'); ?>"></script>
    <script>
      $(document).ready(function() 
      { 

        var frm = $('#signupform');
        frm.submit(function(e){
            e.preventDefault();


            $(".ajax-load1").show();

            var formData = new FormData($(this)[0]);
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url().'pharmacy/Auth/forgot_password_verify'?>',
                data: formData,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data)
                {   
                    $(".ajax-load1").hide();
                    
                    var res = JSON.parse(data);
                    status = res.status;
                    message = res.message;

                    if(status == "success")
                    {   $('#alert_message').html('<div class="text-center alert alert-success">'+message+'</div>');
                            location.href = "<?php echo base_url('pharmacy/Auth/login') ?>";   
                        setInterval(function(){
                        }, 10000);
                    }
                    else if(status=="unsuccess")
                    {   
                        $('#alert_message').html('<div class="text-center alert alert-danger">'+message+'</div>');
                        setInterval(function(){
                        }, 5000);
                    }
                    else
                    {

                    }   
                }
            });
        });

    });
    </script>
</body>

</html>