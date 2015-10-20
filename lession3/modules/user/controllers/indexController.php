<?php
class indexController extends baseController{

	public function index( $arg = array() ) {
		/* @var $userSession User */
		$userSession = $_SESSION['acl']['account'];
		/* @var $modelUser UserModel */
		$modelUser = $this->model->get( 'User' );
		
		$idUserSession = $userSession->getId();
		
		$user = $modelUser->listTableByWhere( 'User' , array( "id = $idUserSession" ));
		/* @var $user User  */
		$user = $user[0];
		
		// get pictures
		$pictures = $modelUser->listTableByWhere('Picture', array( " user_id = $idUserSession " ));
		$user->setPictures( $pictures );
		$user->setGroup( $userSession->getGroup() );

		// total friend
		
		$user->setTotalFriendList( $modelUser->countListTableByWhere( 'friend_relation' , array( " user_id = $idUserSession " )) );
		$user->setTotalFavorite( $modelUser->countListTableByWhere( 'favorite' , array( " user_id = $idUserSession " )) );
		// total favorite
		
		$this->getView()->content->user = $user;
		
	}

}