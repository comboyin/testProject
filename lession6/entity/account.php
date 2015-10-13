<?php
class account {
	public $id;
	public $username;
	public $firstname;
	public $lastname;
	public $birthday;
	public $gender;
	public $address;
	public $avatar;
	public $type;
	public $password;
	public $search;
	/**
	 *
	 * @var Order  */
	private $order;
	private $_properties;

	public function __construct(){
		$this->id = "";
		$this->username = "guest";
		$this->firstname = "";
		$this->lastname = "";
		$this->birthday = new DateTime();
		$this->gender = 1;
		$this->address = "";
		$this->avatar = "";
		$this->type = -1;
		$this->search = array();
		$this->order = new Order();
	}


	/**
	 * set a new property for the view
	 * @param string $name
	 * @param string $value  */
	public function __set($name, $value) {
		$this->_properties [$name] = $value;
	}

	/**
	 * get the specified property from the view
	 * @param string $name
	 * @throws ViewException
	 * @return multitype:  */
	public function __get($name) {
		if (! isset ( $this->_properties [$name] )) {
			throw new ViewException ( 'The requested property is not valid for this view.' );
		}
		return $this->_properties [$name];
	}

	public function getStringGenger(){
	    if( $this->gender == 1 ){
	        return 'Male';
	    }else{
	        return 'Female';
	    }
	}
	/**
	 * @return Order  */
	public function getOrder() {
		return $this->order;
	}
	/**
	 *
	 * @param Order $order  */
	public function setOrder($order) {
		$this->order = $order;
		return $this;
	}

}