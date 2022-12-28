<div class="page-wrapper">
            <div class="content container-fluid content-wrap">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="setting-info profile-info">
                            <h5 class="mb-1 d-flex"><div class="col-12">Active Patients &nbsp;&nbsp;<a href="<?php echo base_url('doctor/Patient/add_new_patient'); ?>" class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i> Add New Patient</a></div></h5>
                            <br>
                            <form autocomplete="off" id="signupform">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Search Existing Patient</label>
                                    <input type="text" class="form-control filterme" id="mobileno" placeholder="Enter Mobile Number" name="mobileno" maxlength="10" required>
                                </div>
                                <div class="text-center">
                                    <div class="ajax-load1 text-center" style="display:none;">
                                          <img src="<?php echo base_url('uploads/loader.gif');?>">
                                      </div>
                                       <div id="alert_message" ></div>
                                </div>
                                <button class="btn btn-primary" type="submit">Search</button>
                                <a href="<?php echo base_url('doctor/Patient/active_patient'); ?>" class="btn btn-dark">Reset</a>
                            </div>
                        </form>
                            <br>    
                            <hr class="mt-0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="datatable table table-stripped" id="patient-table" style="width: ;100%">
                                            <thead >
                                                <tr>
                                                <th>ID</th>
                                                <th>Patient Name</th>
                                                <th>Patient Contact</th>
                                                <th>Consultant Date & Time</th>
                                                <th>Payment</th>
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
<script src="<?php echo base_url('backend/assets/js/jquery-3.6.0.min.js'); ?>"></script>
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

      active_patient_data();


      function active_patient_data()
      {
        $(".ajax-load1").hide();
        var mobileno = $('#mobileno').val();
            
        $('#patient-table').DataTable( {
                "ajax" : {
                    url:"<?php echo base_url('doctor/Patient/fetch_active_patient'); ?>",
                    type:"POST",
                    data : {
                        mobileno:mobileno
                    },
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

            $('#patient-table').DataTable().destroy(); 
                    active_patient_data();
        });

     
    });
</script>        