 <style>
        .ui-autocomplete {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 1056;
        display: none;
        float: left;
        min-width: 160px;
        padding: 5px 0;
        margin: 2px 0 0;
        list-style: none;
        font-size: 14px;
        text-align: left;
        background-color: #ffffff;
        border: 1px solid #cccccc;
        border: 1px solid rgba(0, 0, 0, 0.15);
        border-radius: 4px;
        -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
        background-clip: padding-box;
        }

        .ui-autocomplete > li > div {
        display: block;
        padding: 3px 20px;
        clear: both;
        font-weight: normal;
        line-height: 1.42857143;
        color: #333333;
        white-space: nowrap;
        }

        .ui-state-hover,
        .ui-state-active,
        .ui-state-focus {
        text-decoration: none;
        color: #262626;
        background-color: #f5f5f5;
        cursor: pointer;
        }

        .ui-helper-hidden-accessible {
        border: 0;
        clip: rect(0 0 0 0);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
        }
    </style>
<?php 
    $patient = $details->patient;
    $dateOfBirth = date('d-m-Y',strtotime($patient->birthDate));
    $today = date("Y-m-d");
    $diff = date_diff(date_create($dateOfBirth), date_create($today));
    $age = $diff->format('%y');
    $provisionalDiagnosis = $details->provisionalDiagnosis;
    $lab = $details->lab;
    $medicine = $details->medicine;
    $encounter = $details->encounter;
    $finalDiagnosis = $details->finalDiagnosis;
    $encounter_id = my_encrypt($encounter->id);
    
    $doctorLabReports = $details->doctorLabReports;

?>


