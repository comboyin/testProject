<html>
	<?php include_once __SITE_PATH . "/application/views/include/head.php"?>
<body>
<div class="header">
 <strong class="pull-right" > Hello nguyenvana </strong>
</div>

	<div class="container">
		
		<h3>Main menu</h3>
		<ol>
			<a href="<?php echo site_url('main/profile')?>"><li> Profile </li></a>
			<a href="<?php echo site_url('main/changeemail')?>"><li> Change email </li></a>
			<a href="<?php echo site_url('main/changepassword')?>"><li> Change password </li></a>
			<a href="<?php echo site_url('main/logout')?>"><li> Logout </li></a>
			
		</ol>
		
	</div>
</body>
	
</html>