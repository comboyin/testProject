<?php
class FavoriteModel extends baseModel{
	
	/**
	 * 
	 * @param Favorite $favorite  */
	public function addFavorite( $favorite ){
		$is_error = null;
		try {
			$user_id 		 = $favorite->getUserId(); 
			$user_id_to 	 = $favorite->getUserIdTo();
			$regist_datetime = $favorite->getRegistDatetime();
			
			// check user session
			if( $this->checkIsSession( $user_id_to ) ){
				$is_error[] = "Can not make friends with yourself";
			}
			// check user_id
			$cout = count( $this->listTableByWhere('User', array( " id = '$user_id' " ))  );
			if( $cout == 0  ){
				$is_error[] = "User id '$user_id' not exist";
			}
			
			// check user_id_to
			$cout = count( $this->listTableByWhere('User', array( " id = '$user_id_to' " ))  );
			if( $cout == 0  ){
				$is_error[] = "User id '$user_id' not exist";
			}
			
			// check favorite exist
			if( $is_error == null ){
				$cout = count( $this->listTableByWhere('Favorite', array( " user_id = '$user_id' and user_id_to = '$user_id_to' " ))  );
				if( $cout != 0  ){
					$is_error[] = "Favorite exist";
				}
			}
			
			if( $is_error == null ){
				$sql = " INSERT INTO favorite( user_id, user_id_to, regist_datetime )
				values( '$user_id' , '$user_id_to' , '$regist_datetime' )		";
					
				$stmt = $this->getPdo()->prepare($sql);
				$stmt->execute();
			}
			
		} catch (Exception $e) {
			$is_error[] = $e->getMessage();
		}
		return $is_error;
	}
	
	/**
	 *
	 * @param Favorite $favorite  */
	public function unFavorite( $favorite ){
		$is_error = null;
		try {
			$user_id 		 = $favorite->getUserId();
			$user_id_to 	 = $favorite->getUserIdTo();
			$regist_datetime = $favorite->getRegistDatetime();
				
				
			// check user_id
			$cout = count( $this->listTableByWhere('User', array( " id = '$user_id' " ))  );
			if( $cout == 0  ){
				$is_error[] = "User id '$user_id' not exist";
			}
				
			// check user_id_to
			$cout = count( $this->listTableByWhere('User', array( " id = '$user_id_to' " ))  );
			if( $cout == 0  ){
				$is_error[] = "User id '$user_id' not exist";
			}
				
			// check favorite exist
			if( $is_error == null ){
				$cout = count( $this->listTableByWhere('Favorite', array( " user_id = '$user_id' and user_id_to = '$user_id_to' " ))  );
				if( $cout == 0  ){
					$is_error[] = "Favorite not exist";
				}
			}
				
			if( $is_error == null ){
				$this->deleteTableByWhere('Favorite', " where user_id = '$user_id' and user_id_to = '$user_id_to' ");
			}
				
		} catch (Exception $e) {
			$is_error[] = $e->getMessage();
		}
		return $is_error;
	}
	
	
	
}