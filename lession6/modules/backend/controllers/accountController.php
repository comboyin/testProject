<?php
class accountController extends baseController{

    public function index($arg = array()){
        $config_pagination = $this->registry->pagination;

        if(isset($arg[1])){
            $config_pagination['current_page'] = $arg[1];
        }

        $modelAccount = $this->model->get('account');
        // total record
        $config_pagination['total_record'] = $modelAccount->totalAccountByWhere(array());
        // link first
        $config_pagination['link_first'] = $this->url(array('module'=>'backend','controller'=>'account','action' => 'index'));
        // link page
        $config_pagination['link_full'] = $this->url(array('module'=>'backend','controller'=>'account','action' => 'index')) . '/' . '{page}';

        $pagination = new pagination($config_pagination);

        $configPagiantion = $pagination->getConfig();

        $listAccount = $modelAccount->listProductByWhere(array(" account.type != 1  "),
            array(
                'start' => $configPagiantion['start'],
                'limit' => $configPagiantion['limit']
            ));


        // param to view

        $this->getView()->content->listAccount = $listAccount;
        $this->getView()->content->pagination = $pagination;
    }

    public function updateAccount(){
        $error = null;
        $idaccount = isset( $_POST['idaccount'] ) ? $_POST['idaccount'] : '';
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
        $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
        $birthday = isset($_POST['birthday']) ? $_POST['birthday'] : '';
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '1';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $avatar = isset($_FILES['avatar']) ? $_FILES['avatar'] : '';


        $error = $this->validationNewAccout();
        $producOption = $this->registry->Product;
        $valid = new validation();

        // avatar
        if( $avatar != '' ){
            if( ( $errorAvatar = $valid->fileImageValidation( $avatar , $producOption ) ) != null){
                if( is_array( $errorAvatar ) ){
                    utility::pushArrayToArray( $error[ 'avatar' ], $errorAvatar );
                }else if( is_string( $errorAvatar ) ){
                    $imageFileName = $errorAvatar;
                }
            }
        }
        // not error
        if($error == null ){
             /* @var $modelAccount accountModel */
            $modelAccount = $this->model->get('account');
            // create object account
            $newAccount = new account();
            $newAccount->id = $idaccount;
            $newAccount->username = $username;
            $newAccount->firstname = $firstname;
            $newAccount->lastname = $lastname;
            $newAccount->birthday = $birthday;
            $newAccount->gender = $gender;
            $newAccount->address = $address;
            $newAccount->avatar = isset($imageFileName) ? $imageFileName : '';

            $error = $modelAccount->updateAccount($newAccount);
        }
        $resuft =  array(
            'error' => $error
        );
        header('Content-Type: application/json');
        echo json_encode($resuft);
        exit(0);
    }

    public function deleteAccount(){
        $error = null;
        if( isset( $_POST["id"] ) ){
            $id = $_POST['id'];
            /* @var $accountModel accountModel */
            $accountModel = $this->model->get( 'account' );
            $error = $accountModel->deleteAccountById( $id );
            $resuft =  array(
                'error' => $error
            );
            header('Content-Type: application/json');
            echo json_encode($resuft);
        }
        exit(0);
    }

    public function changePassword(){
        $error = null ;
        $idaccount = isset( $_POST['idaccount'] ) ? $_POST['idaccount'] : '';
        $newpassword = isset($_POST['newpassword']) ? $_POST['newpassword'] : '';
        $renewpassword = isset($_POST['renewpassword']) ? $_POST['renewpassword'] : '';

        // validation

        // id
        /* @var $accountModel accountModel */
        $accountModel = $this->model->get( 'account' );
        $accountId = $accountModel->listProductByWhere( array( " account.id = '$idaccount' " ) ) ;
        if( count( $accountId ) == 0 ){
            utility::pushArrayToArray( $error['Account'] , array( 'Account not exist.' ) );
        }
        $valid = new validation();

        // pass
        if( ( $errorPassEmpty = $valid->checkEmpty( $newpassword ) ) != null){
            utility::pushArrayToArray( $error['password'], $errorPassEmpty );
        }
        if( ( $errorNewPass = $valid->between( $newpassword, array('min'=>6, 'max'=>30) )) != null ){
            utility::pushArrayToArray( $error['password'], $errorNewPass );
        }
        if( $newpassword != $renewpassword ){
            utility::pushArrayToArray( $error['password'] , array( 'Password not match' ) );
        }

        if( $error == null  ){

            $error = $accountModel->updatePasswordAccount( $idaccount , $newpassword);
        }
        $resuft = array(
            'error' => $error
        );
        header('Content-Type: application/json');
        echo json_encode($resuft);
        exit(0);
    }

    public function getAccount( $arg ){
        $error = null;
        $account = null;
        if( isset($arg[1]) ){
            $idAccount = $arg[1];
            /* @var $modelAccount accountModel */
            $modelAccount = $this->model->get('account');
            $account = $modelAccount->listProductByWhere( array(" account.id = '$idAccount' ") );
            $error = null;

            if( count( $account ) == 0 ){
                $error[] = "Account not exist.";
            }

            if( $error == null ){
                $account = $account[0];
                $account->password = '';
                $account->avatar = __FOLDER . __FOLDER_UPLOADS . '/' . $account->avatar ;
            }


            $resuft = array(
                'error' => $error,
                'account' => $account
            );

            header('Content-Type: application/json');
            echo json_encode($resuft);
        }
        exit(0);
    }


