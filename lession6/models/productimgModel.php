<?php
class productimgModel extends baseModel{
	/**
	 *
	 * @param int $idProduct
	 * @return productimg|NULL  */
	public function getProductimgByProduct($idProduct){
		$sql = "SELECT productimg.* FROM product INNER JOIN productimg ON product.id = productimg.product_id
  					WHERE product.id = :idproduct";
		$sth = $this->getPdo()->prepare($sql);
		$sth->bindParam(':idproduct', $idProduct, PDO::PARAM_INT);
		$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'productimg');
		$sth->execute();
		$productimg = $sth->fetchAll();
		return $productimg;
	}

	public function deleteProductImg($id){
		try {
			if( $this->getProductImgById($id) == null ){
				return false;
			}else{
			    /* @var $productImgOld productimg */
			    $productImgOld = $this->getProductImgById($id);
			    $imgLink = __SITE_PATH . '/' . __FOLDER_UPLOADS . '/' . $productImgOld->image;
				$sql = " DELETE FROM productimg WHERE productimg.id = '$id' ";
			    
				if( file_exists( $imgLink ) ){
				    unlink( $imgLink );
				}
				
				$stmt = $this->getPdo()->prepare($sql);
				return $stmt->execute();
			}
		} catch (Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}

	public function getProductImgById($id){
		try{
			$sql = "SELECT * FROM productimg WHERE productimg.id = '$id'";
			$stmt = $this->getPdo()->prepare($sql);
			$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'productimg');
			$stmt->execute();
			$productimg = $stmt->fetch();
			return $productimg == false ? null : $productimg;
		}catch (Exception $e) {
			echo $e->getMessage();
			return null;
		}

	}

	/**
	 * Add new list productimg
	 * Return null if success.
	 * Return array if error.
	 * @param string $listImg
	 * @param int $idProduct
	 * @return Ambigous <NULL, string>  */
	public function addProductImg( $listImg, $idProduct ){
		try {
			$this->getPdo()->beginTransaction();
			$error = null;
			// check idProduct
			$modelProduct = new productModel();
			$modelProduct->setPdo( $this->getPdo() );
			if( $modelProduct->getProductById( $idProduct ) == null ){
				$error[] = "Product not exist.";
			}

			if( !is_array( $listImg ) ){
				$error[] = "Param 1 not is array.";
			}else if ( count($listImg) == 0 ){
				$error[] = "Param 1 is array empty.";
			}else {

				foreach ( $listImg as $img ){

					$fileName = __SITE_PATH . '/' . __FOLDER_UPLOADS . '/' . $img;

					if( !file_exists($fileName) ){
						$error[] = "File $img not exists.";
					}
				}
				if($error == null){
					$sqlInsertProductImg = " INSERT INTO productimg( image, product_id ) VALUES
					                        ( :img, :idProduct ) ";

					foreach ( $listImg as $img ){

						$stmt = $this->getPdo()->prepare($sqlInsertProductImg);
						$stmt->bindParam(':img', $img, PDO::PARAM_STR );
						$stmt->bindParam(':idProduct', $idProduct, PDO::PARAM_INT );
						if( !$stmt->execute() ){
							$error[] = "Add $img not success.";
						}

					}
				}
			}

			if( $error == null ){
				$this->getPdo()->commit();
			}else if( is_array($error) ){
				$this->getPdo()->rollBack();
			}

			return $error;
		} catch (Exception $e) {

			$error[] = $e->getMessage();
			return $error;
		}
	}

}