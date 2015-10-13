<?php
class categoryModel extends baseModel{
	/**
	 *
	 * @param int $idProduct
	 * @return category|NULL  */
	public function getCategoryByProduct($idProduct){
		$sql = "SELECT category.* FROM category INNER JOIN product ON category.id = product.category_id
				WHERE product.id = :idproduct";

		$sth = $this->getPdo()->prepare($sql);
		$sth->bindParam(':idproduct', $idProduct, PDO::PARAM_INT);
		$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'category');
		$sth->execute();

		$category = $sth->fetch();
		return $category;
	}

	/**
	 *
	 * @return array|NULL  */
	public function listCategory(){
		try {
			$sql = "SELECT * FROM category ORDER BY category.sort_order ASC";
			$sth = $this->getPdo()->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'category');
			$sth->execute();
			$category = $sth->fetchAll();
			return $category;
		} catch (Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}

	/**
	 * get category by id category
	 * @param int $idCategory
	 * @return category|NULL  */
	public function getCategoryById($idCategory){
		try {
			$sql = "SELECT * FROM category WHERE category.id = '$idCategory'";
			$stmt = $this->getPdo()->prepare($sql);
			$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'category');
			$stmt->execute();
			$category = $stmt->fetch();
			return $category == false ? null : $category;
		} catch (Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}
}