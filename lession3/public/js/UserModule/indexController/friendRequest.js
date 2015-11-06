var friendRequestAction = function() {
	return {
		init : function() {
			$(document).on( 'click' , "button.accept-request" , function(e){
				e.preventDefault();
				tag_tr 			= $(this).parents('tr')[0];
				idFriendRequest = $(tag_tr).attr('id_friend_request');
				acceptRequest( idFriendRequest, tag_tr , 1 );
			} );
			
			$(document).on( 'click' , "button.delete-request" , function(e){
				e.preventDefault();
				tag_tr 			= $(this).parents('tr')[0];
				idFriendRequest = $(tag_tr).attr('id_friend_request');
				acceptRequest( idFriendRequest, tag_tr , 0 );
			} );
			
			
			function acceptRequest( idFriendRequest, tag_tr , action){
				
				var fd = new FormData();
				
				fd.append("idFriendRequest",idFriendRequest);
				
				fd.append("action" , action);
				
				$.ajax({
			        url: 'index.php?rt=user/index/friendRequest',
			        type: 'POST',
			        data : fd,
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	var is_error = data.is_error;
			        	
			        	if( is_error != null ){
			        		// error
			        		dalert.alert( stringHtmlError(is_error) ,'Error' , function call(){
			        			$(tag_tr).remove();
			        		});
			        	}else{
			        		// success
			        		$(tag_tr).remove();
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
		}

	};
}();

jQuery(document).ready(function() {
	friendRequestAction.init();
});