<div class="page-wrapper">
            <div class="content container-fluid content-wrap">

                  <form id="encounterform" autocomplete="off">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="setting-info profile-info">
                            <h4>Patient Information</h4>
                            <div class="row mb-5">
                                <div class="col-md-12 col-sm-12">
                                    <h4 class="m-0 d-flex"><div class="col-6"><?php echo $patient->name; ?></div> <div class="col-6" style="text-align: right;"><span><?php echo $age; ?> Years (<?php echo ucwords($patient->gender); ?>)</span></div></h4>
                                    <span><?php echo "(".$patient->phoneCode.") ".$patient->phoneNo; ?></span><br>
                                    <span><?php echo $patient->email; ?></span>
                                </div> 
                            </div>
                          
                            <input type="hidden" name="encounterId" value="<?php echo $encounter_id; ?>">
                            <h5 class="mb-1 d-flex"><div class="col-6">Provisional Diagnosis</div><div class="col-6" style="text-align: right;"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProvisional">+ Add</button></div></h5>
                            <div class="col-12 mb-5">
                            <div class="ajax-load text-center" style="display:none;">
                                              <img src="<?php echo base_url('uploads/loader.gif');?>">
                                        </div>
                                       <div id="alert_message" style="color:red;"></div>
                                <div class="table-responsive">
                                    <table class="table table-borderless" id="provisional-diagnosis-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Provisional Diagnosis</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($provisionalDiagnosis as $key => $value) { 
                                                $provisional_diagnosis_id = my_encrypt($value->id);
                                                $encounter_id = my_encrypt($value->encounterId);
                                            ?>    

                                            <tr>
                                                <td><?php echo $value->provisionalDiagnosis; ?>.</td>
                                                <td><button type="button" class="btn btn-danger prd" id="<?php echo $provisional_diagnosis_id; ?>" data-pdeid="<?php echo $encounter_id;?>"   ><i class="fa fa-trash"></i></button></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <h5 class="mb-1 d-flex"><div class="col-6">Lab Information</div><div class="col-6" style="text-align: right;"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLab">Order New Lab</button></div></h5>
                            <hr class="mt-0">
                            <div class="col-12 row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-borderless" id="test-table">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Test Name</th>
                                                            <th>Download</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($lab as $lkey => $lvalue) {?>
                                                        <tr>
                                                            <td><?php echo strtoupper($lvalue->labTestName); ?></td>
                                                            <td>
                                                                    <?php if ($lvalue->labReport =='' ) { echo "In Process";
                                                                    } else { ?>    

                                                                    <a href="<?php echo curisurl.$lvalue->labReport; ?>" download class="btn btn-success" target="_blank"><i class="fa fa-download"></i></a>
                                                                    <?php } ?>
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
                            <br><br>
                            <h5 class="mb-1 d-flex"><div class="col-6">Medicine Information</div><div class="col-6" style="text-align: right;"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMedicine">Order New Pharmacy</button></div></h5>
                            <hr class="mt-0">
                            <div class="col-12 row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="ajax-load1 text-center" style="display:none;">
                                              <img src="<?php echo base_url('uploads/loader.gif');?>">
                                        </div>
                                       <div id="alert_message1" style="color:red;"></div>
                                        <div class="table-responsive">
                                            <table class="table table-borderless" id="medicine-table" style="width: 80%;" >
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Drug Name</th>
                                                        <th>Morning</th>
                                                        <th>Afternoon</th>
                                                        <th>Evening</th>
                                                        <th>Night</th>
                                                        <th>Comment</th>
                                                        <th>Days</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($medicine as $key1 => $value1) { 
                                                    $medicine_id = my_encrypt($value1->id);
                                                    $encounter_id1 = my_encrypt($value1->encounterId);

                                                    ?>
                                                    <tr>
                                                        <td><?php echo $value1->drugName; ?></td>
                                                        <td><?php echo $value1->morning; ?></td>
                                                        <td><?php echo $value1->afternoon; ?></td>
                                                        <td><?php echo $value1->evening; ?></td>
                                                        <td><?php echo $value1->night; ?></td>
                                                        <td><?php echo $value1->comment; ?></td>
                                                        <td><?php echo $value1->comment; ?></td>
                                                        <td><button type="button" class="btn btn-danger med" id="<?php echo $medicine_id; ?>" data-medeids="<?php echo $encounter_id1; ?>"><i class="fa fa-trash"></i></button></td>
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
                    <div class="col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <h5 class="mb-1 d-flex"><div class="col-6">Final Diagnosis</div><div class="col-6" style="text-align: right;"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFinal">+ Add</button></div></h5>
                                    <hr class="mt-0">
                                    <div class="col-12 mb-5">
                                        <div class="ajax-load2 text-center" style="display:none;">
                                              <img src="<?php echo base_url('uploads/loader.gif');?>">
                                        </div>
                                       <div id="alert_message2" style="color:red;"></div>
                                        <div class="table-responsive">
                                            <table class="table table-borderless" id="final-diagnosis-table">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Final Diagnosis</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                    <?php foreach ($finalDiagnosis as $key2 => $value2) { 
                                                        $encounter_id2 = my_encrypt($value2->encounterId);
                                                        $final_diagnosis_id = my_encrypt($value2->id);

                                                        ?>
                                                        <td><?php echo $value2->finalDiagnosis; ?></td>
                                                        <td><button type="button" class="btn btn-danger final" id="<?php echo $final_diagnosis_id; ?>" data-fdeid="<?php echo $encounter_id2; ?>"><i class="fa fa-trash"></i></button></td>
                                                    </tr>
                                                    <?php }  ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <h5 class="mb-1">Symptoms Resolved?</h5>
                                    <hr class="mt-0">
                                    <div class="col-12 mb-5">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="Symptoms" id="syes" value="yes">
                                            <label class="form-check-label" for="syes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="Symptoms" id="sno" value="no">
                                            <label class="form-check-label" for="sno">No</label>
                                        </div>
                                    </div>
                                    <h5 class="mb-1">Patient Completed?</h5>
                                    <hr class="mt-0">
                                    <div class="col-12 mb-5">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="Complete" id="yes" value="yes">
                                            <label class="form-check-label" for="yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="Complete" id="no" value="no">
                                            <label class="form-check-label" for="no">No</label>
                                        </div>
                                    </div>
                                    <h5 class="mb-1">Is Referral?</h5>
                                    <hr class="mt-0">
                                    <div class="col-12 mb-5">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="Referral" id="ryes" value="yes">
                                            <label class="form-check-label" for="ryes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="Referral" id="rno" value="no">
                                            <label class="form-check-label" for="rno">No</label>
                                        </div>
                                    </div>
                                    <div class="row mt-3" id="referral-data" style="display: none;">
                                        <div class="col-12">
                                            <div class="form-group form-focus">
                                                <input type="text" class="form-control floating" id="doctor-name" name="doctorName">
                                                <label class="focus-label">Doctor Name<span class="text-danger"></span></label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group form-focus">
                                                <input type="number" class="form-control floating" name="doctorPhoneNo" id="doctor-contact-number">
                                                <label class="focus-label">Doctor Contact Number<span class="text-danger"></span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="mb-1">Is It Chronic Patient?</h5>
                                    <hr class="mt-0">
                                    <div class="col-12 mb-5">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="chronic" id="cyes" <?php if ($encounter->chronicPatient == true) { echo "checked";} else {}?> value="yes">
                                            <label class="form-check-label" for="cyes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" <?php if ($encounter->chronicPatient == false) { echo "checked";} else {}?> name="chronic" id="cno" value="no">
                                            <label class="form-check-label" for="cno">No</label>
                                        </div>
                                    </div>
                                    <h5 class="mb-1 d-flex">
                                        <div class="col-6">Doctor Reports</div>
                                        <div class="col-6" style="text-align: right;"><button type="button" class="btn btn-primary" onclick="addDoctotReport()" >New Report</button></div>
                                    </h5>
                                    <hr class="mt-0">
                                    <div class="col-12 row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="ajax-load0 text-center" style="display:none;">
                                                        <img src="<?php echo base_url('uploads/loader.gif');?>">
                                                    </div>
                                                    <div id="alert_message0" style="color:red;"></div>
                                                    <div class="table-responsive">
                                                        <table class="table table-borderless" id="doctor-report">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>Test Name</th>
                                                                    <th>Report</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($doctorLabReports as $key1 => $value1) { 
                                                                $doctorLabReports_id = my_encrypt($value1->id);
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $value1->labTestName; ?></td>
                                                                    <td><a href="<?php echo curisurl.$value1->labReport; ?>" download class="btn btn-success" ><i class="fa fa-download"></i></a></td>
                                                                    <td><button type="button" class="btn btn-danger dreport" id="<?php echo $doctorLabReports_id; ?>"><i class="fa fa-trash"></i></button></td>
                                                                </tr>
                                                            <?php } ?>    
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="mb-1">Payment Mode</h5>
                                    <hr class="mt-0">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control floating filterme" name="totalPayment" placeholder="Amount" >
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="mode" id="cash" value="cash" >
                                            <label class="form-check-label" for="cash">Cash</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="mode" id="online" value="online">
                                            <label class="form-check-label" for="online">Online</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3" id="final-diagnosis-data" style="display: none;">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row mt-auto">
                    <div class="col-md-12">
                            <div class="ajax-load4 text-center" style="display:none;">
                                  <img src="<?php echo base_url('uploads/loader.gif');?>">
                            </div>
                           <div id="alert_message4" style="color:red;"></div>
                            <button type="submit" class="btn btn-primary">Save Patient</button>
                            <button class="btn btn-secondary" type="reset">Cancel</button>
                    </div>
                </div>
                </form>

            </div>
        </div>

    <div class="modal fade contentmodal" id="addMedicine" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header">
                    <h3 class="mb-0">Add Medicine</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i></button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="add-wrap">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating autocomplete" id="drug-name">
                                <label class="focus-label">Drug Name<span class="text-danger"></span></label>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating filterme" id="morning">
                                        <label class="focus-label">Morning<span class="text-danger"></span></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating filterme" id="afternoon">
                                        <label class="focus-label">Afternoon<span class="text-danger"></span></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating filterme" id="evening">
                                        <label class="focus-label">Evening<span class="text-danger"></span></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating filterme" id="night">
                                        <label class="focus-label">Night<span class="text-danger"></span></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating filterme" id="days">
                                        <label class="focus-label">Days<span class="text-danger"></span></label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating" id="comment">
                                        <label class="focus-label">Comment<span class="text-danger"></span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                        <button type="button" class="btn btn-primary" onclick="addMedicine()">Order Prescription</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade contentmodal" id="addLab" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header">
                    <h3 class="mb-0">Add Lab</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i></button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="add-wrap">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control testauto floating" id="test-name">
                                <label class="focus-label">Test Name<span class="text-danger"></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                        <button type="button" class="btn btn-primary" onclick="addTest()">Order Lab</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade contentmodal" id="addProvisional" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header">
                    <h3 class="mb-0">Add Provisional Diagnosis</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i></button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="add-wrap">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" id="provisional-diagnosis">
                                <label class="focus-label">Provisional Diagnosis<span class="text-danger"></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                        <button type="button" class="btn btn-primary" onclick="addProvisionalDiagnosis()">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade contentmodal" id="addFinal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header">
                    <h3 class="mb-0">Add Final Diagnosis</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i></button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="add-wrap">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating"  id="final-diagnosis">
                                <label class="focus-label">Final Diagnosis<span class="text-danger"></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                        <button type="button" class="btn btn-primary" onclick="addFinalDiagnosis()">Add</button>
                    </div>
                </form>
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
        $(document).ready(function() {
            
            $(document).on('click','.prd',function(){

            var eid = $(this).data('pdeid');

            var pdid = $(this).attr('id');
            $(".ajax-load").show();
            $('#alert_message').html('');
                $.ajax({
                          url:"<?php echo base_url('doctor/Patient/delete_provisional_diagnosis'); ?>",
                          method:"POST",
                          cache: false,
                          data : { eid:eid, pdid:pdid},
                          success:function(data)
                          {   
                             $(".ajax-load").hide();

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
                                setInterval(function(){
                                 $('#alert_message').html('');
                            }, 2000);
                          }
                })
            });

            $(document).on('click','.med',function(){

            var eid1 = $(this).data('medeids');
            var medid = $(this).attr('id');

            $(".ajax-load1").show();
            $('#alert_message1').html('');
                $.ajax({
                          url:"<?php echo base_url('doctor/Patient/delete_medicine_information'); ?>",
                          method:"POST",
                          cache: false,
                          data : { eid1:eid1, medid:medid},
                          success:function(data)
                          {   
                             $(".ajax-load1").hide();
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
                                setInterval(function(){
                                 $('#alert_message1').html('');
                            }, 2000);
                          }
                })
            });

            $(document).on('click','.dreport',function(){

          
            var id = $(this).attr('id');

            $(".ajax-load0").show();
            $('#alert_message0').html('');
                $.ajax({
                          url:"<?php echo base_url('doctor/Patient/delete_doctor_report'); ?>",
                          method:"POST",
                          cache: false,
                          data : {id:id},
                          success:function(data)
                          {   
                             $(".ajax-load0").hide();
                                var res = JSON.parse(data);
                                status = res.status;
                                message = res.message;

                                if(status == "success")
                                {   
                                    $('#alert_message0').html('<div class="text-center alert alert-success">'+message+'</div>');
                                    location.reload();   
                                }
                                else if(status=="unsuccess")
                                {   
                                    $('#alert_message0').html('<div class="text-center alert alert-danger">'+message+'</div>');
                                }
                                else
                                {

                                }
                                setInterval(function(){
                                 $('#alert_message1').html('');
                            }, 2000);
                          }
                })
            });


            $(document).on('click','.final',function(){

            var eid2 = $(this).data('fdeid');
            var fdid = $(this).attr('id');

            $(".ajax-load2").show();
            $('#alert_message2').html('');
                $.ajax({
                          url:"<?php echo base_url('doctor/Patient/delete_final_diagnosis'); ?>",
                          method:"POST",
                          cache: false,
                          data : { eid2:eid2, fdid:fdid},
                          success:function(data)
                          {   
                             $(".ajax-load2").hide();
                                var res = JSON.parse(data);
                                status = res.status;
                                message = res.message;

                                if(status == "success")
                                {   
                                    $('#alert_message2').html('<div class="text-center alert alert-success">'+message+'</div>');
                                    location.reload();   
                                }
                                else if(status=="unsuccess")
                                {   
                                    $('#alert_message2').html('<div class="text-center alert alert-danger">'+message+'</div>');
                                }
                                else
                                {

                                }
                                setInterval(function(){
                                 $('#alert_message2').html('');
                            }, 2000);
                          }
                })
            });


            var frm = $('#encounterform');
            frm.submit(function(e){
                e.preventDefault();


                $(".ajax-load4").show();

                var formData = new FormData($(this)[0]);
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url().'doctor/Patient/edit_save_encounter'?>',
                    data: formData,
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data)
                    {   
                        $(".ajax-load4").hide();
                        console.log(data);
                        var res = JSON.parse(data);
                        status = res.status;
                        message = res.message;
                        flag = res.flag;

                        if(status == "success")
                        {   
                            if (flag == "active" ) 
                            {
                                location.href = "<?php echo base_url('doctor/Patient/active_patient') ?>";   
                            }
                            else
                            {
                                location.href = "<?php echo base_url('doctor/Patient/past_patient') ?>";   
                            }    

                        }
                        else if(status=="unsuccess")
                        {   
                            $('#alert_message4').html('<div class="text-center alert alert-danger">'+message+'</div>');
                        }
                        else
                        {

                        }
                    }
                });
                 setInterval(function(){
                      $('#alert_message4').html('');
                  }, 2000);
            });




            $('input[type=radio][name=Referral]').change(function() {
                if (this.value == 'yes') {
                    $("#referral-data").css('display', 'block');
                }
                else if (this.value == 'no') {
                    $("#referral-data").css('display', 'none');
                    $("#doctor-name").val('');
                    $("#doctor-contact-number").val('');
                }
            });
            $('input[type=radio][name=Complete]').change(function() {
                if (this.value == 'yes') {
                    $("#final-diagnosis-data").css('display', 'block');
                }
                else if (this.value == 'no') {
                    $("#final-diagnosis-data").css('display', 'none');
                }
            });
        });

 
        function addProvisionalDiagnosis()
        {
            const provisional_diagnosis = $("#provisional-diagnosis").val();

            $("#provisional-diagnosis").val('');
            $("#provisional-diagnosis-table").append('<tr><td><input type="hidden" class="form-control floating" value="'+provisional_diagnosis+'" name="pdd[]">'+provisional_diagnosis+'</td><td><button type="button" class="btn btn-danger" onclick="return this.parentNode.parentNode.remove();"><i class="fa fa-trash"></i></button></td><tr>');
            $('#addProvisional').modal('hide');
        }
        function addTest()
        {
            const test_name = $("#test-name").val();
            $("#test-name").val('');
            $("#test-table").append('<tr><td><input type="hidden" class="form-control floating" value="'+test_name+'" name="test[]">'+test_name+'</td><td><button type="button" class="btn btn-danger" onclick="return this.parentNode.parentNode.remove();"><i class="fa fa-trash"></i></button></td><tr>');
            $('#addLab').modal('hide');
        }

        function addDoctotReport() {
        $('#doctor-report').append('<tr><td><input type="text" name="dreportname[]" class="form-control" placeholder="Enter Test Name"></td><td><input type="file" name="labReport[]"class="form-control" ></td><td><button type="button" class="btn btn-danger" onclick="return this.parentNode.parentNode.remove();"><i class="fa fa-trash"></i></button></td></tr>')
     }

        function addMedicine()
        {
            const drug_name = $("#drug-name").val();
            const morning = $("#morning").val();
            const afternoon = $("#afternoon").val();
            const evening = $("#evening").val();
            const night = $("#night").val();
            const comment = $("#comment").val() != '' ? $("#comment").val() : '-';
            const days = $("#days").val();
            $("#drug-name").val('');
            $("#morning").val('');
            $("#afternoon").val('');
            $("#evening").val('');
            $("#night").val('');
            $("#comment").val('');
            $("#days").val('');
            $("#medicine-table").append('<tr><td><input type="hidden" class="form-control floating" value="'+drug_name+'" name="drug_name[]">'+drug_name+'</td><td><input type="hidden" class="form-control floating" value="'+morning+'" name="morning[]">'+morning+'</td><td><input type="hidden" class="form-control floating" value="'+afternoon+'" name="afternoon[]">'+afternoon+'</td><td><input type="hidden" class="form-control floating" value="'+evening+'" name="evening[]">'+evening+'</td><td><input type="hidden" class="form-control floating" value="'+night+'" name="night[]">'+night+'</td><td><input type="hidden" class="form-control floating" value="'+comment+'" name="comment[]">'+comment+'</td><td><input type="hidden" class="form-control floating" value="'+days+'" name="noOfDays[]">'+days+'</td><td><button type="button" class="btn btn-danger" onclick="return this.parentNode.parentNode.remove();"><i class="fa fa-trash"></i></button></td><tr>');
            $('#addMedicine').modal('hide');
        }
        function addFinalDiagnosis()
        {
            const provisional_diagnosis1 = $("#final-diagnosis").val();
            $("#final-diagnosis").val('');
            $("#final-diagnosis-table").append('<tr><td><input type="text" class="form-control floating" value="'+provisional_diagnosis1+'" name="fdd[]">'+provisional_diagnosis1+'</td><td><button type="button" class="btn btn-danger" onclick="return this.parentNode.parentNode.remove();"><i class="fa fa-trash"></i></button></td><tr>');
            $('#addFinal').modal('hide');
        }
    </script>            