<?php
class Order {

	private $id;
	private $name;
	private $phone;
	private $totalprice;
	private $createtime;
	private $listorderproduct;
	private $idorder;
	private $email;

	public function __construct(){
		$this->listorderproduct = array();
	}
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	public function getPhone() {
		return $this->phone;
	}
	public function setPhone($phone) {
		$this->phone = $phone;
		return $this;
	}

	public function getTotalPriceCurrent(){
		return $this->totalprice;
	}

	public function getTotalprice() {
		$totalpriceOrder = 0;
		if( $this->listorderproduct == null ){
			$this->totalprice = 0;

		}else{
			/* @var $orderProduct OrderProduct */
			foreach ( $this->listorderproduct as $orderProduct ){
				$totalpriceOrder += $orderProduct->getTotalprice();
			}
		}
		$this->totalprice = $totalpriceOrder;
		return $this->totalprice;
	}
	public function setTotalprice($totalprice) {
		$this->totalprice = $totalprice;
		return $this;
	}
	/**
	 * @return array  */
	public function getListorderproduct() {
		return $this->listorderproduct;
	}
	/**
	 *
	 * @param array $listorderproduct  */
	public function setListorderproduct( $listorderproduct ) {
		$this->listorderproduct = $listorderproduct;
		return $this;
	}

	/**
	 *
	 * @param  $orderProduct  */
	public function addOderProduct( $orderProduct ){
		array_push($this->listorderproduct, $orderProduct);
	}

	public function removeOrderProduct( $idProduct ){

		$flag = -1;
		/* @var $orderproduct OrderProduct */
		foreach ( $this->listorderproduct as $key=>$orderproduct ){
			if ( $orderproduct->getProduct()->id == $idProduct ){
				$flag = $key;
				break;
			}
		}
		if( $flag != -1 ){
			unset($this->listorderproduct[$flag]);
		}
	}

	public function findOderProductByIdProduct( $idProduct ){
		$flag = -1;
		$OrderProductFind = null;
		/* @var $orderproduct OrderProduct */
		foreach ( $this->listorderproduct as $key=>$orderproduct ){
			if ( $orderproduct->getProduct()->id == $idProduct ){
				$flag = $key;
				$OrderProductFind = $orderproduct;
				break;
			}
		}
		return $OrderProductFind;
	}
/**
 * @return DateTime  */
	public function getCreatetime() {
		return $this->createtime;
	}
	public function setCreatetime($createtime) {
		$this->createtime = $createtime;
		return $this;
	}
	public function getIdorder() {
		return $this->idorder;
	}
	public function setIdorder($idorder) {
		$this->idorder = $idorder;
		return $this;
	}
	public function getEmail() {
		return $this->email;
	}
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}




}