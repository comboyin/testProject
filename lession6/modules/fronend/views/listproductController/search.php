<?php
    $products = $listProduct;
    $pagitation = $pagination;
	$error = $error;
    /* @var $product product */
    /* @var $pagitation pagination */
	/* @var $category category */
?>
<div class="title">
	<a href="#">Tìm kiếm - Có <?php echo count($products)?> sản phẩm được tìm thấy.</a>
</div>

<!-- BEGIN alert  -->
		      <?php if( isset($error) && $error != null ):?>
		          <div class="alert alert-error">
		          
					<strong>Error! </strong>

    		        <?php if(isset($error[ 'keyword']) && count($error[ 'keyword'])> 0):?>
        		        <div class="item">
							
							<p>
								<strong>Từ khóa: </strong>
							</p>
							
							<ul>
            		            <?php foreach ($error[ 'keyword'] as $value):?>
            		            <li>
            		              <?php echo $value ?>
            		            </li>
            		            <?php endforeach;?>
            		        </ul>
        				
        				</div>
    		        <?php endif;?>
    		        
    		        <?php if(isset($error[ 'category' ]) && count($error[ 'category'])> 0):?>
        		        <div class="item">
							
							<p>
								<strong>Danh mục: </strong>
							</p>
							
							<ul>
            		            <?php foreach ($error[ 'category'] as $value):?>
            		            <li>
            		              <?php echo $value ?>
            		            </li>
            		            <?php endforeach;?>
            		        </ul>
        				
        				</div>
    		        <?php endif;?>
    		        
    		        <?php if(isset($error[ 'priceMin' ]) && count($error[ 'priceMin'])> 0):?>
        		        <div class="item">
							
							<p>
								<strong>Giá tiền nhỏ nhất: </strong>
							</p>
							
							<ul>
            		            <?php foreach ($error[ 'priceMin'] as $value):?>
            		            <li>
            		              <?php echo $value ?>
            		            </li>
            		            <?php endforeach;?>
            		        </ul>
        				
        				</div>
    		        <?php endif;?>
    		        
    		        <?php if(isset($error[ 'priceMax' ]) && count($error[ 'priceMax'])> 0):?>
        		        <div class="item">
							
							<p>
								<strong>Giá tiền lớn nhất: </strong>
							</p>
							
							<ul>
            		            <?php foreach ($error[ 'priceMax'] as $value):?>
            		            <li>
            		              <?php echo $value ?>
            		            </li>
            		            <?php endforeach;?>
            		        </ul>
        				
        				</div>
    		        <?php endif;?>
    		        
		          </div>
		      <?php endif;?>

		      <!-- BEGIN alert  -->

<div class="pagination grid" id="menu-outer">
		<ul>
    		<?php if( $products != null ):?>
    		    <?php foreach ($products as $product) :?>
        		    <li>
            		    <a href="<?php echo $router->url( array( 'module' => 'fronend', 'controller' => 'listproduct', 'action' => 'productDetail') ) . '/' . $product->id ?>">
            				<div>
            					<div class="image-product">
            						<img width="250" alt="" src="<?php echo __FOLDER . __FOLDER_UPLOADS . '/' . $product->image_link ?>" >
            						<div class="icon" >
            							<?php if( $product->best == 1 ):?>
            								<img src="<?php echo __FOLDER . 'public/image/icon-best.png'?>">
            							<?php endif;?>
            							<?php if( $product->new == 1 ):?>
            								<img src="<?php echo __FOLDER . 'public/image/icon-new.png'?>">
            							<?php endif;?>
            						</div>
    
            					</div>
    
            					<div class="info">
            						<h2><?php echo $product->name?></h2>
            						<p class="price"><strong><?php echo utility::product_price($product->price)?></strong></p>
            					</div>
    
            				</div>
            			</a>
        			</li>
    		    <?php endforeach;?>
    		<?php endif;?>
		</ul>
</div>

<div class="pagination" id="menu-outer">
    <?php 
        if( $pagitation != null){
            echo $pagitation->html();
        }
    ?>
</div>