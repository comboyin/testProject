<?php
	$product = $product;
	$category = $product->category;
	/* @var $category category */
	/* @var $product product */
?>
<div class="title">
	TRANG CHỦ > SẢN PHẨM > <?php echo htmlspecialchars( $category->name )?> > <a href="#"><?php echo $product->name?> - <?php echo $product->id?></a>
</div>
<div class="content-product-detail" >
	<div class="image-main">
		<img class="img-main" src="<?php echo __FOLDER . __FOLDER_UPLOADS . '/' . $product->image_link ?>">
		<div class="product-detail-right">
			<div class="detail-info info" idproduct="<?php echo $product->id?>">
				<h3><strong><?php echo htmlspecialchars( $product->name )?> - <?php echo $product->id?></strong></h3>
				<h4><?php echo utility::product_price( $product->price ) ?></h4>
				<button class="btn btn-success add-order-product">Thêm vào giỏ</button>
			</div>
			<div class="list-image">
				<ul>
					<?php $productList = $product->productimg;?>
					<?php /* @var $productList productimg */?>
					<li><img src="<?php echo __FOLDER . __FOLDER_UPLOADS . '/' . $product->image_link ?>"></li>
					<?php foreach ( $productList as $img ):?>
						<li><img src="<?php echo __FOLDER . __FOLDER_UPLOADS . '/' . $img->image ?>"></li>
					<?php endforeach;?>
				</ul>
			</div>
		</div>
	</div>
</div>