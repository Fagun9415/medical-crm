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
            </div>
        </div>