<?php
class main extends CI_Controller {

	public function index(){
		$this->load->view("main_menu");
	}

	public function regist(){
		$this->load->view("regist");
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