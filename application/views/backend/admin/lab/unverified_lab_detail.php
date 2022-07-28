<div class="page-wrapper">
            <div class="content container-fluid">

                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
                        <div class="profile-info">
                            <h4>Unverified Lab Profile</h4>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Lab Details</h4>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h6><b>Name</b> : <?php echo ucwords($details->name); ?></h6>    
                                            </div>
                                            <div class="col-md-3">
                                                <h6><b>Phone 1</b> : <?php echo '('.$details->labPhoneCode1.')'. $details->labPhoneNo1; ?></h6>    
                                            </div>
                                            <?php if ($details->labPhoneNo2 != '') {?>
                                            <div class="col-md-3">
                                                <h6><b>Phone 2</b> : <?php echo '('.$details->labPhoneCode2.')'. $details->labPhoneNo2; ?></h6>    
                                            </div>
                                            <?php } else {} ?>
                                            <div class="col-md-3">
                                                <h6><b>Email</b> : <?php echo $details->email; ?></h6>    
                                            </div>
                                            <div class="col-md-3">
                                                <h6><b>Lab Address</b> : <?php echo ucwords($details->address); ?></h6>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h4>License Details</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6><b>License number</b> : <?php echo $details->labRegistrationNo; ?></h6>    
                                            </div>
                                            <div class="col-md-6" >
                                                <a href="<?php echo curisurl.$details->labRegistrationDocument; ?>" download class="btn btn-success" target="_blank"><i class="fa fa-download"></i></a>            
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