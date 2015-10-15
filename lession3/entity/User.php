<?php
class User {

	private $id;
	private $username;
	private $password;
	private $fullname;
	private $sex;
	private $birthday;
	private $address;
	private $introduction;
	private $email;
	private $group_id;
	/**
	 *
	 * @var Group  */
	private $group;

	public function __construct(){
		$this->group = new Group();
	}
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getUsername() {
		return $this->username;
	}
	public function setUsername($username) {
		$this->username = $username;
		return $this;
	}
	public function getPassword() {
		return $this->password;
	}
	public function setPassword($password) {
		$this->password = $password;
		return $this;
	}
	public function getFullname() {
		return $this->fullname;
	}
	public function setFullname($fullname) {
		$this->fullname = $fullname;
		return $this;
	}
	public function getSex() {
		return $this->sex;
	}
	public function setSex($sex) {
		$this->sex = $sex;
		return $this;
	}
	public function getBirthday() {
		return $this->birthday;
	}
	public function setBirthday($birthday) {
		$this->birthday = $birthday;
		return $this;
	}
	public function getAddress() {
		return $this->address;
	}
	public function setAddress($address) {
		$this->address = $address;
		return $this;
	}
	public function getEmail() {
		return $this->email;
	}
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}
	public function getGroupId() {
		return $this->group_id;
	}
	public function setGroupId($group_id) {
		$this->group_id = $group_id;
		return $this;
	}
	public function getIntroduction() {
		return $this->introduction;
	}
	public function setIntroduction($introduction) {
		$this->introduction = $introduction;
		return $this;
	}
	public function getGroup() {
		return $this->group;
	}
	public function setGroup(Group $group) {
		$this->group = $group;
		return $this;
	}


}