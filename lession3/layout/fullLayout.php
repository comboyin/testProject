<?php 
/* @var $user User */
$user = $_SESSION['acl']['account'];
?>
<!DOCTYPE html>

<?php include_once __SITE_PATH . '/layout/include/head.php'?>
<body>
     
	<div id="box_wrapper">
	
	    <?php include_once __SITE_PATH . '/layout/include/header.php'?>
	    
		<div class="margintheme container">
			<?php echo $content->render()?>
		</div>
		
		<?php include_once __SITE_PATH . '/layout/include/footer.php'?>
	</div>
	
</body>
</html>