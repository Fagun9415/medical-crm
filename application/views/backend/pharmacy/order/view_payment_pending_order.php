<?php 
    $patient = $details->patient;
    $dateOfBirth = date('d-m-Y',strtotime($patient->birthDate));
    $today = date("Y-m-d");
    $diff = date_diff(date_create($dateOfBirth), date_create($today));
    $age = $diff->format('%y');

    $order = $details->pharmacyOrderDetail;

    $pharma = $details->pharmacyOrder;

    $order_id = my_encrypt($pharma->id);
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
                <input type="hidden" name="pharmacyOrderId" value="<?php echo $order_id; ?>">    
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="setting-info profile-info">
                            <h4>Patient Information
                            <?php if ($pharma->pharmacyOrderMode == "pickup") { ?>
                            <button type="button" class="btn btn-secondary dev-but" >Pickup</button>
                            <?php } elseif ($pharma->pharmacyOrderMode == "delivery") { ?>
                            <button type="button" class="btn btn-primary dev-but">Delivery</button>
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
                            <?php if ($pharma->pharmacyOrderMode == "delivery") { ?>
                            <div class="row mb-5">
                                <div class="col-md-12 col-sm-12">
                                    <h4 class="m-0 d-flex">Delivery Detail</h4>
                                    <span>Address Line 1 :  <?php echo $pharma->orderAddressLine1; ?></span><br>
                                    <span>Address Line 2 :   <?php echo $pharma->orderAddressLine2; ?></span><br>
                                    <span>Landmark :   <?php echo $pharma->landmark; ?></span><br>
                                    <span>Pincode :   <?php echo $pharma->pincode; ?></span>
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
                                    <h5 class="mb-1">Medicine Information</h5>
                                    <hr class="mt-0">
                                    <div class="col-12">
                                        <div class="col-12">
                                            <div class="row">
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
                                                        <?php foreach ($order as $key => $value) { ?>
                                                            <tr>
                                                                <td><?php echo $key+1; ?></td>
                                                                <td><?php echo $value->drugName; ?></td>
                                                                <td><?php echo $value->morning; ?></td>
                                                                <td><?php echo $value->afternoon; ?></td>
                                                                <td><?php echo $value->evening; ?></td>
                                                                <td><?php echo $value->night; ?></td>
                                                                <td><?php echo $value->comment; ?></td>
                                                                <td><?php echo $value->noOfDays; ?></td>
                                                                <td><?php echo $value->qty; ?></td>
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
                    <br>
                    <h5 class="mb-1">Payment Details</h5>
                        <hr class="mt-0">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group form-check-inline">
                                <p>Amount :  <?php echo $pharma->paymentAmount; ?></p>
                                <p>Mode : <?php echo ucwords($pharma->paymentMode); ?></p>
                            </div>
                        </div>
                    </div>                
                </div>
                <?php if ($pharma->paymentStatus=="complete") { ?> 
                <div class="row mt-auto">
                    <div class="col-md-12">
                            <div class="ajax-load1 text-center" style="display:none;">
                                  <img src="<?php echo base_url('uploads/loader.gif');?>">
                            </div>
                           <div id="alert_message" style="color:red;"></div>
                            <button type="submit" class="btn btn-primary">Payment Collection Completed</button>
                    </div>
                </div>
                <?php } else {} ?>
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
            

            var frm = $('#orderform');
            frm.submit(function(e){
                e.preventDefault();


                $(".ajax-load1").show();

                var formData = new FormData($(this)[0]);
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url().'pharmacy/Order/change_order_status'?>',
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
                            location.href = "<?php echo base_url('pharmacy/Order/complete_patient') ?>";   
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