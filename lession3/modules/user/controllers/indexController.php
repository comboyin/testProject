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
	/**
	 * get atrr value of user logined
	 * Lấy giá trị thuộc tính của user đã đăng nhập  */
	public function getValueParameterUserSession(){
		
		/* @var $userModel UserModel  */
		$userModel = $this->model->get('User');
		/* @var $accountSession User */
		$accountSession = $_SESSION['acl']['account'];
		$idAcc = $accountSession->getId();
		/*@var $acc User  */
		$acc = $userModel->listTableByWhere( 'User' , array( " id = $idAcc " ));
		$acc = $acc[0];
		
		$kq = array( 
			'fullname' => $acc->getFullname(),
				'email'=> $acc->getEmail(),
			'address'  => $acc->getAddress(),
			'sex'      => $acc->getSex(),
			'stringsex'	=> $acc->getStringSex(),
			'birthday' => $acc->getBirthday(),
		'introduction' => $acc->getIntroduction(),
		'username'     => $acc->getUsername()
		);
		
		echo json_encode( array(  'user' => $kq) );
		exit(0);
	}
	
	public function editProfile(){
		$is_error = null;
		$stringSetValue = "";
		// get parameter.
		
		// fullname
		$fullname = isset( $_POST['fullname'] ) ? $_POST['fullname'] : null;
		// email
		$email    = isset( $_POST['email'] ) ? $_POST['email'] : null;
		// sex
		$sex      = isset( $_POST['sex'] ) ? $_POST['sex'] : null;
		// birthday
		$birthday = isset( $_POST['birthday'] ) ? $_POST['birthday'] : null;
		// address
		$address  = isset( $_POST['address'] ) ? $_POST['address'] : null;
		
		// validation
		$valid = new validation();
		// fullname
		if( $fullname != null ){
			
			$stringSetValue .= " fullname = '$fullname' , " ;
			
			// empty
			if( ( $emptyFullName = $valid->checkEmpty( $fullname ) ) != null )
			{
				utility::pushArrayToArray( $is_error['Full Name'] , $emptyFullName);
			}
			
			// between
			if( ( $betweenFullName = $valid->between( $fullname, array( 'min' => 4 , 'max' => 30 ) )) != null )
			{
				utility::pushArrayToArray( $is_error['Full Name'] , $betweenFullName);
			}
		}
		
		// email 
		if( $email != null ){
			
			$stringSetValue .= " email = '$email' , ";
			// empty
			if( ( $emptyEmail = $valid->checkEmpty( $email ) )  != null )
			{
				utility::pushArrayToArray( $is_error['Email'] , $emptyEmail);
			}
			
			// between
			if( ( $betweenEmail = $valid->between( $email, array( 'min' => 6 , 'max' => 40 ) ) ) != null )
			{
				utility::pushArrayToArray( $is_error['Email'] , $betweenEmail);
			}
			
			// email
			if( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
				utility::pushArrayToArray( $is_error['Email'] , array( "This ($email) email address is NOT considered valid." ) );
			}
		}
		// sex
		if( $sex != null ){
			
			$stringSetValue .= " sex = $sex , ";
			// empty
			if( ( $emptySex = $valid->checkEmpty( $sex ) )  != null )
			{
				utility::pushArrayToArray( $is_error['Sex'] , $emptySex);
			}
			
			// value 
			if( $sex != 0 && $sex != 1 ){
				utility::pushArrayToArray( $is_error['Sex'] , array( "Value is NOT considered valid." ));
			}
		}
		
		// birthday 
		if( $birthday != null ){
			$stringSetValue .= " birthday = '$birthday' , ";
			// birthday
	        $split = array();
	        if( ( $errorBirthdayEmpty = $valid->checkEmpty( $birthday ) ) != null){
	            utility::pushArrayToArray($is_error['birthday'], $errorBirthdayEmpty);
	        }
	        if ( !preg_match ("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $birthday , $split) || !checkdate( $split[2], $split[3], $split[1] ) )
	        {
	            utility::pushArrayToArray($is_error['birthday'], array( 'Birthday format yyyy-mm-dd.' ) );
	            utility::pushArrayToArray($is_error['birthday'], array( 'Value birthdat is not DATE.' ) );
	        }
		}
		
		if( $address != null ){
			
			$stringSetValue .= " address = '$address' , ";
			// address
			if( ( $errorAddressEmpty = $valid->checkEmpty( $address ) ) != null){
				utility::pushArrayToArray($is_error['address'], $errorAddressEmpty);
			}
			if(($errorAddress = $valid->between( $address, array('min'=>8, 'max'=>100) )) != null){
				utility::pushArrayToArray($is_error['address'], $errorAddress);
			}
		}
		
		if( strlen( $stringSetValue ) == 0 ){
			utility::pushArrayToArray($is_error['Parameter'], array( 'No parameter.' ));
		}
		
		if( $is_error == null && strlen( $stringSetValue ) > 0){
			// update database
			$stringSetValue = " set " . $stringSetValue;
			$stringSetValue = trim( $stringSetValue );
			$stringSetValue = substr_replace($stringSetValue, ' ', strlen($stringSetValue)-1);
			$tableName      = " user "    ;
			/* @var $accountSession User */
			$accountSession = $_SESSION['acl']['account'];
			$idAcc = $accountSession->getId();
			
			$stringWhere    = " where id = '$idAcc' "  ;
			
			/* @var $modelUser UserModel  */
			$modelUser = $this->model->get( 'User' );
			$error = $modelUser->updateTableByWhere($tableName, $stringSetValue, $stringWhere);
			if( $error != null ){
				utility::pushArrayToArray($is_error['SQL'],  $error );
			}
		}
		// $is_error == null  => success
		// $is_error == array => error
		echo json_encode( 
				array( 
					'is_error' => $is_error ) 
				);
		
		exit(0);
		
	}

}