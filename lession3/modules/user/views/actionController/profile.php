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
				                    		
				                    			$is_like = $picture->is_like( $idacc );
				                    			$class_icon_thumbs = ( $is_like == false ) ? 'fa-thumbs-o-up' : 'fa-thumbs-o-down';
				                    			$data_original_title = ( $is_like == false ) ? 'Like' : 'Unlike';
				                    		
				                    		?>
				                    		
				                    		<div class="col-sm-3 shop-product">
											    <div class="product-wrapper">
					                                <div class="product-image">
					                                    <a href="">
					                                        <img alt="" src="<?php echo $picture->getViewUrl() ?> " >
					                                    </a>
					                                </div>
					                                <div class="product-details">
					                                    <div class="row">
					                                        <div class="col-xs-12">
					                                            <div class="product-tools">
					                                            	<?php if( $is_friend == true ):?>
					                                            		<a href="#" title="<?php echo $data_original_title?>" data-toggle="tooltip">
					                                                    	<i class="fa <?php echo $class_icon_thumbs ?>">(<?php echo $picture->getLikeNumber()?>)</i>
					                                                	</a>
					                                                	 <a href="#" title="View" data-toggle="tooltip">
					                                                    	<i class="fa fa-eye ">(<?php echo $picture->getView()?>) |</i>
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
                                		sadasd
                                	</div>
                                </div>
                            </div>
      </div>
</div>
