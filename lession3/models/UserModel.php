<?php
class UserModel extends baseModel{

	/**
	 *
	 * @param string $user
	 * @param string $pass
	 * @return boolean|account  */
    public function checkLogin($user,$pass){
    	try {
    		$passMD5 = md5($pass);
    		$sql = "select * from user where username = '$user' and password = '$passMD5'";
    		$stmt = $this->getPdo()->prepare ( $sql );
    		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
    		$stmt->execute();
    		/* @var $result User */
    		$result = $stmt->fetch();
			$idGroup = $result->getGroupId();
    		if( $result  !== false ){
				$sqlGroup = "select * from `group` where `group`.id = $idGroup";
				$stmt = $this->getPdo()->prepare ( $sqlGroup );
				$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Group');
				$stmt->execute();
				$resultGroup = $stmt->fetch();
				$result->setGroup( $resultGroup );
    		}
			return $result;
    	} catch (Exception $e) {
    		return false;
    	}

    }


}