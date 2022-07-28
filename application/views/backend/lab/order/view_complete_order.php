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
                                                                    <th>Report</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($order as $key => $value) { ?>
                                                                <tr>
                                                                    <td><?php echo $key+1; ?></td>
                                                                    <td><?php echo strtoupper($value->labTestName); ?></td>
                                                                    <?php if ($value->labReport == '' ) { } else { ?>
                                                                    <td><a href="<?php echo curisurl.$value->labReport; ?>" download class="btn btn-success" target="_blank"><i class="fa fa-download"></i></a></td>
                                                                    <?php } ?>
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
                </div>
            </div>
        </div>
