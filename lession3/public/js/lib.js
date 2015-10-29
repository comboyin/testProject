function stringHtmlError( errorArray ){
	// data error
	htmlError = '<div class="alert alert-error">';
	$.each(errorArray,function(k,v){
		htmlError += v + "</br>";
	});
	htmlError += '</div>';
	return htmlError;
}

function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
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
	
	var updateNumberRequest = setInterval( updateNumberRequest , 2000);
	
	function updateNumberFollow(){
		
	}
	
});

