<style type="text/css">
    .page-wrapper {
    margin-left: 30px;
    padding-top: 60px;
    position: relative;
    transition: all 0.4s ease;
}

.dev-image {
    width: 50px; 
    height: 50px;
}
</style>
<div class="page-wrapper">
    <div class="content container-fluid pb-0">
        <div class="col-12">
            <h4 class="mb-3">Choose Profile</h4>
            <div class="row">
            <div class="col-md-12">
                 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPatient">+ Add Relation</button>
            </div>
            <br><br><br>
                <?php foreach ($families as $key => $value) { 
                    $patient_id = my_encrypt($value->id);
                    ?>
                    <div class="col-xl-4 col-sm-6 col-12">
                        <a href="javascript:void(0)" class="patientclick" id="<?php echo $patient_id ; ?>">
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
<div class="modal fade contentmodal" id="addPatient" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header">
                    <h3 class="mb-0">Add Patient Relation</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i></button>
                </div>
                <form id="signupform" autocomplete="off"> 
                    <div class="modal-body">
                        <div class="add-wrap">
                            <div class="form-group">
                                <label class="focus-label">Patient Name<span class="text-danger"></span></label>
                                <input type="text" class="form-control floating testauto" id="patient-name" name="name">
                            </div>
                            <div class="form-group">
                                <label class="focus-label">Patient Birth Date<span class="text-danger"></span></label>
                                <input type="date" class="form-control floating testauto" id="birth-date" name="birthDate">
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
                                    <input class="form-check-input" type="radio" name="gender" id="others" value="other">
                                    <label class="form-check-label" for="others">Others</label>
                                </div>
                            </div>
                            <label class="focus-label">Relation<span class="text-danger"></span></label>
                            <div class="form-group">
                                <select class="form-control floating testauto" name="role" >
                                <option value="father">Father</option>
                                <option value="mother">Mother</option>
                                <option value="wife">Wife</option>
                                <option value="son">Son</option>
                                <option value="daughter">Daughter</option>
                                <option value="brother">Brother</option>
                                <option value="sister">Sister</option>
                                <option value="grand_father">Grand Father</option>
                                <option value="grand_mother">Grand mother</option>
                                <option value="cousin_sister">Cousin Sister</option>
                                <option value="sister_in_law">Sister In Law</option>
                                <option value="daughter_in_law">Daughter In Law</option>
                                <option value="nephew">Nephew</option>
                                <option value="niece">Niece</option>
                                <option value="grand_son">Grand Son</option>
                                <option value="grand_daughter">Drand Daughter</option>
                                </select>
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="ajax-load1 text-center" style="display:none;">
                              <img src="<?php echo base_url('uploads/loader.gif');?>">
                        </div>
                       <div id="alert_message1" style="color:red;"></div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                        <button type="submit" class="btn btn-primary" >Add Patient</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script src="<?php echo base_url('backend/assets/js/jquery-3.6.0.min.js'); ?>"></script>


<script>
$(document).ready(function(){

    $(document).on('click', '.patientclick', function()
    {
        var id = $(this).attr("id");

        $.ajax({
                      
          url:"<?php echo base_url('patient/Dashboard/setsession') ?>",
          method:"POST",
          data:{id:id},
          success:function(data){
               location.href = "<?php echo base_url('patient/Dashboard') ?>";
          }
      });

    });


    var frm = $('#signupform');
        frm.submit(function(e){
            e.preventDefault();


            $(".ajax-load1").show();

            var formData = new FormData($(this)[0]);
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url().'patient/Dashboard/add_patient_relation'?>',
                data: formData,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data)
                {   
                    $(".ajax-load1").hide();
                    var res = JSON.parse(data);

                    status = res.status;
                    message = res.message;

                    if(status == "success")
                    {   
                        location.reload();  
                    }
                    else if(status=="unsuccess")
                    {   
                        $('#alert_message').html('<div class="text-center alert alert-danger">'+message+'</div>');
                    }
                    else
                    {

                    }
                }
            });
             setInterval(function(){
                  $('#alert_message').html('');
              }, 2000);
        });
 
});
</script>       