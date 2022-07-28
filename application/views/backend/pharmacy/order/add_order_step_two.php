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
                <form action="<?php echo base_url('pharmacy/Order/schedule_patient'); ?>" method="post">
                <div class="row">
                    <div class="col-md-12 col-sm-12 mt-3 mb-5">
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
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>paracetamol 500mg</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
                                                        <td><button type="button" class="btn btn-danger" onclick="return this.parentNode.parentNode.remove();"><i class="fa fa-trash"></i></button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>paracetamol 500mg</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
                                                        <td><button type="button" class="btn btn-danger" onclick="return this.parentNode.parentNode.remove();"><i class="fa fa-trash"></i></button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-auto">
                    <div class="col-md-12">
                        <div class="submit-sec">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
<!-- Modal -->
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
                                        <input type="number" class="form-control floating" id="morning">
                                        <label class="focus-label">Morning<span class="text-danger"></span></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group form-focus">
                                        <input type="number" class="form-control floating" id="afternoon">
                                        <label class="focus-label">Afternoon<span class="text-danger"></span></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group form-focus">
                                        <input type="number" class="form-control floating" id="evening">
                                        <label class="focus-label">Evening<span class="text-danger"></span></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group form-focus">
                                        <input type="number" class="form-control floating" id="night">
                                        <label class="focus-label">Night<span class="text-danger"></span></label>
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
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>

    <script src="assets/js/script.js"></script>
    <script>
        $(document).ready(function() {
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
            $(".autocomplete").autocomplete({
                source: availableTags
            });
        });
        function addMedicine()
        {
            const drug_name = $("#drug-name").val();
            const morning = $("#morning").val();
            const afternoon = $("#afternoon").val();
            const evening = $("#evening").val();
            const night = $("#night").val();
            const comment = $("#comment").val() != '' ? $("#comment").val() : '-';
            $("#drug-name").val('');
            $("#morning").val('');
            $("#afternoon").val('');
            $("#evening").val('');
            $("#night").val('');
            $("#comment").val('');
            $("#medicine-table").append('<tr><td>'+drug_name+'</td><td>'+morning+'</td><td>'+afternoon+'</td><td>'+evening+'</td><td>'+night+'</td><td>'+comment+'</td><td><button type="button" class="btn btn-danger" onclick="return this.parentNode.parentNode.remove();"><i class="fa fa-trash"></i></button></td><tr>');
            $('#addMedicine').modal('hide');
        }
    </script>
