<?php
class cartController extends baseController{
	public function index( $arg= array()){

	}

	public function order(){

		/*
		 * TH01 : error captcha
		 * TH02 : error name and phone
		 * TH03 : success
		 *   */

		$error   = null;
		$name    = ( isset( $_POST['name'] )) ? $_POST['name'] : '';
		$phone   = ( isset( $_POST['phone'] )) ? $_POST['phone'] : '';
		$captcha = ( isset( $_POST['captcha'] )) ? $_POST['captcha'] : '';
		$email   = ( isset( $_POST['email'] )) ? $_POST['email'] : '';

		// captcha
		if( $captcha != $_SESSION['acl']['captcha']['code'] ){
			$error['captcha'][] = 'Chuổi captcha không đúng.';
		}
		else{
			// validation
			$vail = new validation();

			// name
			if( ( $vail->checkEmpty( $name ) ) != null ){
				utility::pushArrayToArray( $error['Họ và tên'] , array( 'Họ tên không bỏ trống' ) );
			}

			if( ( $vail->between( $name , array( 'min'=>8,'max'=>30 )) ) != null ){
				utility::pushArrayToArray( $error['Họ và tên'] , array( 'Họ tên có 8 đến 30 kí tự.' ) );
			}

			// phone
			if( ( $vail->checkEmpty( $phone ) ) != null ){
				utility::pushArrayToArray( $error['Số điện thoại'] , array( 'Số điện thoại không bỏ trống.' ) );
			}

			if( ( $vail->isNumber( $phone ) ) != null ){
				utility::pushArrayToArray( $error['Số điện thoại'] , array( 'Số điện thoại phải là số.' ) );
			}

			if( ( $vail->between( $phone , array( 'min'=>10,'max'=>11 )) ) != null ){
				utility::pushArrayToArray( $error['Số điện thoại'] , array( 'Số điện thoại có 10 và 11 số' ) );
			}

			// email
			if( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
				utility::pushArrayToArray( $error['Email'] , array( 'Email không hợp lệ.' ) );
			}

			if( $error == null ){

				// add to database
				/* @var $orderModel OrderModel */
				$orderModel = $this->model->get('Order');
				/* @var $account account */
				$account = $_SESSION['acl']['account'];
				$order = $account->getOrder();
				$order->setName($name);
				$order->setPhone($phone);
				$order->setCreatetime(new DateTime());
				$order->setEmail( $email );
				$error = $orderModel->addOrder( $order );

				if( $error == null ){
					// clean session
					$order = new Order();
					$account->setOrder( $order );
				}
			}

		}

		echo json_encode(
				array( 'error' => $error )
			);
		exit(0);

	}



	public function addCart( $arg ){
		$error = null;
		if( isset( $arg[1] ) ){
			$quality = 1;
			if( isset( $arg[2] ) && $arg[2] >0 ){
				$quality = $arg[2];
			}
			$idproduct = $arg[1];
			/* @var $account account */
			$account = $_SESSION['acl']['account'];
			$order = $account->getOrder();
			/* @var $productModel productModel */
			$productModel = $this->model->get('product');
			$productTemp = $productModel->getProductById( $idproduct );
			if( $productTemp == null ){
				$error[] = "Không tồn tại mã sản phẩm.";
			}
			if( $error == null ){
				// check if exists
				$checkExist = 0;
				/* @var $orderProductTemp OrderProduct */
				foreach ( $order->getListorderproduct() as $orderProductTemp ){
					if( $orderProductTemp->getProduct()->id == $idproduct ){
						$orderProductTemp->setQuality( $quality + $orderProductTemp->getQuality() );
						$checkExist = 1;
						break;
					}
				}

				if( $checkExist == 0  ){
					// new orderproduct
					$orderProduct = new OrderProduct();
					// set product to orderproduct
					$orderProduct->setProduct($productTemp);
					$orderProduct->setOrder($order);
					// set quality
					$orderProduct->setQuality( $quality );
					$order->addOderProduct( $orderProduct );
				}

			}
		}else{
			$error[] = "Không tồn tại mã sản phẩm.";
		}
		echo json_encode( array( 'error' => $error ) );
		exit(0);
	}

	public function getTableCart(){
		/* @var $account account */

		$account = $_SESSION['acl']['account'];
		$order = $account->getOrder();
		$listOrderProduct = $order->getListorderproduct();
		$html = "";
		/* @var $orderProduct OrderProduct */
		foreach ( $listOrderProduct as $orderProduct ){
			$html .= '<tr idProduct="'.$orderProduct->getProduct()->id.'">';
			$html .= '<td><input name="quantity" type="number" maxlength="2" value="'. $orderProduct->getQuality() .'" min="1" max="99"></td>';
			$html .= '<td> '.$orderProduct->getProduct()->name.' </td>';
			$html .= '<td> '. $orderProduct->getProduct()->price .' </td>';
			$html .= '<td> '. $orderProduct->getTotalprice() .' </td>';
			$html .= '<td><button class="btn OrderProduct_Delete">Xóa</button></td>';
			$html .= '</tr>';
		}

		echo $html;
		exit(0);
	}

