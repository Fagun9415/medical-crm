<?php 
    $order = $details->pharmacyorder;
    $pharmacy = $details->pharmacy;
    $med = $details->medicines;

    if ($order->orderStatus == "prescribe") 
                    {
                        $ostatus = '<button type="button" class="btn btn-primary">Order Now</button>';
                    }
                    elseif ($order->orderStatus == "pending") 
                    {
                       $ostatus = '<button type="button" class="btn btn-success"><span class="spinner-border spinner-border-sm me-2" role="status"></span>Processing</button>';
                    }
                    else
                    {
                        $ostatus = '';
                    }
?>


<div class="page-wrapper">
            <div class="content container-fluid content-wrap">
                <form id="orderform" autocomplete="off">
                <input type="hidden" name="encounterId" value="<?php echo $encounter_id; ?>">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="setting-info profile-info">
                            <h4>Pharmacy Order Alert Details <?php echo $ostatus; ?></h4>
                             <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <label>Order Mode?<span class="text-danger">*</span></label>
                                    <hr class="mt-0">
                                    <div class="col-12">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pharmacyOrderMode" id="delivery" value="delivery" <?php if ($order->pharmacyOrderMode == 'delivery') {
                                                echo "checked";
                                            } else{} ?> >
                                            <label class="form-check-label" for="delivery">Home Visit</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pharmacyOrderMode" id="pickup" value="pickup" <?php if ($order->pharmacyOrderMode == 'pickup') {
                                                echo "checked";
                                            } else{} ?>>
                                            <label class="form-check-label" for="pickup">Pickup</label>
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
                                    <?php if ($order->pharmacyOrderMode == 'delivery') {?>
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
                            <h5 class="mb-1 d-flex">Pharmacy Details</h5>
                            <hr class="mt-0">
                            <div class="col-12 row">
                                <div class="col-md-3 col-sm-6">
                                    <div class="card" style="border-color: black;">
                                        <div class="card-body" role="button">
                                            <h5 class="card-title"><?php echo ucwords($pharmacy->name); ?></h5>
                                            <p class="card-text"><?php echo "(".$pharmacy->pharmacyPhoneCode1.") ".$pharmacy->pharmacyPhoneNo1; ?> <br><?php echo $pharmacy->address; ?></p>
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
                            <h5 class="mb-1 d-flex">Order Details</h5>
                            <hr class="mt-0">
                            <div class="col-md-12 col-sm-12">
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
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($med as $key => $value) {?>
                                            <tr>
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
