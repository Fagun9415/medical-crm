<div class="page-wrapper">
            <div class="content container-fluid pb-0">
                <h4 class="mb-3">Overview</h4>
                <div class="row">
                    <div class="col-xl-6 col-sm-6 col-12">
                        <a href="<?php echo base_url('admin/Doctor/verified_doctor'); ?>">    
                            <div class="card">
                                <div class="card-body">
                                    <div class="dash-widget-header">
                                        <span class="dash-widget-icon bg-primary">
                                            <i class="feather-user"></i>
                                        </span>
                                        <div class="dash-count">
                                            <h5 class="dash-title">Total Verified Doctors</h5>
                                            <div class="dash-counts">
                                                <p><?php echo $counts->totalDoctors; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>    
                    </div>
                    <div class="col-xl-6 col-sm-6 col-12">
                        <a href="<?php echo base_url('admin/Patient/patient_list'); ?>">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dash-widget-header">
                                        <span class="dash-widget-icon bg-primary">
                                            <i class="feather-user"></i>
                                        </span>
                                        <div class="dash-count">
                                            <h5 class="dash-title">Total Patients</h5>
                                            <div class="dash-counts">
                                                <p><?php echo $counts->totalPatients; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>    
                    </div>
                    <div class="col-xl-6 col-sm-6 col-12">
                        <a href="<?php echo base_url('admin/Pharmacy/verified_pharmacy'); ?>">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dash-widget-header">
                                        <span class="dash-widget-icon bg-primary">
                                            <i class="feather-user"></i>
                                        </span>
                                        <div class="dash-count">
                                            <h5 class="dash-title">Total Verified Pharmacies</h5>
                                            <div class="dash-counts">
                                                <p><?php echo $counts->totalPharmacies; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>    
                    </div>
                    <div class="col-xl-6 col-sm-6 col-12">
                        <a href="<?php echo base_url('admin/Lab/verified_lab'); ?>">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dash-widget-header">
                                        <span class="dash-widget-icon bg-primary">
                                            <i class="feather-user"></i>
                                        </span>
                                        <div class="dash-count">
                                            <h5 class="dash-title">Total Verified Labs</h5>
                                            <div class="dash-counts">
                                                <p><?php echo $counts->totalLabs; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>    
                    </div>
                    <!-- <div class="col-xl-6 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-blue">
                                        <i class="feather-calendar"></i>
                                    </span>
                                    <div class="dash-count">
                                        <h5 class="dash-title">Doctor Orders</h5>
                                        <div class="dash-counts">
                                            <p>4505</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-blue">
                                        <i class="feather-calendar"></i>
                                    </span>
                                    <div class="dash-count">
                                        <h5 class="dash-title">Pharmacy Orders</h5>
                                        <div class="dash-counts">
                                            <p>2000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-blue">
                                        <i class="feather-calendar"></i>
                                    </span>
                                    <div class="dash-count">
                                        <h5 class="dash-title">Lab Orders</h5>
                                        <div class="dash-counts">
                                            <p>4500</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>