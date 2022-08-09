 <style>
        .ui-autocomplete {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 1056;
        display: none;
        float: left;
        min-width: 160px;
        padding: 5px 0;
        margin: 2px 0 0;
        list-style: none;
        font-size: 14px;
        text-align: left;
        background-color: #ffffff;
        border: 1px solid #cccccc;
        border: 1px solid rgba(0, 0, 0, 0.15);
        border-radius: 4px;
        -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
        background-clip: padding-box;
        }

        .ui-autocomplete > li > div {
        display: block;
        padding: 3px 20px;
        clear: both;
        font-weight: normal;
        line-height: 1.42857143;
        color: #333333;
        white-space: nowrap;
        }

        .ui-state-hover,
        .ui-state-active,
        .ui-state-focus {
        text-decoration: none;
        color: #262626;
        background-color: #f5f5f5;
        cursor: pointer;
        }

        .ui-helper-hidden-accessible {
        border: 0;
        clip: rect(0 0 0 0);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
        }
    </style>
<div class="page-wrapper">
            <div class="content container-fluid content-wrap">
                <form id="encounterform" autocomplete="off">
                <input type="hidden" name="patientId" value="<?php echo $patient_id; ?>">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="setting-info profile-info">
                            <h5 class="mb-1">Disease Information</h5>
                            <hr class="mt-0">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <h5 class="mb-1">Encounter Date</h5>
                                    <div class="form-group form-focus focused">
                                        <input type="date" class="form-control floating" name="encounterDate">
                                    </div>
                                </div>  
                                <div class="col-md-6 col-sm-12">
                                    <h5 class="mb-1">Chronic Illness</h5>
                                    <div class="form-group">
                                        <select class="form-control" multiple id="chronic-illness" name="chronicalIllness[]" data-placeholder="Chronic Illness">
                                            <option value="None">None</option>
                                            <option value="Diabetes">Diabetes</option>
                                            <option value="Hypertension">Hypertension</option>
                                            <option value="Kidney Disease">Kidney Disease</option>
                                            <option value="Liver Disease">Liver Disease</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <h5 class="mb-1">Chief Complaint</h5>
                                    <div class="form-group">
                                        <textarea class="form-control" name="chiefComplaint" placeholder="Chief Complaint" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <h5 class="mb-1">Other Symptoms</h5>
                                    <div class="form-group">
                                        <textarea class="form-control" name="otherSymptoms" placeholder="Other Symptoms" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <h5 class="mb-1 d-flex"><div class="col-6">Provisional Diagnosis</div><div class="col-6" style="text-align: right;"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProvisional">+ Add</button></div></h5>
                                    <hr class="mt-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-borderless" id="provisional-diagnosis-table">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Provisional Diagnosis</th>
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
                    <div class="col-md-6 col-sm-12 mt-3">
                        <div class="row">        
                            <h5 class="mb-1 d-flex"><div class="col-6">Lab Information</div><div class="col-6" style="text-align: right;"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLab">Order New Lab</button></div></h5>
                            <hr class="mt-0">
                            <div class="col-12 row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-borderless" id="test-table">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Test Name</th>
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
                    
                    <div class="col-md-6 col-sm-12 mt-3">
                        <div class="row">
                            <h5 class="mb-1 d-flex"><div class="col-6">Medicine Information</div><div class="col-6" style="text-align: right;"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMedicine">Order New Pharmacy</button></div></h5>
                            <hr class="mt-0">
                            <div class="col-12">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-borderless" id="medicine-table">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Drug Name</th>
                                                        <th>Morning</th>
                                                        <th>Afternoon</th>
                                                        <th>Evening</th>
                                                        <th>Night</th>
                                                        <th>Comment</th>
                                                        <th>Days</th>
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
                    
                    <div class="col-md-6 col-sm-12 mt-3">
                        <div class="row">
                            <h5 class="mb-1">Is Referral?</h5>
                            <hr class="mt-0">
                            <div class="col-12 mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Referral" id="yes" value="yes" >
                                    <label class="form-check-label" for="yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Referral" id="no" value="no">
                                    <label class="form-check-label" for="no">No</label>
                                </div>
                                <div class="row mt-3" id="referral-data" style="display: none;">
                                    <div class="col-12">
                                        <div class="form-group form-focus">
                                            <input type="text" class="form-control floating" id="doctor-name" name="doctorName">
                                            <label class="focus-label">Doctor Name<span class="text-danger"></span></label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group form-focus">
                                            <input type="number" class="form-control floating filterme" id="doctor-contact-number" name="doctorPhoneNo">
                                            <label class="focus-label">Doctor Contact Number<span class="text-danger"></span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5 class="mb-1">Is It Chronic Patient?</h5>
                            <hr class="mt-0">
                            <div class="col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="chronicPatient" id="cyes" value="true">
                                    <label class="form-check-label" for="cyes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="chronicPatient" id="cno" value="false">
                                    <label class="form-check-label" for="cno">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-12 mt-3">
                        <h5 class="mb-1">Payment Mode</h5>
                        <hr class="mt-0">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control floating filterme" name="totalPayment" placeholder="Amount" id="doctor-name">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="paymentMode" id="cash" value="cash" >
                                <label class="form-check-label" for="cash">Cash</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="paymentMode" id="online" value="online" >
                                <label class="form-check-label" for="online">Online</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-auto">
                    <div class="col-md-12">
                        <div class="submit-sec">
                            <div class="ajax-load1 text-center" style="display:none;">
                                  <img src="<?php echo base_url('uploads/loader.gif');?>">
                            </div>
                           <div id="alert_message" style="color:red;"></div>
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button class="btn btn-secondary" type="reset">Cancel</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
<div class="modal fade contentmodal" id="addMedicine" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header">
                    <h3 class="mb-0">Add Medicine</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i></button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="add-wrap">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating autocomplete" id="drug-name">
                                <label class="focus-label">Drug Name<span class="text-danger"></span></label>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating filterme" id="morning">
                                        <label class="focus-label">Morning<span class="text-danger"></span></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating filterme" id="afternoon">
                                        <label class="focus-label">Afternoon<span class="text-danger"></span></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating filterme" id="evening">
                                        <label class="focus-label">Evening<span class="text-danger"></span></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating filterme" id="night">
                                        <label class="focus-label">Night<span class="text-danger"></span></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group form-focus">
                                        <input type="number" class="form-control floating" id="days">
                                        <label class="focus-label">Days<span class="text-danger"></span></label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating" id="comment">
                                        <label class="focus-label">Comment<span class="text-danger"></span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                        <button type="button" class="btn btn-primary" onclick="addMedicine()">Order Prescription</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade contentmodal" id="addLab" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header">
                    <h3 class="mb-0">Add Lab</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i></button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="add-wrap">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating testauto" id="test-name">
                                <label class="focus-label">Test Name<span class="text-danger"></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                        <button type="button" class="btn btn-primary" onclick="addTest()">Order Lab</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade contentmodal" id="addProvisional" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header">
                    <h3 class="mb-0">Add Provisional Diagnosis</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i></button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="add-wrap">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" id="provisional-diagnosis">
                                <label class="focus-label">Provisional Diagnosis<span class="text-danger"></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                        <button type="button" class="btn btn-primary" onclick="addProvisionalDiagnosis()">Add</button>
                    </div>
                </form>
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
        $(document).ready(function() {
            $('input[type=radio][name=Referral]').change(function() {
                if (this.value == 'yes') {
                    $("#referral-data").css('display', 'block');
                }
                else if (this.value == 'no') {
                    $("#referral-data").css('display', 'none');
                    $("#doctor-name").val('');
                    $("#doctor-contact-number").val('');
                }
            });

            $('#chronic-illness').select2();
            var availableTags = [
                "ActionScript",
                "AppleScript",
                "Asp",
                "BASIC",
                "C",
                "C++",
                "Clojure",
                "COBOL",
                "ColdFusion",
                "Erlang",
                "Fortran",
                "Groovy",
                "Haskell",
                "Java",
                "JavaScript",
                "Lisp",
                "Perl",
                "PHP",
                "Python",
                "Ruby",
                "Scala",
                "Scheme"
            ];

            var frm = $('#encounterform');
            frm.submit(function(e){
                e.preventDefault();


                $(".ajax-load1").show();

                var formData = new FormData($(this)[0]);
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url().'doctor/Patient/add_save_encounter'?>',
                    data: formData,
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data)
                    {   
                        $(".ajax-load1").hide();
                        console.log(data);  
                        var res = JSON.parse(data);
                        status = res.status;
                        message = res.message;

                        if(status == "success")
                        {   
                            location.href = "<?php echo base_url('doctor/Patient/active_patient') ?>";   
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

        function addProvisionalDiagnosis()
        {
            const provisional_diagnosis = $("#provisional-diagnosis").val();

            $("#provisional-diagnosis").val('');
            $("#provisional-diagnosis-table").append('<tr><td><input type="hidden" class="form-control floating" value="'+provisional_diagnosis+'" name="pdd[]">'+provisional_diagnosis+'</td><td><button type="button" class="btn btn-danger" onclick="return this.parentNode.parentNode.remove();"><i class="fa fa-trash"></i></button></td><tr>');
            $('#addProvisional').modal('hide');
        }
        function addTest()
        {
            const test_name = $("#test-name").val();
            $("#test-name").val('');
            $("#test-table").append('<tr><td><input type="hidden" class="form-control floating" value="'+test_name+'" name="test[]">'+test_name+'</td><td><button type="button" class="btn btn-danger" onclick="return this.parentNode.parentNode.remove();"><i class="fa fa-trash"></i></button></td><tr>');
            $('#addLab').modal('hide');
        }
        function addMedicine()
        {
            const drug_name = $("#drug-name").val();
            const morning = $("#morning").val();
            const afternoon = $("#afternoon").val();
            const evening = $("#evening").val();
            const night = $("#night").val();
            const comment = $("#comment").val() != '' ? $("#comment").val() : '-';
            const days = $("#days").val();
            $("#drug-name").val('');
            $("#morning").val('');
            $("#afternoon").val('');
            $("#evening").val('');
            $("#night").val('');
            $("#comment").val('');
            $("#days").val('');
            $("#medicine-table").append('<tr><td><input type="hidden" class="form-control floating" value="'+drug_name+'" name="drug_name[]">'+drug_name+'</td><td><input type="hidden" class="form-control floating" value="'+morning+'" name="morning[]">'+morning+'</td><td><input type="hidden" class="form-control floating" value="'+afternoon+'" name="afternoon[]">'+afternoon+'</td><td><input type="hidden" class="form-control floating" value="'+evening+'" name="evening[]">'+evening+'</td><td><input type="hidden" class="form-control floating" value="'+night+'" name="night[]">'+night+'</td><td><input type="hidden" class="form-control floating" value="'+comment+'" name="comment[]">'+comment+'</td><td><input type="hidden" class="form-control floating" value="'+days+'" name="noOfDays[]">'+days+'</td><td><button type="button" class="btn btn-danger" onclick="return this.parentNode.parentNode.remove();"><i class="fa fa-trash"></i></button></td><tr>');
            $('#addMedicine').modal('hide');
        }
    </script>        