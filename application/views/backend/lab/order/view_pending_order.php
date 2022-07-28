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
                                                                    <th>Upload</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($order as $key => $value) { 

                                                                $lab_o_Id = my_encrypt($value->id);

                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $key+1; ?></td>
                                                                    <td><?php echo strtoupper($value->labTestName); ?></td>
                                                                    <td><button type="button" class="btn btn-primary prd" data-bs-toggle="modal" data-bs-target="#addProvisional" id="<?php echo $lab_o_Id; ?>">+ Upload Report</button>

                                                                    <?php if ($value->labReport == '' ) { } else { ?>
                                                                    <a href="<?php echo curisurl.$value->labReport; ?>" download class="btn btn-success" target="_blank"><i class="fa fa-download"></i></a>    
                                                                    <?php } ?>
                                                                    </td>
                                                                    
                                                                </tr>
                                                            <?php  } ?>    
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
                </div>
                <br>
                <div class="row mt-auto">
                    <div class="col-md-12">
                            <div class="ajax-load1 text-center" style="display:none;">
                                  <img src="<?php echo base_url('uploads/loader.gif');?>">
                            </div>
                           <div id="alert_message" style="color:red;"></div>
                            <button type="submit" class="btn btn-primary">Complete Order</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="modal fade contentmodal" id="addProvisional" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header">
                    <h3 class="mb-0">Add Lab Report</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i></button>
                </div>
                <form id="labform">
                    <div class="modal-body">
                        <input type="hidden" name="lab_order_id" id="lab_order_id">
                        <div class="add-wrap">
                            <div class="form-group">
                                <input type="file" class="form-control floating" name="file">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="ajax-load2 text-center" style="display:none;">
                              <img src="<?php echo base_url('uploads/loader.gif');?>">
                        </div>
                       <div id="alert_message2" style="color:red;"></div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script src="<?php echo base_url('backend/assets/js/jquery-3.6.0.min.js'); ?>"></script>
    <script>
        $(document).ready(function() {
            

            $(document).on('click','.prd',function()
            {
                var ldid = $(this).attr('id');
                $('#lab_order_id').val(ldid);            
            });

            var frm = $('#orderform');
            frm.submit(function(e){
                e.preventDefault();


                $(".ajax-load1").show();

                var formData = new FormData($(this)[0]);
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url().'lab/Order/change_order_status'?>',
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
                            location.href = "<?php echo base_url('lab/Order/complete_patient') ?>";   
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

            var frm = $('#labform');
            frm.submit(function(e){
                e.preventDefault();


                $(".ajax-load2").show();

                var formData = new FormData($(this)[0]);
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url().'lab/Order/upload_report'?>',
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
                            location.reload();   
                        }
                        else if(status=="unsuccess")
                        {   
                            $('#alert_message2').html('<div class="text-center alert alert-danger">'+message+'</div>');
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
