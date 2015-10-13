<?php
class accountModel extends baseModel
{

    public function listProductByWhere( $stringWhere , $option = array() ){
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
                $sql = " SELECT * FROM account $string ORDER BY account.id desc ";
            } else{
                $start = $option['start'];
                $limit = $option['limit'];
                $sql = " SELECT * FROM account $string ORDER BY account.id desc LIMIT $start,$limit ";
            }

            $sth = $this->getPdo()->prepare($sql);

            $sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'account');
            $sth->execute();

            $listAccount = $sth->fetchAll();

            return $listAccount;

        } catch (Exception $e) {
            echo $e->getMessage();
            return array();
        }
    }

    /**
     *
     * @param string $stringWhere
     * @return int  */
    public function totalAccountByWhere( $stringWhere ){
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

            $sql = " SELECT COUNT(*) AS total FROM account $string ";
            $stmt = $this->getPdo()->prepare($sql);
            $stmt->execute();

            $total = $stmt->fetch();
            // set productImg
            return $total['total'];
        } catch (Exception $e) {
            echo $e->getMessage();
            return array();
        }
    }

    public function deleteAccountById($id){
        $error = null;
        try {

            $this->getPdo()->beginTransaction();
            $sql = " DELETE FROM account WHERE account.id = '$id' ";
            /* @var $accountOlds account */
            $accountOlds = $this->listProductByWhere( array( " account.id = '$id' " ) );
            // check id
            if(  count( $accountOlds ) == 0 ){
                $error[] = "Account not exists.";
            }
            else{
                $accountOlds = $accountOlds[0];
                if( $accountOlds->type == 1 ){
                    $error[] = " You not pemission delete account type 'admin' ";
                }
            }
            if( $error == null ){
                $stmt = $this->getPdo()->prepare( $sql );
                $stmt->execute();
                $this->getPdo()->commit();
            }
        } catch (Exception $e) {
            $error[] = $e->getMessage();
            $this->getPdo()->rollBack();
            echo $e->getMessage();
        }

        return $error;
    }

    /**
     *
     * @param int $idaccount
     * @param string $newPassword
     * @return NULL  */
    public function updatePasswordAccount( $idaccount, $newPassword ){
        $error = null;
        $this->getPdo()->beginTransaction();
        try {

            /* @var $accountOld account */
            $accountOld = $this->listProductByWhere( array( " account.id = '$idaccount' " ) );

            // check id account

            if(  count( $accountOld )  == 0 ){
                $error['account'][] = "Account not exits";
            }

            if( $error == null ){
                $pass = md5( $newPassword );
                $sqlUpdateAccount = "UPDATE account
                    SET account.password = '$pass'
                     WHERE account.id = '$idaccount' ";
                $stmt = $this->getPdo()->prepare( $sqlUpdateAccount );
                $stmt->execute();
            }
           $this->getPdo()->commit();
        } catch (Exception $e) {
            echo $e->getMessage();
            $error[] = $e->getMessage();
            $this->getPdo()->rollBack();
        }

        return $error;
    }

    /**
     *
     * @param account $account
     * @return Ambigous <NULL, string>|unknown  */
    public function updateAccount( $account ){
        $error = null;
        $this->getPdo()->beginTransaction();
        try {
            $id = $account->id;
            $username = $account->username;
            $firstname = $account->firstname;
            $lastname = $account->lastname;
            $birthday = $account->birthday;
            $gender = $account->gender;
            $address = $account->address;
            $avatar = $account->avatar;
            // check account exits.
            /* @var $accountOld account */
            $accountOld = $this->listProductByWhere( array( " account.id = '$id' " ) );
            $fileOld = '';
            if(  count( $accountOld )  == 0 ){

                $error['username'][] = "Account not exits";
            }else{
            	// get avatar old
            	/* @var $accountOld account */
            	$accountOld = $accountOld[0];
            	$fileOld = $accountOld->avatar;

            	// username new == username old => ok
				if( $accountOld->username != $username ){

					$accountTemp = $this->listProductByWhere( array( " account.username = '$username' " ) );
					if( count( $accountTemp ) == 1 ){
						$error['username'][] = "Username account update exist.";
					}
				}

            	// username new != username old => check all user exist


            }
            // not error
            if( $error == null ){
                if( $avatar == '' ){
                    $sqlUpdateAccount = "UPDATE account
                    SET account.username = '$username', account.firstname = '$firstname', account.lastname = '$lastname', account.birthday = '$birthday', account.gender = '$gender', account.address = '$address'
                     WHERE account.id = $id ";
                }else{
                    $sqlUpdateAccount = "UPDATE account
                    SET account.username = '$username', account.firstname = '$firstname', account.lastname = '$lastname', account.birthday = '$birthday', account.gender = '$gender', account.address = '$address', account.avatar = '$avatar'
                    WHERE account.id = $id ";
                    if(file_exists(__SITE_PATH.'/'.__FOLDER_UPLOADS.'/'.$fileOld)){
                        unlink(__SITE_PATH.'/'.__FOLDER_UPLOADS.'/'.$fileOld);
                    }
                }
                // update product
                $stmt = $this->getPdo()->prepare($sqlUpdateAccount);
                $stmt->execute();
            }
            $this->getPdo()->commit();
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->getPdo()->rollBack();
            $error[] = $e->getMessage();
        }
        return $error;
    }

    /**
     *
     * @param account $account
     * @return NULL  */
    public function addNewAccount( $account ){
        $error = null;
        $this->getPdo()->beginTransaction();
        try {
            $username = $account->username;
            $firstname = $account->firstname;
            $lastname = $account->lastname;
            $password =  md5( $account->password );
            $birthday = $account->birthday  ;
            $gender = $account->gender;
            $address = $account->address;
            $avatar = $account->avatar;

            $accountTemp = $this->listProductByWhere( array( " account.username = '$username' " ) );

            if( count( $accountTemp ) == 1 ){
            	$error['username'][] = " Username exits.";
            }

            if( $error == null ){
            	$sqlInsertAccount = "INSERT INTO account ( username, firstname, lastname, password, birthday, gender, address, avatar) VALUES
            	( '$username', '$firstname', '$lastname', '$password' , '$birthday', $gender, '$address' ,'$avatar') ";
            	$stmt = $this->getPdo()->prepare( $sqlInsertAccount );
            	$stmt->execute();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            $error[] = $e->getMessage();
            $this->getPdo()->rollBack();
            return $error;
        }
        $this->getPdo()->commit();
        return $error;
    }

    /**
     * save account to database
     * @param array $account
     * @return multitype:boolean string |multitype:boolean string NULL
     */
    public function saveAccount($account) {
        try {
            $first_name = $account ['first_name'];
            $last_name = $account ['last_name'];
            $user_name = $account ['user_name'];
            $password = md5(trim($account ['password']));

            $month = $account ['month'];
            $day = $account ['day'];
            $year = $account ['year'];
            $sex = $account ['sex'];
            $address = $account ['address'];
            $temp = explode('/', $account ['file']);
            $avatar = $temp[1] ;

            $kq = array ();
            $kq ['bool'] = true;
            $kq ['mess'] = "";

            // check user
            $bool = $this->checkUser($user_name);
            if($bool['bool']==true){
                $kq ['bool'] = false;
                $kq ['mess'] = "Username exists";
                return $kq;
            }
            $this->getPdo()->beginTransaction ();

            // save database

            $sql = "insert into account(username,firstname,lastname,password,birthday,gender,address,avatar)
            values('$user_name','$first_name','$last_name','$password','$year-$month-$day',$sex,'$address','$avatar')";

            $this->getPdo()->exec ( $sql );
            // OK
            $this->getPdo()->commit ();
            // close connect
            $kq['user'] = $user_name;
            return $kq;
        } catch ( Exception $e ) {
            $kq ['bool'] = false;
            $kq ['mess'] = $e->getMessage ();
            $this->getPdo()->rollBack ();
            return $kq;
        }
    }
    /**
     * check username
     * @param string $username
     * @return array */
    public function checkUser($username) {
        try {
            $kq = array ();
            $sql = "select * from account where username = '$username'";
            $stmt = $this->getPdo()->prepare ( $sql );
            $stmt->execute ();

            $result = $stmt->fetchAll ();
            if (count ( $result ) == 1) {
                $kq ['bool'] = true;
                $kq ['mess'] = "username exists";
            }else {
            	$kq ['bool'] = false;
            	$kq ['mess'] = "username not exists";
            }
            return $kq;
        } catch ( Exception $e ) {
            $kq ['bool'] = false;
            $kq ['mess'] = $e->getMessage();
            return $kq;
        }
    }
    /**
     * get info user
     * @param string $username
     * @return array */
    public function getUser($username) {
        try {

            $sql = "select * from account where username = '$username'";
            $stmt = $this->getPdo()->prepare ( $sql );
            $stmt->execute ();

            $result = $stmt->fetchAll ();

            if(count($result)==1){
                return $result[0];
            }
            return null;
        } catch ( Exception $e ) {

            return null;
        }
    }
	/**
	 *
	 * @param string $user
	 * @param string $pass
	 * @return boolean|account  */
    public function checkLogin($user,$pass){
    	try {
    		$passMD5 = md5($pass);
    		$sql = "select * from account where username = '$user' and password = '$passMD5'";
    		$stmt = $this->getPdo()->prepare ( $sql );
    		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'account');
    		$stmt->execute();
    		$result = $stmt->fetch();
			return $result;
    	} catch (Exception $e) {
    		return false;
    	}

    }
}
?>