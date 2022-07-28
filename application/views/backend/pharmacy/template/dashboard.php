<div class="page-wrapper">
            <div class="content container-fluid pb-0">
                <h4 class="mb-3">Overview</h4>
                <div class="col-md-12" >
                 <a href="<?php echo base_url('pharmacy/Dashboard/add_walkin_order'); ?>" class="btn btn-primary">Add Walk-in Order</a>
                 </div>
                 <br>
                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-12">
                        <a href="<?php echo base_url('pharmacy/Order/schedule_patient'); ?>">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dash-widget-header">
                                        <span class="dash-widget-icon bg-blue">
                                            <i class="feather-calendar"></i>
                                        </span>
                                        <div class="dash-count">
                                            <h5 class="dash-title">Schedule Orders</h5>
                                            <div class="dash-counts text-center">
                                                <p><?php echo $counts->pendingOrders; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>    
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <a href="<?php echo base_url('pharmacy/Order/complete_patient'); ?>">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dash-widget-header">
                                        <span class="dash-widget-icon bg-primary">
                                            <i class="feather-user"></i>
                                        </span>
                                        <div class="dash-count">
                                            <h5 class="dash-title">Past Orders</h5>
                                            <div class="dash-counts text-center">
                                                <p><?php echo $counts->completeOrders; ?></p>
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