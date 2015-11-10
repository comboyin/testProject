<?php
class FollowModel extends baseModel{
	/**
	 * 
	 * @param Follow $follow  */
	public function addFollow( $follow ){
		$is_error = null;
		try {
			$idUser   = $follow->getUserId();
			$idUserTo = $follow->getUserIdTo();
			$regist_datetime = $follow->getRegistDatetime();
			
			// check user session
			if( $this->checkIsSession( $idUserTo ) ){
				$is_error[] = "Can not make friends with yourself";
			}
			// check user_id
			$cout = count( $this->listTableByWhere('User', array( " id = '$idUser' " ))  );
			if( $cout == 0  ){
				$is_error[] = "User id '$idUser' not exist";
			}
			
			// check user_id_to
			$cout = count( $this->listTableByWhere('User', array( " id = '$idUserTo' " ))  );
			if( $cout == 0  ){
				$is_error[] = "User id '$idUserTo' not exist";
			}
			
			// check favorite exist
			if( $is_error == null ){
				$cout = count( $this->listTableByWhere('Follow', array( " user_id = '$idUser' and user_id_to = '$idUserTo' " ))  );
				if( $cout != 0  ){
					$is_error[] = "Favorite exist";
				}
			}
			
			
			if( $is_error == null ){
				$sql = " INSERT INTO follow( user_id, user_id_to, regist_datetime )
				values( '$idUser' , '$idUserTo' , '$regist_datetime' )		";
					
				$stmt = $this->getPdo()->prepare($sql);
				$stmt->execute();
			}
			
			
		} catch (Exception $e) {
			$is_error[] = $e->getMessage();
		}
		return $is_error;
	}
	public function listFollow( $idUserSession ){
		$is_error = null;
		$list	  = array();
		try {
			$sql  = "select follow_log.* , follow.user_id as `follow_user_id` , follow.user_id_to as `follow_user_id_to` from follow_log inner join follow on follow_log.follow_id = follow.id where follow.user_id = '$idUserSession'
							ORDER BY follow_log.regist_datetime DESC
						";
			
			$stmt = $this->getPdo()->prepare($sql);
			$stmt->setFetchMode( PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE , 'Follow_log');
			$stmt->execute();
			/* @var $item Follow_log */
			$list = $stmt->fetchAll();
			
			foreach ($list as $item){
				//===============
				$idFollow = $item->getFollowId();
				$idUser   = $item->follow_user_id;
				$idUserTo = $item->follow_user_id_to;
				$follows  = $this->listTableByWhere( 'Follow' , array( " id = '$idFollow' " ));
				/* @var $follow Follow */
				$follow   = $follows[0];
				$users    = $this->listTableByWhere( 'User' , array( " id = '$idUser' " ));
				$user     = $users[0];
				$usertos  = $this->listTableByWhere( 'User' , array( " id = '$idUserTo' " ));
				$userto   = $usertos[0];
				$follow->setUser($user);
				$follow->setUserto($userto);
				$item->setFollow($follow);
				//===============
				$userid_to  = $item->getUseridTo();
				$useridtos  = $this->listTableByWhere( 'User' , array( " id = '$userid_to' " ));
				
				
				$useridto   = $useridtos[0];
				
				$item->setUseridTo( $useridto );
			}
			
			// update statuts
			$sql = "update follow_log 
					inner join follow 
					on follow_log.follow_id = follow.id 
					SET follow_log.status = 1 
					where follow.user_id = '$idUserSession' 
					and follow_log.status = 0 ";
			$stmt = $this->getPdo()->prepare($sql);
			$stmt->execute();
			
		} catch (Exception $e) {
			$is_error = $e->getMessage();
		}
		$kq = array(
			'is_error' => $is_error,
				'list' => $list
		);
		
		return $kq;
	}
	
	/**
	 * 
	 * @param Follow $follow  */
	public function unFollow( $follow ){
		$this->getPdo()->beginTransaction();
		$is_error = null;
		try {
			$idUser   = $follow->getUserId();
			$idUserTo = $follow->getUserIdTo();
			
			// check user_id
			$cout = count( $this->listTableByWhere('User', array( " id = '$idUser' " ))  );
			if( $cout == 0  ){
				$is_error[] = "User id '$idUser' not exist";
			}
				
			// check user_id_to
			$cout = count( $this->listTableByWhere('User', array( " id = '$idUserTo' " ))  );
			if( $cout == 0  ){
				$is_error[] = "User id '$idUserTo' not exist";
			}
				
			// check favorite exist
			if( $is_error == null ){
				$follows = $this->listTableByWhere('Follow', array( " user_id = '$idUser' and user_id_to = '$idUserTo' " ));
				
				$cout = count( $follows  );
				if( $cout == 0  ){
					$is_error[] = "Follow NOT exist";
				}
			}
			
			
			if( $is_error == null ){
				
				//
				$follow = $follows[0];
				$idFollow = $follow->getId();
				
				$this->deleteTableByWhere('Follow_log', " WHERE follow_id = '$idFollow'");
				
				$this->deleteTableByWhere('Follow', " where id = '$idFollow' ");
				
			}
				
			$this->getPdo()->commit();
		} catch (Exception $e) {
			$is_error[] = $e->getMessage();
			$this->getPdo()->rollBack();
		}
		
		return $is_error;
	}
}