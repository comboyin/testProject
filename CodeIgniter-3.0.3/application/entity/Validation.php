<?php
class Validation {

	public function between($string,$option = array()){
		$min = isset($option['min'])? $option['min'] : 0;
		$max = isset($option['max'])? $option['max'] : 10;

		if(strlen($string) < $min || strlen($string) > $max){
			$error[] = "Length at least $min characters and maximum length of $max.";
		}

		return isset($error)?$error:null;
	}

	public function checkSymbol($string){
		$flag = true;
		$error = null;
		if ( preg_match ( '/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $string ) ) {
			$flag = false;
		}

		if( $flag == false ){
			$error[] = 'Value include the characters a-Z0-9';
		}

		return $error;
	}

	public function checkString($string) {
	    $error = null;
	    $flag = true;

	    if ( preg_match ( '/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $string ) ) {
	        $flag = false;
	    }

	    for($i = 0; $i < strlen ( $string ); $i ++) {

	        if (is_numeric ( $string [$i] )) {

	            $flag = false;
	            break;

	        }
	    }

	    if( $flag == false ){
	        $error[] = 'Value include the characters a-Z';
	    }

	    return $error;
	}

	public function checkPass($string){
	    $flag = true;
	    $error = null;
	    if ( preg_match ( '/[\'^£&*()}{~?><>,|=_+¬-]/', $string ) ) {
	        $flag = false;
	    }

	    if( $flag == false ){
	        $error[] = 'Value include the characters a-Z0-9 and special characters follow: @#$%!.';
	    }

	    return $error;
	}

	public function checkUsername($string){
	    $flag = true;
	    $error = null;
	    if ( preg_match ( '/[\'^£$%&*()}{@#~?><>,|=+¬-]/', $string ) ) {
	        $flag = false;
	    }

	    if( $flag == false ){
	        $error[] = 'Value include the characters a-Z0-9 and underscore';
	    }

	    return $error;
	}

	public function isNumberAndBetween($number,$option = array()){

		$min = isset($option['min'])? $option['min'] : 0;
		$max = isset($option['max'])? $option['max'] : 1000000000;
		if(!is_numeric($number)){
			$error[] = "Value is not numberic.";
			$error[] = "Number between $min and $max";
		}else{
			if($number < $min || $number > $max){
				$error[] = "Number between $min and $max";
			}
		}

		return isset($error)?$error:null;
	}

	public function isNumber($number){

		if(!is_numeric($number)){
			$error[] = "Value is not numberic.";
		}

		return isset($error)?$error:null;
	}

	public function checkEmpty($string){
		if(strlen($string) == 0){
			$error[] = "Value is empty.";
		}
		return isset($error) ? $error : null;
	}

	public function checkDate( $date ){
	    if ( !preg_match ("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date , $split) || !checkdate( $split[2], $split[3], $split[1] ) )
	    {
	        $error[] = "Please input correct the date. Format: yyyy-mm-dd";
	    }
	    return isset($error) ? $error : null;
	}
}