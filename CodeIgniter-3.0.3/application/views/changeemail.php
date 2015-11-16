<html>
	<?php include_once __SITE_PATH . "/application/views/include/head.php"?>
<body>
	<div class="header">
		<strong class="pull-left" > <a href="#">>>Home:change email</a> </strong>
	 	<strong class="pull-right" > Hello nguyenvana </strong>
	</div>
	<div class="container">

			<fieldset>
				<legend>Change your email</legend>

				<form class="form_theme" action="" method="post">
					<div>
						<label class="width-label">Current email</label>
						nguyenvana@gmail.com
					</div>
					<br>
					<div>
						<label class="width-label" for="email">New email</label>
						<input type="text" id="email" name="email">
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