<?php

class productController extends baseController {

	public function index($arg = array()) {

	    $config_pagination = $this->registry->pagination;

	    if(isset($arg[1])){
	    	$config_pagination['current_page'] = $arg[1];
	    }
	    /* @var $modelProduct productModel */
	    $modelProduct = $this->model->get('product');
		// total record
	    $config_pagination['total_record'] = count( $modelProduct->listProductByWhere( array( ' product.disable = 0 ' ) ) );
	    // link first
		$config_pagination['link_first'] = $this->url(array('module'=>'backend','controller'=>'product','action' => 'index'));
	    // link page
		$config_pagination['link_full'] = $this->url(array('module'=>'backend','controller'=>'product','action' => 'index')) . '/' . '{page}';

	    $pagination = new pagination($config_pagination);

	    $configPagiantion = $pagination->getConfig();

		$listProduct = $modelProduct->listProductByWhere(array( ' product.disable = 0 ' ),
					array(
						'start' => $configPagiantion['start'],
						'limit' => $configPagiantion['limit']
					));

		/* @var $listCategory categoryModel */
		$listCategory = $this->model->get('category');
		$listCategory = $listCategory->listCategory();
		// param to view
		$this->getView()->content->listCategory = $listCategory;
		$this->getView()->content->listProduct = $listProduct;
		$this->getView()->content->pagination = $pagination;
	}

	public function updateProduct(){


		$name = isset($_POST['name']) ? $_POST['name'] : '';
		$price = isset($_POST['price']) ? $_POST['price'] : 0;
		$hot = isset($_POST['hot']) ? $_POST['hot'] : 0;
		$best = isset($_POST['best']) ? $_POST['best'] : 0;
		$categoryId = isset($_POST['category']) ? $_POST['category'] : '';
		$image = isset($_FILES['image']) ? $_FILES['image'] : array();
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$error = $this->validationNewProduct();
		$valid = new validation();
		$producOption = $this->registry->Product;
		// image
		if(!empty($image)){
			if( ( $errorImage = $valid->fileImageValidation( $image, $producOption ) ) != null){
				if(is_array($errorImage)){
					utility::pushArrayToArray($error['image'], $errorImage);
				}else if(is_string($errorImage)){
		        	$imageFileName = $errorImage;
		    	}
			}
		}


		// not error
		if($error == null ){
			/* @var $modelCategory categoryModel */
			$modelCategory = $this->model->get('category');
			// create object product
			$newProduct = new product();
			$newProduct->id = $id;
			$newProduct->name = $name;
			$newProduct->price = $price;
			$newProduct->hot = $hot;
			$newProduct->best = $best;
			$newProduct->category = $modelCategory->getCategoryById($categoryId);
			$newProduct->image_link = isset($imageFileName) ? $imageFileName : '';
			$newProduct->update = new DateTime();

			/* @var $productModel productModel */
			$productModel = $this->model->get('product');
			$error = $productModel->updateProduct($newProduct);
		}

		$resuft =  array(
				'error' => $error
		);
		header('Content-Type: application/json');
		echo json_encode($resuft);
		exit(0);
	}

	public function deleteProductimg($arg){
		// error == null => delete complete
		// error == array() => delete error
		$error = null;
		if(isset($arg[1])){
			$idimg = $arg[1];
			/* @var $modelProductImg productimgModel */
			$modelProductImg = $this->model->get('productimg');
			if( $modelProductImg->deleteProductImg($idimg) == false ){
				$error[] = "Delete product image not complete.";
			}
		}

		$rs = array(
			'error' => $error
		);
		echo json_encode($rs);
		exit(0);
	}

	public function addNewProductImg(){
		$error = null;
		if(isset($_FILES['listProductImage']) && isset($_POST['idproduct'])){

			$idProduct = $_POST['idproduct'];
			$listImage = $_FILES['listProductImage'];

			$coutListImage = isset($listImage['name']) ? count($listImage['name']) : 0;

			$listImageCustom = array();
			for($i = 0 ; $i < $coutListImage ; $i++){
				$listImageCustom[$i]['name'] = $listImage['name'][$i];
				$listImageCustom[$i]['type'] = $listImage['type'][$i];
				$listImageCustom[$i]['tmp_name'] = $listImage['tmp_name'][$i];
				$listImageCustom[$i]['error'] = $listImage['error'][$i];
				$listImageCustom[$i]['size'] = $listImage['size'][$i];
			}

			// check max img
			/* @var $modelProductImg productimgModel */
			$modelProductImg = $this->model->get('productimg');
			$configProduct = $this->registry->Product;
			$maxImg = $configProduct['maxProductImg'];

			$currentNumberProductImg = count( $modelProductImg->getProductimgByProduct($idProduct) );

			// check number image
			if( ( $currentNumberProductImg + $coutListImage ) > $maxImg ){
				//
				$error['list image'] = array('A product with only 4 image.');
			}
			// check image
			else{

				$valid = new validation();
				$producOption = $this->registry->Product;
				// list image
				foreach ( $listImageCustom as $imageCustom ){
					if( ($errorImageCustom = $valid->fileImageValidation( $imageCustom, $producOption )) != null){
						if(is_array($errorImageCustom)){
							utility::pushArrayToArray($error['list image'][$imageCustom['name']], $errorImageCustom);
						}else if(is_string($errorImageCustom)){
							$listImageFileName[] = $errorImageCustom;
						}
					}
				}

				// check id product
				/* @var $modelProduct productModel */
				$modelProduct = $this->model->get('product');
				if( $modelProduct->getProductById($idProduct) == null ){
					utility::pushArrayToArray($error[''], array("Product not exits.") );
				}

				if( $error == null ){
					// add product img

					$errorAddProductImg = $modelProductImg->addProductImg($listImageFileName,$idProduct);

					if( $errorAddProductImg != null ){
						utility::pushArrayToArray( $error[''] , $errorAddProductImg );
					}
				}
			}
		}else{
			$error[''] = array('Select at least one image.');
		}

		$rs = array(
			'error' => $error
		);

		echo json_encode($rs);
		exit(0);
	}

