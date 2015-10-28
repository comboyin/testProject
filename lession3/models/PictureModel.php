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
	
	
	/**
	 * delete picture
	 * @param string $pictures
	 * @return null|array
	 * */
	public function deletePictures( $idpicture ){
		try {
			$this->getPdo()->beginTransaction();
				
			$is_error = null;
			$likes = $this->listTableByWhere('Like', array( " pictures_id = $idpicture " ));
			/* @var $like Like */
			foreach ( $likes as $like ){
				// delete 
				$idlike = $like->getId();
				$error = $this->deleteTableByWhere('Like', " where id = '$idlike' ");
				if( $error != null ){
					utility::pushArrayToArray( $is_error['SQL'] , $error  );
				}
			}
			/* @var $picture Picture */
			$error = $this->deleteTableByWhere('picture', " where id = '$idpicture' ");
			if( $error != null ){
				utility::pushArrayToArray( $is_error['SQL'] , $error  );
			}
			$this->getPdo()->commit();
		} catch (Exception $e) {
			$is_error[] = $e->getMessage();
			$this->getPdo()->rollBack();
		}
		return $is_error;
	}
	
	/**
	 * get list picture
	 * @param string $where  */
	public function listPicture( $where ){
		$listObj = array();
		try {
			$sql = " SELECT * FROM picture $where ORDER BY regist_datetime desc ";
			$sth = $this->getPdo()->prepare($sql);
			$sth = $this->getPdo()->prepare($sql);
			$sth->setFetchMode( PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE , 'Picture' );
			$sth->execute();
			/* @var $obj Picture  */
			$listObj = $sth->fetchAll();
			foreach ( $listObj as $obj ){
				$idPicture = $obj->getId();
				// get list like
				$likes = $this->listTableByWhere( 'Like' , array( " pictures_id = '$idPicture' " ));
				
				// set user from likes
				/* @var $like Like */
				/* @var $user User */
				
				foreach ( $likes as $like ){
					
					$user_id = $like->getUserId();
						
					// get user
					$users = $this->listTableByWhere( 'User' , array( " id = '$user_id' " ));
						
					$user = $users[0];
						
					$like->setUser($user);
				}
				
				
				$obj->setLike( $likes );
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		
		return $listObj;
	}
	
	public function increaseView( $idPicture, $idUserSession ){
		$is_error = null;
		try {
			// check exist.
			$pictures = $this->listPicture(" where id = '$idPicture' ");
			if( count( $pictures ) == 0 ){
				$is_error[] = "Picture not exist.";
			}else{
				// picture yours
				$pictures_ = $this->listPicture(" where id = '$idPicture' and user_id = '$idUserSession' ");
				
				if( count( $pictures_ ) == 0 ){
					
					// is friend ?
					/* @var $pictures Picture */
					$pictures = $pictures[0];
					$user_id_picture = $pictures->getUserId();
					
					$friendRelationModel = new FriendrelationModel();
					$friendRelationModel->setPdo($this->getPdo());
					$is_friend = $friendRelationModel->checkFriendRelation( $idUserSession , $user_id_picture);
					
					if( $is_friend == true ){
						
						$sql  = " UPDATE picture SET view = view + 1 WHERE id = '$idPicture' ";
						$stmt = $this->getPdo()->prepare( $sql );
						$stmt->execute();
						
					}
				}
			}
		} catch (Exception $e) {
			$is_error[] = $e->getMessage();
		}
		
		return $is_error;
	}
	
	public function Like( $idPicture , $idUserSession ){
		
		$kq = array(
				'is_error' => null,
				'result'   => array()
		);
		
		try {
			// check exist.
			$pictures = $this->listPicture(" where id = '$idPicture' ");
			if( count( $pictures ) == 0 ){
				$kq['is_error'][] = "Picture not exist.";
			}else{
				
				// is friend ?
				/* @var $pictures Picture */
				$pictures = $pictures[0];
				$user_id_picture = $pictures->getUserId();
				
				$friendRelationModel = new FriendrelationModel();
				$friendRelationModel->setPdo($this->getPdo());
				$is_friend = $friendRelationModel->checkFriendRelation( $idUserSession , $user_id_picture);
				
				if( $user_id_picture == $idUserSession ){
					$is_friend = true;
				}
				
				if( $is_friend == false ){
					
					$kq['is_error'][] = "You may not like this picture.";
					
				}
				
				if( $kq['is_error'] == null ){
					// check me liked picture ?
					$is_like = true;
					$Likes = $this->listTableByWhere( 'Like' , array( " user_id = '$idUserSession' and pictures_id = '$idPicture' " ) );
					
					if( count( $Likes ) == 0 ){
						$is_like = false;
					}
					
					if( $is_like == false ){
						// like
						$sql = " INSERT INTO `like`( user_id , pictures_id ) VALUES( '$idUserSession' , '$idPicture' )  ";
						$stmt = $this->getPdo()->prepare( $sql );
						$stmt->execute();
						$kq['result']['is_like'] = true; 
					}else{
						// unlike
						$sql = " DELETE FROM `like` WHERE `like`.user_id = '$idUserSession' and `like`.pictures_id = '$idPicture' ";
						$stmt = $this->getPdo()->prepare( $sql );
						$stmt->execute();
						$kq['result']['is_like'] = false;
					}
					
				}
				
				$kq['result']['number_like'] = count( $Likes = $this->listTableByWhere('like', array( " pictures_id = '$idPicture' " )) );
			}
		} catch (Exception $e) {
			
			$kq['is_error'][] = $e->getMessage();
			
		}
		return $kq;
	}
}