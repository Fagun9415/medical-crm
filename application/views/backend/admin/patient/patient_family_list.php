<style type="text/css">
.dev-image {
    width: 50px; 
    height: 50px;
}
</style>
<div class="page-wrapper">
    <div class="content container-fluid pb-0">
        <div class="col-12">
            <h4 class="mb-3">Relation List</h4>
            <div class="row">
            <br><br><br>
                <?php foreach ($families as $key => $value) { 
                    $patient_id = my_encrypt($value->id);
                    ?>
                    <div class="col-xl-4 col-sm-6 col-12">
                        <a href="<?php echo base_url('admin/Patient/patient_detail/').$patient_id; ?>">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dash-widget-header">
                                        <?php if ($value->gender == 'male') { ?>
                                            <img src="<?php echo base_url('images/images/user2.png'); ?>" class="dev-image">
                                        <?php } else { ?>
                                            <img src="<?php echo base_url('images/images/user.png'); ?>" class="dev-image">
                                        <?php } ?>    
                                        <div class="dash-count">
                                            <h5 class="dash-title"><?php echo $value->name; ?></h5>
                                            <div class="dash-counts">
                                                <p><?php echo ucwords($value->role); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>