<html>
	<?php include_once __SITE_PATH . "/application/views/include/head.php"?>
<body>
	<div class="header">
		<strong class="pull-left" > <a href="#">>>Home:change password</a> </strong>
	 	<strong class="pull-right" > Hello nguyenvana </strong>
	</div>
	<div class="container">
		
			<fieldset>
				<legend>Change your password</legend>
				
				<form class="form_theme" action="" method="post">
					<div>
						<label class="width-label" for="oldpassword">Old password</label>
						<input type="password" id="oldpassword" name="oldpassword" >
					</div>
					<br>
					<div>
						<label class="width-label" for="newpassword">New password</label>
						<input type="text" id="newpassword" name="newpassword">
					</div>
					<br>
					<div>
						<label class="width-label" for="confirmpassword">Confirm New password</label>
						<input type="text" id="confirmpassword" name="confirmpassword">
					</div>
					<br>
					<div>
						<input type="submit" value="Change" name="change_email_submit">
					</div>
				</form>
			</fieldset>
		
	</div>
</body>
	
</html>