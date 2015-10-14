
jQuery(document).ready(function() {

	var flag = true;
	function baseUrl (url){
		var baseFolder = '/'+window.location.pathname.split( '/' )[1]+'/';

		return baseFolder+url;


	}
	checkUser();
	function tuoi(nam) {
		var d = new Date();
		var yearC = d.getFullYear();
		if (isNaN(nam) == false) {

			// tuoi = yearC - nam;
			temp = yearC - nam
			// tuoi = year - nam;
			return  "Your age is " +temp;

		} else {
			return "";
		}
	}

	function checkUser(){
		$('div[name="username"]').css("display","none");
		username =  $('input[name="user_name"]').val();
		if( username != null ){
			if(username.length == 0){
				$('div[name="username"]').css("display","none");
				return;
			}
		}
		
		data = {
				username:username,
				ajax:true
		}
		$.post(baseUrl("index.php?rt=fronend/index/createAccount"),data,function(json){
			// có tồn tại
			if(json.bool==true){
				$('div[name="username"]').attr('class','user-wrong');
				flag = false;

			}else if(json.bool==false){
				$('div[name="username"]').attr('class','user-success');
				flag = true;
			}
			$("span.username").html(json.mess);
			$('div[name="username"]').css("display","inline-block");
		});
	}

	$( "form" ).submit(function( event ) {
		  if (flag == false) {
			  event.preventDefault();
		  }
		});

	$("input[name='user_name']").keyup(function(){
		checkUser();
	});

	$(".year").change(function() {

				var y = $(".year").val();
				var m = $(".month").val();

				$("span.tuoi").html(tuoi(y));
				var daysInMonth = new Date(y, m, 1, -1).getDate();
				$('.day option').remove();
				for (i = 1; i <= daysInMonth; i++) {

					$('.day').append(
							'<option value="' + i + '">' + i
									+ '</option>');
				}

			});

	$(".month").change(
			function() {
				var y = $(".year").val();
				var m = $(".month").val();

				var daysInMonth = new Date(y, m, 1, -1).getDate();
				$('.day option').remove();
				for (var i = 1; i <= daysInMonth; i++) {
					$('.day').append(
							'<option value="' + i + '">' + i
									+ '</option>');
				}
			});
});
