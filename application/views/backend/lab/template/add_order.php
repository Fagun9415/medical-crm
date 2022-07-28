<?php
$details = $alldata->labTests;
$encounter = $alldata->encounter;
 ?>

<div class="page-wrapper">
            <div class="content container-fluid content-wrap">
                <form id="orderform" autocomplete="off">
                <input type="hidden" name="encounterId" value="<?php echo $encounter_id; ?>">
                <input type="hidden" name="patientId" value="<?php echo $patient_id; ?>">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="setting-info profile-info">
                            <h4>Lab Order</h4>
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <label>Order Mode?<span class="text-danger">*</span></label>
                                    <hr class="mt-0">
                                    <div class="col-12">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="labOrderMode" id="homeVisit" value="homeVisit">
                                            <label class="form-check-label" for="homeVisit">Home Visit</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="labOrderMode" id="labVisit" value="labVisit">
                                            <label class="form-check-label" for="labVisit">Lab Visit</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Order Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="orderDate" required min="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4 row justify-content-center font-weight-bold">
                                    Walk-in QR Code
                                    <img src="<?php echo base_url('backend/assets/img/QR_code_for_mobile_English_Wikipedia.svg.png'); ?>" height="150" width="150">
                                </div>
                                    <div class="col-md-4 col-sm-12" id="adl1" style="display: none;">
                                        <div class="form-group">
                                            <label>Address Line 1<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="orderAddressLine1"  id="orderAddressLine1">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12" id="adl2" style="display: none;">
                                        <div class="form-group">
                                            <label>Address Line 2<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="orderAddressLine2"  id="orderAddressLine2" >
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12" id="lmark" style="display: none;">
                                        <div class="form-group">
                                            <label>Landmark <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="landmark"  id="landmark">
                                        </div>
                                    </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Pincode <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="pincode"  id="pincode" required >
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">     
                                <h5 class="m-0 d-flex">Order Details</h5>
                                <hr class="mt-0">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-borderless" id="test-table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Sr No.</th>
                                                    <th>Test Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($details as $key => $value) { ?>
                                                <tr>
                                                    <td><?php echo $key+1; ?></td>
                                                    <td><?php echo $value->labTestName; ?></td>
                                                </tr>
                                            <?php } ?>    
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <h5 class="m-0 d-flex">Chief Complaint&nbsp: <?php echo $encounter->chiefComplaint; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row mt-auto">
                    <div class="col-md-12">
                            <div class="ajax-load1 text-center" style="display:none;">
                                  <img src="<?php echo base_url('uploads/loader.gif');?>">
                            </div>
                           <div id="alert_message" style="color:red;"></div>
                            <button type="submit" class="btn btn-primary">Confirm Order</button>
                            <button class="btn btn-secondary" type="reset">Cancel</button>
                    </div>
                </div>
                </form>
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
        $(document).ready(function() {
            $('input[type=radio][name=labOrderMode]').change(function() {
                if (this.value == 'homeVisit') {
                    $("#adl1").css('display', 'block');
                    $("#adl2").css('display', 'block');
                    $("#lmark").css('display', 'block');
                    $("#orderAddressLine1").attr('required', 'required');
                    $("#orderAddressLine2").attr('required', 'required');
                    $("#landmark").attr('required', 'required');
                }
                else if (this.value == 'labVisit') {
                    $("#adl1").css('display', 'none');
                    $("#adl2").css('display', 'none');
                    $("#lmark").css('display', 'none');
                    $("#orderAddressLine1").removeAttr("required");
                    $("#orderAddressLine2").removeAttr("required");
                    $("#landmark").removeAttr("required");
                    $("#orderAddressLine1").val('');
                    $("#orderAddressLine2").val('');
                    $("#landmark").val('');
                }
            });


            var frm = $('#orderform');
            frm.submit(function(e){
                e.preventDefault();


                $(".ajax-load1").show();

                var formData = new FormData($(this)[0]);
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url().'lab/Dashboard/add_save_order'?>',
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
                            location.href = "<?php echo base_url('lab/Order/schedule_patient') ?>";   
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