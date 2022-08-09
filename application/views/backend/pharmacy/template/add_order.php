<?php
$med = $details->medicines;
$encounter = $details->encounter;
 ?>

<div class="page-wrapper">
            <div class="content container-fluid content-wrap">
                <form id="orderform" autocomplete="off">
                <input type="hidden" name="encounterId" value="<?php echo $encounter_id; ?>">
                <input type="hidden" name="patientId" value="<?php echo $patient_id; ?>">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="setting-info profile-info">
                            <h4>Add Order</h4>
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <label>Order Mode?<span class="text-danger">*</span></label>
                                    <hr class="mt-0">
                                    <div class="col-12">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pharmacyOrderMode" id="delivery" value="delivery" disabled>
                                            <label class="form-check-label" for="delivery">Delivery</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pharmacyOrderMode" id="pickup" value="pickup" checked>
                                            <label class="form-check-label" for="pickup">Pick-Up</label>
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
                                   
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <h5 class="m-0 d-flex">Chief Complaint&nbsp: <?php echo $encounter->chiefComplaint; ?></h5>
                    </div>
                    <br><br><br>
                    <div class="col-12">
                        <div class="row">     
                            <h5 class="mb-1 d-flex">Order Details</h5>
                            <hr class="mt-0">
                            <div class="col-md-12 col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-borderless" id="medicine-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Drug Name</th>
                                                <th>Morning</th>
                                                <th>Afternoon</th>
                                                <th>Evening</th>
                                                <th>Night</th>
                                                <th>Comment</th>
                                                <th>Days</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($med as $key => $value) {?>

                                            <tr>
                                                <td><input type=checkbox class="me-2" name ="encounterMedicinesId[]" value="<?php echo $value->id; ?>"><?php echo $key+1; ?></td>
                                                <td><input type="hidden" name="drugName[<?php echo $value->id ; ?>]" value="<?php echo $value->drugName; ?>" ><?php echo $value->drugName; ?></td>
                                                <td><input type="hidden" name="morning[<?php echo $value->id ; ?>]" value="<?php echo $value->morning; ?>" ><?php echo $value->morning; ?></td>
                                                <td><input type="hidden" name="afternoon[<?php echo $value->id ; ?>]" value="<?php echo $value->afternoon; ?>" ><?php echo $value->afternoon; ?></td>
                                                <td><input type="hidden" name="evening[<?php echo $value->id ; ?>]" value="<?php echo $value->evening; ?>" ><?php echo $value->evening; ?></td>
                                                <td><input type="hidden" name="night[<?php echo $value->id ; ?>]" value="<?php echo $value->night; ?>" ><?php echo $value->night; ?></td>
                                                <td><input type="hidden" name="comment[<?php echo $value->id ; ?>]" value="<?php echo $value->comment; ?>" ><?php echo $value->comment; ?></td>
                                                <td><input type="hidden" name="noOfDays[<?php echo $value->id ; ?>]" value="<?php echo $value->noOfDays; ?>" ><?php echo $value->noOfDays; ?></td>
                                                <td>
                                                    <div class="form-group form-focus">
                                                        <input type="number" class="form-control floating" name="qty[<?php echo $value->id;?>]">
                                                        <label class="focus-label">Quantity (strip/tube/bottle)<span class="text-danger"></span></label>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>    
                                        </tbody>
                                    </table>
                                </div>
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
                            <button type="submit" class="btn btn-primary">Add Order</button>
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
            $('input[type=radio][name=pharmacyOrderMode]').change(function() {
                if (this.value == 'delivery') {
                    $("#adl1").css('display', 'block');
                    $("#adl2").css('display', 'block');
                    $("#lmark").css('display', 'block');
                    $("#orderAddressLine1").attr('required', 'required');
                    $("#orderAddressLine2").attr('required', 'required');
                    $("#landmark").attr('required', 'required');
                }
                else if (this.value == 'pickup') {
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
                    url: '<?php echo base_url().'pharmacy/Dashboard/add_save_order'?>',
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
                            location.href = "<?php echo base_url('pharmacy/Order/schedule_patient') ?>";   
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