	public function deleteProduct(){

		if(isset($_POST["id"])){

			$id = $_POST['id'];

			/* @var $productModel productModel */
			$productModel = $this->model->get('product');
			$error = $productModel->disableProductById( $id , 1 );
			$resuft =  array(
				'error' => $error
			);
			header('Content-Type: application/json');
			echo json_encode($resuft);
		}
		exit(0);
	}

	public function getProductImg($arg){
		if(isset($arg[1])){
			$idProduct = $arg[1];
			$listProductImg = null;
			$error = null;
			/* @var $modelProductImg productimgModel */
			/* @var $modelProduct productModel */
			$modelProduct = $this->model->get('product');
			if( $modelProduct->getProductById($idProduct) == null ){
				$error[] = "Product not exist.";
			}else{
				$modelProductImg = $this->model->get('productimg');
				$listProductImg = $modelProductImg->getProductimgByProduct($idProduct);
				if( count($listProductImg) == 0 ){
					$error[] = "Product have not image.";
				}
			}

			$htmlListImg = "<tr>";
			/* @var $productImg productimg */
			if($listProductImg != null){
				foreach ($listProductImg as $productImg){
					$id = $productImg->id;
					$image = $productImg->image;
					$htmlListImg .= '<td>';
					$htmlListImg .= '<div>';
					$htmlListImg .= '<img idImg="'. $id .'" src="'.__FOLDER.__FOLDER_UPLOADS.'/' . $image . '">';
					$htmlListImg .= '<br/>';
					$htmlListImg .= '<button class="btn btn-danger button-delete-productimg">DELETE</button>';
					$htmlListImg .= '</div>';
					$htmlListImg .= '</td>';
				}
			}

			$htmlListImg .= "</tr>";

			$resuft =  array(
				'error' => $error,
				'htmlListImg' => $htmlListImg
			);

			header('Content-Type: application/json');
			echo json_encode($resuft);
		}
		exit(0);
	}

	public function getProduct($arg){
		if(isset($arg[1])){
			$idProduct = $arg[1];
			/* @var $modelProduct productModel */
			$modelProduct = $this->model->get('product');
			$product = $modelProduct->getProductById($idProduct);
			$error = null;

			if( $product == null ){
				$error[] = "Product not exist.";
			}

			$resuft =  array(
					'error' => $error,
					'product' => $product
			);

			header('Content-Type: application/json');
			echo json_encode($resuft);
		}
		exit(0);
	}

