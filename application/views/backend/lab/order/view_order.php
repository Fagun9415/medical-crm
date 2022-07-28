<?php 
    $patient = $details->patient;
    $dateOfBirth = date('d-m-Y',strtotime($patient->birthDate));
    $today = date("Y-m-d");
    $diff = date_diff(date_create($dateOfBirth), date_create($today));
    $age = $diff->format('%y');

    $order = $details->labOrderDetail;

    $lab = $details->labOrder;

    $order_id = my_encrypt($lab->id);
    $encounter = $details->encounter;
    $provisionalDiagnosis = $details->provisionalDiagnosis;

 ?>
 <style type="text/css">
    .dev-but {
    right: 30px; 
    position: absolute;
}
</style>
<div class="page-wrapper">
            <div class="content container-fluid content-wrap">
                <form id="orderform">
                <input type="hidden" name="labOrderId" value="<?php echo $order_id; ?>">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="setting-info profile-info">
                            <h4>Patient Information
                            <?php if ($lab->labOrderMode == "labVisit") { ?>
                            <button type="button" class="btn btn-secondary dev-but" >Lab Visit</button>
                            <?php } elseif ($lab->labOrderMode == "homeVisit") { ?>
                            <button type="button" class="btn btn-primary dev-but">Home Visit</button>
                            <?php }  else {}?>    
                            </h4>
                            <div class="row mb-5">
                                <div class="col-md-12 col-sm-12">
                                    <h4 class="m-0 d-flex"><?php echo $patient->name; ?></h4>
                                    <span><?php echo "(".$patient->phoneCode.") ".$patient->phoneNo; ?></span><br>
                                    <span><?php echo $patient->email; ?></span><br>
                                    <span><?php echo $age; ?> Years (<?php echo ucwords($patient->gender); ?>)</span>
                                     
                                </div> 
                            </div>
                            <?php if ($lab->labOrderMode == "homeVisit") { ?>
                            <div class="row mb-5">
                                <div class="col-md-12 col-sm-12">
                                    <h4 class="m-0 d-flex">Visit Detail</h4>
                                    <span>Address Line 1 :  <?php echo $lab->orderAddressLine1; ?></span><br>
                                    <span>Address Line 2 :   <?php echo $lab->orderAddressLine2; ?></span>
                                    <span>Landmark :   <?php echo $lab->landmark; ?></span>
                                    <span>Pincode :   <?php echo $lab->pincode; ?></span>
                                </div> 
                            </div>
                            <?php } else {} ?>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <h5 class="m-0 d-flex"><b>Chief Complaint</b>&nbsp: <?php echo $encounter->chiefComplaint; ?></h5>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <h5 class="mb-1">Provisional Diagnosis</h5>
                                    <hr class="mt-0">
                                    <div class="col-12">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless" id="medicine-table">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Sr No.</th>
                                                                <th>Provisional Diagnosis</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($provisionalDiagnosis as $key1 => $value1) { ?>
                                                            <tr>
                                                                <td><?php echo $key1+1; ?></td>
                                                                <td><?php echo $value1->provisionalDiagnosis; ?></td>
                                                            </tr>
                                                        <?php } ?>    
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <h5 class="mb-1">Lab Information</h5>
                                    <hr class="mt-0">
                                    <div class="col-12 row">
                                        <div class="col-12">
                                            <div class="row">
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
                                                            <?php foreach ($order as $key => $value) { ?>
                                                                <tr>
                                                                    <td><?php echo $key+1; ?></td>
                                                                    <td><?php echo strtoupper($value->labTestName); ?></td>
                                                                </tr>
                                                            <?php } ?>    
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                    <br>
                    <h5 class="mb-1">Payment Amount</h5>
                        <hr class="mt-0">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control floating filterme" name="paymentAmount" placeholder="Amount" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="paymentMode" id="cash" value="cash" >
                                <label class="form-check-label" for="cash">Cash</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="paymentMode" id="online" value="online">
                                <label class="form-check-label" for="online">Online</label>
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
                            <button type="submit" class="btn btn-primary">Request for payment</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
<script src="<?php echo base_url('backend/assets/js/jquery-3.6.0.min.js'); ?>"></script>
    <script>
        $(document).ready(function() {
            

            var frm = $('#orderform');
            frm.submit(function(e){
                e.preventDefault();


                $(".ajax-load1").show();

                var formData = new FormData($(this)[0]);
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url().'lab/Order/change_payment_status'?>',
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
                            location.href = "<?php echo base_url('lab/Order/payment_pending_patient') ?>";   
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
