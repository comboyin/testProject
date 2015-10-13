<?php
class loginController extends baseController {

	public function index($arg = array()){
		//session_start();
		if($this->checkLogin()){
			$this->redirect("index.php?rt=fronend/login/loginSuccess");
			exit(0);
		}
		if(isset($_POST['login']) && $_POST['login']=='login'){
			$user =  $_POST['username'];
			$_SESSION['tempUser'] = $user;
			$pass = $_POST['password'];
			$model = $this->model->get('accountModel');
			$account = $model->checkLogin($user,$pass);

			if($account==false){
				$error = 'Username and password wrong.';
			}else{
				$_SESSION['acl']['account'] = $account;
				$this->redirectUrl($this->url( array( 'module'=>'backend', 'controller' => 'index', 'action' => 'index' )) );
				exit(0);
			}
		}
		if(isset($error)){
			$this->getView()->content->error = $error;
		}
	}

	public function loginSuccess(){
		//session_start();
		if(!$this->checkLogin()){
			$this->redirect("index.php?rt=fronend/login");
		}
	}

	public function logout(){
		//session_start();
		if(!$this->checkLogin()){

		}else if($this->checkLogin()){
			/* @var $account account */
			$account = $_SESSION['acl']['account'];
			$account->type = -1;
		}
		$this->redirect("index.php?rt=fronend/login");
	}

}
?>