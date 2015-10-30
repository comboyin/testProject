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
				$sql = " insert into `friend_request`( user_id, user_id_to, regist_datetime )
				values( '$user_id' , '$user_id_to' , '$regist_datetime' ) ";
				$stmt = $this->getPdo()->prepare( $sql );
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
				$users = $this->listTableByWhere( 'User' , array( " id = '$user_id' " ));
				
				$id_user    = $friendRequest->getUserId();
				$id_user_to = $friendRequest->getUserIdTo();
				
				$users = $this->listTableByWhere( 'User' , array( " id = '$id_user' " ));
				$users_to = $this->listTableByWhere( 'User' , array( " id = '$id_user_to' " ));
			}
			
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		return $ListFriendRequest;
	}
}