  <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="row">
                    <div class="col-xl-12 d-flex">
                        <div class="card flex-fill">
                        <div class="card-header">
                                <h4 class="card-title">Search Walk-in Order</h4>
                            </div>
                            <div class="card-body">
                                <form id="signupform" autocomplete="off">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Patient Mobile Number</label>
                                        <div class="col-lg-9">
                                            <input type="text" placeholder="Patient Mobile Number" class="form-control filterme" name="mobileNo" maxlength="10"  required>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="ajax-load1 text-center" style="display:none;">
                                              <img src="<?php echo base_url('uploads/loader.gif');?>">
                                        </div>
                                       <div id="alert_message" style="color:red;"></div>
                                        <button type="submit" class="btn btn-primary">Search</button>
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

        var frm = $('#signupform');
        frm.submit(function(e){
            e.preventDefault();


            $(".ajax-load1").show();

            var formData = new FormData($(this)[0]);
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url().'pharmacy/Dashboard/search_schedule_order'?>',
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
                    mobileno = res.mobileno;

                    if(status == "success")
                    {   
                        location.href = "<?php echo base_url('pharmacy/Dashboard/schedule_order_list/') ?>"+mobileno;   
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
      