	public function editQualityOderProduct(){

		$error= null;
		$quality = ( isset( $_POST['quality'] ) && is_numeric( $_POST['quality'] )  ) ? $_POST['quality'] : null;
		$idProduct = ( isset( $_POST['idProduct'] ) && is_numeric( $_POST['idProduct'] )  ) ? $_POST['idProduct'] : null;
		// check quality
		if( $quality == null ){
			$error[] = "Số lượng không tồn tại.";
		}
		if( $quality > 99 ){
			$error[] = "Mỗi mặt hàng chỉ mua tối đa được 99.";
		}
		// check id product
		/* @var $productModel productModel */
		$productModel = $this->model->get('product');
		$productTemp = $productModel->getProductById( $idProduct );
		if( $idProduct == null || $productTemp == null ){
			$error[] = "Không tồn tại mã sản phẩm.";
		}

		if( $error == null ){

			$orderproductInOrderProduct = null;
			/* @var $account account */
			$account = $_SESSION['acl']['account'];
			$order = $account->getOrder();
			foreach ( $order->getListorderproduct() as $orderProductTemp ){
				/* @var $orderProductTemp OrderProduct */
				if( $orderProductTemp->getProduct()->id == $idProduct ){
					$orderproductInOrderProduct = $orderProductTemp;
					break;
				}
			}

			if( $orderproductInOrderProduct != null  ){
				$orderproductInOrderProduct->setQuality( $quality );
			}else{
				$error[] = "Hiện tại mã sản phẩm này không có trong giỏ hàng.";
			}
		}

		echo json_encode( array( 'error' => $error ) );
		exit(0);
	}

	public function deleteOrderProductInOrder(){
		$error = null;

		$idProduct = ( isset( $_POST['idProduct'] ) ) ? $_POST['idProduct'] : '';
		/* @var $account account */
		$account = $_SESSION['acl']['account'];
		$order = $account->getOrder();
		/* @var $productModel productModel */
		$productModel = $this->model->get('product');
		$productTemp = $productModel->getProductById( $idProduct );
		if( $idProduct == null || $productTemp == null ){
			$error[] = "Không tồn tại mã sản phẩm.";
			$OrderProductTemp = $order->findOderProductByIdProduct( $idProduct );
			if( $OrderProductTemp != null ){
				$order->removeOrderProduct( $idProduct );
			}
		}

		// check order product in session
		$OrderProductTemp = $order->findOderProductByIdProduct( $idProduct );
		if( $OrderProductTemp == null ){
			$error[] = "Hiện tại mã sản phẩm này không có trong giỏ hàng.";
		}
		if( $error == null ){
			$order->removeOrderProduct( $idProduct );
		}
		echo json_encode( array( 'error' => $error ) );
		exit(0);
	}

	public function checkOrderProduct( ){
		$error = null;
		$idProduct = ( isset( $_POST['idproduct'] ) ) ? $_POST['idproduct'] : '';
		/* @var $account account */
		$account = $_SESSION['acl']['account'];
		$order = $account->getOrder();
		/*
		 * TH01: not exist in database 0
		 * TH02: not exist in cart     1
		 * TH03: exist in cart         2*/
		/* @var $productModel productModel */
		$productModel = $this->model->get('product');
		$productTemp = $productModel->getProductById( $idProduct );

		if( $idProduct == null || $productTemp == null ){
			$error = 0;
			$OrderProductTemp = $order->findOderProductByIdProduct( $idProduct );
			if( $OrderProductTemp != null ){
				$order->removeOrderProduct( $idProduct );
			}
		}

		/* @var $account account */
		$account = $_SESSION['acl']['account'];
		$order = $account->getOrder();

		// check order product in session
		$OrderProductTemp = $order->findOderProductByIdProduct( $idProduct );
		if( $OrderProductTemp == null ){
			$error = 1;
		}
		if( $error == null ){
			$error = 2;
		}
		echo json_encode( array( 'error' => $error ) );
		exit(0);
	}

	public function getItemOrderProduct(){
		//$idProduct = ( isset( $arg[1] ) ) ? $arg[1] : '';
		$idProduct = ( isset( $_POST['idproduct'] ) ) ? $_POST['idproduct'] : '';
		/* @var $account account */
		$account = $_SESSION['acl']['account'];
		$order = $account->getOrder();
		$OrderProductTemp = $order->findOderProductByIdProduct( $idProduct );
		$totalprice = $OrderProductTemp->getTotalprice();

		echo json_encode( array(
				'totalprice' => $totalprice
				));
		exit(0);
	}

	public function totalOrderPrice(){

		/* @var $account account */
		$account = $_SESSION['acl']['account'];
		$order = $account->getOrder();
		$totalprice = $order->getTotalprice();
		echo json_encode(
				array(
				'totalorderprice' => utility::product_price($totalprice)
					)
		);
		exit(0);
	}

	public function createCaptcha(){
		$_SESSION['acl']['captcha'] = simple_php_captcha();

		echo json_encode( $_SESSION['acl']['captcha'] );
		exit(0);
	}

	public function getCaptcha(){

		echo json_encode( $_SESSION['acl']['captcha'] );
		exit(0);
	}
}