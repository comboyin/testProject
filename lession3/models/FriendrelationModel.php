<?php
class FriendrelationModel extends baseModel{
	
	public function getListFriendRelation( $user_id ){
		$ListFriendRelation = array();
		try {
			$ListFriendRelation = $this->listTableByWhere( 'Friend_relation' , array( " user_id = '$user_id' " ));
			foreach ( $ListFriendRelation as $FriendRelation ){
				/* @var $FriendRelation Friend_relation */
				$users = $this->listTableByWhere( 'User' , array( " id = '$user_id' " ));
				$user_id_to = $FriendRelation->getUserIdTo();
				$users_to = $this->listTableByWhere( 'User' , array( " id = '$user_id_to' " ));
				$FriendRelation->setUser( $users[0] );
				$FriendRelation->setUserTo( $users_to[0] );
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		return $ListFriendRelation;
	}
	
}