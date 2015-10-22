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

var indexAction = function () {
	return {
		init : function () {
			// == == == == == == == == == == begin Edit user session == == == == == == == == == == == == == == == == == == == == ==
			datepickerBirthday = $('input[name=birthday]').datepicker({
			    format: 'yyyy-mm-dd'
			});
			// edit sex
			$(document).on( 'click' ,'a.edit_sex',function(e){
				e.preventDefault();
				
				productPrices = $(this).parents('.row')[0];
				valueText =  $.trim( $( 'span.product-vars span' , productPrices).html() );
				// hidden name and button save
				$( 'span.product-vars span' , productPrices).css( 'display','none' );
				$( 'a.edit_sex' , productPrices).css( 'display','none' );
				// show input
				$( '.input_sex' , productPrices).css( 'display','inline-block' );
				// set value
				valueSex = $( 'span.product-vars span' , productPrices).attr('sex');
				if( valueSex == 1 ){
					$( 'input:radio[name=sex]' )[0].checked = true;
				}else if( valueSex == 0 ){
					$( 'input:radio[name=sex]' )[1].checked = true;
				}
				//set value
				

				// show button save and cancel
				$( 'span.saveCancelInfo' , productPrices).css( 'display','inline' );
				
			});
			
			$(document).on( 'click' ,'a.Cancel_sex',function(e){
				e.preventDefault();
				
				productPrices = $(this).parents('.row')[0];
				cancelSex(productPrices);
				
			});
			function cancelSex(productPrices){
				// hidden save and cancel
				$( 'span.saveCancelInfo' , productPrices).css( 'display','none' );
				$( 'a.edit_sex' , productPrices).css( 'display','inline' );
				// hidden input
				$( 'span.product-vars div.input_sex' , productPrices).css( 'display','none' );
				// hidden button save and cancel
				$( 'span.product-vars span' , productPrices).css( 'display','inline' );
			}
						
			$(document).on( 'click' ,'a.edit_info',function(e){
				e.preventDefault();
				productPrices = $(this).parents('.row')[0];
				valueText =  $.trim( $( 'span.product-vars span' , productPrices).html() );
				// hidden name and button save
				$( 'span.product-vars span' , productPrices).css( 'display','none' );
				$( 'a.edit_info' , productPrices).css( 'display','none' );
				// show input
				$( 'span.product-vars input' , productPrices).css( 'display','inline' );
				
				if( $.trim( $( 'span.product-vars strong' , productPrices).html() ) == "Birthday :" ){
					
					$('input[name=birthday]').datepicker( 'update', valueText );
					
				}else{
					console.log( valueText );
					$( 'span.product-vars input' , productPrices).val( valueText );
				}
				// show button save and cancel
				$( 'span.saveCancelInfo' , productPrices).css( 'display','inline' );
				
			});
			
			$(document).on( 'click' ,'a.Cancel_info',function(e){
				e.preventDefault();
				productPrices = $(this).parents('.row')[0];
				CancelInfo(productPrices);
				
			});
			
			function CancelInfo(productPrices){
				
				// show name and button save
				$( 'span.product-vars span' , productPrices).css( 'display','inline' );
				$( 'a.edit_info' , productPrices).css( 'display','inline' );
				// hidden input
				$( 'span.product-vars input' , productPrices).css( 'display','none' );
				// hidden button save and cancel
				$( 'span.saveCancelInfo' , productPrices).css( 'display','none' );
			}
			
			// == == == == == == == == == == end Edit user session == == == == == == == == == == == == == == == == == == == == ==
			
			// == == == == == == == == == == begin Edit sex == == == == == == == == == == == == == == == == == == == == ==
			$(document).on( 'click' , 'a.Save_sex' , function( e ){
				e.preventDefault();
				row   = $(this).parents('.row')[0];
				value  = $('input[name=sex]:checked',row).val();
				
				name = 'sex';
				
				updateSex( name, value, row);
				cancelSex(row);
				
			} );
			// == == == == == == == == == == end Edit sex == == == == == == == == == == == == == == == == == == == == ==
			
			// == == == == == == == == == == begin Save user == == == == == == == == == == == == == == == == == == == == ==
			$(document).on( 'click','a.Save_info',function(e){
				e.preventDefault();
				row   = $(this).parents('.row')[0];
				name  = $('input',row).attr('name');
				value = $('input',row).val();
				
				updateFieldUser( name, value, row);
				CancelInfo(row);
				
			} );
			
			function updateSex( name , value, row ){
				fd = new FormData();
				fd.append( name , value );
				$.ajax({
			        url: 'index.php?rt=user/index/editProfile',
			        type: 'POST',
			        data: fd,
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	/*
			    		 * TH01: null => success
			    		 * TH02: array => error
			    		 * */
			        	var error = data.is_error;
			        	if( error == null ){
			        		
			        		
			        		// success
			        		dalert.alert( "Edit Success" , 'Success' );
			        		
			        		
			        		$.ajax({
						        url: 'index.php?rt=user/index/getValueParameterUserSession',
						        type: 'GET',
						        cache: false,
						        dataType: 'json',
						        processData: false, // Don't process the files
						        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
						        success: function(data, textStatus, jqXHR)
						        {
						        	
						        	var user = data.user;
						        	var _value= "";
						        	var _valueSex = "";
						        	_value = user.sex;
						        	_valueSex = user.stringsex;
						        	$( ".product-vars span" , row ).html(_valueSex);
						        	console.log(_valueSex);
						        	$( ".product-vars span" , row ).attr('sex',_value);
						        	
						        },
						        error: function(jqXHR, textStatus, errorThrown)
						        {
						        	var error = ['ERRORS: ' + textStatus];
						            // Handle errors here
						        	dalert.alert( stringHtmlError(error) , 'Error' );
						        }
						    });
			        		
			        		
			        		
			        	}else{
			        		dalert.alert( generateHtmlAlertError( error ) , 'Error' );
			        	}
			        	

			        },
			        error: function(jqXHR, textStatus, errorThrown)
			        {
			        	var error = ['ERRORS: ' + textStatus];
			            // Handle errors here
			        	dalert.alert( stringHtmlError(error) , 'Error' );
			        }
			    });
			}

			function updateFieldUser( name , value, row ){
				fd = new FormData();
				fd.append( name , value );
				$.ajax({
			        url: 'index.php?rt=user/index/editProfile',
			        type: 'POST',
			        data: fd,
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	/*
			    		 * TH01: null => success
			    		 * TH02: array => error
			    		 * */
			        	var error = data.is_error;
			        	if( error == null ){
			        		
			        		
			        		// success
			        		dalert.alert( "Edit Success" , 'Success' );
			        		
			        		
			        		$.ajax({
						        url: 'index.php?rt=user/index/getValueParameterUserSession',
						        type: 'GET',
						        cache: false,
						        dataType: 'json',
						        processData: false, // Don't process the files
						        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
						        success: function(data, textStatus, jqXHR)
						        {
						        	
						        	var user = data.user;
						        	var _value= "";
						        	$.each( user , function ( key, value){
						        		if( key == name ){
						        			_value = value;
						        		}
						        	} );
						        	$( ".product-vars span" , row ).html(_value);
						        	console.log( row );
						        },
						        error: function(jqXHR, textStatus, errorThrown)
						        {
						        	var error = ['ERRORS: ' + textStatus];
						            // Handle errors here
						        	dalert.alert( stringHtmlError(error) , 'Error' );
						        }
						    });
			        		
			        		
			        		
			        	}else{
			        		dalert.alert( generateHtmlAlertError( error ) , 'Error' );
			        	}
			        	

			        },
			        error: function(jqXHR, textStatus, errorThrown)
			        {
			        	var error = ['ERRORS: ' + textStatus];
			            // Handle errors here
			        	dalert.alert( stringHtmlError(error) , 'Error' );
			        }
			    });
			}
			// == == == == == == == == == == end Save user == == == == == == == == == == == == == == == == == == == == ==			
		}

	};
}();


jQuery(document).ready(function () {
	indexAction.init();
});