<?php 
 $site_path = realpath(dirname(__FILE__));
 define ('__SITE_PATH', $site_path);

function sendMail( $contentBody , $email ){
	include_once __SITE_PATH . '/' . 'PHPMailer' . '/' . 'PHPMailerAutoload.php' ;

	$error = "success";

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

	$mail->Body = $contentBody;
	
	//send the message, check for errors
	if (!$mail->send()) {
		$error = "Gặp lỗi trong quá trình gởi mail.";
	}

	return $error;
}

function getContentTemplate( $email, $url ){
	$content = "";
	if( file_exists(__SITE_PATH . '/' . 'template.html') ){
		$content = file_get_contents(__SITE_PATH . '/' . 'template.html');
		$content = str_replace("{email}", $email, $content);
		$content = str_replace("{url}", $url, $content);
	}
	return $content;
}

$emailSend = "trannhut031192@gmail.com";
$urlActive = "http://domain.com/user/action/active/key_asdjabsdkjasbdkjabsdkas";
$content = getContentTemplate($emailSend, $urlActive);
echo sendMail( $content, $emailSend );

?>