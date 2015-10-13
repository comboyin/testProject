<?php
    $products = $listProduct;
    $pagitation = $pagination;
	$category = $category;
    /* @var $product product */
    /* @var $pagitation pagination */
	/* @var $category category */
?>
<div class="title">
	<a href="#"><?php echo $category->name ?></a>
</div>

<div class="pagination grid" id="menu-outer">
		<ul>
		    <?php foreach ($products as $product) :?>
    		    <li>
        		    <a href="#">
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
		</ul>
</div>

<div class="pagination" id="menu-outer">
	<?php echo $pagitation->html()?>
</div>