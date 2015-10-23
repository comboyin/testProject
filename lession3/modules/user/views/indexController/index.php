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
                            <button class="btn change-avatar">Change avatar</button>
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

							 <div class="col-xs-6 text-right">
                                    <span><a class="edit_sex" href="#">Edit</a></span>
                                    	<span style="display: none" class="saveCancelInfo">
	                                    	<a class="Save_sex" href="#">Save</a>
	                                    	<a class="Cancel_sex" href="#">Cancel</a>
                                    </span>
                             </div>
						</div>
						
						<div class="row">

							<div class="col-xs-6">
								<span class="product-vars">
                            		<strong>
                                		Birthday :
                            		</strong>
                            			<input style="display: none" type="text" value="" name="birthday" class="form-control" placeholder="yyyy-mm-dd">
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
                            		    Address :
                           		 </strong>
                           		 	<input style="display: none" type="text" value="" name="address" class="form-control" placeholder="">
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
					                    	<div class="col-sm-3 shop-product add-picture">
											    <div class="product-wrapper">
					                                <div class="product-image">
					                                    <a href="">
					                                        <img alt="" src="<?php echo __FOLDER  . 'public/img/friend_finder.png' ?>" >
					                                    </a>
					                                </div>
					                            </div>
					                        </div>
					                        
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
						                                                <a id-picture="<?php echo $picture->getId()?>" href="#" title="Delete" data-toggle="tooltip">
						                                                    <i class="fa fa-remove"> | </i>
						                                                </a>
						                                                <a href="#" title="View" data-toggle="tooltip">
						                                                    <i class="fa fa-eye ">(<?php echo $picture->getView()?>) |</i>
						                                                </a>
						                                                <a href="#" title="<?php echo $data_original_title?>" data-toggle="tooltip">
						                                                    <i class="fa <?php echo $class_icon_thumbs ?>">(<?php echo $picture->getLikeNumber()?>)</i>
						                                                </a>
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
                </div>
			</div>
</section>


<!--=============================BEGIN DIALOG CHANGE AVATAR================================================-->
		<div id="dialog-change-avatar" title="Change avatar">
			<div class="error_change_avatar">
			
			</div>
			  <div class="border-style">
				   <table class="form_table">
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
		</div>
<!--=============================END DIALOG CHANGE AVATAR================================================-->


<!--=============================BEGIN DIALOG ADD LIST PICTURE================================================-->
		<div id="dialog-add-list-picture" title="Add Pictures">
			<div class="error_picture">
			
			</div>
			  <div>
				   <table style="margin: 0 auto;">
				   		<caption>PICTURE (JPEG, GIF, and PNG files up to 700kb)</caption>
				      <tbody>
				        <tr class="list-image">
							<td>Pictures</td>
				            <td>
								<input type="file" maxlength="10" accept="gif|jpg|png" name="pictures[]" class="form-control multi with-preview" multiple />
						 	</td>
						 </tr>
						 <tr>
				            <td colspan="2" style="text-align: center;">
				            	<input class="btn btn-success" name="submit_add_picture" value="Add">
				            	<span style="display:none" class="progress-loading-picture"><img src="<?php echo __FOLDER . 'public/img/AjaxLoader.gif'?>"></span>
				            </td>
				         </tr>
				      </tbody>
				   </table>
			</div>
		</div>
<!--=============================BEGIN DIALOG ADD LIST PICTURE================================================-->
  
<script type="text/javascript" src="<?php echo __FOLDER . 'public/js/UserModule/indexController/indexAction.js'?>"></script>
