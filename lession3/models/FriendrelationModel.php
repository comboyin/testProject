<?php
class FriendrelationModel extends baseModel{
	

	/**
	 * 
	 * @param Friend_relation $friendRelation  */
	public function addFriendRelation( $friendRelation ){
		
		$is_error = null;
		
		try {
			$user_id 			= $friendRelation->getUserId(); 
			$user_id_to 		= $friendRelation->getUserIdTo();
			$regist_datetime	= $friendRelation->getRegistDatetime();
			$sql = " INSERT INTO friend_relation( user_id, user_id_to, regist_datetime ) 
						values( '$user_id' , '$user_id_to' , '$regist_datetime' )	";
			$stmt 				= $this->getPdo()->prepare( $sql );
			$stmt->execute();
			
			
		} catch (Exception $e) {
			$is_error[] = $e->getMessage();
		}
		return $is_error;
	}
	
	
	
	public function getListFriendRelation( $user_id , $idUserSession ){
		$ListFriendRelation = array();
		try {
			
			$ListFriendRelation = $this->listTableByWhere( 'Friend_relation' , array( " user_id = '$user_id' or user_id_to = '$user_id' " ));
			/* @var $FriendRelation Friend_relation */
			foreach ( $ListFriendRelation as $FriendRelation ){
				// get friend 
				if( $FriendRelation->getUserIdTo() == $user_id ){
					
					$tempidto   = $FriendRelation->getUserIdTo();
					$tempid     = $FriendRelation->getUserId();
					$FriendRelation->setUserIdTo($tempid);
					$FriendRelation->getUserId($tempidto);
					
				}
				$users = $this->listTableByWhere( 'User' , array( " id = '$user_id' " ));
				$user_id_to = $FriendRelation->getUserIdTo();
				$users_to = $this->listTableByWhere( 'User' , array( " id = '$user_id_to' " ));
				$FriendRelation->setUser( $users[0] );
				$FriendRelation->setUserTo( $users_to[0] );
				
				foreach ( $users_to as $user_to ){
					
					$id_temp = $user_to->getId();
				
					// add friend 
					$user_to->setStatusForUserSession( 0 );
					/* @var $user_to User */
					// check friend_request exist
					$friend_requests = $this->listTableByWhere( 'Friend_request' , array( " user_id = '$idUserSession' and user_id_to = '$id_temp' " ));
					if( count( $friend_requests ) > 0 ){
						// un request
						$user_to->setStatusForUserSession( 2 );
					}else{
						
						/* $friendRelationModel = new FriendrelationModel();
						$friendRelationModel->setPdo($this->getPdo());
						$is_friend = $friendRelationModel->checkFriendRelation( $user_id, $user_id_to );
						if(  $is_friend  == true ){
							// un request
							$user_to->setStatusForUserSession( 1 );
						} */
						
						$friend_relations = $this->listTableByWhere( 'Friend_relation' , array( "  ( user_id = '$idUserSession' and user_id_to = '$id_temp' )
																										or
																									( user_id = '$id_temp' and user_id_to = '$idUserSession' )
																												"));
						if( count( $friend_relations ) > 0 ){
							// un request
							$user_to->setStatusForUserSession( 1 );
						}
						
					}
				}
			}
		} catch (Exception $e) {
			
			echo $e->getMessage();
		}
		return $ListFriendRelation;
	}
	/**
	 * check A and B is friend order
	 * @param unknown $user_id
	 * @param unknown $user_id_to  
	 * @return bool*/
	public function checkFriendRelation( $user_id , $user_id_to ){
		
		try {
			$listFriendRelation = $this->getListFriendRelation( $user_id, $user_id );
			
			/* @var $value Friend_relation */
			foreach ($listFriendRelation as $value) {
				if( $value->getUserTo()->getId() == $user_id_to ){
					return true;
				}
			}
		}catch (Exception $e) {
			echo $e->getMessage();
		}
		return false;
	}
	
	public function findFriendRelation( $user_id, $user_id_to ){
		$id = -1;
		$sql = " select id from friend_relation where user_id = '$user_id' and user_id_to = '$user_id_to' ";
		$stmt = $this->getPdo()->prepare( $sql );
		$stmt->execute();
		$rs = $stmt->fetch();
		if ( isset($rs['id']) ){
			$id = $rs['id'];
		}else{
			$sql = " select id from friend_relation where user_id = '$user_id_to' and user_id_to = '$user_id' ";
			$stmt = $this->getPdo()->prepare( $sql );
			$stmt->execute();
			$rs = $stmt->fetch();
			if( isset($rs['id']) ){
				$id = $rs['id'];
			}
		}
		return $id;
	}
	
	public function deleteFriendRelation( $user_id, $user_id_to ){
		$is_error = null;
		try{
			if( !$this->checkFriendRelation( $user_id, $user_id_to ) ){
				$is_error[] = "User have id '$user_id_to' not friend relation.";
			}else{
				// find 
				$idFriendRelation = $this->findFriendRelation($user_id, $user_id_to);
				
				$error = $this->deleteTableByWhere( 'friend_relation' , " where id = '$idFriendRelation' ");
				
				if( $error != null ){
					utility::pushArrayToArray( $is_error , $error);
				}
			}
		}catch (Exception $e) {
			echo $e->getMessage();
			$is_error[] = $e->getMessage();
		}
		return $is_error;
	}
}