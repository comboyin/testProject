<?php
class cartController extends baseController {


	public function index($arg = array()) {
		$config_pagination = $this->registry->pagination;

		if(isset($arg[1])){
			$config_pagination['current_page'] = $arg[1];
		}

		/* @var $modelOrder OrderModel */
		$modelOrder = $this->model->get('Order');
		// total record
		$config_pagination['total_record'] = count( $modelOrder->listOderByWhere(array() ) ) ;
		// link first
		$config_pagination['link_first'] = $this->url(array('module'=>'backend','controller'=>'cart','action' => 'index'));
		// link page
		$config_pagination['link_full'] = $this->url(array('module'=>'backend','controller'=>'cart','action' => 'index')) . '/' . '{page}';

		$pagination = new pagination($config_pagination);

		$configPagiantion = $pagination->getConfig();

		$listCart = $modelOrder->listOderByWhere(array(),
				array(
						'start' => $configPagiantion['start'],
						'limit' => $configPagiantion['limit']
				));

		$this->getView()->content->listCart = $listCart;
		$this->getView()->content->pagination = $pagination;

	}

	public function loadListOrderProduct($arg){
		$error     = null;
		$orderTemp = null;
		$html      = '';
		$idOrder   = ( isset( $arg[1] ) && is_numeric( $arg[1] ) ) ? $arg[1] : '';
		/* @var $orderModel OrderModel */
		$orderModel = $this->model->get('Order');
		$orderTemp = $orderModel->listOderByWhere(array( " `order`.id = '$idOrder' " ));

		if( count( $orderTemp )  == 0 ){
			$error[] = " Order not exist. ";
		}

		if( $error == null ){
			/* @var $orderTemp Order */
			$orderTemp = $orderTemp[0];

			$listOrderProduct = $orderModel->listOrderProduct( $idOrder );

			$orderTemp->setListorderproduct( $listOrderProduct );

			// create html

			// header
			$html .= '<table class="form_table table">';
			$html .= '<tbody>';
				$html .= '<tr>';
				$html .= '<td>Name: </td>';
				$html .= '<td>'.$orderTemp->getName().'</td>';
				$html .= '</tr>';

				$html .= '<tr>';
				$html .= '<td>Phone: </td>';
				$html .= '<td>'.$orderTemp->getPhone().'</td>';
				$html .= '</tr>';

				$html .= '<tr>';
				$html .= '<td>Create time: </td>';
				$html .= '<td>'.$orderTemp->getCreatetime().'</td>';
				$html .= '</tr>';
			$html .= '</tbody>';

			// body

			$html .= '</table>';
			$html .= '<div style="max-height:370px;overflow: auto;">';
			$html .= '<table class="form_table table">';
			$html .= '<thead>';
				$html .= '<tr>';
				$html .= '<th>Id product</th>';
				$html .= '<th>Image</th>';
				$html .= '<th>Product name</th>';
				$html .= '<th>Quality</th>';
				$html .= '<th>Total price</th>';
				$html .= '</tr>';
			$html .= '</thead>';

			$html .= '<tbody>';
				foreach ( $orderTemp->getListorderproduct() as $orderproduct ){
					/* @var $orderproduct OrderProduct */
					$html .= '<tr>';
						$html .= '<td>'.$orderproduct->getProductId().'</td>';
						$html .= '<td> <img alt="" src="' . __FOLDER  .  __FOLDER_UPLOADS.'/' . $orderproduct->getProduct()->image_link . '"> </td>';
						$html .= '<td>'.$orderproduct->getProduct()->name.'</td>';
						$html .= '<td>'.$orderproduct->getQuality().'</td>';
						$html .= '<td>'.utility::product_price($orderproduct->getTotalprice()).'</td>';
					$html .= '</tr>';
				}

					$html .= '</tbody>';
				$html .= '</table>';
			$html .= '</div>';
			$html .= '<table class="form_table table">';
				$html .= '<tbody>';
					$html .= '<tr>';
						$html .= '<td>Total price: </td>';
						$html .= '<td>'.utility::product_price($orderTemp->getTotalprice()).'</td>';
					$html .= '</tr>';
				$html .= '</tbody>';
			$html .= '</table>';
		}

		$rs = array(
			'error' => $error,
			'html'  => $html
		);

		echo json_encode($rs);

		exit(0);
	}
}