    public function addNewAccount(){

        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
        $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
        $birthday = isset($_POST['birthday']) ? $_POST['birthday'] : '';
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '1';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $repassword = isset($_POST['repassword']) ? $_POST['repassword'] : '';
        $avatar = isset($_FILES['avatar']) ? $_FILES['avatar'] : array();


        $error = $this->validationNewAccout();
        $producOption = $this->registry->Product;
        $valid = new validation();

        // password

        if( ($errorPassEmpty = $valid->checkEmpty( $password ) ) != null){
            utility::pushArrayToArray( $error['password'], $errorPassEmpty);
        }
        if(( $errorPass = $valid->between( $password, array('min'=>6, 'max'=>30) )) != null){
            utility::pushArrayToArray($error['password'], $errorPass);
        }
        if( $password != $repassword ){
            utility::pushArrayToArray($error['password'], array( 'Password not match.' ) );
        }



        // avatar
        if( ( $errorAvatar = $valid->fileImageValidation( $avatar , $producOption ) ) != null){
            if( is_array( $errorAvatar ) ){
                utility::pushArrayToArray( $error[ 'avatar' ], $errorAvatar );
            }else if( is_string( $errorAvatar ) ){
                $imageFileName = $errorAvatar;
            }
        }

        // not error
        if($error == null ){

            /* @var $modelAccount accountModel */
            $modelAccount = $this->model->get('account');
            // create object account
            $newAccount = new account();
            $newAccount->username = $username;
            $newAccount->firstname = $firstname;
            $newAccount->lastname = $lastname;
            $newAccount->birthday = $birthday;
            $newAccount->gender = $gender;
            $newAccount->address = $address;
            $newAccount->avatar = $imageFileName;
            $newAccount->password = $password;

            $error = $modelAccount->addNewAccount( $newAccount );

        }

        $resuft =  array(
            'error' => $error
        );
        header('Content-Type: application/json');
        echo json_encode($resuft);
        exit(0);

    }

    private function validationNewAccout(){

        $producOption = $this->registry->Product;

        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
        $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
        $birthday = isset($_POST['birthday']) ? $_POST['birthday'] : '';
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '1';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $avatar = isset($_FILES['avatar']) ? $_FILES['avatar'] : array();


        $valid = new validation();
        // user name
        if( ($errorUserNameEmpty = $valid->checkEmpty( $username )) != null){
            utility::pushArrayToArray($error['username'], $errorUserNameEmpty);
        }
        if(($errorUserNameSymbol = $valid->checkSymbol( $username ) ) != null){
        	utility::pushArrayToArray( $error['username'], $errorUserNameSymbol );
        }
        if(($errorUserName = $valid->between( $username, array('min'=>5, 'max'=>30) )) != null){
            utility::pushArrayToArray($error['username'], $errorUserName);
        }


        // first name
        if( ( $errorFirstNameEmpty = $valid->checkEmpty( $firstname ) ) != null){
            utility::pushArrayToArray($error['first name'], $errorFirstNameEmpty);
        }
        if(( $errorFirstName = $valid->between( $firstname, array('min'=>3, 'max'=>50) )) != null){
            utility::pushArrayToArray($error['first name'], $errorFirstName);
        }

        if( ( $errorFirstNameString = $valid->checkString( $firstname ) != null ) ){
            utility::pushArrayToArray($error['first name'], $errorFirstNameString);
        }

        // last name
        if( ($errorLastNameEmpty = $valid->checkEmpty($lastname)) != null){
            utility::pushArrayToArray($error['last name'], $errorLastNameEmpty);
        }
        if(($errorLastName = $valid->between( $lastname, array('min'=>3, 'max'=>50) )) != null){
            utility::pushArrayToArray($error['last name'], $errorLastName);
        }
        if( ( $errorLastNameString = $valid->checkString( $lastname ) ) != null ) {
            utility::pushArrayToArray($error['last name'], $errorLastNameString);
        }

        // birthday
        $split = array();
        if( ($errorBirthdayEmpty = $valid->checkEmpty($birthday)) != null){
            utility::pushArrayToArray($error['birthday'], $errorBirthdayEmpty);
        }
        if ( !preg_match ("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $birthday , $split) || !checkdate( $split[2], $split[3], $split[1] ) )
        {
            utility::pushArrayToArray($error['birthday'], array( 'Birthday format yyyy-mm-dd .' ) );
            utility::pushArrayToArray($error['birthday'], array( 'Value birthdat is not DATE.' ) );
        }

        // gender
        if( ( $errorGender = $valid->isNumber($gender) ) != null){
            utility::pushArrayToArray($error['gender'], $errorGender);
            utility::pushArrayToArray($error['gender'],array("Gender is not invalid."));
        }else{
            if($gender != 0 && $gender != 1){
                utility::pushArrayToArray($error['gender'],array("Gender is not invalid."));
            }
        }

        // address
        if( ($errorAddressEmpty = $valid->checkEmpty($address)) != null){
            utility::pushArrayToArray($error['address'], $errorAddressEmpty);
        }
        if(($errorAddress = $valid->between( $address, array('min'=>8, 'max'=>100) )) != null){
            utility::pushArrayToArray($error['address'], $errorAddress);
        }



        return isset($error) ? $error : null;
    }

}