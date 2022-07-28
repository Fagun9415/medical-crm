<div class="page-wrapper">
            <div class="content container-fluid content-wrap">
                <form action="<?php echo base_url('pharmacy/Order/add_order_step_two'); ?>" method="post">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="setting-info profile-info">
                            <h5 class="mb-1">Personal Details</h5>
                            <hr class="mt-0">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating">
                                        <label class="focus-label">First Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating">
                                        <label class="focus-label">Last Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating">
                                        <label class="focus-label">Birth Date</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating">
                                        <label class="focus-label">Mobile Number</label>
                                    </div>
                                </div>  
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating">
                                        <label class="focus-label">Email</label>
                                    </div>
                                </div>  
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group form-focus">
                                        <input type="date" class="form-control floating">
                                    </div>
                                </div>  
                                <div class="col-md-6 col-sm-12 d-flex align-items-center">
                                    Gender:&nbsp;&nbsp;     
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="others" value="others">
                                        <label class="form-check-label" for="others">Others</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="setting-info profile-info">
                            <h5 class="mb-1">Address & Location</h5>
                            <hr class="mt-0">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating">
                                        <label class="focus-label">Address / Street name</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating">
                                        <label class="focus-label">Country</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating">
                                        <label class="focus-label">City</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating">
                                        <label class="focus-label">State</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating">
                                        <label class="focus-label">Pincode</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-auto">
                    <div class="col-md-12">
                        <div class="submit-sec">
                            <button type="submit" class="btn btn-primary">Next</button>
                            <button class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>