
var geocoder;
var map;
var default_latlng;
var waypointMarker = null;
var address = "Hồ Chí Minh";
var markers = [];

function initialize() {

  map = new google.maps.Map(
    document.getElementById("map"), {
      center: new google.maps.LatLng(37.4419, -122.1419),
      zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
  geocoder = new google.maps.Geocoder();
  geocoder.geocode({
      'address' 	: address
    }, function( results ) {
      var addr_type = results[0].types[0];
      moveCenterAddress( results[0].geometry.location, address, addr_type );
    });
}

function moveCenterAddress( default_latlng  , address , addr_type ){

    // Center the map at the specified location
    map.setCenter( default_latlng );

    setMapOnAll(null);
    markers = [];

    waypointMarker = new google.maps.Marker({
        position: default_latlng,
        map: map,
          /*draggable: true,*/
          title: address
        });
      //Create an InfoWindow for the marker
      var contentString = "<b>" + address + "</b>";	// HTML text to display in the InfoWindow
      var infowindow = new google.maps.InfoWindow( { content: contentString } );
      // Set event to display the InfoWindow anchored to the marker when the marker is clicked.
      google.maps.event.addListener( waypointMarker, 'click', function() { infowindow.open( map, waypointMarker ); });
        waypointMarker.setVisible(true);
        // add to markers
       markers.push( waypointMarker );
  }

function actionChangeLocation( latlng ){
    geocoder.geocode( {'location': latlng}, function(results, status) {

    if ( status == google.maps.GeocoderStatus.OK ){
      // type of address inputted that was geocoded
      var addr_type = results[0].types[0];
      // edit database
      var address = results[0].formatted_address;
      var addr_type = results[0].types[0];
      /*dalert.confirm("Do you want to change your address: <br/> '" + address + "'","Alert Confirm !",function(result){
              if( result ){

                  fd = new FormData();
                  fd.append( "address" , address );
                  $.ajax({
                        url: 'index.php?rt=user/index/editProfile',
                        type: 'POST',
                        data : fd,
                        cache: false,
                        dataType: 'json',
                        processData: false, // Don't process the files
                        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                        success: function(data, textStatus, jqXHR)
                        {

                          if ( data.is_error != null ){
                            // error
                            dalert.alert( stringHtmlError(data.is_error) ,'Error');

                          }else{
                            // success
                            moveCenterAddress( results[0].geometry.location, address, addr_type );
                            // change address
                            $("input[name=address]").next().html(address);
                          }
                        },
                        error: function(jqXHR, textStatus, errorThrown)
                        {
                          var error = ['ERRORS: ' + textStatus];
                            // Handle errors here
                          dalert.alert( stringHtmlError(error) ,'Error');
                        }
                    });
              }
              else{
              }
          });*/
          $("label").html(address);
          $("input[name=address]").val(address);
          moveCenterAddress( results[0].geometry.location, address, addr_type );
    }
    else
      dalert.alert( stringHtmlError( "Geocode was not successful for the following reason: " + status ) ,'Error');
  });
}

function activeEventClickGoogleMap(){
  google.maps.event.addListener( map , 'click', function(e) {
    actionChangeLocation( e.latLng );
  });
}

//Sets the map on all markers in the array.
function setMapOnAll(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}


function setupMarkerWaypoint() {

  function geocodePosition( pos ) {
      geocoder.geocode({
        'address' 	: '61 nguyễn trãi'
      }, function(responses) {
        if ( responses && responses.length > 0 ) {
          updateMarkerAddress( responses[0].formatted_address );
        } else {
          updateMarkerAddress('Cannot determine address at this location.');
        }
      });
    }

  function updateMarkerAddress(str) {

    document.getElementById('AddWaypoint').innerHTML = str;
  }

  // Update current position info.

  geocodePosition(waypointMarker.getPosition());

  // Add dragging event listeners.

  google.maps.event.addListener( waypointMarker, 'dblclick', function() {
    // updateMarkerStatus('Drag ended');
    geocodePosition( waypointMarker.getPosition() );
  });

}