<html>
	<?php include_once __SITE_PATH . "/application/views/include/head.php"?>
<body>
<div class="header">
	<strong class="pull-left" > <a href="#">>>Home:profile</a> </strong>
 	<strong class="pull-right" > Hello nguyenvana </strong>
</div>
	<div class="container">
			<fieldset>
				<legend>Registration form</legend>
				
				<form class="form_theme" action="" method="post">
					<p class="error-alert">jasbdkajsbd</p>
					<div>
						<label class="input_text" for="fullname">Fullname</label>
						<input type="text" id="fullname" name="Nguyen van a">
					</div>
					<br>
					<div>
						<label class="input_text" for="username">username</label>
						nguyenvana
					</div>
					<br>
					<div>
						<label class="input_text" for="email">Email</label>
						nguyenvana@gmail.com
					</div>
					<br>
					<div>
						<label class="input_text" for="address">Address</label>
						<input type="text" id="address" value="141D Phan Dang Luu" >
					</div>
					<br>
					<div>
						<label class="input_text" for="sex">Sex</label>
						<input checked="checked" type="radio" id="male" name="sex">
						<label for="male">Male</label>
						<input type="radio" id="female"  name="sex">
						<label for="female">Female</label>
					</div>
					<br>
					<div>
						<label class="input_text" >Birthday(*)</label>
						<select name="day">
							<option selected="true" style="display: none;">Day</option>
							<option></option>
							<option></option>
						</select>
						<select  name="month">
							<option selected="true" style="display: none;">Month</option>
							<option></option>
							<option></option>
						</select>
						<select name="year">
							<option selected="true" style="display: none;">Year</option>
							<option></option>
							<option></option>
						</select>
					</div>
					<br>
					<div>
						<input type="submit" value="Save" name="save">
					</div>
				</form>
			</fieldset>
		
	</div>
</body>
	
</html>