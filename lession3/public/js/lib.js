
var entityMap = {
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': '&quot;',
    "'": '&#39;',
    "/": '&#x2F;'
  };

  function escapeHtml(string) {
    return String(string).replace(/[&<>"'\/]/g, function (s) {
      return entityMap[s];
    });
  }

/*function escapeHtml(str) {
		return str.replace('&', '&amp;').replace('"', '&quot;').replace("'", '&#039;').replace('<', '&lt;').replace('>', '&gt;');
	}*/
//I needed the opposite function today, so adding here too:
function htmlUnescape(value){
    return String(value)
        .replace(/&quot;/g, '"')
        .replace(/&#39;/g, "'")
        .replace(/&lt;/g, '<')
        .replace(/&gt;/g, '>')
        .replace(/&amp;/g, '&');
}
function stringHtmlError( errorArray ){
	// data error
	htmlError = '<div class="alert alert-danger">';
	$.each(errorArray,function(k,v){
		htmlError += escapeHtml( v )  + "</br>";
	});
	htmlError += '</div>';
	console.log(htmlError);
	return htmlError;
}

//create html error alert
//error = array.
function generateHtmlAlertError( error ){
	var htmlError = " ";
	htmlError += '<div class="alert alert-danger"';
	htmlError += '<strong>Error! </strong>';
	$.each(error,function(keyName,valueName){
		htmlError += '<div class="item">';
		htmlError += '<p>';
		htmlError += '<strong>'+keyName+'</strong>';
		htmlError += '</p>';
		htmlError += '<ul>';

		$.each( valueName ,function( keyError , valueError){
			if(typeof(valueError) == 'object'){
				htmlError += '<p>';
 			htmlError += '<strong>'+keyError+'</strong>';
 			htmlError += '</p>';
				$.each(valueError,function( keyListImage , valueListImage ){
					htmlError += '<li>';
 				htmlError += valueListImage;
 				htmlError += '</li>';
				});
			}else{
				htmlError += '<li>';
				htmlError += escapeHtml ( valueError );
				htmlError += '</li>';
			}
		});
		htmlError += '</ul>';
	});
	htmlError += '</div>';
	return htmlError;
}


function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

var geocoder;
var map;
var default_latlng;
var waypointMarker = null;
var address = "";
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
    	console.log( results[0].geometry.location );
    	moveCenterAddress( results[0].geometry.location, address, addr_type );
    });
}

function actionChangeLocation( latlng ){
		geocoder.geocode( {'location': latlng}, function(results, status) {
			
		if ( status == google.maps.GeocoderStatus.OK ){
			// type of address inputted that was geocoded
			var addr_type = results[0].types[0];
			// edit database
			var address = results[0].formatted_address;
			var addr_type = results[0].types[0];
			
			
			dalert.confirm("Do you want to change your address: <br/> '" + address + "'","Alert Confirm !",function(result){
	            if(result){
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
	        });
		}
		else     
			
			dalert.alert( stringHtmlError( "Geocode was not successful for the following reason: " + status ) ,'Error');
	});
}

function activeEventClickGoogleMap(){
	google.maps.event.addListener( map , 'click', function(e) {
		actionChangeLocation(e.latLng);
	});
}

//Sets the map on all markers in the array.
function setMapOnAll(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
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
	   markers.push(waypointMarker);
	
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
	  console.log('aaaa');
	  geocodePosition(waypointMarker.getPosition());
  });

}




