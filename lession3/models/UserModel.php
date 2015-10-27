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
    				
    		if( $result  !== false ){
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
				`user`.id not in ( select `friend_request`.user_id from `friend_request` where `friend_request`.user_id_to = '1' )
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
}