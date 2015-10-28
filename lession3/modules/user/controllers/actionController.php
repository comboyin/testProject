<?php
class actionController extends baseController{
	
	
	public function index( $arg =  array() ) {
		
	}
	
	public function friendList( $args ){	
		
		$username = ( isset( $args[1] ) ) ? $args[1] : '' ;
		/* @var $modelPicture PictureModel */
		$modelPicture = $this->model->get( 'Picture' );
		// check user name 
		/* @var $UserModel UserModel */
		$UserModel = $this->model->get('User');
		$users = $UserModel->listTableByWhere('User', array( "username = '$username'" ) );
		if( count( $users ) == 0 ){
			$this->redirect( 'error' );
		}
		/* @var $user User */
		$user = $users[0];
		$user->getId();
		
		$userSession = $this->getUserSession();
		
		if ( $user->getId() == $userSession->getId() ){
			$this->redirect( 'user' );
		}
		$user = $users[0];
		$idUser = $user->getId();
		
		
		// total friend
		
		/* @var $friendRelationModel FriendrelationModel */
		$friendRelationModel = $this->model->get('Friendrelation');
		$friendRelations = array();
		
		// is friend
		$is_friend = $friendRelationModel->checkFriendRelation( $userSession->getId() , $idUser);
		
		if( $is_friend == true ){
			$user->setTotalFriendList( $modelPicture->countListTableByWhere( 'friend_relation' , array( " user_id = $idUser or user_id_to = $idUser " )) );
			$user->setTotalFavorite( $modelPicture->countListTableByWhere( 'favorite' , array( " user_id = $idUser or user_id_to = $idUser" )) );
			$friendRelations = $friendRelationModel->getListFriendRelation( $user->getId() );
		}
		
		$this->getView()->content->friendRelations = $friendRelations;
		$this->getView()->content->user = $user;
		$this->getView()->content->is_friend = $is_friend;
		
		
	}
	
	public function profile( $args ){
		
		$username = ( isset( $args[1] ) ) ? $args[1] : '' ;
		/* @var $modelPicture PictureModel */
		$modelPicture = $this->model->get( 'Picture' );
		// check user name 
		/* @var $UserModel UserModel */
		$UserModel = $this->model->get('User');
		$users = $UserModel->listTableByWhere('User', array( "username = '$username'" ) );
		if( count( $users ) == 0 ){
			$this->redirect( 'error' );
		}
		/* @var $user User */
		$user = $users[0];
		$user->getId();
		
		$userSession = $this->getUserSession();
		
		if ( $user->getId() == $userSession->getId() ){
			$this->redirect( 'user' );
		}
		$user = $users[0];
		$idUser = $user->getId();
		$pictures = $modelPicture->listPicture( " where user_id = '$idUser' " );
		$user->setPictures( $pictures );
		
		// total friend
		
		/* @var $friendRelationModel FriendrelationModel */
		$friendRelationModel = $this->model->get('Friendrelation');
		
		// is friend
		$is_friend = $friendRelationModel->checkFriendRelation( $userSession->getId() , $idUser);
		
		if( $is_friend == true ){
			$user->setTotalFriendList( $modelPicture->countListTableByWhere( 'friend_relation' , array( " user_id = $idUser or user_id_to = $idUser " )) );
			$user->setTotalFavorite( $modelPicture->countListTableByWhere( 'favorite' , array( " user_id = $idUser or user_id_to = $idUser" )) );
		}
		
		
		$this->getView()->content->user = $user;
		$this->getView()->content->is_friend = $is_friend;
	}
	
	public function friendRequest( $args ){
		
		$username = ( isset( $args[1] ) ) ? $args[1] : '' ;
		/* @var $modelPicture PictureModel */
		$modelPicture = $this->model->get( 'Picture' );
		// check user name
		/* @var $UserModel UserModel */
		$UserModel = $this->model->get('User');
		$users = $UserModel->listTableByWhere('User', array( "username = '$username'" ) );
		if( count( $users ) == 0 ){
			$this->redirect( 'error' );
		}
		
	}
	
	public function viewPicture( $args ){
		$IdPicture = ( isset( $args[1] ) ) ? $args[1] : '' ;
		$is_error = null;
		
		$userSe = $this->getUserSession();
		
		/* @var $PictureModel PictureModel */
		$PictureModel = $this->model->get('Picture');
		$is_error = $PictureModel->increaseView( $IdPicture , $userSe->getId() );
		
		header('Content-Type: application/json');
		
		echo json_encode(  array( 'is_error' => $is_error ));
		exit(0);
		
	}
	
	public function getPicture( $args ){
		
		$IdPicture = ( isset( $args[1] ) ) ? $args[1] : '' ;
		
		$is_error = null;
		
		/* @var $PictureModel PictureModel */
		$PictureModel = $this->model->get('Picture');
		
		$listObj = $PictureModel->listPicture(" where id = '$IdPicture' ");
		
		if( count( $listObj ) == 0 ){
			$is_error[] = array( 'Picture not exist.' );
		}else{
			/* @var $listObj Picture */
			$listObj = $listObj[0];
		}
		$is_error = array(
			'is_error' => $is_error,
			'view'  => $listObj->getView()
		);
		
		header('Content-Type: application/json');
		
		echo json_encode(  $is_error );
		
		exit(0);
	}
	
	public function like(){
		
		$IdPicture = ( isset( $_POST['IdPicture']) ) ? $_POST['IdPicture']: '' ;
		/* @var $PictureModel PictureModel */
		$PictureModel = $this->model->get('Picture');
		$user = $this->getUserSession();
		$kq = $PictureModel->Like( $IdPicture , $user->getId() );
		
		header('Content-Type: application/json');
		echo json_encode( 
					$kq
				);
		exit(0);
		
	}
	
	

}