

var indexAction = function () {
	return {
		init : function () {
			
			loadGoogleMap();
			var picture = null;
			
			dialogAddPicture = $("#dialog-add-list-picture").dialog({
				autoOpen: false,
				modal: true,
			    maxHeight: 600,
			    maxWidth: 600
			    
			});
			
			dialogEdit = $("#dialog-edit-introduction").dialog({
				autoOpen: false,
				modal: true,
				width: 450,
			    maxHeight: 600,
			    maxWidth: 600
			});
			
			$("a.edit-introduction").click(function(e){
				e.preventDefault();
				
				$.ajax({
			        url: 'index.php?rt=user/index/getValueParameterUserSession',
			        type: 'GET',
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	var introduction = data.user.introduction;
			        	$("textarea[name=introduction]").val(  introduction  );
			        	dialogEdit.dialog('open');
			        },
			        
			        error: function(jqXHR, textStatus, errorThrown)
			        {
			        	var error = ['ERRORS: ' + textStatus];
			            // Handle errors here
			        	dalert.alert( stringHtmlError(error) ,'Error');
			        }
			    });
			});
			
			$("input[name=submit_edit_introduction]").click(function (e){
				e.preventDefault();
				var value = $("textarea[name=introduction]").val();
				
				// success
				changeIntroduction( value );
        		
			});
			
			function changeIntroduction(value){
				fd = new FormData();
				fd.append( 'introduction' , value );
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
			        		
			        		$.ajax({
						        url: 'index.php?rt=user/index/getValueParameterUserSession',
						        type: 'GET',
						        cache: false,
						        dataType: 'json',
						        processData: false, // Don't process the files
						        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
						        success: function(data, textStatus, jqXHR)
						        {
						        	dalert.alert( "Edit introduction success" , 'success' , function callbackMe(){
						        		$("div.introduction-content").html( escapeHtml( data.user.introduction ) );
						        		dialogEdit.dialog('close');
					                });
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
			
			function loadGoogleMap(){
				
				$.ajax({
			        url: 'index.php?rt=user/index/getValueParameterUserSession',
			        type: 'GET',
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	address = data.user.address
			        	initialize();
			        	activeEventClickGoogleMap();
			        },
			        error: function(jqXHR, textStatus , errorThrown)
			        {
			        	var error = ['ERRORS: ' + textStatus];
			            // Handle errors here
			        	dalert.alert( stringHtmlError(error) ,'Error');
			        }
			    });
			};
			
			
			
			// == == == == == == == == == == begin add picture == == == == == == == == == == == == == == == == == == == == ==
			$("div.add-picture").click(function(e){
				e.preventDefault();
				
				dialogAddPicture.dialog('open');
			});
			
			function resetListPicture(){
				$.ajax({
			        url: 'index.php?rt=user/index/getHtmlListPicture',
			        type: 'GET',
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	var content = data.content;
			        	
			        	$("span.listPicture").html( content );
			        	
			        	$("a[data-gal^='prettyPhoto']").prettyPhoto({
			    	   		hook: 'data-gal',
			    			theme: 'facebook' /* light_rounded / dark_rounded / light_square / dark_square / facebook / pp_default*/
			    	  	});
			        },
			        
			        
			        error: function(jqXHR, textStatus, errorThrown)
			        {
			        	var error = ['ERRORS: ' + textStatus];
			            // Handle errors here
			        	dalert.alert(stringHtmlError(error),'Error');
			        }
			    });
			}
			
			function addPicture(){
				
				$(".progress-loading-picture").css("display",'inline-block');
				
				$("input[name=submit_add_picture]").css("display",'none');
				
				fd = new FormData();
				// list image
				$.each( $('input[name="pictures[]"]') ,function(key,value){
					var files = value.files;
					$.each(files,function(keyF,valueF){
						fd.append("pictures[]",valueF);
					});
				});
				
				$.ajax({
			        url: 'index.php?rt=user/index/addPictures',
			        type: 'POST',
			        data: fd,
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	
			        	$(".progress-loading-picture").css("display",'none');
						$("input[name=submit_add_picture]").css("display",'inline-block');
			        	var htmlError = '';
			        	// error
			        	if(data.is_error != null){
			        		
			        		htmlError = generateHtmlAlertError( data.is_error );
			        		$("div.error_picture").html(htmlError);
			        		
			        	}else{
			        		
			        		$("div.error_picture").html('');
			        		// remove image.
			        		$( 'input[name="pictures[]"]' ).MultiFile( 'reset' );
			        		// close dialog
			        		dialogAddPicture.dialog( 'close' );
			        		
			        		dalert.alert("Add pictures success.","Success",function callbackMe(){
			        			resetListPicture();
			                });
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
			
			$("input[name=submit_add_picture]").click(function(e){
				e.preventDefault();
				addPicture();
			});
			// == == == == == == == == == == end add picture == == == == == == == == == == == == == == == == == == == == ==
			
			
			
			
			// == == == == == == == == == == begin Delete picture == == == == == == == == == == == == == == == == == == == == ==
			$(document).on( 'click' , 'a i[class="fa fa-remove"]' , function(e){
					e.preventDefault();
					var parent = $(this).parents('a')[0];
					var idpicture = $(parent).attr('id-picture');
					var parentShopProduct = $(this).parents('div.shop-product')[0];
			        dalert.confirm("Are You Sure?","Alert Confirm !",function(result){
			            if(result){
			            	deletePicture( idpicture , parentShopProduct );
			            } 
			            else{
			            	
			            }
			        });
				});
			
			function deletePicture( idpicture , parentShopProduct){
				fd = new FormData();
				fd.append("idpicture", idpicture );

				$.ajax({
			        url: 'index.php?rt=user/index/deletePicture',
			        type: 'POST',
			        data: fd,
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	var is_error = data.is_error;
			        	if( is_error == null ){
			        		// success
			        		dalert.alert("Delete picture success.","Success",function callbackMe(){
			        			$(parentShopProduct).remove();
			                });	
			        		
			        	}else{
			        		// error
			        		dalert.alert(generateHtmlAlertError( is_error ) , "error" );
			        		
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
			
			// == == == == == == == == == == end delete picture == == == == == == == == == == == == == == == == == == == == ==
			
			// == == == == == == == == == == begin view picture == == == == == == == == == == == == == == == == == == == == ==
			
			
			// == == == == == == == == == == end view picture == == == == == == == == == == == == == == == == == == == == ==
		}

	};
}();


jQuery(document).ready(function () {
	indexAction.init();
});