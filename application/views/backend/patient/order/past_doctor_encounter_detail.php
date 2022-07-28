<?php 
    $doctor = $details->doctor;
    $pd = $details->provisionalDiagnosis;
    $lab = $details->lab;
    $medicine = $details->medicine;
    $patient = $details->patient;
    $dateOfBirth = date('d-m-Y',strtotime($patient->birthDate));
    $today = date("Y-m-d");
    $diff = date_diff(date_create($dateOfBirth), date_create($today));
    $age = $diff->format('%y');
 ?>
<div class="page-wrapper">
            <div class="content container-fluid content-wrap">

                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="setting-info profile-info">
                            <h4>Doctor Information </h4>
                            <div class="row mb-5">
                                <div class="col-md-12 col-sm-12">
                                    <h4 class="m-0 d-flex"><div class="col-6"><?php echo ucwords($doctor->name).'('.ucwords($doctor->doctorSpeciality).')'; ?></div> <div class="col-6" style="text-align: right;"><span><?php echo $doctor->hospitalName; ?> Hospital</span></div></h4>
                                    <span><?php echo "(".$doctor->doctorPhoneCode.") ".$doctor->doctorPhoneNo; ?></span><br>
                                    <span><?php echo $doctor->email; ?></span>
                                </div> 
                            </div>
                            <hr>
                            <h4>Patient Information </h4>
                            <div class="row mb-5">
                                <div class="col-md-12 col-sm-12">
                                    <h4 class="m-0 d-flex"><div class="col-6"><?php echo $patient->name; ?></div> <div class="col-6" style="text-align: right;"><span><?php echo $age; ?> Years (<?php echo ucwords($patient->gender); ?>)</span></div></h4>
                                    <span><?php echo "(".$patient->phoneCode.") ".$patient->phoneNo; ?></span><br>
                                    <span><?php echo $patient->email; ?></span>
                                </div>  
                            </div>
                            <h5 class="mb-1">Provisional Diagnosis</h5>
                            <hr class="mt-0">
                            <div class="col-12 mb-5">
                                <div class="table-responsive">
                                    <table class="table table-borderless" id="provisional-diagnosis-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Provisional Diagnosis</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($pd as $key => $value) { ?>
                                            <tr>
                                                <td><?php echo $value->provisionalDiagnosis; ?>.</td>
                                            </tr>
                                        <?php } ?>    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <h5 class="mb-1">Final Diagnosis</h5>
                            <hr class="mt-0">
                            <div class="col-12 mb-5">
                                <div class="table-responsive">
                                    <table class="table table-borderless" id="final-diagnosis-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Final Diagnosis</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($finalDiagnosis as $pkey => $pvalue) { ?>
                                            <tr>
                                                <td><?php echo $pvalue->finalDiagnosis; ?>.</td>
                                            </tr>
                                        <?php } ?>    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
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
                                    
                                    <h5 class="mb-1">Medicine Information</h5>
                                    <hr class="mt-0">
                                    <div class="col-12 row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless" id="medicine-table">
                                                        <thead class="thead-light">
                                                            <tr>
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
                                                <?php foreach ($medicine as $key1 => $value1) { ?>
                                                    <tr>
                                                        <td><?php echo $value1->drugName; ?></td>
                                                        <td><?php echo $value1->morning; ?></td>
                                                        <td><?php echo $value1->afternoon; ?></td>
                                                        <td><?php echo $value1->evening; ?></td>
                                                        <td><?php echo $value1->night; ?></td>
                                                        <td><?php echo $value1->comment; ?></td>
                                                        <td><?php echo $value1->noOfDays; ?></td>
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
                            <div class="col-12 mt-3" id="final-diagnosis-data" style="display: none;">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>