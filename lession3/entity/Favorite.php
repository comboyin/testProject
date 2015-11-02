<?php
class Favorite {
	private $id;
	private $user_id;
	private $user_id_to;
	private $regist_datetime;
	
	private $user;
	private $userto;
	
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getUserId() {
		return $this->user_id;
	}
	public function setUserId($user_id) {
		$this->user_id = $user_id;
		return $this;
	}
	public function getUserIdTo() {
		return $this->user_id_to;
	}
	public function setUserIdTo($user_id_to) {
		$this->user_id_to = $user_id_to;
		return $this;
	}
	public function getRegistDatetime() {
		return $this->regist_datetime;
	}
	public function setRegistDatetime($regist_datetime) {
		$this->regist_datetime = $regist_datetime;
		return $this;
	}
	public function getUser() {
		return $this->user;
	}
	public function setUser($user) {
		$this->user = $user;
		return $this;
	}
	public function getUserto() {
		return $this->userto;
	}
	public function setUserto($userto) {
		$this->userto = $userto;
		return $this;
	}
	
	
}