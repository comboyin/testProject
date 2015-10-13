<?php
class productModel extends baseModel
{
	/**
	 * Return total record product.
	 * @return mixed|number  */
	public function totalRecord(){
		try {
			$sql = "SELECT COUNT(*) as total FROM product";
			$sth = $this->getPdo()->prepare($sql);
			$sth->execute();
			$result = $sth->fetch();
			return $result['total'];
		} catch (Exception $e) {
			echo $e->getMessage();
			return 0;
		}
	}

	public function deleteProductById($id){
		try {
			$this->getPdo()->beginTransaction();
			$sql = " DELETE FROM product WHERE product.id = '$id' ";
			/* @var $productOld product */
			$productOld = $this->getProductById($id);
			// check
			if( $productOld == null ){
				$error[] = "Product not exists.";
			}else{
				// check list image of product
				$modelProductimg = new productimgModel();
				$modelProductimg->setPdo($this->getPdo());
				$listProductImg = $modelProductimg->getProductimgByProduct($id);

				foreach ($listProductImg as $productImg){
					 if( $modelProductimg->deleteProductImg($productImg->id) == false){
					 	$this->getPdo()->rollBack();
					 	$error[] = "Have one product image delete not complete.";
						return $error;
					 }
				}

				$sth = $this->getPdo()->prepare($sql);
				$sth->execute();

				$this->getPdo()->commit();

				// unlink file image
				$imgLink = __SITE_PATH . '/' . __FOLDER_UPLOADS . '/' . $productOld->image_link;
				if( file_exists($imgLink) ){
				    unlink($imgLink);
				}

				// inlink list image
				foreach ($listProductImg as $productImg){
				    $lImgLink = __SITE_PATH . '/' . __FOLDER_UPLOADS . '/' . $productImg->image;
				    if( file_exists( $lImgLink ) ){
				        unlink($lImgLink);
				    }
				}

			}
			return isset($error) ? $error : null;
		} catch (Exception $e) {
			$error[] = $e->getMessage();
			$this->getPdo()->rollBack();
			echo $e->getMessage();
			return $error;
		}
	}

	public function disableProductById( $id , $value){
		$error = null;
		try {
			$sqlUpdateProduct = "UPDATE product
					SET product.disable = '$value'
					WHERE product.id = $id ";
			$stmt = $this->getPdo()->prepare($sqlUpdateProduct);
			$stmt->execute();
		} catch (Exception $e) {
			$error[] = $e->getMessage();
		}
		return $error;
	}

