<?php 
	/* @var $user User */
	$user = $user;
	$idacc = $user->getId();
	$pictures = $user->getPictures();
	$address = $user->getAddress();
	/* @var $userSession User */
	$userSession = $_SESSION['acl']['account'];
?>
<section class="light_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-4 profile-avatar">
                        <div class="text-center">
                            <img id="product-image" src="<?php echo $user->getLinkAvatar();?>" >
                        </div>
                        <button idUser="<?php echo $user->getId()?>" class="btn <?php echo ( $is_favorite == true ) ? 'unfavorite btn-danger' : 'add-favorite btn-info' ?>"><?php echo ( $is_favorite == true ) ? 'Unfavorite' : 'Add Favorite' ?></button>
                        <button idUser="<?php echo $user->getId()?>" class="btn <?php echo ( $is_follow == true ) ? 'un-follow btn-danger' : 'add-follow btn-info' ?>"><?php echo ( $is_follow == true ) ? 'Unfollow' : 'Add Follow' ?></button>
                            
                        	<?php if( $user->getStatusForUserSession() == 0 ):?>
			                        	<?php 
				                        	/**
				                        	 * 0 : add friend
				                        	 * 1 : unfriend
				                        	 * 2 : unRequest
				                        	 * @var int  */
			                        	?>
	                        		
                        				<button class="btn btn-info add-friend">
                        					<a idfriend="<?php echo $user->getId()?>" style="color: white;" class="add-friend" href="#">
                        						Add Friend
                        					</a>
                        				</button>
                        		
                        	<?php elseif ( $user->getStatusForUserSession() == 1 ):?>
                        		
                        			<button  class="btn btn-danger un-friend">
                        				<a style="color: white;" idfriend="<?php echo $user->getId()?>" class="un-friend" href="#">
                        					UnFriend
                        				</a>
                        			</button>
                        		
                        	<?php elseif ( $user->getStatusForUserSession() == 2 ):?>
                        	
                        			<button  class="btn btn-danger un-request">
                        				<a style="color: white;" idfriend="<?php echo $user->getId()?>" class="un-request" href="#">
                        					unRequest
                        				</a>
                        			</button>
                        	
                        	<?php endif;?>
                        	   
                        
                        
                        
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
	                                    			<?php echo htmlspecialchars( $user->getFullname() )?>
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
                            			
                            			<span><?php echo htmlspecialchars( $user->getEmail() )?></span>
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
                            			<span><?php echo htmlspecialchars( $user->getBirthday() )?></span>
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
									<span><?php echo htmlspecialchars( $user->getAddress() )?></span>

                        		</span>
							</div>
						</div>

						<div class="row">

							<div class="col-xs-12">
								<span class="product-vars">
                            		<strong>
                            		    Level :
                           		 	</strong>
                           		 	<span><?php echo htmlspecialchars( $user->getGroup()->getStringLevel() ) ?></span>
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
                				<button type="button" class="theme_button" name="apply_coupon">Friend list (<span><?php echo $user->getTotalFriendList()?></span>)</button>
                			</a>
	                    	
	                    	<a href="<?php echo __FOLDER . 'user/action/favoriteList/' . $user->getUsername()?>">
	                    		<button type="button" class="theme_button" name="apply_coupon">Favorite (<span><?php echo $user->getTotalFavorite()?></span>)</button>
	                    	</a>
                    		
	               		</div>
                	</div>
</div>
<?php endif;?>
<div class="row margintheme">
                    <div class="col-sm-12">
                        <div id="product-tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active">
                                    <a href="#tab-introduction" role="tab" data-toggle="tab">Introduction</a>
                                </li>
                                <li >
                                    <a href="#tab-Picture" role="tab" data-toggle="tab">Picture</a>
                                </li>
                                <li >
                                    <a href="#tab-Location" role="tab" data-toggle="tab">Location</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tab-introduction">
                                		sadasd
                                </div>

                                <div class="tab-pane fade" id="tab-Picture">
					                  <div id="product_listing">
					                  	<div class="row">
					                    <span class="listPicture">
				                    		<?php  /* @var $picture Picture */ ?>
				                    		<?php foreach ($pictures as $picture):?>
				                    		<?php
				                    		
				                    			$is_like = $picture->is_like( $userSession->getId() );
				                    			$class_icon_thumbs = ( $is_like == false ) ? 'fa-thumbs-o-up' : 'fa-thumbs-o-down';
				                    			$data_original_title = ( $is_like == false ) ? 'Like' : 'Unlike';
				                    			
				                    		?>
				                    		
				                    		<div class="col-sm-3 shop-product">
											    <div class="product-wrapper">
					                                <div idPicture="<?php echo $picture->getId()?>" class="product-image">
					                                    <a rel="prettyPhoto" href="<?php echo $picture->getViewUrl() ?> ">
					                                        <img alt="" src="<?php echo $picture->getViewUrl() ?> " >
					                                    </a>
					                                </div>
					                                <div class="product-details">
					                                    <div class="row">
					                                        <div class="col-xs-12">
					                                            <div class="product-tools">
					                                            	<?php if( $is_friend == true ):?>
					                                                	 <a href="#" title="View" data-toggle="tooltip">
					                                                    	<i class="fa fa-eye ">(<span class="number-view"><?php echo $picture->getView()?></span>) |</i>
					                                               		</a>
					                                               		<a class="like-picture" href="#" title="<?php echo $data_original_title?>" data-toggle="tooltip">
					                                                    	<i class="fa <?php echo $class_icon_thumbs ?>">(<span class="number-like"><?php echo $picture->getLikeNumber()?></span>)</i>
					                                                	</a>
					                                            	<?php endif;?>
					                                            </div>
					                                        </div>
					                                    </div>
					                                </div>
					                            </div>
				                        	</div>
				                    		<?php endforeach;?>
					                    	</span>
					                        </div>   
					                    </div>
									</div>
									<div class="tab-pane fade" id="tab-Location">
                                		<section class="grey_section" id="map"></section>
                                	</div>
                                </div>
                            </div>
      </div>
</div>

<script type="text/javascript" src="<?php echo __FOLDER . 'public/js/UserModule/indexController/profileAction.js'?>"></script>

<script type="text/javascript" >
	var address = "<?php echo $address?>";
	initialize();
</script>