jQuery(document).ready(function () {
	// when show tab location
	// 
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		if( $( e.target ).attr('href') == "#tab-Location" ){
			
			
			  var center = map.getCenter();
			  google.maps.event.trigger(map, "resize");
			  map.setCenter(center);
		}
	});
	
	$(document).on('click','a.like-picture',function(e){
		e.preventDefault();
		var IdPicture = $ ($( 'div' , $(this).parents( 'div.product-wrapper' )[0] )[0] ).attr('idpicture');
		
		var tag_product_details = $(this).parents( 'div.product-details' )[0];
		
		likePicture( IdPicture , tag_product_details );
	});
	
	function likePicture( IdPicture , tag_product_details ){
		fd = new FormData();
		fd.append( "IdPicture" ,IdPicture );
		
		$.ajax({
	        url: 'index.php?rt=user/action/like',
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
	        		var is_like     = data.result.is_like;
	        		var number_like = data.result.number_like;
	        		
	        		if( is_like == true ){
	        			
	        			$( $('div.product-tools a.like-picture i' , tag_product_details )[0] ).attr( 'class' , "fa fa-thumbs-o-down" );
	        			$( $('div.product-tools a.like-picture' , tag_product_details )[0] ).attr( 'data-original-title' , "Unlike" );
	        			
	        		}else if( is_like == false ){
	        			
	        			$( $('div.product-tools a.like-picture i' , tag_product_details )[0] ).attr( 'class' , "fa fa-thumbs-o-up" );
	        			$( $('div.product-tools a.like-picture' , tag_product_details )[0] ).attr( 'data-original-title' , "Like" );
	        		}
	        		
	        		$( $('span.number-like' , tag_product_details )[0] ).html( number_like );	
	        		
	        		$('[data-toggle="tooltip"]').tooltip();
	        		console.log ( $('div.product-tools a.like-picture' , tag_product_details )[0]) ;
	        		$( $('div.product-tools a.like-picture' , tag_product_details )[0] ).tooltip('show');
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
	
	
	$(document).on( 'click' , "a[rel^='prettyPhoto']" , function(e){
		e.preventDefault();
		var href = $(this).attr( 'href' ); 
		$.prettyPhoto.open( href );
		$("div.pp_social").css("display",'none');
		// view
		var tag_product_wrapper = $(this).parents('div.product-wrapper')[0];
		var IdPicture = $( "div.product-image" , tag_product_wrapper ).attr( 'idpicture' );
		
		$.ajax({
	        url: 'index.php?rt=user/action/viewPicture/'+IdPicture,
	        type: 'GET',
	        cache: false,
	        dataType: 'json',
	        processData: false, // Don't process the files
	        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
	        success: function(data, textStatus, jqXHR)
	        {
	        	if ( data.is_error != null ){
	        		dalert.alert( stringHtmlError(error) ,'Error');
	        	}else{
	        		updateNumberView( IdPicture , tag_product_wrapper );	        		
	        	}
	        },
	        error: function(jqXHR, textStatus, errorThrown)
	        {
	        	var error = ['ERRORS: ' + textStatus];
	            // Handle errors here
	        	dalert.alert( stringHtmlError(error) ,'Error');
	        }
	    });
		
	});
	
	function updateNumberView( IdPicture , tag_product_wrapper ){
		$.ajax({
	        url: 'index.php?rt=user/action/getPicture/'+IdPicture,
	        type: 'GET',
	        cache: false,
	        dataType: 'json',
	        processData: false, // Don't process the files
	        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
	        success: function(data, textStatus, jqXHR)
	        {
	        	if ( data.is_error != null ){
	        		dalert.alert( stringHtmlError( data.is_error ) ,'Error');
	        	}else{
	        		numberView = data.view;
	        		$("span.number-view" , tag_product_wrapper ).html( numberView );
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
	
	$(document).on('click','a[data-original-title="View"]',function(e){
		e.preventDefault();
	});
	
	
	function updateNumberRequest(){
		$.ajax({
			
	        url: 'index.php?rt=user/index/getValueParameterUserSession',
	        type: 'GET',
	        cache: false,
	        dataType: 'json',
	        processData: false, // Don't process the files
	        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
	        success: function(data, textStatus, jqXHR)
	        {
	        	
	        	if( data.user.numberRequest == 0 ){
	        		$("span.number-request").html("");
	        	}else{
	        		$("span.number-request").html( "(" + data.user.numberRequest + ")");
	        
	        	}
	        	
	        	if( data.user.numberFollow == 0 ){
	        		$("span.number-follow").html("");
	        	}else{
	        		
	        		$("span.number-follow").html( "(" + data.user.numberFollow + ")");
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
	
	updateNumberRequest();
	
	//var updateNumberRequest = setInterval( updateNumberRequest , 3000);
	
	// ==================================begin un request============================================================================
	$(document).on( 'click', 'a.un-request', function(e){
		
		e.preventDefault();
		
		var parent =  $(this).parents('div')[0];
		
		var idUser =  $(this).attr('idfriend');
		
		var acctionSuccess = function ( parent ){
			$( $( "a.un-request" , parent ).parents('button')[0] ).attr('class','btn btn-info');
			$( "a.un-request" , parent ).html( "Add Friend" );
			$( "a.un-request" , parent ).attr( 'class' , 'add-friend' );
		};
		unRequest( idUser , acctionSuccess, $(this).parents('div')[0] );
	} );
	
	function unRequest( idUser , acctionSuccess , parent ){
		fd = new FormData();
		
		fd.append( "iduser" , idUser );
		
		$.ajax({
	        url: 'index.php?rt=user/action/unRequest',
	        type: 'POST',
	        data: fd,
	        cache: false,
	        dataType: 'json',
	        processData: false, // Don't process the files
	        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
	        success: function(data, textStatus, jqXHR)
	        {
	        	var error = data.is_error;
	        	if( error != null ){
	        		dalert.alert(stringHtmlError(error),'Error');
	        	}else{
	        		acctionSuccess( parent );
	        	}
	        },
	        error: function(jqXHR, textStatus, errorThrown)
	        {
	        	var error = ['ERRORS: ' + textStatus];
	            // Handle errors here
	        	dalert.alert(stringHtmlError(error),'Error');
	        }
	    });
	} 
	// ==================================end un request============================================================================
	
	// ==================================begin add follow============================================================================
	
	$(document).on( 'click', 'button.add-follow', function(e){
		e.preventDefault();
		var idUser =  $(this).attr('iduser');
		var parent =  $(this).parents('div')[0];
		var acctionSuccess = function ( parent ){
			$( "button.add-follow" , parent ).html( "Unfollow" );
			$( "button.add-follow" , parent ).attr( 'class' , 'btn btn-danger un-follow' );
		};
		addFollow( idUser , acctionSuccess, $(this).parents('div.media')[0] );
	} );
	
	function addFollow( idUser , acctionSuccess , parent ){
		fd = new FormData();
		
		fd.append( "iduser" , idUser );
		
		$.ajax({
	        url: 'index.php?rt=user/action/addFollow',
	        type: 'POST',
	        data: fd,
	        cache: false,
	        dataType: 'json',
	        processData: false, // Don't process the files
	        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
	        success: function(data, textStatus, jqXHR)
	        {
	        	var error = data.is_error;
	        	if( error != null ){
	        		dalert.alert(stringHtmlError(error),'Error');
	        	}else{
	        		acctionSuccess( parent );
	        	}
	        },
	        error: function(jqXHR, textStatus, errorThrown)
	        {
	        	var error = ['ERRORS: ' + textStatus];
	            // Handle errors here
	        	dalert.alert(stringHtmlError(error),'Error');
	        }
	    });
	}
	
	// ==================================end add follow============================================================================
	
	// ==================================begin un follow============================================================================
	
	$(document).on( 'click', 'button.un-follow', function(e){
		e.preventDefault();
		var idUser =  $(this).attr('iduser');
		var parent =  $(this).parents('div')[0];
		var acctionSuccess = function ( parent ){
			$( "button.un-follow" , parent ).html( "Add follow" );
			$( "button.un-follow" , parent ).attr( 'class' , 'btn btn-info add-follow' );
		};
		unFollow( idUser , acctionSuccess, $(this).parents('div.media')[0] );
	} );
	
	function unFollow( idUser , acctionSuccess , parent ){
		fd = new FormData();
		
		fd.append( "iduser" , idUser );
		
		$.ajax({
	        url: 'index.php?rt=user/action/unFollow',
	        type: 'POST',
	        data: fd,
	        cache: false,
	        dataType: 'json',
	        processData: false, // Don't process the files
	        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
	        success: function(data, textStatus, jqXHR)
	        {
	        	var error = data.is_error;
	        	if( error != null ){
	        		dalert.alert(stringHtmlError(error),'Error');
	        	}else{
	        		acctionSuccess( parent );
	        	}
	        },
	        error: function(jqXHR, textStatus, errorThrown)
	        {
	        	var error = ['ERRORS: ' + textStatus];
	            // Handle errors here
	        	dalert.alert(stringHtmlError(error),'Error');
	        }
	    });
	}
	
	// ==================================end un follow============================================================================
	
	// ==================================begin add favorite============================================================================
	
	$(document).on( 'click', 'a.add-favorite', function(e){
		e.preventDefault();
		var idUser =  $ ( $( 'p a' , $(this).parents('div.media')[0] )[0] ).attr('idfriend') ;
		
		var acctionSuccess = function ( parent ){
			
			$( "a.add-favorite" , parent ).html( "unfavorite" );
			$( "a.add-favorite" , parent ).attr( 'class' , 'un-favorite' );
		};
		
		addFavorite( idUser , acctionSuccess, $(this).parents('div.media')[0] );
	} );
	
	
	$(document).on( 'click', 'button.add-favorite', function(e){
		e.preventDefault();
		var idUser = $(this).attr('iduser');
		
		var acctionSuccess = function (){
			$( "button.add-favorite" ).html( "Unfavorite" );
			$( "button.add-favorite" ).attr( 'class' , 'btn unfavorite btn-danger' );
		};
		
		addFavorite( idUser , acctionSuccess , parent );
	} );
	
	
	
	function addFavorite( idUser , acctionSuccess , parent ){
		fd = new FormData();
		
		fd.append( "iduser" , idUser );
		
		$.ajax({
	        url: 'index.php?rt=user/action/addFavorite',
	        type: 'POST',
	        data: fd,
	        cache: false,
	        dataType: 'json',
	        processData: false, // Don't process the files
	        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
	        success: function(data, textStatus, jqXHR)
	        {
	        	var error = data.is_error;
	        	if( error != null ){
	        		dalert.alert(stringHtmlError(error),'Error');
	        	}else{
	        		acctionSuccess( parent );
	        	}
	        },
	        error: function(jqXHR, textStatus, errorThrown)
	        {
	        	var error = ['ERRORS: ' + textStatus];
	            // Handle errors here
	        	dalert.alert(stringHtmlError(error),'Error');
	        }
	    });
	}
	
	// ==================================end add favorite============================================================================
	
	
	$(document).on( 'click', 'button.unfavorite', function(e){
		e.preventDefault();
		var idUser = $(this).attr('iduser');
		var parent = $(this).parent("div")[0];
		$actionSuccess = function ( parent ){
			$( "button.unfavorite" , parent ).html( "Add favorite" );
    		$( "button.unfavorite", parent ).attr( 'class' , 'btn add-favorite btn-info' );
		};
		unFavorite( idUser , $actionSuccess , parent);
	});
	
	$(document).on( 'click', 'a.un-favorite', function(e){
		e.preventDefault();
		var idUser =  $ ( $( 'p a' , $(this).parents('div.media')[0] )[0] ).attr('idfriend') ;
		
		$acctionSuccess = function ( parent ){
			$( "a.un-favorite" ,parent ).html( "Add favorite" );
			$( "a.un-favorite" ,parent ).attr( 'class' , 'add-favorite' );
		};
		
		unFavorite( idUser , $acctionSuccess , $(this).parents('div.media')[0] );
	});
	
	function unFavorite( idUser , actionSuccess , parent ){
		fd = new FormData();
		
		fd.append( "iduser" , idUser );
		
		$.ajax({
	        url: 'index.php?rt=user/action/unFavorite',
	        type: 'POST',
	        data: fd,
	        cache: false,
	        dataType: 'json',
	        processData: false, // Don't process the files
	        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
	        success: function(data, textStatus, jqXHR)
	        {
	        	var error = data.is_error;
	        	if( error != null ){
	        		dalert.alert(stringHtmlError(error),'Error');
	        	}else{
	        		actionSuccess(parent);
	        	}
	        },
	        error: function(jqXHR, textStatus, errorThrown)
	        {
	        	var error = ['ERRORS: ' + textStatus];
	            // Handle errors here
	        	dalert.alert(stringHtmlError(error),'Error');
	        }
	    });
	}
	
	//= = =  = = = = =  = = = = = begin send request  = = = = =  = = = = =  = = = = =  = = = = =  = = = = =  = = = = =  = =
	
	$(document).on('click',"a.add-friend",function(e){
		
		e.preventDefault();
		media = $( this ).parents('div')[0];
		IdFriend = $( this ).attr('idfriend');
		sendRequest( IdFriend , media );
	});
	
	function sendRequest( IdFriend , media ){
		
		var fd = new FormData();
		
		fd.append("IdFriend",IdFriend);
		
		$.ajax({
	        url: 'index.php?rt=user/index/sendRequest',
	        type: 'POST',
	        data : fd,
	        cache: false,
	        dataType: 'json',
	        processData: false, // Don't process the files
	        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
	        success: function(data, textStatus, jqXHR)
	        {
	        	error = data.error;
	        	if( error != null ){
	        		
	        		dalert.alert(stringHtmlError(error),'Error');
	        		
	        	}else{
	        		
	        		$( $('a.add-friend',media).parents('button')[0] ).attr( 'class' , 'btn btn-danger' );
	        		$('a.add-friend',media).html( 'unRequest' );
        			$('a.add-friend',media).attr( 'class', 'un-request' );
        			
	        	}
	        },
	        error: function(jqXHR, textStatus, errorThrown)
	        {
	        	var error = ['ERRORS: ' + textStatus];
	            // Handle errors here
	        	dalert.alert(stringHtmlError(error),'Error');
	        }
	    });
	}
	//= = =  = = = = =  = = = = = end send request  = = = = =  = = = = =  = = = = =  = = = = =  = = = = =  = = = = =  = =
	
	// = = =  = = = = =  = = = = = begin unfriend  = = = = =  = = = = =  = = = = =  = = = = =  = = = = =  = = = = =  = =
	$(document).on('click',"a.un-friend",function(e){
		e.preventDefault();
		var media    = $(this).parents("div.media")[0];
		var tag_a    = this ;
		var idfriend = $( this ).attr('idfriend');
		var tag_a 	 = this;
		dalert.confirm( "Are You Sure?","Confirm !" , function( result ){
            if( result ){
            	
            	unfriend( idfriend , tag_a );
            }
            else{
            	
            }
        });
	});
	
	function unfriend( idfriend , tag_a ){
		
		var fd = new FormData();
		
		fd.append( "UserId" , idfriend );
		
		$.ajax({
	        url: 'index.php?rt=user/index/unfriend',
	        type: 'POST',
	        data : fd,
	        cache: false,
	        dataType: 'json',
	        processData: false, // Don't process the files
	        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
	        success: function(data, textStatus, jqXHR)
	        {
	        	var error = data.is_error;
	        	if( error != null ){
	        		dalert.alert(stringHtmlError(error),'Error');
	        	}else{
	        		$ ( $( tag_a ).parents('button')[0] ).attr('class','btn btn-info');
	        		$(tag_a).attr( 'class' ,'add-friend');
	        		$(tag_a).html( "Add friend" );
	        		
	        	}
	        },
	        error: function(jqXHR, textStatus, errorThrown)
	        {
	        	var error = ['ERRORS: ' + textStatus];
	            // Handle errors here
	        	dalert.alert(stringHtmlError(error),'Error');
	        }
	    });
	}
});

