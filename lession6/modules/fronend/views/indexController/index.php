<?php
    $products = $productNew;

    /* @var $product product */
?>
<div class="title">
	<a href="#">SẢN PHẨM MỚI</a>
</div>

<div class="pagination grid" id="menu-outer">
		<ul>
		    <?php foreach ($products as $product) :?>
    		    <li>
        		    <a href="<?php echo $router->url( array( 'module' => 'fronend', 'controller' => 'listproduct', 'action' => 'productDetail') ) . '/' . $product->id ?>">
        				<div>
        					<div class="image-product" >
        						<img width="250" alt="" src="<?php echo __FOLDER . __FOLDER_UPLOADS . '/' . $product->image_link ?>" >
        						<div class="icon" >
        							<img src="<?php echo __FOLDER . 'public/image/icon-new.png'?>">
        						</div>
        					</div>

        					<div class="info" idproduct="<?php echo $product->id ?>">
        						<h2><?php echo htmlspecialchars( $product->name )?></h2>
        						<p class="price"><strong><?php echo utility::product_price($product->price)?></strong></p>
        						<p><button class="btn btn-success add-order-product">Thêm vào giỏ</button></p>
        					</div>

        				</div>
        			</a>
    			</li>
		    <?php endforeach;?>
		</ul>
</div>


<div class="title">
	<a href="#">SẢN PHẨM HOT</a>
</div>

<div class="pagination grid" id="menu-outer">
		<ul>
		    <?php foreach ($productHots as $product) :?>
    		    <li>
        		    <a href="<?php echo $router->url( array( 'module' => 'fronend', 'controller' => 'listproduct', 'action' => 'productDetail') ) . '/' . $product->id ?>">
        				<div>
        					<div class="image-product">
        						<img width="250" alt="" src="<?php echo __FOLDER . __FOLDER_UPLOADS . '/' . $product->image_link ?>" >
        						<div class="icon" >
        							<img src="<?php echo __FOLDER . 'public/image/icon-hot-pc.png'?>">
        						</div>
        					</div>

        					<div class="info" idproduct="<?php echo $product->id ?>">
        						<h2><?php echo htmlspecialchars( $product->name )?></h2>
        						<p class="price"><strong><?php echo utility::product_price($product->price)?></strong></p>
        						<p><button class="btn btn-success add-order-product">Thêm vào giỏ</button></p>
        					</div>

        				</div>
        			</a>
    			</li>
		    <?php endforeach;?>
		</ul>
</div>


<div class="title">
	<a href="#">SẢN PHẨM TỐT</a>
</div>

<div class="pagination grid" id="menu-outer">
		<ul>
			<?php foreach ($productBest as $product) :?>
    		    <li>
        		     <a href="<?php echo $router->url( array( 'module' => 'fronend', 'controller' => 'listproduct', 'action' => 'productDetail') ) . '/' . $product->id ?>">
        				<div>
        					<div class="image-product">
        						<img width="250" alt="" src="<?php echo __FOLDER . __FOLDER_UPLOADS . '/' . $product->image_link ?>" >
        						<div class="icon" >
        							<img src="<?php echo __FOLDER . 'public/image/icon-best.png'?>">
        						</div>
        					</div>

        					<div class="info" idproduct="<?php echo $product->id ?>">
        						<h2><?php echo htmlspecialchars( $product->name )?></h2>
        						<p class="price"><strong><?php echo utility::product_price($product->price)?></strong></p>
        						<p><button class="btn btn-success add-order-product">Thêm vào giỏ</button></p>
        					</div>

        				</div>
        			</a>
    			</li>
		    <?php endforeach;?>
		</ul>
</div>

