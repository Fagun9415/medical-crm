<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Curis - Doctor Registration</title>

    <link rel="shortcut icon" type="image/x-icon" href="<?php  echo base_url('backend/assets/img/favicon.png'); ?>">

    <link rel="stylesheet" href="<?php  echo base_url('backend/assets/css/bootstrap.min.css'); ?>">

    <link rel="stylesheet" href="<?php  echo base_url('backend/assets/css/feather.css'); ?>">

    <link rel="stylesheet" href="<?php  echo base_url('backend/assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php  echo base_url('backend/assets/code/css/jquery.ccpicker.css'); ?>">
    
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
                            <img src="<?php  echo base_url('backend/assets/img/logo.png'); ?>" class="img-fluid" alt="Logo">
                        </div>
                        <h3>Doctor Signup</h3>
                        <form autocomplete="off" enctype='multipart/form-data' id="signupform">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Full Name" name="full_name" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" placeholder="Enter Email" name="email" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" placeholder="Enter Password" name="password" minlength="6" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Phone Number<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control phone-field filterme" id="phoneField1" placeholder="Enter Phone Number" name="phoneNo" maxlength="10" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Doctor Registration Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Doctor Registration Number" name="doctorRegistrationNo" maxlength="15" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Doctor Registration Document <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="file" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Specialities <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Your Specialities" name="doctorSpeciality"  required>
                                </div>
                            </div>
                            <hr>
                            <h5>Hospital Information</h5>
                            <hr>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Hospital Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Hospital Name" name="hospitalName" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Hospital Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control phone-field filterme" id="phoneField2" placeholder="Enter Hospital Number" name="phoneNo1" maxlength="10" required>
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="custom_check mr-2 mb-0"> I agree to the <a href="<?php echo base_url('Terms_and_Conditions'); ?>"
                                                class="text-primary"> terms & conditions</a> and <a href="<?php echo base_url('Privacy_Policy'); ?>"
                                                class="text-primary">privacy policy</a>
                                            <input type="checkbox" name="radio" required>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                    <div class="ajax-load1 text-center" style="display:none;">
                                          <img src="<?php echo base_url('uploads/loader.gif');?>">
                                      </div>
                                       <div id="alert_message" ></div>
                                </div>
                            <div class="d-grid">
                                <button class="btn btn-primary" type="submit">Register</button>
                            </div>
                            <div class="dont-have">Already have an account? <a href="<?php echo base_url('doctor/Auth/login'); ?>">Login</a></div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script src="<?php  echo base_url('backend/assets/js/jquery-3.6.0.min.js'); ?>"></script>

    <script src="<?php  echo base_url('backend/assets/js/bootstrap.bundle.min.js'); ?>"></script>

    <script src="<?php  echo base_url('backend/assets/js/script.js'); ?>"></script>
    <script src="<?php echo base_url('backend/assets/code/js/jquery.ccpicker.js'); ?>"></script>
    <script src="<?php echo base_url('backend/assets/code/js/jquery.ccpicker.min.js'); ?>"></script>

    <script>
        $('.filterme').keypress(function(eve) {
        if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0)) {
        eve.preventDefault();
        }

        // this part is when left part of number is deleted and leaves a . in the leftmost position. For example, 33.25, then 33 is deleted
        $('.filterme').keyup(function(eve) {
        if ($(this).val().indexOf('.') == 0) {
        $(this).val($(this).val().substring(1));
        }
        });
        });
    </script>
    <script>
      $(document).ready(function() 
      { 

        $("#phoneField1").CcPicker({
              "countryCode":"IN",
              dataUrl:"<?php echo base_url('backend/assets/code/data.json'); ?>"
          });

        $("#phoneField2").CcPicker({
              "countryCode":"IN",
              dataUrl:"<?php echo base_url('backend/assets/code/data.json'); ?>"
          });

        var frm = $('#signupform');
        frm.submit(function(e){
            e.preventDefault();


            $(".ajax-load1").show();

            var formData = new FormData($(this)[0]);
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url().'doctor/Auth/save_user'?>',
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
                            location.href = "<?php echo base_url('doctor/Auth/login') ?>";   
                        setInterval(function(){
                        }, 5000);
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