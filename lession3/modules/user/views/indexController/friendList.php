<?php 
$friendRelations = $friendRelations;

?>

<div class="row">
                	<div class="col-sm-12">
                		<div class="form-group">
	                    	<input type="submit" class="theme_button" name="apply_coupon" value="Friend list (0)">
                    	<input type="submit" class="theme_button" name="update_cart" value="Favorite (0)">
	               		</div>
                	</div>
</div>

<div class="widget widget_popular_entries">
	<h3 class="widget-title">Friend list</h3>
	<div class="row">
	<?php /* @var $friendRelation Friend_relation */?>
		<?php foreach ( $friendRelations as $friendRelation ):?>
		
			<div class="col-xs-6">
	
				<div class="list-friend">
					<div class="media">
					
						<p class="pull-left">
							<a href="#"><?php echo $friendRelation->getUserTo()->getFullname()?></a>
						</p>
						
						<a class="pull-left" href="#"> <img class="media-object"
							src="<?php echo $friendRelation->getUserTo()->getLinkAvatar()?>" alt="">
						</a>
						
						<p class="pull-left">
							<a href="#">Unfriend</a>
						</p>
						
					</div>
				</div>
	
			</div>
		<?php endforeach;?>

	</div>
</div>