<?php
$doctor = $details->doctor;
$encounter = $details->encounterList;
 ?>
<link rel="stylesheet" href="<?php echo base_url('backend/assets/css/bootstrap-switch-button.min.css'); ?>"> 
<div class="page-wrapper">
            <div class="content container-fluid">

                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                        <div class="profile-info">
                            <h4>Doctor Profile</h4>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Doctor Details</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6><b>Name</b> : <?php echo ucwords($doctor->name); ?></h6>    
                                            </div>
                                            <div class="col-md-6">
                                                <h6><b>Phone</b> : <?php echo '('.$doctor->doctorPhoneCode.')'. $doctor->doctorPhoneNo; ?></h6>    
                                            </div>
                                            <div class="col-md-6">
                                                <h6><b>Email</b> : <?php echo $doctor->email; ?></h6>    
                                            </div>
                                            <div class="col-md-6">
                                                <h6><b>Doctor Speciality</b> : <?php echo ucwords($doctor->doctorSpeciality); ?></h6>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Hospital Details</h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h6><b>Hospital Name</b> : <?php echo ucwords($doctor->hospitalName); ?></h6>    
                                            </div>
                                            <div class="col-md-12">
                                                <h6><b>Hospital Phone</b> : <?php echo '('.$doctor->hospitalPhoneCode.')'. $doctor->hospitalPhoneNo; ?></h6>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h4>License Details</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6><b>License number</b> : <?php echo $doctor->doctorRegistrationNo; ?></h6>    
                                            </div>
                                            <div class="col-md-6" >
                                                <a href="<?php echo curisurl.$doctor->doctorRegistrationDocument; ?>" download class="btn btn-success" target="_blank"><i class="fa fa-download"></i></a>            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                        <div style="text-align: right;">
                            <a class="edit-pro" style="margin-right: 10px;"><b>Active</b></a>
                            <input type="checkbox" data-toggle="switchbutton" id="<?php echo my_encrypt($doctor->id); ?>" <?php if ($doctor->isActive == 1) { echo "checked";} else {} ?> class="status">
                        </div>
                        <div class="row mt-3">
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dash-widget-header">
                                            <span class="dash-widget-icon bg-primary">
                                                <i class="feather-user-plus"></i>
                                            </span>
                                            <div class="dash-count">
                                                <h5 class="dash-title">Total Patients</h5>
                                                <div class="dash-counts">
                                                    <p><?php echo $details->totalPatients; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dash-widget-header">
                                            <span class="dash-widget-icon bg-primary">
                                                <i class="feather-user-plus"></i>
                                            </span>
                                            <div class="dash-count">
                                                <h5 class="dash-title">Total Revenue</h5>
                                                <div class="dash-counts">
                                                    <p><?php echo $details->totalRevenue; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4>Encounter Details</h4>
                        <div class="table-responsive">
                            <table class="datatable table table-borderless hover-table" id="data-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Patient Name</th>
                                        <th>Contact Number</th>
                                        <th>Email</th>
                                        <th>Consultant Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($encounter as $key => $value) { ?>
                                    <tr>
                                        <td>#<?php echo $key+1; ?></td>
                                        <td>
                                            <a href="#">
                                            <h2 class="table-avatar">
                                                <span class="user-name"><?php echo $value->patientName; ?></span>
                                            </h2></a>
                                        </td>
                                        <td><?php echo "(".$value->patientPhoneCode.") ".$value->patientPhoneNo; ?></td>
                                        <td>
                                            <?php echo $value->patientEmail; ?>
                                        </td>
                                        <td><?php echo date('d-F-Y H:i:s',strtotime($value->createdAt)); ?></td>
                                    </tr>
                                <?php } ?>    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
<script src="<?php echo base_url('backend/assets/js/bootstrap-switch-button.min.js'); ?>"></script>        
<script src="<?php echo base_url('backend/assets/js/jquery-3.6.0.min.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
        $('.filterme').keypress(function(eve) {
        if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0)) {
        eve.preventDefault();
        }

        // this part is when left part of number is deleted and leaves a . in the leftmost position. For example, 33.25, then 33 is deleted
        $('.filterme').keyup(function(eve) {
        if ($(this).val().indexOf('.') == 0) {
        $(this).val($(this).val().substring(1));
        }
        });
        });
    </script>
<script>
    $(document).ready(function(){

      $(document).on('change', '.status', function()
      {
        var id = $(this).attr("id");
      
        Swal.fire({
          title: 'Are you sure?',
              //text: "You won't be delete this customer!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#0B0B0B',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Want to change status?'
            }).then((result) => {
              if (result.value) {

                $.ajax({
                  url:"<?php echo base_url('admin/Doctor/change_status') ?>",
                  method:"POST",
                  data:{id:id},
                  success:function(data)
                  { 
                      var res = JSON.parse(data);
                      datastatus = res.status;
                      message = res.message;

                      if(datastatus=='success')
                      {
                              Swal.fire({
                              title: 'Doctor Status Changed successfully!',
                              //text: "You can add more customer!",
                              type: 'success',
                              showCancelButton: false,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              confirmButtonText: 'Done',
                              cancelButtonText: "No",
                              }).then((result) => {
                              if (result.value) {
                                location.href = "<?php echo base_url('admin/Doctor/verified_doctor_detail/') ?>"+id;
                              }
                          
                          })
                      }
                      else
                      {
                          $('#alert_message').html('<div class="text-center alert alert-danger">'+message+'</div>');
                      }

                  }
                });
                setInterval(function(){
                    $('#alert_message').html('');
                }, 2000);
              }
            })
        });


     
    });
</script>