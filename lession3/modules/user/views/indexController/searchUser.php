<?php 
$error = $error;
$listUser = $listUser;
?>
<?php if ( isset( $error ) && $error != null ):?>
	<div class="row" >
		<div class="alert alert-danger">
			<strong>Error!</strong>
				<div class="item">
					<ul>
						<?php foreach ( $error as $e ):?>
							<li><?php echo $e?></li>
						<?php endforeach;?>
					</ul>
				</div>
		</div>
	</div>
<?php endif;?>

<div class="widget widget_popular_entries">
	<h3 class="widget-title">Friend list search</h3>
	<div class="row list-friend">
		<?php /* @var $user User */ ?>
		<?php foreach ($listUser as $user):?>
			<?php
				$action = 0;
				if( count( $user->getFriendRequest() ) == 1 ){
					$action = 1;
				}
			?>
			<div class="col-xs-6">
				<div class="list-friend">
					<div class="media">
						<p class="pull-left">
							<a idfriend="<?php echo $user->getId()?>" href="<?php echo __FOLDER?>user/action/profile/<?php echo $user->getUsername()?>"><?php echo $user->getFullname()?></a>
						</p>
						<a class="pull-left" href="<?php echo __FOLDER?>user/action/profile/<?php echo $user->getUsername()?>"> <img class="media-object" src="<?php echo $user->getLinkAvatar()?>" alt="">
						</a>
						<p class="pull-left">
							<a idfriend="<?php echo $user->getId()?>" class="<?php echo ( $action == 0 ) ? 'add-friend':'un-request'?>" href="#"><?php echo ( $action == 0 ) ? 'Add Friend':'UnRequest'?></a>
						</p>
					</div>
				</div>
			</div>
		<?php endforeach;?>
	</div>
</div>
<script type="text/javascript" src="<?php echo __FOLDER . 'public/js/UserModule/indexController/searchUserAction.js'?>"></script>