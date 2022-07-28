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
    .error{
color: red;
text-align: center;
}
</style>
 <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Edit Profile</h3>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xl-12 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <h4 class="card-title">Basic Information</h4>
                            </div>
                            <div class="card-body">
                                <form id="signupform" autocomplete="off">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Email</label>
                                        <div class="col-lg-9">
                                            <input type="email" class="form-control" value="<?php echo $user->email; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Pharmacy Name</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="name" value="<?php echo $user->name; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Phone Number 1</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control phone-field filterme" id="phoneField1" placeholder="Enter Phone Number 1" name="phoneNo" value="<?php echo $user->labPhoneNo1; ?>" required maxlength="10">
                                        </div>
                                        <input type="hidden" id="countrycode" name="countrycode" value="<?php echo $user->labPhoneCode1; ?>">
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Phone Number 2</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control phone-field filterme" id="phoneField2" placeholder="Enter Phone Number 2" name="phoneNo1" value="<?php echo $user->labPhoneNo2; ?>" <?php if (!empty($user->labPhoneNo2)) { echo "required"; }  ?> maxlength="10">
                                        </div>
                                        <input type="hidden" id="countrycode1" name="countrycode1" value="<?php echo $user->labPhoneCode2; ?>">
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Pincode</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="pincode" value="<?php echo $user->pincode; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Address</label>
                                        <div class="col-lg-9">
                                            <input type="text" id="searchInput" class="form-control input-controls" name="paddress" value="<?php echo $user->address; ?>" required>
                                        </div>
                                        <div class="map" id="map" style="width: 100%; height: 200px;"></div>
			                               	<div class="form_area">
			                                   <input type="hidden" name="location" id="location">
			                                   <input type="hidden" name="lat" id="lat">
			                                   <input type="hidden" name="lng" id="lng">
			                                   <input type="hidden" name="address" value="<?php echo $user->address; ?>">
			                                   <input type="hidden" name="lat1" id="lat1" value="<?php echo $user->lat; ?>">
			                                   <input type="hidden" name="lng1" id="lng1" value="<?php echo $user->lng; ?>">
			                               </div>
										</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="ajax-load1 text-center" style="display:none;">
                                              <img src="<?php echo base_url('uploads/loader.gif');?>">
                                        </div>
                                       <div id="alert_message" style="color:red;"></div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    <br>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <h4 class="card-title">Change Password</h4>
                            </div>
                            <div class="card-body">
                                <form id="changepassform" autocomplete="off">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Old Password</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="oldPassword" minlength="6" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">New Password</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="newPassword" minlength="6" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Confirm Password</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="confirmPassword" minlength="6" required>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="ajax-load2 text-center" style="display:none;">
                                              <img src="<?php echo base_url('uploads/loader.gif');?>">
                                        </div>
                                       <div id="alert_message1" style="color:red;"></div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
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
      $(document).ready(function() 
      { 

        $("#phoneField1").CcPicker({
          //"countryCode":"us",
          dataUrl:"<?php echo base_url('backend/assets/code/data.json'); ?>"

      	});

        var code = $('#countrycode').val();
         
       	// $("#phoneField1").CcPicker();
        $("#phoneField1").CcPicker("setCountryByPhoneCode",code);


        $("#phoneField2").CcPicker({
          //"countryCode":"us",
          dataUrl:"<?php echo base_url('backend/assets/code/data.json'); ?>"

      	});

        var code = $('#countrycode1').val();
         
       	// $("#phoneField1").CcPicker();
        $("#phoneField2").CcPicker("setCountryByPhoneCode",code);
    });
    </script> 

<script type="text/javascript">
$(document).ready(function() 
{ 

	 var frm = $('#signupform');
    frm.submit(function(e){
        e.preventDefault();

        $(".ajax-load1").show();

        var formData = new FormData($(this)[0]);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url().'lab/Auth/edit_save_profile'?>',
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
                    $('#alert_message').html('<div class="text-center alert alert-success">'+message+'</div>');
                    location.reload();   
                    
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

    var frm = $('#changepassform');
    frm.submit(function(e){
        e.preventDefault();


        $(".ajax-load2").show();

        var formData = new FormData($(this)[0]);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url().'lab/Auth/change_password'?>',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data)
            {   
                $(".ajax-load2").hide();
                var res = JSON.parse(data);

                status = res.status;
                message = res.message;

                if(status == "success")
                {   
                    $('#alert_message1').html('<div class="text-center alert alert-success">'+message+'</div>');
                    location.reload();   
                    
                }
                else if(status=="unsuccess")
                {   
                    $('#alert_message1').html('<div class="text-center alert alert-danger">'+message+'</div>');
                }
                else
                {

                }
            }
        });
         setInterval(function(){
              $('#alert_message1').html('');
          }, 2000);
    });

});
</script>



<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAl5i_Lv4MQwX4rz890fRzMIElAaHBDrDw&libraries=places"></script>
<script>
/* script */
function initialize() {
    var latlng = new google.maps.LatLng(<?php echo $user->lat; ?>,<?php echo $user->lng; ?>);
    var map = new google.maps.Map(document.getElementById('map'), {
      center: latlng,
      zoom: 6
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