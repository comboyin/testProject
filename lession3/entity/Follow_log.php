<?php
class Follow_log {
	private $id;
	private $follow_id;
	private $action;
	private $userid_to;
	private $regist_datetime;
	private $status;
	
	/**
	 * 
	 * @var Follow */
	private $follow;
	/**
	 * 
	 * @var User  */
	private $userto;
	
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getFollowId() {
		return $this->follow_id;
	}
	public function setFollowId($follow_id) {
		$this->follow_id = $follow_id;
		return $this;
	}
	public function getAction() {
		return $this->action;
	}
	public function setAction($action) {
		$this->action = $action;
		return $this;
	}
	/**
	 * @return User  */
	public function getUseridTo() {
		return $this->userid_to;
	}
	public function setUseridTo($userid_to) {
		$this->userid_to = $userid_to;
		return $this;
	}
	public function getRegistDatetime() {
		return $this->regist_datetime;
	}
	public function setRegistDatetime($regist_datetime) {
		$this->regist_datetime = $regist_datetime;
		return $this;
	}
	public function getFollow() {
		return $this->follow;
	}
	public function setFollow(Follow $follow) {
		$this->follow = $follow;
		return $this;
	}
	public function getUserto() {
		return $this->userto;
	}
	public function setUserto(User $userto) {
		$this->userto = $userto;
		return $this;
	}
	public function getStatus() {
		return $this->status;
	}
	public function setStatus($status) {
		$this->status = $status;
		return $this;
	}
	
	
}