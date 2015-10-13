<?php
/* @var $product product */
/* @var $pagination pagination */
/* @var $viewHelper helper */
/* @var $category category */
?>
<div class="page-title">
	<div class="pull-left">
		<h1>PRODUCT MANAGER</h1>
	</div>
</div>
<br/>
<div class="page-title">
	<div class="pull-left">
		<button class="btn btn-success add-product"><span aria-hidden="true" class="icon-play"></span> &nbsp;ADD</button>
		<button style="display: none" class="btn btn-danger"><span aria-hidden="true" class="icon-play"></span> &nbsp;DELETE SELECTED</button>
	</div>
</div>
<section class="box">
	<header class="panel_header">
		<h2 class="title pull-left">PRODUCT LIST</h2>

		<!-- <select class="form-control pull-right select-numberpage">
		    <option>5</option>
		    <option>10</option>
		    <option>20</option>
 		</select> -->

	</header>
	<div class="content-body">
		<div class="content-table">
		<table class="table">
		   <thead>
		      <tr>
		         <th>Id</th>
		         <th>Name</th>
		         <th>Price</th>
		         <th>Image</th>
		         <th>Category</th>
		         <th>Create time</th>
		         <th>Update time</th>
		         <th>Hot</th>
		         <th>Best</th>
				 <th>List image</th>
				 <th>Edit</th>
				 <th>Delete</th>
		      </tr>
		   </thead>
		   <tbody>
		   		<?php foreach ($listProduct as $product):?>
					<tr>
				         <td><?php echo $product->id?></td>
				         <td><?php echo htmlspecialchars($product->name)?></td>
				         <td><?php echo $viewHelper->product_price($product->price)?></td>
				         <td><img src="<?php echo __FOLDER.__FOLDER_UPLOADS.'/'.$product->image_link?>"></td>
				         <td><?php echo $product->category->name?></td>
				         <td><?php echo $product->create?></td>
				         <td><?php echo $product->update?></td>
				         <td><?php echo $product->iconHot()?></td>
				         <td><?php echo $product->iconBest()?></td>
				         <td><button class="btn btn-primary list-image"><span aria-hidden="true" class="icon-play"></span> &nbsp;LIST IMAGE</button></td>
				         <td><button class="btn btn-primary edit-product"><span aria-hidden="true" class="icon-play"></span> &nbsp;EDIT</button></td>
						 <td><button class="btn btn-danger delete-product"><span aria-hidden="true" class="icon-play"></span> &nbsp;DELETE</button></td>
		      		</tr>
		   		<?php endforeach;?>
		   </tbody>
		</table>
		</div>
		<div class="pagination" id="menu-outer">
			<?php echo $pagination->html()?>
		</div>
		<!--=============================BEGIN DIALOG ADD NEW PRODUCT================================================-->
		<div id="dialog-add-product" title="Add new product">
			<div class="error_product">
			</div>
			  <div class="border-style">
				   <table class="form_table">
				      <tbody>
				         <tr>
				            <td>Name <span class="error">(*)</span></td>
				            <td><input name="name" type="text" value="">
				            </td>
				         </tr>
				         <tr>
				            <td>Price <span class="error">(*)</span></td>
				            <td><input name="price" type="text" value="">
				            </td>
				         </tr>
				         <tr>
				            <td>Hot </td>
				            <td><input name="hot" type="checkbox" value="1"></td>
				         </tr>
				         <tr>
				            <td>Best </td>
				            <td><input name="best" type="checkbox" value="1"></td>
				         </tr>
						 <tr>
							<td>Category <span class="error">(*)</span></td>
				            <td><select name="category" class="form-control">
								    <?php foreach ($listCategory as $category):?>
										<option value="<?php echo $category->id?>"><?php echo $category->name?></option>
								    <?php endforeach;?>
						 		</select>
						 	</td>
						 </tr>

						 <tr>
							<td>Image <span class="error">(*)</span></td>
				            <td>
								<input maxlength="1" type="file" accept="gif|jpg|png" name="image" class="form-control multi with-preview"/>
								<br/>
								<img class="image-link" style="max-height: 100px;display: none" src="">
						 	</td>
						 </tr>

						 <tr class="list-image">
							<td>List image <span class="error"></span></td>
				            <td>
								<input  type="file" maxlength="4" accept="gif|jpg|png" name="listImage[]" class="form-control multi with-preview" multiple />
						 	</td>
						 </tr>
				         <tr>
				            <td colspan="2" class="form-button">
				            	<input type="submit" class="btn btn-success hvr-pulse-grow" name="submit_addproduct" value="Create">
				            	<input type="submit" class="btn btn-success hvr-pulse-grow" name="submit_updateproduct" value="Update">
				            	<span class="progress-loading"><img src="<?php echo __FOLDER . 'public/image/ajax-loader.gif'?>"></span>
				            </td>
				         </tr>
				      </tbody>
				   </table>
			</div>
		</div>
		<!--=============================END DIALOG ADD NEW PRODUCT================================================-->

		<!--=============================BEGIN DIALOG LIST IMAGE================================================-->
		<div id="dialog-list-img-product" title="List image product">
			  <div class="error_product_img">

			  </div>
			  <div class="border-style">

			  	   <table class="form_table">
				      <tbody>
				         <tr>
							<td>List image <span class="error">(*)</span></td>
				            <td>
								<input type="file" maxlength="4" accept="gif|jpg|png" name="listProductImage[]" class="form-control multi with-preview" multiple />
						 	</td>
						 </tr>
				         <tr>
				            <td colspan="2" class="form-button">
				            	<input type="submit" class="btn btn-success hvr-pulse-grow" name="submit_addproductimg" value="Add Product Img">
				            	<span style="display: none" class="progress-loading1"><img src="<?php echo __FOLDER . 'public/image/ajax-loader.gif'?>"></span>
				            </td>
				         </tr>
				      </tbody>
				   </table>
				   <table class="form_table dialog-product-img">
				      <tbody>
				      </tbody>
				   </table>
			</div>
		</div>
		<!--=============================END DIALOG LIST IMAGE================================================-->
	</div>
</section>

<script type="text/javascript">
	jQuery(document).ready(function () {
		productmanager.init();
	});
</script>

