<?php
class PictureModel extends baseModel{
	
	/**
	 * 
	 * @param Picture $pictures 
	 * @return null|array
	 * */
	public function addPicture( $pictures ){
		
		try {
			
			$this->getPdo()->beginTransaction();
			
			$is_error = null;
			
			foreach ( $pictures as $picture){
				/* @var $picture Picture */
				$url     = $picture->getUrl();
				$view    = $picture->getView();
				$like    = $picture->getLikeNumber();
				$date    = $picture->getRegistDatetime();
				$user_id = $picture->getUser()->getId();
				$sql     = " INSERT INTO picture ( url, `view`, like_number, regist_datetime, user_id ) 
						 VALUES ( '$url', $view, $like, '$date', '$user_id' ) ";
				
				$stmt = $this->getPdo()->prepare($sql);
				$stmt->execute();
			}
			
			$this->getPdo()->commit();
			
		} catch (Exception $e) {
			$is_error[] = $e->getMessage();
			$this->getPdo()->rollBack();
		}
		return $is_error;
	}
	
}