  <div class="page-wrapper">
            <div class="content container-fluid">


                <div class="row">
                    <div class="col-xl-12 d-flex">
                        <div class="card flex-fill">
                        <div class="card-header">
                                <h4 class="card-title">Add New Patient</h4>
                            </div>
                            <div class="card-body">
                                <form id="signupform" autocomplete="off">
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
                            <br>
                            <br>
                                    <div class="text-center">
                                        <div class="ajax-load1 text-center" style="display:none;">
                                              <img src="<?php echo base_url('uploads/loader.gif');?>">
                                        </div>
                                       <div id="alert_message" style="color:red;"></div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button class="btn btn-secondary" type="reset">Cancel</button>
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
                url: '<?php echo base_url().'doctor/Patient/add_save_new_patient'?>',
                data: formData,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data)
                {   
                    $(".ajax-load1").hide();
                    console.log(data);
                    var res = JSON.parse(data);
                    status = res.status;
                    message = res.message;

                    if(status == "success")
                    {   
                        location.href = "<?php echo base_url('doctor/Patient/add_patient') ?>";   
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


    });
    </script>        
      