<!-- jQuery -->
<script src="<?=base_url('assets/app/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?=base_url('assets/app/'); ?>vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=base_url('assets/app/'); ?>vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
<script src="<?=base_url('assets/app/');?>/vendors/bower_components/bootstrap-validator/dist/validator.min.js"></script>

<!-- Slimscroll JavaScript -->
<script src="<?=base_url('assets/app/'); ?>dist/js/jquery.slimscroll.js"></script>

<!-- Init JavaScript -->
<script src="<?=base_url('assets/app/'); ?>dist/js/init.js"></script>
<?php
if(!empty($page)){
?>
<!-- google map .start -->
<script>
// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
  
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -33.8688, lng: 151.2195},
    zoom: 13
  });
  var card = document.getElementById('pac-card');
  var input = document.getElementById('pac-input');
  var types = document.getElementById('type-selector');
  var strictBounds = document.getElementById('strict-bounds-selector');
    
  map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
    
  var autocomplete = new google.maps.places.Autocomplete(input);

  // Bind the map's bounds (viewport) property to the autocomplete object,
  // so that the autocomplete requests use the current map bounds for the
  // bounds option in the request.
  autocomplete.setComponentRestrictions(
  {'country': ['tz']}); // limit map to retrieve data from Tanzania only
  autocomplete.bindTo('bounds', map);

  // Set the data fields to return when the user selects a place.
  autocomplete.setFields(
      ['address_components', 'geometry', 'icon', 'name']);

  var infowindow = new google.maps.InfoWindow();
  var infowindowContent = document.getElementById('infowindow-content');
  infowindow.setContent(infowindowContent);
  var marker = new google.maps.Marker({
    map: map,
  //draggable: true,
    anchorPoint: new google.maps.Point(0, -29)
  });

  autocomplete.addListener('place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    
    if (!place.geometry) {
      // User entered the name of a Place that was not suggested and
      // pressed the Enter key, or the Place Details request failed.
      window.alert("No details available for input: '" + place.name + "'");
      return;
    }else{
        $('.location_name').val($('#pac-input').val());
        $('.locationName').html('Location name: <span class="text-danger">'+$('#pac-input').val()+'</span>');
        $('.dir').val(place.name);
        $('.lati').val(place.geometry.location.lat());
        $('.lattitude_no').html('Latitude: <span class="text-danger">'+place.geometry.location.lat()+'</span>');
        $('.longi').val(place.geometry.location.lng());
        $('.longitude_no').html('Longitude: <span class="text-danger">'+place.geometry.location.lng()+'</span>');
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);  // Why 17? Because it looks good.
    }
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }
      
    infowindowContent.children['place-icon'].src = place.icon;
    infowindowContent.children['place-name'].textContent = place.name;
    infowindowContent.children['place-address'].textContent = address;
    infowindow.open(map, marker);
  });

  // Sets a listener on a radio button to change the filter type on Places
  // Autocomplete.
  function setupClickListener(id, types) {
    var radioButton = document.getElementById(id);
    radioButton.addEventListener('click', function() {
      autocomplete.setTypes(types);
    });
  }

  setupClickListener('changetype-all', []);
  setupClickListener('changetype-address', ['address']);
  setupClickListener('changetype-establishment', ['establishment']);
  setupClickListener('changetype-geocode', ['geocode']);

  document.getElementById('use-strict-bounds')
      .addEventListener('click', function() {
        console.log('Checkbox clicked! New state=' + this.checked);
        autocomplete.setOptions({strictBounds: this.checked});
      });
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQSCSiJMsoMca0n65p0vPv5Em8Uk8FjLQ&libraries=places&callback=initMap"
  async defer></script>
<!-- google map .end -->

<script>
  $(document).ready(function(){
    $("form").submit(function (event) {
      var loc_name1 = $('.location_name').val();
      var loc_name2 = $('.dir').val();
      var lattitude = $('.lati').val();
      var longitude = $('.longi').val();
      
      if(loc_name1 != '' && loc_name2 != '' && lattitude != '' && longitude != ''){
        return;
      }else{
        event.preventDefault();
        $('.loc_div_error').html("location was not detected, please try again");
      }
    });
  });
</script>
<?php
}
?>
	</body>
</html>

