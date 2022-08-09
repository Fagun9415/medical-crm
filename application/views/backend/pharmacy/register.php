<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Curis - Pharmacy Registration</title>

    <link rel="shortcut icon" type="image/x-icon" href="<?php  echo base_url('backend/assets/img/favicon.png'); ?>">

    <link rel="stylesheet" href="<?php  echo base_url('backend/assets/css/bootstrap.min.css'); ?>">

    <link rel="stylesheet" href="<?php  echo base_url('backend/assets/css/feather.css'); ?>">

    <link rel="stylesheet" href="<?php  echo base_url('backend/assets/css/style.css'); ?>">
     <link rel="stylesheet" href="<?php  echo base_url('backend/assets/code/css/jquery.ccpicker.css'); ?>">
    <style type="text/css">
    .input-controls {
      margin-top: 10px;
      border: 1px solid transparent;
      border-radius: 2px 0 0 2px;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
      height: 32px;
      outline: none;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }
    #searchInput {
      background-color: #fff;
      font-family: Roboto;
      font-size: 15px;
      font-weight: 300;
      margin-left: 3px;
      padding: 0 11px 0 13px;
      text-overflow: ellipsis;
      width: 50%;
    }
    #searchInput:focus {
      border-color: #4d90fe;
    }  
    
</style>
</head>

<body>

    <div class="main-wrapper">
        <!-- <div class="header d-none">

            <ul class="nav nav-tabs user-menu">

                <li class="nav-item">
                    <a href="#" id="dark-mode-toggle" class="dark-mode-toggle">
                        <i class="feather-sun light-mode"></i><i class="feather-moon dark-mode"></i>
                    </a>
                </li>

            </ul>

        </div> -->
        <div class="row">

            <div class="col-md-6 login-bg">
                <div class="login-banner"></div>
            </div>

            <div class="col-md-6 login-wrap-bg">

                <div class="login-wrapper">
                    <div class="loginbox">
                        <div class="img-logo">
                            <img src="<?php echo base_url('backend/assets/img/logo.png'); ?>" class="img-fluid" alt="Logo">
                        </div>
                        <h3>Pharmacy Signup</h3>
                        <form autocomplete="off" enctype='multipart/form-data' id="signupform">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Pharmacy Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Pharmacy Name" name="full_name" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" placeholder="Enter Email" name="email" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Phone Number 1<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control phone-field filterme" id="phoneField1" placeholder="Enter Phone Number" name="phoneNo" required maxlength="10">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Phone Number 2</label>
                                    <input type="text" class="form-control phone-field filterme" id="phoneField2" placeholder="Enter Phone Number" name="phoneNo1" maxlength="10">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control input-controls" id="searchInput" placeholder="Enter Your Address" name="address" required>
                                </div>
                                <div class="map" id="map" style="width: 100%; height: 200px;"></div>
                               <div class="form_area">
                                   <input type="hidden" name="location" id="location">
                                   <input type="hidden" name="lat" id="lat">
                                   <input type="hidden" name="lng" id="lng">
                               </div>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Pincode <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Pincode" name="pincode" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Pharmacy Registration Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Pharmacy Registration Number" name="pharmacyRegistrationNo" maxlength="15" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Pharmacy Registration Document <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="file" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Doctor Document <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control"  required>
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="custom_check mr-2 mb-0"> I agree to the <a href="<?php echo base_url('Terms_and_Conditions'); ?>"
                                                class="text-primary"> terms & conditions</a> and <a href="<?php echo base_url('Privacy_Policy'); ?>"
                                                class="text-primary">privacy policy</a>
                                            <input type="checkbox" name="radio" required>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                    <div class="ajax-load1 text-center" style="display:none;">
                                          <img src="<?php echo base_url('uploads/loader.gif');?>">
                                      </div>
                                       <div id="alert_message" ></div>
                                </div>
                            <div class="d-grid">
                                <button class="btn btn-primary" type="submit">Register</button>
                            </div>
                            <div class="dont-have">Already have an account? <a href="<?php echo base_url('pharmacy/Auth/login'); ?>">Login</a></div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script src="<?php  echo base_url('backend/assets/js/jquery-3.6.0.min.js'); ?>"></script>

    <script src="<?php  echo base_url('backend/assets/js/bootstrap.bundle.min.js'); ?>"></script>

    <script src="<?php  echo base_url('backend/assets/js/script.js'); ?>"></script>
    <script src="<?php echo base_url('backend/assets/code/js/jquery.ccpicker.js'); ?>"></script>
    <script src="<?php echo base_url('backend/assets/code/js/jquery.ccpicker.min.js'); ?>"></script>

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
      $(document).ready(function() 
      { 

        $("#phoneField1").CcPicker({
              "countryCode":"IN",
              dataUrl:"<?php echo base_url('backend/assets/code/data.json'); ?>"
          });

        $("#phoneField2").CcPicker({
              "countryCode":"IN",
              dataUrl:"<?php echo base_url('backend/assets/code/data.json'); ?>"
          });

        var frm = $('#signupform');
        frm.submit(function(e){
            e.preventDefault();


            $(".ajax-load1").show();

            var formData = new FormData($(this)[0]);
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url().'pharmacy/Auth/save_user'?>',
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
                    {   $('#alert_message').html('<div class="text-center alert alert-success">'+message+'</div>');
                            location.href = "<?php echo base_url('pharmacy/Auth/login') ?>";   
                        setInterval(function(){
                        }, 5000);
                    }
                    else if(status=="unsuccess")
                    {   
                        $('#alert_message').html('<div class="text-center alert alert-danger">'+message+'</div>');
                        setInterval(function(){
                        }, 5000);
                    }
                    else
                    {

                    }   
                }
            });
        });

    });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAl5i_Lv4MQwX4rz890fRzMIElAaHBDrDw&libraries=places"></script>

<script>
/* script */
function initialize() {
    var latlng = new google.maps.LatLng(23.12216556206112,79.40235312499999);
    var map = new google.maps.Map(document.getElementById('map'), {
      center: latlng,
      zoom: 4
    });
    var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      draggable: true,
      anchorPoint: new google.maps.Point(0, -29)
   });
    var input = document.getElementById('searchInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var geocoder = new google.maps.Geocoder();
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();   
    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
  
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
       
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);          
    
        bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng());
        infowindow.setContent(place.formatted_address);
        infowindow.open(map, marker);
       
    });
    // this function will work on marker move event into map 
    google.maps.event.addListener(marker, 'dragend', function() {
        geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (results[0]) {        
              bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
          }
        }
        });
    });
}
function bindDataToForm(address,lat,lng){
   document.getElementById('location').value = address;
   document.getElementById('searchInput').value = address;
   document.getElementById('lat').value = lat;
   document.getElementById('lng').value = lng;
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
</body>

</html>