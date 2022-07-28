<div class="page-wrapper">
    <div class="content container-fluid pb-0">
        <h4 class="mb-3">Overview</h4>
        <div class="row">
            <div class="col-xl-3 col-sm-6 col-12">
				<a href= "<?php echo base_url('patient/Order/past_doctor_order'); ?>">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-primary">
                                <i class="feather-user-plus"></i>
                            </span>
                            <div class="dash-count">
                                <h5 class="dash-title">Visited Doctors</h5>
                                <div class="dash-counts">
                                    <p><?php echo $counts->visitedDoctors; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				</a>	
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
				<a href= "<?php echo base_url('patient/Order/past_pharmacy_order'); ?>">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-blue">
                                <i class="feather-users"></i>
                            </span>
                            <div class="dash-count">
                                <h5 class="dash-title">Visited Pharmacy</h5>
                                <div class="dash-counts">
                                    <p><?php echo $counts->visitedPharmacy; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				</a>		
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
			<a href= "<?php echo base_url('patient/Order/past_lab_order'); ?>">	
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-warning">
                                <img src="<?php echo base_url('backend/assets/img/icon/calendar.png'); ?>" alt="User Image">
                            </span>
                            <div class="dash-count">
                                <h5 class="dash-title">Visited Labs</h5>
                                <div class="dash-counts">
                                    <p><?php echo $counts->visitedLabs; ?></p>
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

    