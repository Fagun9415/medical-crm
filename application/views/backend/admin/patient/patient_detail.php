<?php
    $patient = $details->patient;
    $dateOfBirth = date('d-m-Y',strtotime($patient->birthDate));
                    $today = date("Y-m-d");
                    $diff = date_diff(date_create($dateOfBirth), date_create($today));
                    $age = $diff->format('%y');


 ?>
<div class="page-wrapper">
            <div class="content container-fluid">

                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
                        <div class="profile-info">
                            <h4>Patient Profile</h4>
                            <div class="col-12">
                                <div class="row mt-3">
                                    <div class="col-xl-4 col-sm-12 col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="dash-widget-header">
                                                    <span class="dash-widget-icon bg-primary">
                                                        <i class="feather-user-plus"></i>
                                                    </span>
                                                    <div class="dash-count">
                                                        <h5 class="dash-title">Total Encounters</h5>
                                                        <div class="dash-counts">
                                                            <p><?php echo $details->encounterCount; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-sm-12 col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="dash-widget-header">
                                                    <span class="dash-widget-icon bg-primary">
                                                        <i class="feather-user-plus"></i>
                                                    </span>
                                                    <div class="dash-count">
                                                        <h5 class="dash-title">Total Pharmacy Orders</h5>
                                                        <div class="dash-counts">
                                                            <p><?php echo $details->pharmacyOrder; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-sm-12 col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="dash-widget-header">
                                                    <span class="dash-widget-icon bg-primary">
                                                        <i class="feather-user-plus"></i>
                                                    </span>
                                                    <div class="dash-count">
                                                        <h5 class="dash-title">Total Lab Orders</h5>
                                                        <div class="dash-counts">
                                                            <p><?php echo $details->labOrder; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Patient Details</h4>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h6><b>Name</b> : <?php echo ucwords($patient->name); ?>(<?php echo ucwords($patient->gender); ?>)</h6>    
                                            </div>
                                            <div class="col-md-3">
                                                <h6><b>Phone</b> : <?php echo '('.$patient->phoneCode.')'. $patient->phoneNo; ?></h6>    
                                            </div>
                                            <div class="col-md-3">
                                                <h6><b>Email</b> : <?php echo $patient->email; ?></h6>    
                                            </div>
                                            <div class="col-md-3">
                                                <h6><b>Age</b> : <?php echo $age; ?> yrs</h6>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Encounter And Order Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <ul class="nav nav-tabs nav-tabs-solid">
                                            <li class="nav-item"><a class="nav-link active" href="#solid-tab1"
                                                    data-bs-toggle="tab">Total Encounters</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#solid-tab2"
                                                    data-bs-toggle="tab">Total Pharmacy Orders</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#solid-tab3"
                                                    data-bs-toggle="tab">Total Lab Orders</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="solid-tab1">
                                                <div class="table-responsive">
                                                    <table class="datatable table table-borderless hover-table" id="data-table3">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Doctor</th>
                                                                <th>Disease</th>
                                                                <th>Encopunter Payment Amount</th>
                                                                <th>Encounter Payment Status</th>
                                                                <th>Encounter Date & Time</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($encounters as $key => $value) { 
                                                            
                                                            $doctor = $value->doctor;

                                                            if ($value->paymentPending == true) 
                                                            {
                                                                $pstatus = 'Pending';
                                                            }
                                                            else
                                                            {
                                                                $pstatus = 'Completed';
                                                            }    
                                                            ?>
                                                            <tr>
                                                                <td>#<?php echo $key+1; ?></td>
                                                                <td>
                                                                    <a href="#">
                                                                    <h2 class="table-avatar">
                                                                        <span class="user-name"><?php echo ucwords($doctor->name); ?></span>
                                                                    </h2><br>
                                                                    <span><?php echo "(".$doctor->doctorPhoneCode.") ".$doctor->doctorPhoneNo; ?></span><br>
                                                                        <span><?php echo $doctor->email; ?></span><br>
                                                                        <span><?php echo ucwords($doctor->hospitalName); ?></span>
                                                                    </a>
                                                                </td>
                                                                <td><?php echo ucwords($value->chiefComplaint); ?></td>
                                                                <td><?php echo $value->totalPayment; ?></td>
                                                                <td><?php echo $pstatus; ?></td>
                                                                <td><?php echo date('d-F-Y H:i:s',strtotime($value->createdAt)); ?></td>
                                                            </tr>
                                                        <?php } ?>    
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="solid-tab2">
                                                <div class="table-responsive">
                                                    <table class="datatable table table-borderless hover-table" id="data-table1">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Pharmacy</th>
                                                                <th>Total Medicines</th>
                                                                <th>Order Mode</th>
                                                                <th>Order Address</th>
                                                                <th>Order Status</th>
                                                                <th>Order Payment</th>
                                                                <th>Order Date & Time</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($pharmacies as $key1 => $value1) { 
                                                            
                                                            $orderInfo = $value1->orderInfo;
                                                            $pharmacy = $value1->pharmacy;

                                                                
                                                            ?>
                                                            <tr>
                                                                <td>#<?php echo $key1+1; ?></td>
                                                                <td>
                                                                    <a href="#">
                                                                    <h2 class="table-avatar">
                                                                        <span class="user-name"><?php echo ucwords($pharmacy->name); ?></span>
                                                                    </h2><br>
                                                                    <span><?php echo "(".$pharmacy->pharmacyPhoneCode1.") ".$pharmacy->pharmacyPhoneNo1; ?></span><br>
                                                                        <span><?php echo $pharmacy->email; ?></span><br>
                                                                        <span><?php echo ucwords($pharmacy->address); ?></span>
                                                                    </a>
                                                                </td>
                                                                <td><?php echo $orderInfo->totalMedicine; ?></td>
                                                                <td><?php echo ucwords($orderInfo->pharmacyOrderMode); ?></td>
                                                                <?php if ($orderInfo->pharmacyOrderMode == 'delivery') {  ?>
                                                                <td><?php echo $orderInfo->orderAddressLine1.','.$orderInfo->orderAddressLine2.','.$orderInfo->landmark; ?></td>
                                                                <?php } else { ?>
                                                                <td></td>
                                                                <?php } ?>
                                                                <td><?php echo ucwords($orderInfo->orderStatus); ?></td>
                                                                <td>
                                                                    Amount : <?php echo ucwords($orderInfo->paymentAmount); ?><br>
                                                                    Status : <?php echo ucwords($orderInfo->paymentStatus); ?>
                                                                    
                                                                </td>
                                                                <td><?php echo date('d-F-Y H:i:s',strtotime($orderInfo->orderDate)); ?></td>
                                                            </tr>
                                                        <?php } ?>    
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="solid-tab3">
                                                <div class="table-responsive">
                                                    <table class="datatable table table-borderless hover-table" id="data-table2">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Lab</th>
                                                                <th>Total Reports</th>
                                                                <th>Order Mode</th>
                                                                <th>Order Address</th>
                                                                <th>Order Status</th>
                                                                <th>Order Payment</th>
                                                                <th>Order Date & Time</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($labs as $key2 => $value2) { 
                                                            
                                                            $orderInfo = $value2->orderInfo;
                                                            $lab = $value2->lab;

                                                            if ($orderInfo->labOrderMode == "labVisit") 
                                                            {
                                                                $ordermode = 'Lab Visit';
                                                            }
                                                            elseif ($orderInfo->labOrderMode == "homeVisit") {
                                                                $ordermode = 'Home Visit';
                                                            }
                                                            else
                                                            {
                                                                $ordermode = '';
                                                            }    
                                                                
                                                            ?>
                                                            <tr>
                                                                <td>#<?php echo $key2+1; ?></td>
                                                                <td>
                                                                    <a href="#">
                                                                    <h2 class="table-avatar">
                                                                        <span class="user-name"><?php echo ucwords($lab->name); ?></span>
                                                                    </h2><br>
                                                                    <span><?php echo "(".$lab->labPhoneCode1.") ".$lab->labPhoneNo1; ?></span><br>
                                                                        <span><?php echo $lab->email; ?></span><br>
                                                                        <span><?php echo ucwords($lab->address); ?></span>
                                                                    </a>
                                                                </td>
                                                                <td><?php echo $orderInfo->totalReport; ?></td>
                                                                <td><?php echo $ordermode; ?></td>
                                                                <?php if ($orderInfo->labOrderMode == "homeVisit")  {?>
                                                                <td><?php echo $orderInfo->orderAddressLine1.','.$orderInfo->orderAddressLine2.','.$orderInfo->landmark; ?></td>
                                                                <?php } else { ?>
                                                                <td></td>
                                                                <?php } ?>
                                                                <td><?php echo ucwords($orderInfo->orderStatus); ?></td>
                                                                <td>
                                                                    Amount : <?php echo ucwords($orderInfo->paymentAmount); ?><br>
                                                                    Status : <?php echo ucwords($orderInfo->paymentStatus); ?>
                                                                    
                                                                </td>
                                                                <td><?php echo date('d-F-Y H:i:s',strtotime($orderInfo->orderDate)); ?></td>
                                                            </tr>
                                                        <?php } ?>    
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
                    </div>
                </div>

            </div>
        </div>
<script src="<?php echo base_url('backend/assets/js/jquery-3.6.0.min.js'); ?>"></script>

<script>
    $(document).ready(function(){

            
        $('#data-table3').DataTable( {
                
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

        $('#data-table1').DataTable( {
                
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

        $('#data-table2').DataTable( {
                
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
      



     
    });
</script>         