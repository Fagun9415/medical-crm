<?php
    
    $order = $details->labOrder;
    $lab = $details->lab;
    $tests = $details->labTests;
 ?>

<div class="page-wrapper">
            <div class="content container-fluid content-wrap">
                <form id="orderform" autocomplete="off">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="setting-info profile-info">
                            <h4>Lab Order Detail</h4>
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <label>Order Mode?<span class="text-danger">*</span></label>
                                    <hr class="mt-0">
                                    <div class="col-12">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="labOrderMode" id="homeVisit" value="homeVisit" <?php if ($order->labOrderMode == 'homeVisit') {
                                                echo "checked";
                                            } else{} ?> >
                                            <label class="form-check-label" for="homeVisit">Home Visit</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="labOrderMode" id="labVisit" value="labVisit" <?php if ($order->labOrderMode == 'labVisit') {
                                                echo "checked";
                                            } else{} ?>>
                                            <label class="form-check-label" for="labVisit">Lab Visit</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Order Date <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="orderDate" value="<?php echo date('d M Y',strtotime($order->orderDate)); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4 row justify-content-center font-weight-bold">
                                    Walk-in QR Code
                                    <img src="<?php echo base_url('backend/assets/img/QR_code_for_mobile_English_Wikipedia.svg.png'); ?>" height="150" width="150">
                                </div>
                                <?php if ($order->labOrderMode == 'homeVisit') {?>
                                    <div class="col-md-4 col-sm-12" >
                                        <div class="form-group">
                                            <label>Address Line 1<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="orderAddressLine1"  id="orderAddressLine1" value="<?php echo $order->orderAddressLine1; ?>"  readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12" >
                                        <div class="form-group">
                                            <label>Address Line 2<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="orderAddressLine2"  id="orderAddressLine2" value="<?php echo $order->orderAddressLine2; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Landmark <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="landmark"  id="landmark" value="<?php echo $order->landmark; ?>" readonly>
                                        </div>
                                    </div>
                                <?php } else { } ?>    
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Pincode <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="pincode"  id="pincode" value="<?php echo $order->pincode; ?>" readonly >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row">     
                            <h5 class="mb-1 d-flex">Lab Details</h5>
                            <hr class="mt-0">
                            <div class="col-12 row">
                                <div class="col-md-3 col-sm-6">
                                    <div class="card" style="border-color: black;">
                                        <div class="card-body" role="button">
                                            <h5 class="card-title"><?php echo ucwords($lab->name); ?></h5>
                                            <p class="card-text"><?php echo "(".$lab->labPhoneCode1.") ".$lab->labPhoneNo1; ?> <br><?php echo $lab->address; ?></p>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">     
                                <h5 class="mb-1 d-flex">Order Details</h5>
                                <hr class="mt-0">
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
                                            <?php foreach ($tests as $key => $value) { ?>
                                                <tr>
                                                    <td><?php echo $key+1; ?></td>
                                                    <td><?php echo $value->labTestName; ?></td>
                                                    <td>
                                                        <?php if ($value->labReport =='' ) { echo "In Process";
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
                </div>
            </div>
        </div>