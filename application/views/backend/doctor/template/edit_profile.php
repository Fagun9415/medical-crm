 <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Edit Profile</h3>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xl-6 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <h4 class="card-title">Basic Information</h4>
                            </div>
                            <div class="card-body">
                                <form id="signupform" autocomplete="off">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Email</label>
                                        <div class="col-lg-9">
                                            <input type="email" class="form-control" value="<?php echo $user->email; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Full Name</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="name" value="<?php echo $user->name; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Phone Number</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control phone-field filterme" id="phoneField1" placeholder="Enter Phone Number" name="phoneNo" value="<?php echo $user->doctorPhoneNo; ?>" maxlength="10" required>
                                        </div>
                                        <input type="hidden" id="countrycode" name="countrycode" value="<?php echo $user->doctorPhoneCode; ?>">
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Specialities</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="doctorSpeciality" value="<?php echo $user->doctorSpeciality; ?>" required placeholder="Enter Your Specialities" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Hospital Name</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="hospitalName" value="<?php echo $user->hospitalName; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Hospital Phone Number</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control phone-field filterme" id="phoneField2" placeholder="Enter Hospital Phone Number" name="phoneNo1" value="<?php echo $user->hospitalPhoneNo; ?>" required maxlength="10">
                                        </div>
                                        <input type="hidden" id="countrycode1" name="countrycode1" value="<?php echo $user->hospitalPhoneCode; ?>">
                                    </div>
                                    <div class="text-center">
                                        <div class="ajax-load1 text-center" style="display:none;">
                                              <img src="<?php echo base_url('uploads/loader.gif');?>">
                                        </div>
                                       <div id="alert_message" style="color:red;"></div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <h4 class="card-title">Change Password</h4>
                            </div>
                            <div class="card-body">
                                <form id="changepassform" autocomplete="off">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Old Password</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="oldPassword" minlength="6" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">New Password</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="newPassword" minlength="6" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Confirm Password</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="confirmPassword" minlength="6" required>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="ajax-load2 text-center" style="display:none;">
                                              <img src="<?php echo base_url('uploads/loader.gif');?>">
                                        </div>
                                       <div id="alert_message1" style="color:red;"></div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>     
<script src="<?php echo base_url('backend/assets/js/jquery-3.6.0.min.js'); ?>"></script>

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
          //"countryCode":"us",
          dataUrl:"<?php echo base_url('backend/assets/code/data.json'); ?>"

      });

          var code = $('#countrycode').val();
         
       // $("#phoneField1").CcPicker();
        $("#phoneField1").CcPicker("setCountryByPhoneCode",code);


        $("#phoneField2").CcPicker({
          //"countryCode":"us",
          dataUrl:"<?php echo base_url('backend/assets/code/data.json'); ?>"

      });

          var code = $('#countrycode1').val();
         
       // $("#phoneField1").CcPicker();
        $("#phoneField2").CcPicker("setCountryByPhoneCode",code);

        var frm = $('#signupform');
        frm.submit(function(e){
            e.preventDefault();


            $(".ajax-load1").show();

            var formData = new FormData($(this)[0]);
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url().'doctor/Auth/edit_save_profile'?>',
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
                    {   
                        $('#alert_message').html('<div class="text-center alert alert-success">'+message+'</div>');
                        location.reload();   
                        
                    }
                    else if(status=="unsuccess")
                    {   
                        $('#alert_message').html('<div class="text-center alert alert-danger">'+message+'</div>');
                    }
                    else
                    {

                    }
                }
            });
             setInterval(function(){
                  $('#alert_message').html('');
              }, 2000);
        });

        var frm = $('#changepassform');
        frm.submit(function(e){
            e.preventDefault();


            $(".ajax-load2").show();

            var formData = new FormData($(this)[0]);
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url().'doctor/Auth/change_password'?>',
                data: formData,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data)
                {   
                    $(".ajax-load2").hide();
                    var res = JSON.parse(data);

                    status = res.status;
                    message = res.message;

                    if(status == "success")
                    {   
                        $('#alert_message1').html('<div class="text-center alert alert-success">'+message+'</div>');
                        location.reload();   
                        
                    }
                    else if(status=="unsuccess")
                    {   
                        $('#alert_message1').html('<div class="text-center alert alert-danger">'+message+'</div>');
                    }
                    else
                    {

                    }
                }
            });
             setInterval(function(){
                  $('#alert_message1').html('');
              }, 2000);
        });

    });
    </script>        