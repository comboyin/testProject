
<div class="widget widget_popular_entries">
	<h3 class="widget-title">Friend list</h3>
	<div class="row list-friend">
			<?php /* @var $UserSuggestion User */ ?>
			<?php foreach ( $listSuggestion as $UserSuggestion ):?>
				<div class="col-xs-6">
					<div class="list-friend">
						<div class="media">
							<p class="pull-left">
								<a idfriend="<?php echo $UserSuggestion->getId()?>" href="<?php echo __FOLDER?>user/action/profile/<?php echo htmlspecialchars( $UserSuggestion->getUsername() )?>"><?php echo htmlspecialchars( $UserSuggestion->getFullname() )?></a>
							</p>
							<a class="pull-left" href="#"> <img class="media-object" src="<?php echo __FOLDER?><?php echo __FOLDER_UPLOADS?>/<?php echo $UserSuggestion->getAvatar()?>" alt="">
							</a>
							<p class="pull-left">
									<a idfriend="<?php echo $UserSuggestion->getId()?>" class="add-friend" href="#">Add Friend</a>
							</p>
						</div>
					</div>
				</div>
			<?php endforeach;?>
			
	</div>
</div>