<?php
class UserModel extends baseModel{	
	
	/**
	 *
	 * @param string $user
	 * @param string $pass
	 * @return boolean|account  */
    public function checkLogin($user,$pass){
    	try {
    		$passMD5 = md5($pass);
    		$sql = "select * from user where username = '$user' and password = '$passMD5'";
    		$stmt = $this->getPdo()->prepare ( $sql );
    		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
    		$stmt->execute();
    		/* @var $result User */
    		$result = $stmt->fetch();
    				
    		if( $result !== false ){
    			$idGroup = $result->getGroupId();
				$sqlGroup = "select * from `group` where `group`.id = $idGroup";
				$stmt = $this->getPdo()->prepare ( $sqlGroup );
				$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Group');
				$stmt->execute();
				$resultGroup = $stmt->fetch();
				$result->setGroup( $resultGroup );
				
				$id_user = $result->getId();
				// get list picture
				$pictures = $this->listTableByWhere( 'Picture' , array( "user_id = $id_user" ));
				
				$result->setPictures( $pictures );
				
    		}
			return $result;
    	} catch (Exception $e) {
    		return false;
    	}

    }
    
    public function friendSuggestionFeature($idUser){
    	$is_error = null;
    	$list     = array();
    	try {
    		
    		$sql = " call Friend_suggestion_feature($idUser); ";
    		$stmt = $this->getPdo()->prepare ( $sql );
    		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
    		$stmt->execute();
    		$list = $stmt->fetchAll();
    	} catch (Exception $e) {
    		$is_error[] = $e->getMessage();
    	}	
    	
    	$kq = array(
    			"is_error" => null,
    			"list"	   => $list
    	);
    	return $kq;
    }
    
    
    /**
     * return
     * $kq['error'] = null => success
     * $kq['result']
     * @param int $idUser
     * @param string $keyWord
     * @return array*/
    public function findUser( $idUser, $keyWord ){
    	$kq = array(
    			'error' => null,
    			'result' => array()
    	);
    	try {
    		// check user exist.
    		$users = $this->listTableByWhere( 'User' , array( " id = '$idUser' " ));
    		if( count( $users ) == 0 ){
    			$kq['error'][] = " '$idUser' not exist. ";
    		}
    		else{
    			$sql = "				
				 select * from `user` where 
				`user`.id not in 
								(
									select `user`.id from `user` where 
										`user`.id in  
										( 
											select `friend_relation`.user_id_to 
											from `user` inner join `friend_relation` 
											on `user`.id = `friend_relation`.user_id 
											where `friend_relation`.user_id = '$idUser' 
										) 
										or
										`user`.id in 
										( 
											select `friend_relation`.user_id 
											from `user` inner join `friend_relation` 
											on `user`.id = `friend_relation`.user_id_to 
											where `friend_relation`.user_id_to = '$idUser' 
										)
								)
				AND
				`user`.id not in ( select `friend_request`.user_id from `friend_request` where `friend_request`.user_id_to = '$idUser' )
				AND
				`user`.id not in ($idUser)
				AND ( `user`.username like '%$keyWord%' or `user`.fullname like '%$keyWord%' or `user`.email like '%$keyWord%' )
				ORDER BY `user`.id desc ";
    			
    			$stmt = $this->getPdo()->prepare( $sql );
    			$stmt->setFetchMode( PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User' );
    			$stmt->execute();
    			$results = $stmt->fetchAll();
    			
    			foreach ( $results as $result ){
    				$user_id_to = $result->getId();
    				$res = $this->listTableByWhere('Friend_request', array( " user_id = '$idUser' and user_id_to = '$user_id_to' " ));
    				$result->setFriendRequest( $res );
    			}
    			
    			$kq['result'] = $results;
    		}
    	} catch (Exception $e) {
    		$kq['error'][] = $e->getMessage();
    	}
    	return $kq;
    }
    
    public function listUserFavorite( $idUser , $idUserSession ){
    	$is_error = null;
    	$lists	  = array();
    	try {
    		$sql = " SELECT `user1`.* FROM `user` 
    				
    				INNER JOIN `favorite` 
					on `user`.id = `favorite`.user_id 
					
					INNER JOIN `user` as `user1`
					on `user1`.id = `favorite`.user_id_to
					
					WHERE `favorite`.user_id = '$idUser' ";
    		
    		$stmt = $this->getPdo()->prepare($sql);
    		$stmt->execute();
    		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
    		$stmt->execute();
    		$lists = $stmt->fetchAll();
    		foreach ( $lists as $user ){
    			/**
    			 * 0 : add friend => not is friend
    			 * 1 : unfriend => is friend
    			 * 2 : unRequest => is request
    			 **/
    			/* @var $user User */
    			$idUserTo = $user->getId();
    			// get status friend
    			// add friend
    			$user->setStatusForUserSession( 0 );
    			/* @var $user_to User */
    			// check friend_request exist
    			$friend_requests = $this->listTableByWhere( 'Friend_request' , array( " user_id = '$idUserSession' and user_id_to = '$idUserTo' " ));
    			
    			if( count( $friend_requests ) > 0 ){
    				// un request
    				$user->setStatusForUserSession( 2 );
    				
    			}else{
    				$friendRelationModel = new FriendrelationModel();
    				$friendRelationModel->setPdo($this->getPdo());
    				$is_friend = $friendRelationModel->checkFriendRelation( $idUserSession, $idUserTo );
    				
    				if(  $is_friend  == true ){
    					// is friend
    					$user->setStatusForUserSession( 1 );
    				}
    				
    			}
    			// get status favorite
    			/**
    			 * 0 : add favorite => not is favorite
    			 * 1 : unfavorite => is favorite
    			 * 
    			 **/
    			$user->setStatusFavorite( 0 );
    			$favorites = $this->listTableByWhere( 'Favorite' , array( " user_id = '$idUserSession' and user_id_to = '$idUserTo' " ));
    			if( count( $favorites ) != 0 ){
    				// un request
    				$user->setStatusFavorite( 1 );
    			}
    		}
    		
    	} catch (Exception $e) {
    		$is_error[] = $e->getMessage();
    	}
    	
    	$kq = array(
    			'is_error' => $is_error,
    			'list' => $lists
    	);
    	
    	return $kq;
    	
    }
}