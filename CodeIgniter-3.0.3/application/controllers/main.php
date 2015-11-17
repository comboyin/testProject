<?php
class main extends CI_Controller {

	public function index(){
		$this->load->view("main_menu");
	}

	public function regist(){

		if( $this->checkLogin() == true ){
			redirect("main/home");
		}
		$content = array();
		$error = array();
		if( isset( $_POST['regist_submit'] ) && $_POST['regist_submit'] == "Regist"){

	        $content['result'] = false;
	        $fullname  = isset( $_POST['fullname'] ) ? $_POST['fullname'] : '';
	        $username  = isset( $_POST['username'] ) ? $_POST['username'] : '';
	        $email     = isset( $_POST['email'] ) ? $_POST['email'] : '';
	        $pass      = isset( $_POST['pass'] ) ? $_POST['pass'] : '';
	        $confpass  = isset( $_POST['confpass'] ) ? $_POST['confpass'] : '';
	        $sex       = isset( $_POST['sex'] ) ? $_POST['sex'] : '';
	        $address   = isset( $_POST['address'] ) ? $_POST['address'] : '';
	        $month     = isset( $_POST['month'] ) ? $_POST['month'] : '';
	        $day       = isset( $_POST['day'] ) ? $_POST['day'] : '';
	        $year      = isset( $_POST['year'] ) ? $_POST['year'] : '';
	        $captcha   = isset( $_POST['captcha'] ) ? $_POST['captcha'] : '';

	        // validation
	        $valid = new Validation();

	        //fullname
	        if( ( $errorItem = $valid->checkEmpty( $fullname ) ) != null)
	            utility::pushArrayToArray( $error['fullname'], $errorItem );
            if( ( $errorItem = $valid->checkString ( $fullname ) ) != null)
                utility::pushArrayToArray( $error['fullname'], $errorItem );
            if( ( $errorItem = $valid->between( $fullname, array('min'=>4, 'max'=>30) )) != null )
                utility::pushArrayToArray( $error['fullname'], $errorItem );
	        //username
            if( ( $errorItem = $valid->checkEmpty( $username ) ) != null)
                utility::pushArrayToArray( $error['username'], $errorItem );
            if( ( $errorItem = $valid->checkUsername ( $username ) ) != null)
                utility::pushArrayToArray( $error['username'], $errorItem );
            if( ( $errorItem = $valid->between( $username, array('min'=>4, 'max'=>30) )) != null )
                utility::pushArrayToArray( $error['username'], $errorItem );
            if( !$this->getObjectModel()->checkUsername ( $username ) )
                utility::pushArrayToArray( $error['username'] , array( 'Duplicate username!' ) );
	        //email
            if( ( $errorItem = $valid->checkEmpty( $email ) ) != null)
                utility::pushArrayToArray( $error['email'], $errorItem );
            if( ( $errorItem = $valid->between( $email, array('min'=>3, 'max'=>30) )) != null )
                utility::pushArrayToArray( $error['email'], $errorItem );
            if( !filter_var( $email, FILTER_VALIDATE_EMAIL ) )
                utility::pushArrayToArray( $error['email'] , array( 'Please enter a valid email address.' ) );
            if( !$this->getObjectModel()->checkEmail ( $email ) )
                utility::pushArrayToArray( $error['email'] , array( 'Duplicate email!' ) );
	        //pass
            if( $pass != $confpass )
                utility::pushArrayToArray( $error['password'] , array( 'The password must be same than the confirm password.' ) );
            if( $pass == $username )
                utility::pushArrayToArray( $error['password'] , array( 'The password must be different than the user name.' ) );
            if( ( $errorItem = $valid->checkEmpty( $pass ) ) != null)
                utility::pushArrayToArray( $error['password'], $errorItem );
            if( ( $errorItem = $valid->between( $pass, array('min'=>3, 'max'=>20) )) != null )
                utility::pushArrayToArray( $error['password'], $errorItem );
            if( ( $errorItem = $valid->checkPass( $pass ) ) != null)
                utility::pushArrayToArray( $error['password'], $errorItem );
	        //sex
            if( $sex != 1 && $sex != 2)
                utility::pushArrayToArray( $error['sex'] , array( 'Please input correct the gender' ) );
	        //address
            if( ( $errorItem = $valid->checkEmpty( $address ) ) != null)
                utility::pushArrayToArray( $error['address'], $errorItem );
            if( ( $errorItem = $valid->between( $address, array('min'=>4, 'max'=>255) )) != null )
                utility::pushArrayToArray( $error['address'], $errorItem );
	        //birthday yyyy-mm-dd
            $month = (strlen($month) == 1)? '0'.$month : $month;
            $day = (strlen($day) == 1)? '0'.$day : $day;
            $birthday = $year."-".$month."-".$day;
            if ( !preg_match ("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $birthday , $split) || !checkdate( $split[2], $split[3], $split[1] ) )
            {
                utility::pushArrayToArray($error['birthday'], array( 'Please input correct the date.' ) );
            }
            $now = strtotime("now");
            $bd = strtotime($birthday);
            if ($bd >= $now)
            {
                utility::pushArrayToArray($error['birthday'], array( 'Date is not in the past' ) );
            }
	        //captcha
            if( ( $errorItem = $valid->checkEmpty( $captcha ) ) != null)
                utility::pushArrayToArray( $error['captcha'], $errorItem );
	        if( $captcha != $this->_dataSess->captcha['code'] ){
	            utility::pushArrayToArray( $error['captcha'] , array( 'Please input correct the captcha' ) );
	        }

	        if($error == null)
	        {
	            //insert
	            //. date('mY')
	            $key = $username . $email . date('mY');
	            $key = md5($key);
	            $user = new user();
	            $user->fullname    = $fullname;
	            $user->username    = $username;
	            $user->email       = $email;
	            $user->password    = $pass;
                $user->sex         = $sex;
	            $user->address     = $address;
	            $user->birthday    = $birthday;
	            $user->active      = 0;
	            $user->key         = $key;
	            $user->tmpemail    = "";

	            $data = $this->getObjectModel()->register($user);
	            if($data['result'] === true)
	            {
	                $this->sendEmail( $username, $key, $email );
	                $content['result'] = true;
	            }
	            else
	                utility::pushArrayToArray($content['error']['error'], array( $data['error'] ) );
	        }
	        else
	            $content['error'] = $error;
	    }
	    xdebug_break();
		$this->load->view("regist", $content);
	}

	public function successfull()
	{
		$this->load->view("successfull");
	}

	public function login(){
		$this->load->view("login");
	}

	public function home(){
		$this->load->view("home");
	}

	public function profile(){
		$this->load->view("profile");
	}

	public function editprofile(){
		$this->load->view("editprofile");
	}

	public function changeemail(){
		$this->load->view("changeemail");
	}

	public function changeemailsuccess(){
		$this->load->view("changeemailsuccess");
	}

	public function changepassword(){
		$this->load->view("changepassword");
	}

	public function changepasswordsuccess(){
		$this->load->view("changepasswordsuccess");
	}

	public function info(){
		phpinfo();
	}
}