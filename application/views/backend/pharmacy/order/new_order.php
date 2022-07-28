<div class="page-wrapper">
            <div class="content container-fluid content-wrap">
                <form action="<?php echo base_url('pharmacy/Order/add_order_step_one'); ?>" method="post">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="setting-info profile-info">
                            <h4>Order Information</h4>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating">
                                        <label class="focus-label">Mobile Number / Order ID</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-auto">
                    <div class="col-md-12">
                        <div class="submit-sec">
                            <button type="submit" class="btn btn-primary">Search Order</button>
                            <button class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>