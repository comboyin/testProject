<section class="light_section">
			    <div class="container">
			        <div class="row">
			            <div class="col-sm-12">
			                <div class="row">
			                    <div class="col-sm-4 profile-avatar">
			                        <div class="text-center">
			                        
			                        	<div class="avatar-img">
			                        		<img id="product-image" src="<?php echo $user->getLinkAvatar();?>" >
			                            	<button class="btn change-avatar">Change avatar</button>
			                        	</div>
			                            
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
				                                    			<?php echo htmlspecialchars( $user->getFullname() )?>
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
										
											<div class="col-xs-10">
												<span class="product-vars product-items">
				                            		<strong>
				                                		Email :
				                            		</strong>
			                            			
			                            			<span><?php echo htmlspecialchars( $user->getEmail() )?></span>
			                            			<input style="display: none" type="text" value="" name="email" class="form-control" placeholder="">
				                       		 	</span>
											</div>
											 <div class="col-xs-2 text-right">
			                                     	<span><a class="edit_info" href="#">Edit</a></span>
			                                    	<span style="display: none" class="saveCancelInfo">
				                                    	<a class="Save_info" href="#">Save</a>
				                                    	<a class="Cancel_info" href="#">Cancel</a>
			                                    	</span>
				                             </div>
			                             </span>
									</div>
			
			
									<div class="row">
			
										<div class="col-xs-10">
											<span class="product-vars product-items">
					                            <strong>
					                                Sex :
					                            </strong>
			                            	
			                            		<span sex="<?php echo $user->getSex()?>"><?php echo htmlspecialchars( $user->getStringSex() )?></span>
			                            		
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
			
										 <div class="col-xs-2 text-right product-items">
			                                    <span><a class="edit_sex" href="#">Edit</a></span>
			                                    	<span style="display: none" class="saveCancelInfo">
				                                    	<a class="Save_sex" href="#">Save</a>
				                                    	<a class="Cancel_sex" href="#">Cancel</a>
			                                    </span>
			                             </div>
									</div>
									
									<div class="row">
			
										<div class="col-xs-10">
											<span class="product-vars product-items">
			                            		<strong>
			                                		Birthday :
			                            		</strong>
			                            			<input style="display: none" type="text" value="" name="birthday" class="form-control" placeholder="yyyy-mm-dd">
			                            			<span><?php echo htmlspecialchars ( $user->getBirthday() )?></span>
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
			
			
									<div class="row">
			
										<div class="col-xs-10">
											<span class="product-vars product-items">
			                            		<strong>
			                            		    Address :
			                           		 </strong>
			                           		 	<input style="display: none" type="text" value="" name="address" class="form-control" placeholder="">
												<span><?php echo htmlspecialchars( $user->getAddress() )?></span>
			
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
			
									<div class="row">
			
										<div class="col-xs-10">
											<span class="product-vars product-items">
			                            		<strong>
			                            		    Level :
			                           		 	</strong>
			                           		 	<span><?php echo htmlspecialchars( $user->getGroup()->getStringLevel() )?></span>
			                        		</span>
										</div>
									</div>
			                      </div>
			
			                    </div>
			                </div>
			                </div>
						</div>
			</section>