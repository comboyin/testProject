<?php
class OrderModel extends baseModel{
	/**
	 *
	 * @param Order $orderTemp  */
	public function genaraHTMLOrder( $orderTemp ){
		$name = $orderTemp->getName();
		$html = "<h1>Hi $name ! Your order. </h1>";

		// header
		$html .= '<table class="form_table table">';
		$html .= '<tbody>';

		$html .= '<tr>';
		$html .= '<td>Code bill: </td>';
		$html .= '<td>'.$orderTemp->getIdorder().'</td>';
		$html .= '</tr>';

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
		$html .= '<td>'.$orderTemp->getCreatetime()->format('Y-m-d h:i:s').'</td>';
		$html .= '</tr>';


		$html .= '</tbody>';

		// body

		$html .= '</table>';
		$html .= '<div style="max-height:370px;overflow: auto;">';
		$html .= '<table class="form_table table">';
		$html .= '<thead>';
		$html .= '<tr>';

		$html .= '<th>Image</th>';
		$html .= '<th>Product name</th>';
		$html .= '<th>Price</th>';
		$html .= '<th>Quality</th>';
		$html .= '<th>Total price</th>';
		$html .= '</tr>';
		$html .= '</thead>';

		$html .= '<tbody>';
		foreach ( $orderTemp->getListorderproduct() as $orderproduct ){
			/* @var $orderproduct OrderProduct */
			$html .= '<tr>';

			$html .= '<td> <img alt="" src="' . __DOMAIN . __FOLDER  .  __FOLDER_UPLOADS.'/' . $orderproduct->getProduct()->image_link . '"> </td>';
			$html .= '<td>'.$orderproduct->getProduct()->name.'</td>';
			$html .= '<td>'.utility::product_price( $orderproduct->getProduct()->price ).'</td>';
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

		return $html;
	}

	private function sendMail( $body, $email ){
		include_once __SITE_PATH . '/' . 'PHPMailer' . '/' . 'PHPMailerAutoload.php' ;

		$error = null;

		//Create a new PHPMailer instance
		$mail = new PHPMailer;

		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		$mail->CharSet = "UTF-8";

		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0;

		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
		$mail->isHTML(true);

		//Set the hostname of the mail server
		$mail->Host = 'smtp.gmail.com';
		// use
		// $mail->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6

		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;

		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';

		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;

		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = "comboyin1@gmail.com";

		//Password to use for SMTP authentication
		$mail->Password = 'Mainho7ngay';

		//Set who the message is to be sent from
		$mail->setFrom($email);

		//Set an alternative reply-to address
		$mail->addReplyTo($email);

		//Set who the message is to be sent to
		$mail->addAddress($email);

		//Set the subject line
		$mail->Subject = 'NhutShop - Mail xác nhận đơn đặt hàng.';

		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		//$mail->msgHTML('sadasdasdasd asd asdas');

		//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
		$mail->Body = $body;

		//Replace the plain text body with one created manually
		//$mail->AltBody = 'This is a plain-text message body';

		//send the message, check for errors
		if (!$mail->send()) {
			$error = "Gặp lỗi trong quá trình gởi mail.";
		}

		return $error;
	}



	/**
	 *
	 * @param Order $order  */
	public function addOrder( $order ){

		$error = null;
		$this->getPdo()->beginTransaction();
		try {
			// add order
			$order_name       = $order->getName();
			$order_phone      = $order->getPhone();
			$order_email      = $order->getEmail();

			$order_totalprice = $order->getTotalprice();
			$order_createtime = $order->getCreatetime()->format('Y-m-d h:i:s');
			$sql_insert_order = " INSERT INTO `order`( name, phone, totalprice, createtime, email )
								  VALUES( '$order_name','$order_phone', $order_totalprice, '$order_createtime', '$order_email' ) ";

			$stmt = $this->getPdo()->prepare( $sql_insert_order );
			$stmt->execute();

			// get order id new

			$sql_select_order = " SELECT * FROM `order` ORDER BY `order`.id desc ";

			$stmt = $this->getPdo()->prepare( $sql_select_order );
			$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Order');
			$stmt->execute();
			/* @var $orderNew Order */
			$orderNew = $stmt->fetch();

			$count = count( $order->getListorderproduct() );
			if( $count == 0 ){
				$error['Hóa đơn'][] = " Phải có ít nhất một sản phẩm được chọn. ";
			}

			/* @var $orderProduct OrderProduct */
			foreach ( $order->getListorderproduct() as $orderProduct ){
				$orderProduct_productId = $orderProduct->getProduct()->id;
				$orderProduct_orderId = $orderNew->getId();
				$orderProduct_quality = $orderProduct->getQuality();
				$orderProduct_totalPrice = $orderProduct->getTotalprice();
				$sql_insert_order_product = " INSERT INTO orderproduct ( quality, totalprice, product_id, order_id )
								VALUES( $orderProduct_quality, $orderProduct_totalPrice, $orderProduct_productId, $orderProduct_orderId ) ";
				$stmt = $this->getPdo()->prepare( $sql_insert_order_product );
				$stmt->execute();


				$orderTemp = $this->listOderByWhere(array(),array( 'start' => 0,'limit'=>1 ) );
				$orderTemp = $orderTemp[0];
				$order->setIdorder( $orderTemp->getIdorder() );
				// send mail
				$errorEmail = $this->sendMail( $this->genaraHTMLOrder( $order ), $order->getEmail() );

				if( $errorEmail != null ){
					$error['Hóa đơn'][] = $errorEmail;
				}

			}
		} catch (Exception $e) {
			$error['Hóa đơn'][] = $e->getMessage();
		}

		if( $error == null  ){
			$this->getPdo()->commit();
		}else{
			$this->getPdo()->rollBack();
		}
		return $error;
	}

	public function listOderByWhere( $stringWhere , $option = array() ){
		try {

			// create string sql
			$string = "";
			if( !empty( $stringWhere ) ){
				foreach ( $stringWhere as $key=>$where ){
					if( $key == 0 ){
						$string .= " WHERE $where ";
					}else{
						$string .= " and $where ";
					}
				}
			}

			if( $option == null ){
				$sql = " SELECT * FROM `order` $string ORDER BY `order`.id desc ";
			} else{
				$start = $option['start'];
				$limit = $option['limit'];
				$sql = " SELECT * FROM `order` $string ORDER BY `order`.id desc LIMIT $start,$limit ";
			}

			$sth = $this->getPdo()->prepare($sql);

			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Order');
			$sth->execute();

			$listorder = $sth->fetchAll();

			return $listorder;

		} catch (Exception $e) {
			echo $e->getMessage();
			return array();
		}
	}

	public function listOrderProduct( $idOrder ){
		$sql = " SELECT * FROM orderproduct where orderproduct.order_id = $idOrder ";
		$stmt = $this->getPdo()->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'OrderProduct');
		$stmt->execute();

		$orderProducts = $stmt->fetchAll();

		/* @var $productModel productModel */
		$productModel = new productModel();
		$productModel->setPdo( $this->getPdo() );

		foreach ($orderProducts as $value) {
			/* @var $value OrderProduct */
			$idProduct = $value->getProductId();

			$productTemp = $productModel->getProductById( $idProduct );

			$value->setProduct( $productTemp );

		}

		return $orderProducts;
	}

}