	public function idProductMax(){
	    try {
	        $sql = "SELECT MAX(product.id) AS max FROM product";
	        $stmt = $this->getPdo()->prepare($sql);
	        $stmt->execute();
	        $result = $stmt->fetch();
	        return $result['max'];
	    } catch (Exception $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}

	public function getProductById($idProduct){
	   try{
			$sql = "SELECT * FROM product WHERE product.id = '$idProduct'";
			$stmt = $this->getPdo()->prepare($sql);
			$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'product');
			$stmt->execute();
			/*	@var $product product */
			$product = $stmt->fetch();

			if( $product != false && $product->getDisable() == 1 ){
				$product = false;
			}
			return $product == false ? null : $product;
		}catch (Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}

	/**
	 * Add new product into database.
	 * Return NULL if complete
	 * Return error[] if error
	 * @param product $product
	 * @return null|array
	 * */
	public function addNewProduct( $product ){
	    try {

	        $this->getPdo()->beginTransaction();
	        $product->id = $this->idProductMax() + 1;
	        $id = $product->id;
	        $name = $product->name;
	        $price = $product->price;
	        $hot = $product->hot;
	        $best = $product->best;
	        $image_link = $product->image_link;
	        $create = $product->create->format("Y-m-d h:i:s");
	        $category_id = $product->category->id;

	        $sqlInsertProduct = "INSERT INTO product (id, name, price, image_link, `create`, `hot`, best, category_id ) VALUES
                                ( $id , '$name', $price, '$image_link', '$create' , $hot, $best, $category_id) ";


	        // add new product
	        $stmt = $this->getPdo()->prepare($sqlInsertProduct);
	        $stmt->execute();

	        // check product add complete
	        $newProduct = $this->getProductById($id);
	        if($newProduct == null){
	            $this->getPdo()->rollBack();
	            $error[] = "Add new product NOT complete.";
	            return isset($error) ? $error : null;
	        }else{
	            // add list image .
	            $listImage = $product->productimg;
	            $sizeListImage = count($listImage);
	            if( $sizeListImage > 0 )
	            {
	                foreach ($listImage as $imageItem){
	                  $image = $imageItem->image;
	                  $sqlInsertProductImg = "INSERT INTO productimg( image, product_id ) VALUES
	                                               ( '$image', $id) ";
	                  $stmt = $this->getPdo()->prepare($sqlInsertProductImg);
	                  $rs = $stmt->execute();
	                  if($rs == false){
	                      $this->getPdo()->rollBack();
	                      $error[] = "Insert productimg NOT complete.";
	                      return isset($error) ? $error : null;
	                  }
	                }

	            }
	        }
	        $this->getPdo()->commit();
	        return isset($error) ? $error : null;
	    } catch (Exception $e) {
	        echo $e->getMessage();
	        $this->getPdo()->rollBack();
	        $error[] = $e->getMessage();
	        return $error;
	    }
	}

	/**
	 * update product into database.
	 * Return NULL if complete
	 * Return error[] if error
	 * @param product $product
	 * @return null|array
	 * */
	public function updateProduct($product){
		try {
				$this->getPdo()->beginTransaction();
				$id = $product->id;
				$name = $product->name;
				$price = $product->price;
				$hot = $product->hot;
				$best = $product->best;
				$image_link = $product->image_link;

				$update = $product->update->format("Y-m-d h:i:s");
				$category_id = $product->category->id;
				// check product exits.
				/* @var $productOld product */
				$productOld = $this->getProductById($id);
				$fileOld = '';
				if( $productOld == null ){
					$this->getPdo()->rollBack();
					$error[] = "Product not exits";
					return isset($error) ? $error : null;
				}else{
					$fileOld = $productOld->image_link;
				}

				//get file image old

				if($image_link == ''){
					$sqlUpdateProduct = "UPDATE product
					SET product.name = '$name', product.price = $price, product.update = '$update', product.hot = $hot, product.best = $best,product.category_id=$category_id
					WHERE product.id = $id ";
				}else{
					$sqlUpdateProduct = "UPDATE product
					SET product.name = '$name', product.price = $price, product.update = '$update', product.image_link = '$image_link', product.hot = $hot, product.best = $best,product.category_id=$category_id
					WHERE product.id = $id ";
					if(file_exists(__SITE_PATH.'/'.__FOLDER_UPLOADS.'/'.$fileOld)){
						unlink(__SITE_PATH.'/'.__FOLDER_UPLOADS.'/'.$fileOld);
					}
				}
				// update product
				$stmt = $this->getPdo()->prepare($sqlUpdateProduct);
				$stmt->execute();

				$this->getPdo()->commit();
				return isset($error) ? $error : null;
		    } catch (Exception $e) {
				echo $e->getMessage();
				$this->getPdo()->rollBack();
				$error[] = $e->getMessage();
				return $error;
			}
	}

	public function listProductBest( $option = null ){
	    if( $option == null ){
	        var_dump('aaaa');
	        exit(0);
	    }else{
	        if (! isset ( $option['start'] )) {
	            throw new Exception( 'Not exits option start.' );
	        }
	        if (! isset ( $option['limit'] )) {
	            throw new Exception( 'Not exits option limit.' );
	        }
	        $start = $option['start'];
	        $limit = $option['limit'];
	        $sql = "SELECT * FROM product WHERE product.best = 1 ORDER BY product.id desc LIMIT :start,:limit";
	        $sth = $this->getPdo()->prepare($sql);
	        $sth->bindParam(':start', $start, PDO::PARAM_INT );
	        $sth->bindParam(':limit', $limit, PDO::PARAM_INT );
	        $sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'product');
	        $sth->execute();
	        /* @var $product product */
	        $listProduct = $sth->fetchAll();

	        // set category
	        $modelCategory = new categoryModel();
	        $modelCategory->setPdo($this->getPdo());

	        // set productImg
	        $modelProductimg = new productimgModel();
	        $modelProductimg->setPdo($this->getPdo());


	        foreach ($listProduct as $product){
	            $product->category = $modelCategory->getCategoryByProduct($product->id);
	            $product->productimg = $modelProductimg->getProductimgByProduct($product->id);
	        }

	        return $listProduct;

	    }
	}

