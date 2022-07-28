<div class="page-wrapper">
            <div class="content container-fluid content-wrap">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="setting-info profile-info">
                            <h5 class="mb-1 d-flex"><div class="col-6">Patient Details</div><div class="col-6" style="text-align: right;"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPatient">+ Add Relation</button></div></h5>
                            <hr class="mt-0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="datatable table table-stripped" id="patient-table">
                                            <thead >
                                                <tr>
                                                    <th>Patient Name</th>
                                                    <th>Birth Date</th>
                                                    <th>Gender</th>
                                                    <th>Relation</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<div class="modal fade contentmodal" id="addPatient" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header">
                    <h3 class="mb-0">Add Patient</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i></button>
                </div>
                <form id="signupform" autocomplete="off"> 
                <input type="hidden" name="phoneNo" value="<?php echo $mobile_no; ?>">
                    <div class="modal-body">
                        <div class="add-wrap">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating testauto" id="patient-name" name="name">
                                <label class="focus-label">Patient Name<span class="text-danger"></span></label>
                            </div>
                            <div class="form-group form-focus">
                                <input type="date" class="form-control floating testauto" id="birth-date" name="birthDate">
                                <label class="focus-label">Patient Birth Date<span class="text-danger"></span></label>
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
                            <div class="form-group form-focus">
                                <select class="form-control floating testauto" name="role" >
                                <option value="father">Father</option>
                                <option value="mother">Mother</option>
                                <option value="wife">Wife</option>
                                <option value="son">Son</option>
                                <option value="daughter">Daughter</option>
                                </select>
                                <label class="focus-label">Relation<span class="text-danger"></span></label>
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

      credential_data();


      function credential_data()
      {
         var mobileno = '<?php echo $mobile_no; ?>';


        $('#patient-table').DataTable( {
                /*dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
                buttons: {
                    buttons: [
                        { extend: 'copy', className: 'btn' },
                        { extend: 'csv', className: 'btn' },
                        { extend: 'excel', className: 'btn' },
                        { extend: 'print', className: 'btn' }
                    ]
                },*/
                "ajax" : {
                    url:"<?php echo base_url('doctor/Patient/fetch_patient_relation') ;?>",
                    type:"POST",
                    data:{mobileno:mobileno}
                },
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                   "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [10, 20, 50],
                "pageLength": 10 
            } );
      }

      var frm = $('#signupform');
        frm.submit(function(e){
            e.preventDefault();


            $(".ajax-load1").show();

            var formData = new FormData($(this)[0]);
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url().'doctor/Patient/add_patient_relation'?>',
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
                        $('#patient-table').DataTable().destroy(); 
                        credential_data();   
                        
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