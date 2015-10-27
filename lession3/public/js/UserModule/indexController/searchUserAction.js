var searchUserAction = function() {
	return {
		init : function() {
			
			//= = =  = = = = =  = = = = = begin send request  = = = = =  = = = = =  = = = = =  = = = = =  = = = = =  = = = = =  = =
			$(document).on('click',"a.Add-Friend",function(e){
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
			        		
			        		dalert.alert("Send request success!","success",function callbackMe(){
			        			$( $('a',media)[2] ).attr( 'class', 'Un-Request' );
				        		$( $('a',media)[2] ).html( 'UnRequest' );
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
			//= = =  = = = = =  = = = = = end send request  = = = = =  = = = = =  = = = = =  = = = = =  = = = = =  = = = = =  = =
		}

	};
}();

jQuery(document).ready(function() {
	searchUserAction.init();
});