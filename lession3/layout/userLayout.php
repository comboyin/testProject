<?php 
/* @var $user User */
$user = $_SESSION['acl']['account'];
?>
<!DOCTYPE html>

<?php include_once __SITE_PATH . '/layout/include/head.php'?>

<body>

<div id="box_wrapper">

    <?php include_once __SITE_PATH . '/layout/include/header.php'?>

	<div class="container">
	
			<?php 
				/* @var $user User */
				$user = $user;
				$idacc = $user->getId();
				$pictures = $user->getPictures();
			?>
			
			<?php include_once __SITE_PATH . '/layout/include/profile.php'?>
		
			<?php echo $content->render()?>
	</div>

  	<?php include_once __SITE_PATH . '/layout/include/footer.php'?>
  	
  	<script type="text/javascript" src="<?php echo __FOLDER . 'public/js/userLayout.js'?>"></script>
  	
</div>

<!--=============================BEGIN DIALOG CHANGE AVATAR================================================-->
					<div style="display: none;" id="dialog-change-avatar" title="Change avatar">
						<div class="error_change_avatar">
						
						</div>
						<table>
						   		<caption>Avatar (JPEG, GIF, and PNG files up to 700kb)</caption>
						      <tbody>
						        <tr>
									<td>Avatar: </td>
						            <td>
										<input maxlength="1" type="file" accept="gif|jpg|png" name="avatar" class="form-control multi with-preview"/>
										<br/>
										<img class="avatar" style="max-height: 100px;display: none" src="">
								 	</td>
								 </tr>
		
						         <tr>
						            <td colspan="2" style="text-align: center;">
						            	<input class="btn btn-success" name="submit_change_avatar" value="Change">
						            	<span style="display:none" class="progress-loading"><img src="<?php echo __FOLDER . 'public/img/AjaxLoader.gif'?>"></span>
						            </td>
						         </tr>
						      </tbody>
						</table>
					</div>
<!--=============================END DIALOG CHANGE AVATAR================================================-->
 
    </body>
</html>