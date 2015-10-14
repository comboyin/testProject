<?php
class OrderProduct {

	private $id;
	private $quality;
	private $totalprice;
	private $product;
	private $order;
	private $product_id;
	private $order_id;

	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	public function getTotalprice() {
		return $this->totalprice;
	}
	public function setTotalprice($totalprice) {
		$this->totalprice = $totalprice;
		return $this;
	}

	/**
	 * @return product  */
	public function getProduct() {
		return $this->product;
	}

	/**
	 * @param product $product  */
	public function setProduct($product) {
		$this->product = $product;
		return $this;
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
	public function getQuality() {
		return $this->quality;
	}
	public function setQuality($quality) {
		$this->quality = $quality;

		$totalPrice = $this->product->price * $this->quality;
		$this->totalprice = $totalPrice;

		return $this;
	}
	public function getProductId() {
		return $this->product_id;
	}
	public function setProductId($product_id) {
		$this->product_id = $product_id;
		return $this;
	}
	public function getOrderId() {
		return $this->order_id;
	}
	public function setOrderId($order_id) {
		$this->order_id = $order_id;
		return $this;
	}

}