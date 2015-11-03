var friendListAction = function() {
	return {
		init : function() {
			//= = =  = = = = =  = = = = = begin unfriend  = = = = =  = = = = =  = = = = =  = = = = =  = = = = =  = = = = =  = =
				
				
				
				function loadListFriendList(){
					$.ajax({
				        url: 'index.php?rt=user/index/getHTMLListFriendRelation',
				        type: 'GET',
				        cache: false,
				        dataType: 'json',
				        processData: false, // Don't process the files
				        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
				        success: function(data, textStatus, jqXHR)
				        {
				        	var content = data.content;
				        	var total   = data.totalFriend;
				        	$("div.list-friend").html(content);
				        	$("span.total-friend").html(total);
				        	
				        },
				        error: function(jqXHR, textStatus, errorThrown)
				        {
				        	var error = ['ERRORS: ' + textStatus];
				            // Handle errors here
				        	dalert.alert(stringHtmlError(error),'Error');
				        }
				    });
				}
				
			//= = =  = = = = =  = = = = = end unfriend  = = = = =  = = = = =  = = = = =  = = = = =  = = = = =  = = = = =  = =
		}

	};
}();

jQuery(document).ready(function() {
	friendListAction.init();
});