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
    $Referral = $details->referDoctor;

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
                            <h5 class="mb-1 d-flex"><div class="col-6">Provisional Diagnosis</div></h5>
                            <hr class="mt-0">
                            <div class="col-12 mb-5">
                                <div class="table-responsive">
                                    <table class="table table-borderless" id="provisional-diagnosis-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Provisional Diagnosis</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($provisionalDiagnosis as $key => $value) { 
                                                $provisional_diagnosis_id = my_encrypt($value->id);
                                                $encounter_id = my_encrypt($value->encounterId);
                                            ?>    

                                            <tr>
                                                <td><?php echo $key+1; ?></td>
                                                <td><?php echo $value->provisionalDiagnosis; ?>.</td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <h5 class="mb-1 d-flex"><div class="col-6">Lab Information</div></h5>
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
                                                            <th>Download</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($lab as $lkey => $lvalue) {?>
                                                        <tr>
                                                            <td><?php echo $lkey+1; ?></td>
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
                            <br>
                            <br>
                            <h5 class="mb-1 d-flex"><div class="col-6">Medicine Information</div></h5>
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
                                                        <th>Sr No.</th>
                                                        <th>Drug Name</th>
                                                        <th>Morning</th>
                                                        <th>Afternoon</th>
                                                        <th>Evening</th>
                                                        <th>Night</th>
                                                        <th>Comment</th>
                                                        <th>Days</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($medicine as $key1 => $value1) { 
                                                    $medicine_id = my_encrypt($value1->id);
                                                    $encounter_id1 = my_encrypt($value1->encounterId);

                                                    ?>
                                                    <tr>
                                                        <td><?php echo $key1+1; ?></td>
                                                        <td><?php echo $value1->drugName; ?></td>
                                                        <td><?php echo $value1->morning; ?></td>
                                                        <td><?php echo $value1->afternoon; ?></td>
                                                        <td><?php echo $value1->evening; ?></td>
                                                        <td><?php echo $value1->night; ?></td>
                                                        <td><?php echo $value1->comment; ?></td>
                                                        <td><?php echo $value1->comment; ?></td>
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
                                    <h5 class="mb-1 d-flex"><div class="col-6">Final Diagnosis</div></h5>
                                    <br>
                                    <hr class="mt-0">
                                    <div class="col-12 mb-5">
                                        <div class="table-responsive">
                                            <table class="table table-borderless" id="final-diagnosis-table">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Sr No.</th>
                                                        <th>Final Diagnosis</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                    <?php foreach ($finalDiagnosis as $key2 => $value2) { ?>
                                                        <td><?php echo $key2+1; ?></td>
                                                        <td><?php echo $value2->finalDiagnosis; ?></td>
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
                                            <input class="form-check-input" type="radio" name="Symptoms" id="syes" value="yes" <?php if ($encounter->symptomsResolved == true) { echo "checked";} else {}?>>
                                            <label class="form-check-label" for="syes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="Symptoms" id="sno" value="no" <?php if ($encounter->symptomsResolved == false) { echo "checked";} else {}?>>
                                            <label class="form-check-label" for="sno">No</label>
                                        </div>
                                    </div>
                                    <h5 class="mb-1">Patient Completed?</h5>
                                    <hr class="mt-0">
                                    <div class="col-12 mb-5">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="Complete" id="yes" value="yes"
                                            <?php if ($encounter->isComplete == '1') { echo "checked";} else {}?>
                                            >
                                            <label class="form-check-label" for="yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="Complete" id="no" value="no" <?php if ($encounter->isComplete == '0') { echo "checked";} else {}?>>
                                            <label class="form-check-label" for="no">No</label>
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
                                    <h5 class="mb-1">Is Referral?</h5>
                                    <hr class="mt-0">
                                    <div class="col-12 mb-5">
                                        <div class="table-responsive">
                                            <table class="table table-borderless" id="final-diagnosis-table">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Doctor Name</th>
                                                        <th>Doctor Contact</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                    <?php foreach ($Referral as $key3 => $value3) { 
                                                        ?>
                                                        <td><?php echo $value3->doctorName; ?></td>
                                                        <td><?php echo "(".$value3->doctorPhoneCode.") ".$value3->doctorPhoneNo; ?></td>
                                                    </tr>
                                                    <?php }  ?>
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