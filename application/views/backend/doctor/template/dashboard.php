<div class="page-wrapper">
            <div class="content container-fluid pb-0">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="mb-3">Overview</h4>
                        <a href="<?php echo base_url('doctor/Patient/add_patient'); ?>" class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i> Search/Add Patient</a>
                        </div>
                        
                    </div>
                </div>

                
                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-12">
                        <a href="<?php echo base_url('doctor/Patient/active_patient'); ?>">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dash-widget-header">
                                        <span class="dash-widget-icon bg-primary">
                                            <i class="feather-user"></i>
                                        </span>
                                        <div class="dash-count">
                                            <h5 class="dash-title">Active Patients</h5>
                                            <div class="dash-counts">
                                                <p><?php echo $counts->activePatients; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                    <a href="<?php echo base_url('doctor/Patient/past_patient'); ?>">    
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-primary">
                                        <i class="feather-user"></i>
                                    </span>
                                    <div class="dash-count">
                                        <h5 class="dash-title">Past Patients</h5>
                                        <div class="dash-counts">
                                            <p><?php echo $counts->pastPatients; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                    <a href="<?php echo base_url('doctor/Patient/chronic_patient'); ?>">
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-blue">
                                        <i class="feather-user"></i>
                                    </span>
                                    <div class="dash-count">
                                        <h5 class="dash-title">Chronic Patients</h5>
                                        <div class="dash-counts">
                                            <p><?php echo $counts->chronicPatients; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>