<?php
class FriendrequestModel extends baseModel{
	/**
	 * 
	 * @param Friend_request $friendRequest  */
	public function addFriendRequest( $friendRequest ){
		
		$kq = array(
				'error'  => null,
				'result' => null
				);
		
		try {
			$user_id         = $friendRequest->getUserId();
			$user_id_to      = $friendRequest->getUserIdTo();
			$regist_datetime = $friendRequest->getRegistDatetime();
			
			// check user session
			if( $this->checkIsSession( $user_id_to ) ){
				$kq['error'][] = "Can not make friends with yourself";
			}
			// check user_id exist.
			$friend_requests = $this->listTableByWhere( 'User' , array( " id = '$user_id' " ));
			if( count( $friend_requests ) == 0 ){
				$kq['error'][] = "User id '$user_id' not exist.";
			}
			
			// check user_id_to exist.
			$friend_requests = $this->listTableByWhere( 'User' , array( " id = '$user_id_to' " ));
			if( count( $friend_requests ) == 0 ){
				$kq['error'][] = "User id '$user_id_to' not exist.";
			}
			
			// check friend_request exist
			$friend_requests = $this->listTableByWhere( 'Friend_request' , array( " user_id = '$user_id' and user_id_to = '$user_id_to' " ));
			if( count( $friend_requests ) > 0 ){
				$kq['error'][] = "This person did sent request.";
			}
			
			if( $kq['error'] == null ){
				// check friend order
				$friendRelationModel = new FriendrelationModel();
				$friendRelationModel->setPdo( $this->getPdo() );
				$bool = $friendRelationModel->checkFriendRelation( $user_id, $user_id_to);
				if( $bool == true ){
					$kq['error'][] = "Sorry ! This person is your friend.";
				}
			}
			
			if ( $kq['error'] == null ){
				$user_id         = $friendRequest->getUserId();
				$user_id_to      = $friendRequest->getUserIdTo();
				$regist_datetime = $friendRequest->getRegistDatetime();
				$sql 			 = " insert into `friend_request`( user_id, user_id_to, regist_datetime )
				values( '$user_id' , '$user_id_to' , '$regist_datetime' ) ";
				$stmt 			 = $this->getPdo()->prepare( $sql );
				$stmt->execute();
			}
		} catch (Exception $e) {
			$kq['error'][] = $e->getMessage();
		}
		return $kq;
	}
	
	public function getListFriendRequest( $user_id ){
		
		$ListFriendRequest = array();
		try {
			
			$ListFriendRequest = $this->listTableByWhere('Friend_request', array( "user_id_to = '$user_id'" ));
			
			foreach ( $ListFriendRequest as $friendRequest ){
				/* @var $friendRequest Friend_request */
				$users 		= $this->listTableByWhere( 'User' , array( " id = '$user_id' " ));
				
				$id_user    = $friendRequest->getUserId();
				$id_user_to = $friendRequest->getUserIdTo();
				/* @var $users User */
				/* @var $users_to User */
				$users 		= $this->listTableByWhere( 'User' , array( " id = '$id_user' " ));
				$users_to 	= $this->listTableByWhere( 'User' , array( " id = '$id_user_to' " ));
				$friendRequest->setUser( $users[0] );
				$friendRequest->setUserTo( $users_to[0] );
				
			}
			
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		return $ListFriendRequest;
	}
	public function deleteFriendRequest( $idFriend, $idUserSession ){
	
		$is_error = null;
		try {
			// check exist
			/* @var $friendRequests $friendRequest */
			$friendRequests = $this->listTableByWhere('Friend_request', array( " user_id = '$idUserSession' and user_id_to = '$idFriend' " ));
			if( count( $friendRequests ) == 0 ){
				$is_error[] = "Friend request not exist.";
			}
			
			if( $is_error == null ){
				//var_dump( $action );
				$this->getPdo()->beginTransaction();
				
				$this->deleteTableByWhere('Friend_request', " where user_id = '$idUserSession' and user_id_to = '$idFriend' ");
	
				$this->getPdo()->commit();
			}
				
		} catch (Exception $e) {
			$is_error[] = $e->getMessage();
			$this->getPdo()->rollBack();
		}
		return $is_error;
	}	
	public function acceptAndDeleteFriendRequest( $idFriendRequest, $idUserSession, $action ){
		
		$is_error = null;
		
		try {
			// check exist
			/* @var $friendRequests $friendRequest */
			$friendRequests = $this->listTableByWhere('Friend_request', array( " id = '$idFriendRequest' " ));
			
			if( count( $friendRequests ) == 0 ){
				$is_error[] = "Friend request not exist.";
			}else{
				// check id friend request of user session
				$friendRequest = $friendRequests[0];
				if( $idUserSession != $friendRequest->getUserIdTo() ){
					$is_error[] = "Sorry ! you can't use friend request other people.";
				}
			}
			if( $is_error == null ){
				//var_dump( $action );
				$this->getPdo()->beginTransaction();
				// action == 1 = accept
				// action == 0 = delete
				
				if( $action == 1 ){
					
					// delete
					$this->deleteTableByWhere('Friend_request', " where id = '$idFriendRequest' ");
					$modelFriendRelation = new FriendrelationModel();
					$modelFriendRelation->setPdo( $this->getPdo() );
					// add to friend relation
					$friendRelation 	 = new Friend_relation();
					$friendRelation->setUserId(   $friendRequest->getUserId()  );
					$friendRelation->setUserIdTo( $friendRequest->getUserIdTo() );
					$friendRelation->setRegistDatetime( utility::getDatetimeNow() );
					
					$error = $modelFriendRelation->addFriendRelation( $friendRelation );
					if( $error != null ){
						utility::pushArrayToArray( $is_error , $error );
					}
				}else if( $action == 0 ){
					
					$this->deleteTableByWhere('Friend_request', " where id = '$idFriendRequest' ");
					
				}
				
				$this->getPdo()->commit();
			}
			
		} catch (Exception $e) {
			$is_error[] = $e->getMessage();
			$this->getPdo()->rollBack();
		}
		
		return $is_error;
	}
}