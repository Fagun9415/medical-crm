<div class="page-wrapper">
            <div class="content container-fluid content-wrap">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="setting-info profile-info">
                            <h5 class="mb-1 d-flex"><div class="col-6">Unverified Pharmacies</div></h5>
                            <br>    
                            <hr class="mt-0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="datatable table table-stripped" id="patient-table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Pharmacy Name</th>
                                                    <th>Contact Number</th>
                                                    <th>Pharmacy Address</th>
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

      verified_doctor();


      function verified_doctor()
      {
            
        $('#patient-table').DataTable( {
                "ajax" : {
                    url:"<?php echo base_url('admin/Pharmacy/fetch_unverified_pharmacy'); ?>"
                    
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

      $(document).on('click', '.status', function()
      {
        var id = $(this).attr("id");
      
        Swal.fire({
          title: 'Are you sure?',
              //text: "You won't be delete this customer!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#0B0B0B',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Want to verify this pharmacy?'
            }).then((result) => {
              if (result.value) {

                $.ajax({
                  url:"<?php echo base_url('admin/Pharmacy/verify_pharmacy') ?>",
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
                              title: 'Pharmacy Verified successfully!',
                              //text: "You can add more customer!",
                              type: 'success',
                              showCancelButton: false,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              confirmButtonText: 'Done',
                              cancelButtonText: "No",
                              }).then((result) => {
                              if (result.value) {
                                $('#patient-table').DataTable().destroy(); 
                                verified_doctor();
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