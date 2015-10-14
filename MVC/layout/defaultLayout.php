<?php
$category = $category;
$router = $router;
$account = $_SESSION['acl']['account'];
/* @var $router router */
/* @var $category category */
?>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="shortcut icon" href="http://limeorange.vn/template/default/images/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="<?php echo __FOLDER.'public/css/main.css';?>">
		<link rel="stylesheet" type="text/css" href="<?php echo __FOLDER.'public/css/hover.css';?>">
		<link rel="stylesheet" type="text/css" href="<?php echo __FOLDER.'public/js/jquery-ui-1.11.4/jquery-ui.css';?>">
		<link rel="stylesheet" type="text/css" href="<?php echo __FOLDER.'public/admin/Font-Face/style.css';?>">

	</head>
	<body>
		<div class="main">
		<!-- ========================================LOGO - MENU==============================================================  -->
		<header>
    		<div class="logo">
    			<a href="<?php echo $router->url(array('module'=>'fronend')) ?>">
    				<span class="first">NHUT</span> <span class="last">SHOP</span>
    			</a>
    		</div>

    		<div class="menu" id="menu-outer">
    			<div class="table">
    					<ul class="horizontal-list">
    						<?php /* @var $cate category */?>
    						<?php
    							if( $router->controller == 'listproduct' && $router->action == 'index' && isset($router->args[1]) ){
									$idCategory = $router->args[1];
								}else{
									$idCategory = 0;
								}
    						?>
    						<?php foreach ($category as $cate):?>
    							<li>
    								<a <?php echo ( $cate->id == $idCategory ) ? 'class="active"' : '' ?>
    								 	href="<?php echo $router->url(array('module' => 'fronend','controller' => 'listproduct','action' => 'index')) . '/' . $cate->id ?>"
    								>
    								<img src="public/image/facial-cosmetic.png" />

    								<?php echo $cate->name ?>

    								</a>
    							</li>
    						<?php endforeach;?>

    						<li>
								<a href="<?php echo $router->url( array( 'module' => 'fronend', 'controller' => 'cart', 'action' => 'index' ) )?>">

								   <img src="public/icon/history.png" />

								</a>
    						</li>

    						<li class="search">
								<a href="#">
								    <img src="http://limeorange.vn/template/default/images/icon-search.png">
								</a>
    						</li>
    					</ul>

    				</div>
    		</div>

    		<?php

    		/*
    		 * array (size=6)
    		 'rt' => string 'fronend/listproduct/search' (length=26)
    		 'keyword' => string '' (length=0)
    		 'category' => string '0' (length=1)
    		 'priceMin' => string '' (length=0)
    		 'priceMax' => string '' (length=0)
    		 'submit_search' => string 'Tìm kiếm' (length=11)
    		 *
    		 *   */

    		?>

    		<div class="container-search">

			     <form action="<?php echo $router->url(array( 'module' => 'fronend', 'controller' => 'listproduct', 'action' => 'search' ))?>">
			         <table class="form_table">
    				      <tbody>
    				         <input type="hidden" name="rt" value="fronend/listproduct/search" />
    				         <tr>
    				            <td>Từ khóa: </td>
    				            <td><input class="form-control" type="text" name="keyword" value="<?php echo isset( $account->search['keyword'] ) ? $account->search['keyword'] : '' ?>" /></td>
    				         </tr>

    				         <tr>
    				            <td>Danh mục: </td>
    				            <td>
        				             <select class="form-control" name="category">
    						             <option value="0">Tất cả</option>
    						             <?php foreach ($category as $cate):?>
                							<option
                							        value="<?php echo $cate->id?>"
                							        <?php
                							             if( isset( $account->search['category_id'] ) && $account->search['category_id'] == $cate->id ){
                							                 echo 'selected';
                							             }
                							        ?>
                							        >
                							<?php echo $cate->name ?></option>
                						<?php endforeach;?>
    						        </select>
    				            </td>
    				         </tr>

    				         <tr>
    				            <td>Giá: </td>
    				            <td>Từ: &ensp;&ensp;&ensp; <input value="<?php echo isset( $account->search['priceMin'] ) ? $account->search['priceMin'] : ''?>" class="form-control" type="number" name="priceMin" />
        				            <br/>
        				            <br/>
        				            Đến: &ensp; <input value="<?php echo isset( $account->search['priceMax'] ) ? $account->search['priceMax'] : ''?>" class="form-control" type="number" name="priceMax" />
    				            </td>
    				         </tr>

    				         <tr>
    				            <td colspan="2" class="form-button">
    				            	<input type="submit" class="btn btn-success hvr-pulse-grow" name="submit_search" value="Tìm kiếm">
    				            	<button type="button" class="btn btn-danger close-search" >Đóng</button>
    				            </td>
				            </tr>

    				      </tbody>
    				   </table>
			     </form>
			</div>
		</header>


	    <!-- ========================================LOGO - MENU==============================================================  -->
	            <div class="container">
	                <?php echo $content->render()?>

		             <div class="cart">

	             	<div class="container-cart" >
	             			<span> <button class="close-cart" data-icon="&#xe0b3;"></button> </span>

		             		<table class="form_table">
		    				      <tbody>

		    				         <tr>
		    				            <td>Họ và tên: </td>
		    				            <td><input type="text" name="cart_name" value="" /></td>
		    				         </tr>

		    				         <tr>
		    				            <td>Số điện thoại: </td>
		    				            <td><input type="number" name="cart_phone" value="" /></td>
		    				         </tr>

		    				          <tr>
		    				            <td>Email: </td>
		    				            <td><input type="email" name="cart_email" value="" /></td>
		    				         </tr>

		    				         <tr>
		    				            <td>Captcha: </td>
		    				            <td>
		    				            	<img class="captcha" src=""/>
		    				            	<br/>
		    				            	<input type="text" name="cart_captch" />
		    				            	<span> <div class="reset_capcha" data-icon="&#xe125;"></div> </span>
		    				            </td>
		    				         </tr>

									<tr>
		    				            <td colspan="2" class="form-button">
		    				            	<button style="display: none" class="btn order-loading"><img alt="" src="<?php echo __FOLDER  . 'public/image/ajax-loader.gif'?>"></button>
		    				            	<button class="btn order">Đặt hàng</button>
		    				            	<button class="btn close-cart">Đóng</button>
		    				            </td>
					            	</tr>
								</tbody>
	    				   </table>
						<div style="height: 200px;overflow: auto;">
	    				   <table class="form_table">
	    				   	  <thead>
							      <tr>
							         <th>Số lượng</th>
							         <th>Tên</th>
							         <th>Đơn giá</th>
							         <th>Tổng</th>
							         <th>Xóa</th>
							      </tr>
							   </thead>
						   		<tbody class="cart-table">
    				      		</tbody>
	    				   </table>
		           		</div>
	           			<table class="form_table">
    				      <tbody>
    				         <tr>
    				            <td>Tổng: </td>
    				            <td><span class="cart_sum error"> </span></td>
    				         </tr>
    				      </tbody>
    				   </table>
		             </div>

					<div class="container-button-show"> <button class="btn">Giỏ hàng</button>

		        	</div>

		        </div>


	    <!-- ========================================footer==============================================================  -->
				<footer>Copyright 2015 by Trần Minh Nhựt </footer>
	    <!-- ========================================footer==============================================================  -->
	        </div>
	</body>
    	<script type="text/javascript" src="<?php echo __FOLDER.'public/js/jquery-1.11.3.js';?>"></script>
    	<script type="text/javascript" src="<?php echo __FOLDER.'public/js/jquery-ui-1.11.4/jquery-ui.js';?>"></script>
    	<script type="text/javascript" src="<?php echo __FOLDER.'public/alertJquery/dalert.jquery.min.js';?>"></script>
    	<script type="text/javascript" src="<?php echo __FOLDER.'public/js/create_account.js';?>"></script>

    	<script type="text/javascript" src="<?php echo __FOLDER.'public/js/create_account.js';?>"></script>
    	<script type="text/javascript" src="<?php echo __FOLDER.'public/js/myjs.js';?>"></script>
</html>