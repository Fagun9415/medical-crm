<?php
$lab = $details->lab;
$order = $details->order;
 ?>
<link rel="stylesheet" href="<?php echo base_url('backend/assets/css/bootstrap-switch-button.min.css'); ?>"> 
<div class="page-wrapper">
            <div class="content container-fluid">

                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                        <div class="profile-info">
                            <h4>Lab Profile</h4>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Lab Details</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6><b>Name</b> : <?php echo ucwords($lab->name); ?></h6>    
                                            </div>
                                            <div class="col-md-6">
                                                <h6><b>Phone 1</b> : <?php echo '('.$lab->labPhoneCode1.')'. $lab->labPhoneNo1; ?></h6>    
                                            </div>
                                            <?php if ($lab->labPhoneNo2 != '') { ?>
                                            <div class="col-md-6">
                                                <h6><b>Phone 2</b> : <?php echo '('.$lab->labPhoneCode2.')'. $lab->labPhoneNo2; ?></h6>    
                                            </div>
                                            <?php } else {} ?>
                                            <div class="col-md-6">
                                                <h6><b>Email</b> : <?php echo $lab->email; ?></h6>    
                                            </div>
                                            <div class="col-md-6">
                                                <h6><b>Lab Address</b> : <?php echo ucwords($lab->address); ?></h6>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h4>License Details</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6><b>License number</b> : <?php echo $lab->labRegistrationNo; ?></h6>    
                                            </div>
                                            <div class="col-md-6" >
                                                <a href="<?php echo curisurl.$lab->labRegistrationDocument; ?>" download class="btn btn-success" target="_blank"><i class="fa fa-download"></i></a>            
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
                            <input type="checkbox" data-toggle="switchbutton" id="<?php echo my_encrypt($lab->id); ?>" <?php if ($lab->isActive == 1) { echo "checked";} else {} ?> class="status">
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
                                                <h5 class="dash-title">Total Orders</h5>
                                                <div class="dash-counts">
                                                    <p><?php echo $details->totalOrders; ?></p>
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
                        <h4>Orders Details</h4>
                        <div class="table-responsive">
                            <table class="datatable table table-borderless hover-table" id="data-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Patient</th>
                                        <th>Doctor</th>
                                        <th>Order Mode</th>
                                        <th>Order Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($order as $key => $value) { 
                                    $patient = $value->patient;
                                    $encounter = $value->encounter;
                                    $doctor = $value->doctor;
                                    $orderInfo = $value->orderInfo;

                                    if ($orderInfo->labOrderMode == "labVisit") 
                                    {
                                        $mode = 'Lab Visit';
                                    }
                                    else if ($orderInfo->labOrderMode == "homeVisit") {
                                        $mode = 'Home Visit';
                                    }
                                    else
                                    {
                                        $mode = '';
                                    }    


                                    ?>
                                    <tr>
                                        <td>#<?php echo $key+1; ?></td>
                                        <td>
                                            <a href="#">
                                            <h2 class="table-avatar">
                                                <span class="user-name"><?php echo $patient->name; ?></span><br>
                                            </h2><br>
                                            <span><?php echo "(".$patient->phoneCode.") ".$patient->phoneNo; ?></span><br>
                                                <span><?php echo $patient->email; ?></span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#">
                                            <h2 class="table-avatar">
                                                <span class="user-name"><?php echo $doctor->name; ?></span>
                                            </h2><br>
                                            <span><?php echo "(".$doctor->doctorPhoneCode.") ".$doctor->doctorPhoneNo; ?></span><br>
                                                <span><?php echo $doctor->email; ?></span>
                                            </a>
                                        </td>
                                        <td><?php echo $mode; ?></td>
                                        <td><?php echo date('d-F-Y H:i:s',strtotime($encounter->createdAt)); ?></td>
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
                  url:"<?php echo base_url('admin/Lab/change_status') ?>",
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
                              title: 'Lab Status Changed successfully!',
                              //text: "You can add more customer!",
                              type: 'success',
                              showCancelButton: false,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              confirmButtonText: 'Done',
                              cancelButtonText: "No",
                              }).then((result) => {
                              if (result.value) {
                                location.href = "<?php echo base_url('admin/Lab/verified_lab_detail/') ?>"+id;
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