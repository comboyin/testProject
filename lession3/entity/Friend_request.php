<?php
class Friend_request {
	private $id;
	private $user_id;
	private $user_id_to;
	private $regist_datetime;
	
	private $user;
	private $userTo;
	
	
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
	/**
	 * @return User  */
	public function getUser() {
		return $this->user;
	}
	public function setUser($user) {
		$this->user = $user;
		return $this;
	}
	/**
	 * @return User  */
	public function getUserTo() {
		return $this->userTo;
	}
	public function setUserTo($userTo) {
		$this->userTo = $userTo;
		return $this;
	}
	
}