	public function addNewProduct(){

		$name = isset($_POST['name']) ? $_POST['name'] : '';
		$price = isset($_POST['price']) ? $_POST['price'] : 0;
		$hot = isset($_POST['hot']) ? $_POST['hot'] : 0;
		$best = isset($_POST['best']) ? $_POST['best'] : 0;
		$categoryId = isset($_POST['category']) ? $_POST['category'] : '';
		$image = isset($_FILES['image']) ? $_FILES['image'] : array();
		$listImage = isset($_FILES['listImage']) ? $_FILES['listImage'] : array();

		$coutListImage = isset($listImage['name']) ? count($listImage['name']) : 0;
		$listImageCustom = array();
		for($i = 0 ; $i < $coutListImage ; $i++){
			$listImageCustom[$i]['name'] = $listImage['name'][$i];
			$listImageCustom[$i]['type'] = $listImage['type'][$i];
			$listImageCustom[$i]['tmp_name'] = $listImage['tmp_name'][$i];
			$listImageCustom[$i]['error'] = $listImage['error'][$i];
			$listImageCustom[$i]['size'] = $listImage['size'][$i];
		}

		$error = $this->validationNewProduct();
		$producOption = $this->registry->Product;
		$valid = new validation();
		// image
		if( ( $errorImage = $valid->fileImageValidation( $image, $producOption ) ) != null){
		    if(is_array($errorImage)){
		        utility::pushArrayToArray($error['image'], $errorImage);
		    }else if(is_string($errorImage)){
		        $imageFileName = $errorImage;
		    }
		}

		// list image
		foreach ( $listImageCustom as $imageCustom ){
		    if( ($errorImageCustom = $valid->fileImageValidation($imageCustom,$producOption)) != null){
		        if(is_array($errorImageCustom)){
		            utility::pushArrayToArray($error['listImage'][$imageCustom['name']], $errorImageCustom);
		        }else if(is_string($errorImageCustom)){
		            $listImageFileName[] = $errorImageCustom;
		        }
		    }
		}

		// not error
		if($error == null ){
		    /* @var $modelCategory categoryModel */
            $modelCategory = $this->model->get('category');
			// create object product
			$newProduct = new product();
			$newProduct->name = $name;
			$newProduct->price = $price;
			$newProduct->hot = $hot;
			$newProduct->best = $best;
			$newProduct->category = $modelCategory->getCategoryById($categoryId);
			$newProduct->image_link = $imageFileName;
			$newProduct->create = new DateTime();

			// create object product image
			$newListImage = array();
			if($coutListImage > 0){
				foreach ($listImageFileName as $fileImageName){
					$temp = new productimg();
					$temp->image = $fileImageName;
					$temp->product = $newProduct;
					$newListImage[] = $temp;
				}
			}
			$newProduct->productimg = $newListImage;

			/* @var $productModel productModel */
			$productModel = $this->model->get('product');
			$error = $productModel->addNewProduct($newProduct);
		}

		$resuft =  array(
			'error' => $error
		);
		header('Content-Type: application/json');
		echo json_encode($resuft);
		exit(0);
	}

	private function validationNewProduct(){
		$producOption = $this->registry->Product;


		$name = isset($_POST['name']) ? $_POST['name'] : '';
		$price = isset($_POST['price']) ? $_POST['price'] : 0;
		$hot = isset($_POST['hot']) ? $_POST['hot'] : 0;
		$best = isset($_POST['best']) ? $_POST['best'] : 0;
		$categoryId = isset($_POST['category']) ? $_POST['category'] : '';
		$image = isset($_FILES['image']) ? $_FILES['image'] : array();
		$listImage = isset($_FILES['listImage']) ? $_FILES['listImage'] : array();

		$coutListImage = isset($listImage['name']) ? count($listImage['name']) : 0;

		$listImageCustom = array();

		for($i = 0 ; $i < $coutListImage ; $i++){
			$listImageCustom[$i]['name'] = $listImage['name'][$i];
			$listImageCustom[$i]['type'] = $listImage['type'][$i];
			$listImageCustom[$i]['tmp_name'] = $listImage['tmp_name'][$i];
			$listImageCustom[$i]['error'] = $listImage['error'][$i];
			$listImageCustom[$i]['size'] = $listImage['size'][$i];
		}

		$valid = new validation();
		// name
		if( ($errorNameEmpty = $valid->checkEmpty($name)) != null){
			utility::pushArrayToArray($error['name'], $errorNameEmpty);
		}
		if( ( $errorNameSymbol = $valid->checkSymbol( $name ) ) != null ){
			utility::pushArrayToArray( $error['name'], $errorNameSymbol );
		}
		if(($errorName = $valid->between( $name, array('min'=>8, 'max'=>50) )) != null){
			utility::pushArrayToArray($error['name'], $errorName);
		}

		// price
		if( ($errorPriceEmpty = $valid->checkEmpty($price)) != null){
			utility::pushArrayToArray($error['price'], $errorPriceEmpty);
		}
		if(($errorPrice = $valid->isNumberAndBetween( $price, array('min'=>1000, 'max'=>5000000) )) != null){
			utility::pushArrayToArray($error['price'], $errorPrice);
		}

		//new
		if( ( $errorNew = $valid->isNumber($hot) ) != null){
			utility::pushArrayToArray($error['hot'], $errorNew);
			utility::pushArrayToArray($error['hot'],array("Gender is not invalid."));
		}else{
			if($hot != 0 && $hot != 1){
				utility::pushArrayToArray($error['hot'],array("Gender is not invalid."));
			}
		}
		//best
		if( ( $errorBest = $valid->isNumber($best) ) != null){
			utility::pushArrayToArray($error['best'], $errorBest);
			utility::pushArrayToArray($error['best'], array("Best value is 0 or 1."));
		}else{
			if($best != 0 && $best != 1){
				utility::pushArrayToArray($error['best'], array("Gender is not invalid."));
			}
		}

		// check category
		/* @var $modelCategory categoryModel */
		$modelCategory = $this->model->get('category');
		$cate = $modelCategory->getCategoryById($categoryId);
		if( $cate == null ){
			utility::pushArrayToArray($error['category'], array("category not exits."));
		}

		return isset($error) ? $error : null;
	}

}