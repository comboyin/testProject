<?php
class productimg {
	public $id;
	public $image;
	/**
	 *
	 * @var product */
	public $product;

	public function __construct(){
		$this->id = '';
		$this->image = '';
		$this->product = new product();
	}



}