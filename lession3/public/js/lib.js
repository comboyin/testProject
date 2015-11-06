function stringHtmlError( errorArray ){
	// data error
	htmlError = '<div class="alert alert-danger">';
	$.each(errorArray,function(k,v){
		htmlError += v + "</br>";
	});
	htmlError += '</div>';
	return htmlError;
}

function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

var geocoder;
var map;
var address;
var currentMapCenter = null; 
function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(-34.397, 150.644);
  var myOptions = {
    zoom: 15,
    center: latlng,
    mapTypeControl: true,
    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
    navigationControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById("map"), myOptions);
  if (geocoder) {
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
        	map.setCenter(results[0].geometry.location);

          var infowindow = new google.maps.InfoWindow(
              { content: '<b>'+address+'</b>',
                size: new google.maps.Size(150,50)
              });

          var marker = new google.maps.Marker({
              position: results[0].geometry.location,
              map: map, 
              title:address
          }); 
          google.maps.event.addListener(marker, 'click', function() {
              infowindow.open(map,marker);
          });

        } else {
        	// alert("No results found");
        }
      } else {
    	  // dalert.alert("Not find position in google map.",'Error');
      }
    });
  }
  
	google.maps.event.addListener(map, 'resize', function () {
	    currentMapCenter = map.getCenter();
	});

	google.maps.event.addListener(map, 'bounds_changed', function () {
	    if (currentMapCenter) {
	    	// react here
	        map.setCenter( currentMapCenter );
	    }
	    currentMapCenter = null;
	});
}

//create html error alert
// error = array.
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

		$.each(valueName,function(keyError,valueError){
			if(typeof(valueError) == 'object'){
				htmlError += '<p>';
    			htmlError += '<strong>'+keyError+'</strong>';
    			htmlError += '</p>';
				$.each(valueError,function(keyListImage,valueListImage){
					htmlError += '<li>';
    				htmlError += valueListImage;
    				htmlError += '</li>';
				});
			}else{
				htmlError += '<li>';
				htmlError += valueError;
				htmlError += '</li>';
			}
		});
		htmlError += '</ul>';
	});
	htmlError += '</div>';
	return htmlError;
}


jQuery(document).ready(function () {
	// when show tab location
	// 
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		if( $( e.target ).attr('href') == "#tab-Location" ){
			google.maps.event.trigger(map, "resize");
		}
	});
	
	$('a.like-picture').click( function(e){
		e.preventDefault();
		
		var IdPicture = $ ($( 'div' , $(this).parents( 'div.product-wrapper' )[0] )[0] ).attr('idpicture');
		
		var tag_product_details = $(this).parents( 'div.product-details' )[0];
		console.log( IdPicture );
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
	
	var updateNumberRequest = setInterval( updateNumberRequest , 3000);
	
	// ==================================begin un request============================================================================
	$(document).on( 'click', 'a.un-request', function(e){
		e.preventDefault();
		
		var parent =  $(this).parents('div.media')[0];
		
		var idUser =  $("p a",parent).attr('idfriend');
		var acctionSuccess = function ( parent ){
			$( "a.un-request" , parent ).html( "Add Friend" );
			$( "a.un-request" , parent ).attr( 'class' , 'add-friend' );
		};
		unRequest( idUser , acctionSuccess, $(this).parents('div.media')[0] );
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
		media = $(this).parents('div.media')[0];
		IdFriend = $( $('a',media)[0] ).attr('idfriend');
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
	        		
        			$( $('a',media)[2] ).attr( 'class', 'un-request' );
	        		$( $('a',media)[2] ).html( 'unRequest' );
	                
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
		var tag_a    = $( 'a' , media )[0];
		var idfriend = $( tag_a ).attr('idfriend');
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

