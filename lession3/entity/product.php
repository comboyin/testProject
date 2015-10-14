<?php
class product {
	public $id;
	public $name;
	public $price;
	public $image_link;
	private $disable;

	private $listorderproduct;

	/**
	 *
	 * @var DateTime  */
	public $create;
	/**
	 *
	 * @var DateTime  */
	public $update;
	public $new;
	public $hot;
	public $best;
	/**
	 *
	 * @var category
	 * */
	public $category;

	/**
	 *
	 * @var productimg*/
	public $productimg;

	public $category_id;


	public function __construct(){
		$this->id = '';
		$this->name = '';
		$this->price = 0;
		$this->image_link = '';
		$this->create = new DateTime();
		$this->new = null;
		$this->best = null;
		$this->category = new category();
	}

	public function iconHot(){
		if( $this->hot == 1 ){
			return ' <div style="font-size: 2em;" aria-hidden="true" data-icon="&#xe0e2;"></div> ';

		}

		if( $this->hot == 0 ){
			return ' <div style="font-size: 2em;" aria-hidden="true" data-icon="&#xe0eb;"></div> ';
		}
	}

	public function iconBest(){
		if( $this->best == 1 ){
			return ' <div style="font-size: 2em;" aria-hidden="true" data-icon="&#xe0e2;"></div> ';

		}

		if( $this->best == 0 ){
			return ' <div style="font-size: 2em;" aria-hidden="true" data-icon="&#xe0eb;"></div> ';
		}
	}
	public function getListorderproduct() {
		return $this->listorderproduct;
	}
	public function setListorderproduct($listorderproduct) {
		$this->listorderproduct = $listorderproduct;
		return $this;
	}
	public function getDisable() {
		return $this->disable;
	}
	public function setDisable($disable) {
		$this->disable = $disable;
		return $this;
	}


}