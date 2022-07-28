<div class="page-wrapper">
            <div class="content container-fluid">

                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
                        <div class="profile-info">
                            <h4>Unverified Doctor Profile</h4>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Doctor Details</h4>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h6><b>Name</b> : <?php echo ucwords($details->name); ?></h6>    
                                            </div>
                                            <div class="col-md-3">
                                                <h6><b>Phone</b> : <?php echo '('.$details->doctorPhoneCode.')'. $details->doctorPhoneNo; ?></h6>    
                                            </div>
                                            <div class="col-md-3">
                                                <h6><b>Email</b> : <?php echo $details->email; ?></h6>    
                                            </div>
                                            <div class="col-md-3">
                                                <h6><b>Doctor Speciality</b> : <?php echo ucwords($details->doctorSpeciality); ?></h6>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Hospital Details</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6><b>Hospital Name</b> : <?php echo ucwords($details->hospitalName); ?></h6>    
                                            </div>
                                            <div class="col-md-6">
                                                <h6><b>Hospital Phone</b> : <?php echo '('.$details->hospitalPhoneCode.')'. $details->hospitalPhoneNo; ?></h6>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h4>License Details</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6><b>License number</b> : <?php echo $details->doctorRegistrationNo; ?></h6>    
                                            </div>
                                            <div class="col-md-6" >
                                                <a href="<?php echo curisurl.$details->doctorRegistrationDocument; ?>" download class="btn btn-success" target="_blank"><i class="fa fa-download"></i></a>            
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