<html>
	<?php include_once __SITE_PATH . "/application/views/include/head.php"?>
<body>
	<div class="container">
		
			<fieldset>
				<legend>Registration form</legend>
				
				<form class="form_theme" action="" method="post">
					<p class="error-alert">jasbdkajsbd</p>
					<div>
						<label class="input_text" for="fullname">Fullname(*)</label>
						<input type="text" id="fullname" name="fullname">
					</div>
					<br>
					<div>
						<label class="input_text" for="username">username(*)</label>
						<input type="text" id="username" name="username">
					</div>
					<br>
					<div>
						<label class="input_text" for="email">Email(*)</label>
						<input type="text" id="email" name="email">
					</div>
					<br>
					<div>
						<label class="input_text" for="password">password(*)</label>
						<input type="text" id="password" name="password">
					</div>
					<br>
					<div>
						<label class="input_text" for="re-password">Re-password(*)</label>
						<input type="text" id="re-password" name="repassword">
					</div>
					<br>
					<div>
						<label class="input_text" for="address">Address(*)</label>
						<input type="text" id="address" name="address">
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
						<label class="input_text" for="sex">Security check</label>
						<img class="captcha" alt="" src="<?php echo base_url() . "public/2015-11-16_111853.jpg"?>">
					</div>
					<br>
					<div>
						<label class="input_text" for="address">Text in the box</label>
						<input type="text" id="address" name="texcaptcha">
						<img class="icon-reset" style="display: inline-block;" alt="" src="<?php echo base_url() . "public/image/icon-reset.jpg"?>">
					</div>
					<br>
					<div>
						<a href="<?php echo site_url("main/index")?>"><input  type="button" value="Cancel" name="cancel_submit"></a>
						<input type="submit" value="Regist" name="regist_submit">
					</div>
				</form>
			</fieldset>
	</div>
</body>
</html>