<?php 
	/* @var $user User */
	$user = $user;
	$idacc = $user->getId();
	$pictures = $user->getPictures();
?>
<section class="light_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="text-center">
                            <img id="product-image" src="<?php echo $user->getLinkAvatar();?>" >
                        </div>
                    </div>
                    <div class="col-sm-8 single-product-description">
                        <div class="product-prices">
                            <div class="row">
                                <div class="col-xs-12">
                                    <span class="product-vars">
                                    	<input style="display: none" type="text" value="" name="fullname" class="form-control" placeholder=""> 
                                    	<h1>
                                    		<strong>
                                    			<span>
	                                    			<?php echo $user->getFullname()?>
                                    			</span>
	                                    	</strong>
                                    	</h1>
                                    </span>
                                </div>
                            </div>
                        </div>

						<div class="row">
							
								<div class="col-xs-12">
									<span class="product-vars">
	                            		<strong>
	                                		Email :
	                            		</strong>
                            			
                            			<span><?php echo $user->getEmail()?></span>
                            			<input style="display: none" type="text" value="" name="email" class="form-control" placeholder="">
	                       		 	</span>
								</div>
								 
                             </span>
						</div>


						<div class="row">

							<div class="col-xs-12">
								<span class="product-vars">
		                            <strong>
		                                Sex :
		                            </strong>
                            	
                            		<span sex="<?php echo $user->getSex()?>"><?php echo $user->getStringSex()?></span>
                            		
                            		<div style="display: none;" class="input_sex">
                            			<div  class="radio">
									  		<label><input value="1" type="radio" name="sex">Female</label>
										</div>
										
										<div class="radio">
									  		<label><input value="0" type="radio" name="sex">Male</label>
										</div>
										
                            		</div>
	                            	
                        		</span>
							</div>
						</div>
						
						<div class="row">

							<div class="col-xs-12">
								<span class="product-vars">
                            		<strong>
                                		Birthday :
                            		</strong>
                            			<input style="display: none" type="text" value="" name="birthday" class="form-control" placeholder="yyyy-mm-dd">
                            			<span><?php echo $user->getBirthday()?></span>
                        		</span>
							</div>

							 
						</div>


						<div class="row">

							<div class="col-xs-12">
								<span class="product-vars">
                            		<strong>
                            		    Address :
                           		 </strong>
                           		 	<input style="display: none" type="text" value="" name="address" class="form-control" placeholder="">
									<span><?php echo $user->getAddress()?></span>

                        		</span>
							</div>
						</div>

						<div class="row">

							<div class="col-xs-12">
								<span class="product-vars">
                            		<strong>
                            		    Level :
                           		 	</strong>
                           		 	<span><?php echo $user->getGroup()->getStringLevel() ?></span>
                        		</span>
							</div>
						</div>
                      </div>

                    </div>
                </div>
                </div>
			</div>
</section>

<?php if( $is_friend == true ):?>
<div class="row">
                	<div class="col-sm-12">
                		<div class="form-group">
                			<a href="<?php echo __FOLDER . 'user/action/friendList/' . $user->getUsername()?>">
                				<input type="button" class="theme_button" name="apply_coupon" value="Friend list (<?php echo $user->getTotalFriendList()?>)">
                			</a>
	                    	
	                    	<a>
	                    		<input type="button" class="theme_button" name="update_cart" value="Favorite (<?php echo $user->getTotalFavorite()?>)">	
	                    	</a>
                    		
	               		</div>
                	</div>
</div>
<?php endif;?>

<div class="widget widget_popular_entries">
	<h3 class="widget-title">Friend list</h3>
	<div class="row list-friend">
	<?php /* @var $friendRelation Friend_relation */?>
		<?php foreach ( $friendRelations as $friendRelation ):?>
			<div class="col-xs-6">
				<div class="list-friend">
					<div class="media">
						<p class="pull-left">
							<a idfriend="<?php echo $friendRelation->getUserTo()->getId()?>" href="<?php echo __FOLDER . 'user/action/profile/' . $friendRelation->getUserTo()->getUsername()?>"><?php echo $friendRelation->getUserTo()->getFullname()?></a>
						</p>
						<a class="pull-left" href="#"> <img class="media-object"
							src="<?php echo $friendRelation->getUserTo()->getLinkAvatar()?>" alt="">
						</a>
						<p class="pull-left">
							<a class="Unfriend" href="#">Unfriend</a>
						</p>
					</div>
				</div>
			</div>
		<?php endforeach;?>
	</div>
</div>