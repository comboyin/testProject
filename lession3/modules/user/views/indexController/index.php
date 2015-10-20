<?php 
/* @var $user User */
$user = $user;
$pictures = $user->getPictures();
?>
<section class="light_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="product-image text-center">
                            <img id="product-image" src="<?php echo __FOLDER . 'public/' ?>example/shop/01.jpg" data-zoom-image="example/shop/01.jpg" alt="">
                            <button class="btn">Change avatar</button>
                        </div>
                    </div>
                    <div class="col-sm-8 single-product-description">
                        <div class="product-prices">
                            <div class="row">
                                <div class="col-xs-10">
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
                                <div class="col-xs-2 text-right">
                                    <span><a class="edit_info" href="#">Edit</a></span>
                                    <span style="display: none" class="saveCancelInfo">
                                    	<a class="Save_info" href="#">Save</a>
                                    	<a class="Cancel_info" href="#">Cancel</a>
                                    </span>
                                </div>
                            </div>
                        </div>

						<div class="row">
							
								<div class="col-xs-6">
									<span class="product-vars">
	                            		<strong>
	                                		Email :
	                            		</strong>
                            			
                            			<span><?php echo $user->getEmail()?></span>
                            			<input style="display: none" type="text" value="" name="email" class="form-control" placeholder="">
	                       		 	</span>
								</div>
								 <div class="col-xs-6 text-right">
                                     	<span><a class="edit_info" href="#">Edit</a></span>
                                    	<span style="display: none" class="saveCancelInfo">
	                                    	<a class="Save_info" href="#">Save</a>
	                                    	<a class="Cancel_info" href="#">Cancel</a>
                                    	</span>
	                             </div>
                             </span>
						</div>

						<div class="row">

							<div class="col-xs-6">
								<span class="product-vars">
                            		<strong>
                                		Birthday :
                            		</strong>
                            			<input style="display: none" type="text" value="" name="birthday" class="form-control" placeholder="">
                            			<span><?php echo $user->getBirthday()?></span>
                        		</span>
							</div>

							 <div class="col-xs-6 text-right">
                                    <span><a class="edit_info" href="#">Edit</a></span>
                                    	<span style="display: none" class="saveCancelInfo">
	                                    	<a class="Save_info" href="#">Save</a>
	                                    	<a class="Cancel_info" href="#">Cancel</a>
                                    </span>
                             </div>
						</div>

						<div class="row">

							<div class="col-xs-6">
								<span class="product-vars">
                            <strong>
                                Sex :
                            </strong>
                            	
                            	<span><?php echo $user->getStringSex()?></span>
                            	<input style="display: none" type="text" value="" name="sex" class="form-control" placeholder="">
                        </span>
							</div>

							 <div class="col-xs-6 text-right">
                                    <span><a class="edit_info" href="#">Edit</a></span>
                                    	<span style="display: none" class="saveCancelInfo">
	                                    	<a class="Save_info" href="#">Save</a>
	                                    	<a class="Cancel_info" href="#">Cancel</a>
                                    </span>
                             </div>
						</div>


						<div class="row">

							<div class="col-xs-6">
								<span class="product-vars">
                            		<strong>
                            		    Address :
                           		 </strong>
                           		 	<input style="display: none" type="text" value="" name="sex" class="form-control" placeholder="">
									<span><?php echo $user->getAddress()?></span>

                        		</span>
							</div>

							 <div class="col-xs-6 text-right">
                                    <span><a class="edit_info" href="#">Edit</a></span>
                                    	<span style="display: none" class="saveCancelInfo">
	                                    	<a class="Save_info" href="#">Save</a>
	                                    	<a class="Cancel_info" href="#">Cancel</a>
                                    </span>
                             </div>
						</div>

						<div class="row">

							<div class="col-xs-6">
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
                <div class="row">
                	<div class="col-sm-12">
                		<div class="form-group">
	                    	<input type="submit" class="theme_button" name="apply_coupon" value="Friend list (<?php echo $user->getTotalFriendList()?>)">
	                    	<input type="submit" class="theme_button" name="update_cart" value="Favorite (<?php echo $user->getTotalFavorite()?>)">
	               		</div>
                	</div>
                </div>

                <div class="row">
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
					                    	<div class="col-sm-3 shop-product">
											    <div class="product-wrapper">
					                                <div class="product-image">
					                                    <a href="">
					                                        <img alt="" src="<?php echo __FOLDER  . 'public/img/friend_finder.png' ?>" >
					                                    </a>
					                                </div>
					                            </div>
					                        </div>
					                    	
					                    	<?php  /* @var $picture Picture */ ?>
					                    	<?php foreach ($pictures as $picture):?>
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
						                                                <a href="#" title="Delete" data-toggle="tooltip">
						                                                    <i class="fa fa-remove"> | </i>
						                                                </a>
						                                                <a href="#" title="View" data-toggle="tooltip">
						                                                    <i class="fa fa-eye ">(<?php echo $picture->getView()?>) |</i>
						                                                </a>
						                                                <a href="#" title="Like" data-toggle="tooltip">
						                                                    <i class="fa fa-thumbs-o-up">(<?php echo $picture->getLikeNumber()?>)</i>
						                                                </a>
						                                            </div>
						                                        </div>
						                                    </div>
						                                    <p>
						                                        <?php echo $picture->getDescription()?>
						                                    </p>
						                                </div>
						                            </div>
					                        	</div>
					                    		<?php endforeach;?>
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
                </div>
			</div>
</section>
  
<script type="text/javascript" src="<?php echo __FOLDER . 'public/js/UserModule/indexController/indexAction.js'?>"></script>
