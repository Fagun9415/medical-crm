<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Curis - Patient Registration</title>

    <link rel="shortcut icon" type="image/x-icon" href="<?php  echo base_url('backend/assets/img/favicon.png'); ?>">

    <link rel="stylesheet" href="<?php  echo base_url('backend/assets/css/bootstrap.min.css'); ?>">

    <link rel="stylesheet" href="<?php  echo base_url('backend/assets/css/feather.css'); ?>">

    <link rel="stylesheet" href="<?php  echo base_url('backend/assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php  echo base_url('backend/assets/code/css/jquery.ccpicker.css'); ?>">
    <style type="text/css">
    .input-controls {
      margin-top: 10px;
      border: 1px solid transparent;
      border-radius: 2px 0 0 2px;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
      height: 32px;
      outline: none;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }
    #searchInput {
      background-color: #fff;
      font-family: Roboto;
      font-size: 15px;
      font-weight: 300;
      margin-left: 3px;
      padding: 0 11px 0 13px;
      text-overflow: ellipsis;
      width: 50%;
    }
    #searchInput:focus {
      border-color: #4d90fe;
    }  
    }
</style>
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
                        <h3>Patient Signup</h3>
                        <form  autocomplete="off" id="signupform">
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
                                    <label>Phone Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control phone-field filterme" id="phoneField1" placeholder="Enter Phone Number" name="phoneNo" maxlength="10" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Gender <span class="text-danger">*</span></label>
                                    <select class="select form-control" name="gender" required>
                                        <option value="" selected disabled>Select</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label>Date of Birth <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="birthDate" required max="<?php echo date('Y-m-d'); ?>">
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
                                       <div id="alert_message" style="color:red;"></div>
                                </div>       
                            <div class="d-grid">
                                <button class="btn btn-primary" type="submit">Register</button>
                            </div>
                            <div class="dont-have">Already have an account? <a href="<?php echo base_url('patient/Auth/login'); ?>">Login</a></div>
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

        var frm = $('#signupform');
        frm.submit(function(e){
            e.preventDefault();


            $(".ajax-load1").show();

            var formData = new FormData($(this)[0]);
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url().'patient/Auth/save_user'?>',
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
                            location.href = "<?php echo base_url('patient/Auth/login') ?>";   
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