	public function listProductByCategory( $idCategory , $option = array()){
		try {
			$error = null;
			$modelCategory = new categoryModel();
			$modelCategory->setPdo($this->getPdo());

			$start = $option['start'];
			$limit = $option['limit'];

			if( $modelCategory->getCategoryById( $idCategory ) == null ){
				$error[] = "Category not exist.";
			}
			if( $error == null ){
				$sql = " SELECT product.* FROM product WHERE product.category_id = :idCategory
						  ORDER BY product.id desc LIMIT :start,:limit ";
				$stmt = $this->getPdo()->prepare($sql);
				$stmt->bindParam( ':idCategory', $idCategory, PDO::PARAM_INT );
				$stmt->bindParam(':start', $start, PDO::PARAM_INT );
				$stmt->bindParam(':limit', $limit, PDO::PARAM_INT );
				$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'product');
				$stmt->execute();
				/* @var $product product */
				$listProduct = $stmt->fetchAll();
				// set productImg
				$modelProductimg = new productimgModel();
				$modelProductimg->setPdo($this->getPdo());
				foreach ($listProduct as $product){
					$product->category = $modelCategory->getCategoryByProduct($product->id);
					$product->productimg = $modelProductimg->getProductimgByProduct($product->id);
				}
				return $listProduct;
			}

		} catch (Exception $e) {
				echo $e->getMessage();
				return array();
		}
	}

	public function totalProductByCategory( $idCategory ){
		try {
			$sql = " SELECT COUNT(*) AS total FROM product WHERE product.category_id = :idCategory ";
			$stmt = $this->getPdo()->prepare($sql);
			$stmt->bindParam( ':idCategory', $idCategory, PDO::PARAM_INT );
			$stmt->execute();
			/* @var $product product */
			$total = $stmt->fetch();
			// set productImg
			return $total['total'];
		} catch (Exception $e) {
			echo $e->getMessage();
			return array();
		}
	}

	/**
	 *
	 * @param string $stringWhere
	 * @return int  */
	public function totalProductByWhere( $stringWhere ){
	    try {

	        // create string sql
	        $string = "";
	        if( !empty( $stringWhere ) ){
	            foreach ( $stringWhere as $key=>$where ){
	                if( $key == 0 ){
	                    $string .= " WHERE $where ";
	                }else{
	                    $string .= " and $where ";
	                }
	            }
	        }

	        $sql = " SELECT COUNT(*) AS total FROM product $string ";
	        $stmt = $this->getPdo()->prepare($sql);
	        $stmt->execute();
	        /* @var $product product */
	        $total = $stmt->fetch();
	        // set productImg
	        return $total['total'];
	    } catch (Exception $e) {
	        echo $e->getMessage();
	        return array();
	    }
	}

	public function listProductByWhere( $stringWhere , $option = array() ){
	    try {

	        // create string sql
	        $string = "";
	        if( !empty( $stringWhere ) ){
	            foreach ( $stringWhere as $key=>$where ){
	                if( $key == 0 ){
	                    $string .= " WHERE $where ";
	                }else{
	                    $string .= " and $where ";
	                }
	            }
	        }

	        if( $option == null ){
	            $sql = " SELECT * FROM product $string ORDER BY product.id desc ";
	        } else{
	            $start = $option['start'];
	            $limit = $option['limit'];
	            $sql = " SELECT * FROM product $string ORDER BY product.id desc LIMIT $start,$limit ";
	        }

	        $sth = $this->getPdo()->prepare($sql);

	        $sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'product');
	        $sth->execute();
	        /* @var $product product */
	        $listProduct = $sth->fetchAll();


	        // set category
	        $modelCategory = new categoryModel();
	        $modelCategory->setPdo($this->getPdo());

	        // set productImg
	        $modelProductimg = new productimgModel();
	        $modelProductimg->setPdo($this->getPdo());

	        foreach ($listProduct as $product){
	            $product->category = $modelCategory->getCategoryByProduct($product->id);
	            $product->productimg = $modelProductimg->getProductimgByProduct($product->id);
	        }

	        return $listProduct;

	    } catch (Exception $e) {
	        echo $e->getMessage();
	        return array();
	    }
	}

	public function listProduct( $option = null ){
		if( $option == null ){
			var_dump('aaaa');
			exit(0);
		}else{
			if (! isset ( $option['start'] )) {
				throw new Exception( 'Not exits option start.' );
			}
			if (! isset ( $option['limit'] )) {
				throw new Exception( 'Not exits option limit.' );
			}

			$sql = "SELECT * FROM product ORDER BY product.id desc LIMIT :start,:limit";

			$start = $option['start'];
			$limit = $option['limit'];

			$sth = $this->getPdo()->prepare($sql);
			$sth->bindParam(':start', $start, PDO::PARAM_INT );
			$sth->bindParam(':limit', $limit, PDO::PARAM_INT );
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'product');
			$sth->execute();
			/* @var $product product */
			$listProduct = $sth->fetchAll();

			// set category
			$modelCategory = new categoryModel();
			$modelCategory->setPdo($this->getPdo());

			// set productImg
			$modelProductimg = new productimgModel();
			$modelProductimg->setPdo($this->getPdo());


			foreach ($listProduct as $product){
				$product->category = $modelCategory->getCategoryByProduct($product->id);
				$product->productimg = $modelProductimg->getProductimgByProduct($product->id);
			}

			return $listProduct;

		}
	}
}
?>