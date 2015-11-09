<?php

$userFavorites = $userFavorites;
$userSession   = $_SESSION['acl']['account'];

?>

<div class="row">
	<div class="col-sm-12">
		<div class="form-group">
		<a href="<?php echo __FOLDER . 'user/index/friendList' ?>">
			<button class="theme_button">Friend list (<span class="total-friend"> <?php echo $totalFriend?> </span>)</button>
		</a>
		<a href="<?php echo __FOLDER . 'user/index/favoriteList'?>">
			<button class="theme_button">Favorite (<span class="total-favorite"> <?php echo $totalFavorite?> </span>)</button>
		</a> 
			
		</div>
	</div>
</div>

<div class="widget widget_popular_entries">
	<h3 class="widget-title">Favorite list</h3>
	<div class="row list-friend">
	<?php /* @var $userFavorite User */?>
		<?php foreach ( $userFavorites as $userFavorite ):?>
			<div class="col-xs-6">
				<div class="list-friend">
					<div class="media">
						<p class="pull-left">
							<a idfriend="<?php echo $userFavorite->getId()?>" href="<?php echo __FOLDER . 'user/action/profile/' . $userFavorite->getUsername()?>"><?php echo $userFavorite->getFullname()?></a>
						</p>
						<a class="pull-left" href="#"> <img class="media-object"
							src="<?php echo $userFavorite->getLinkAvatar()?>" alt="">
						</a>
						<p class="pull-left">
							
							<?php if ( $userFavorite->getId() != $userSession->getId() ):?>
							<a idfriend="<?php echo $userFavorite->getId()?>" class="<?php 
								switch ( $userFavorite->getStatusForUserSession() ) {
									/**
									 * 0 : add friend
									 * 1 : unfriend
									 * 2 : unRequest
									 * @var int  */
									case 0:
										echo 'add-friend';
									break;
									case 1:
										echo 'un-friend';
									break;
									case 2:
										echo 'un-request';
									break;
								}
							?>" href="#">
								<?php
								switch ( $userFavorite->getStatusForUserSession() ) {
									case 0:
										echo 'Add Friend';
										break;
									case 1:
										echo 'unFriend';
										break;
									case 2:
										echo 'unRequest';
										break;
									}
								?>
							</a>
							<?php endif;?>
						</p>
						
						<p class="pull-left">
							<?php if ( $userFavorite->getId() != $userSession->getId() ):?>
							<a class="<?php 
								switch ( $userFavorite->getStatusFavorite() ) {
									/**
									 * 0 : add favorite => is not favorite
									 * 1 : unfavorite   => is favorite
									 * @var int  */
									case 0:
										echo 'add-favorite';
									break;
									case 1:
										echo 'un-favorite';
									break;
								}
							?>" href="#">
								<?php
								switch ( $userFavorite->getStatusFavorite() ) {
									case 0:
										echo 'Add favorite';
										break;
									case 1:
										echo 'unFavorite';
										break;
									}
								?>
							</a>
							<?php endif;?>
						</p>
					</div>
				</div>
			</div>
		<?php endforeach;?>
	</div>
</div>
<script type="text/javascript" src="<?php echo __FOLDER . 'public/js/UserModule/indexController/friendListAction.js'?>"></script>