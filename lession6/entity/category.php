<?php
class category {
	public $id;
	public $name;
	public $parent_id;
	public $sort_order;

	/**
	 * @var product
	 * */
	public $product;

	public function __construct(){
		$this->id = '';
		$this->name = '';
		$this->parent_id = 0;
		$this->sort_order = 0;
		$this->product = array();
	}


}