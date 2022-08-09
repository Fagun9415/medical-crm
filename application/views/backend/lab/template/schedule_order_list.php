<div class="page-wrapper">
            <div class="content container-fluid content-wrap">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="setting-info profile-info">
                            <h5 class="mb-1 d-flex">Walk-in Order List</h5>
                            <hr class="mt-0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="datatable table table-stripped" id="patient-table" style="width:100%">
                                            <thead >
                                                <tr>    
                                                    <th>ID</th>
                                                    <th>Patient</th>
                                                    <th>Patient Contact</th>
                                                    <th>Doctor</th>
                                                    <th>Date</th>
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
                    url:"<?php echo base_url('lab/Dashboard/fetch_schedule_order') ;?>",
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


     
    });
</script>        