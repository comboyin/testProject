<?php
class indexController extends baseController

{
    /* begin global */
    private $validation_max_file_size = 140000;
    private $validation_min_username = 4;
    private $validation_max_username = 30;
    /* end global */
    public function index($arg = array())
    {
        /* @var $modelProduct productModel */
        $modelProduct = $this->model->get('product');
        // product new

        $productNew = $modelProduct->listProductByWhere(
        		array( ' product.disable = 0 ') ,
        		array( 'start'=>0 , 'limit'=>9 ) );

        // product best

        $productBest = $modelProduct->listProductByWhere( array( ' product.disable = 0 ' , ' product.best = 1 ') , array( 'start'=>0 ,'limit'=>9 ) );

        $productHots = $modelProduct->listProductByWhere( array( ' product.hot = 1 ', ' product.disable = 0 ' ), array( 'start'=>0 ,'limit'=>9 ) );

        $this->getView()->content->productHots = $productHots;
        $this->getView()->content->productNew = $productNew;
        $this->getView()->content->productBest = $productBest;


    }
    public function test(){

    }
    public function productDetail(){

    }

    public function product($arg){
		if(isset($arg[1])){
			// check $arg[1]

			$idCategory = $arg[1];

			/* @var $modelCategory categoryModel */
			$modelCategory = $this->model->get('category');
			if( ($category = $modelCategory->getCategoryById($idCategory)) != null ){

				$config_pagination = $this->registry->pagination;

				if(isset($arg[2])){
					$config_pagination['current_page'] = $arg[2];
				}
				/* @var $modelProduct productModel */
				$modelProduct = $this->model->get('product');
				// total record
				$config_pagination['total_record'] = $modelProduct->totalProductByCategory($idCategory);
				// link first
				$config_pagination['link_first'] = $this->url(array('module'=>'fronend','controller'=>'index','action' => 'product')) . '/' . $idCategory;
				// link page
				$config_pagination['link_full'] = $this->url(array('module'=>'fronend','controller'=>'index','action' => 'product')) . '/'. $idCategory . '/' . '{page}';

				$pagination = new pagination($config_pagination);

				$configPagiantion = $pagination->getConfig();

				$listProduct = $modelProduct->listProductByCategory( $idCategory,
						array(
								'start' => $configPagiantion['start'],
								'limit' => $configPagiantion['limit']
						));

				// param to view
				$this->getView()->content->category = $category;
				$this->getView()->content->listProduct = $listProduct;
				$this->getView()->content->pagination = $pagination;

			}else{
				$this->redirect( $this->url( array( 'module'=>'error','controller'=>'error404','action' => 'index' ) ) );
			}
		}else{
			// not exists arg[1]
		}
    }

    public function productManager(){

    }
    public function accountDetail(){
    	//session_start();
    	if(isset($_POST['back']) && $_POST['back']=='Back'){
    		session_unset();
    		header("Location: ".__FOLDER."index.php?rt=fronend/index/createAccount");
    		exit(0);
    	}
    	$arUser = null;
    	if(isset($_SESSION['user'])){
    		$model =$this->model->get('accountModel');
    		$arUser = $model->getUser($_SESSION['user']);
    	}
    	$this->getView()->content->arUser = $arUser;
    }

    public function previewAccount(){
        //session_start ();

        if(isset($_SESSION['user'])){
            header ( "Location: ".__FOLDER."index.php?rt=fronend/index/accountDetail");
            exit ( 0 );
        }
        /* Nếu không tồn tại session error  -> create_account.php*/
        if(!isset($_SESSION['error'])){
            header ( "Location: ".__FOLDER."index.php?rt=fronend/index/createAccount");
            exit ( 0 );
        }
        /*Nếu tồn tại session error và session error == true  */
        if(isset($_SESSION['error']) && $_SESSION['error']==true){
            header ( "Location: ".__FOLDER."index.php?rt=fronend/index/createAccount");
            exit ( 0 );
        }
        if(isset($_POST["back"]) && $_POST["back"]=="Back"){
            if(isset($_SESSION['error']) && $_SESSION['error']==false){
                if(file_exists($_SESSION['file'])){
                    unlink($_SESSION['file']);
                }

                $_SESSION['error'] = true;

                header ( "Location: ".__FOLDER."index.php?rt=fronend/index/createAccount");
                exit ( 0 );
            }
        }
        if(isset($_POST["save"]) && $_POST["save"] == "Save"){
            $model = $this->model->get('account');

            $kq = $model->saveAccount($_SESSION);

            if($kq['bool']==true){
                $_SESSION['user'] = $kq['user'];
                header ( "Location: ".__FOLDER."index.php?rt=fronend/index/accountDetail");
                exit(0);
            }else if($kq['bool']==false){
                $error = $kq['mess'];
            }
        }

        if(isset($error)){
            $this->getView()->content->error = $error;
        }

    }

    public function createAccount(){

        //session_start ();
        if(isset($_SESSION['user'])){
            header ( "Location: ".__FOLDER."index.php?rt=fronend/index/accountDetail");
            exit ( 0 );
        }

        if(isset($_SESSION['error']) && $_SESSION['error']==false){
            header ( "Location: ".__FOLDER."index.php?rt=fronend/index/previewAccount" );
            exit ( 0 );
        }

        $_SESSION ['account'] = true;


        /* begin  Main */
        if (isset ( $_POST ['account'] )) {
            $error = $this->validation_form( $_POST );
            if (count ( $error ) > 0) {
                //session_start ();
                $_SESSION ['error'] = true;
                }
                else if (count ( $error ) == 0){

                    //session_start ();
                    $_SESSION ['error'] = false;

                    header ( "Location: ".__FOLDER."index.php?rt=fronend/index/previewAccount" );
                    exit ( 0 );
                }
        }

        if(isset($_POST['ajax'])){
            //error_reporting(0);
            $username = $_POST['username'];
            $model = $this->model->get('account');
            $kq = $model->checkUser($username);
            // return json
            header('Content-type: application/json');
            echo json_encode($kq);
            exit ( 0 );

        }
        if(isset($error)){
            $this->getView()->content->error = $error;
        }

    }


    /* BEGIN function */
    private function uploadFile() {
        $error = array();
        $target_dir = "uploads/".uniqid();
        $target_file = $target_dir.basename($_FILES["avatar"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["avatar"]["tmp_name"]);
            if ($check !== false) {
                // echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {

                // echo "File is not an image.";
                $uploadOk = 0;
                $error[] = "File is not an image.";
            }
        }
        // Kiểm tra nếu file đã tồn tại
        if (file_exists($target_file)) {
            // echo "Sorry, file already exists.";
            unlink($target_file);
            //$uploadOk = 0;
        }

        // kiểm tra kích thước file
        if ($_FILES["avatar"]["size"] > $this->validation_max_file_size) {

            $uploadOk = 0;
            // echo "Sorry, your file is too large.";

            $error[] = "Sorry, your file is too large.";
        }
        // Kiểm tra định dạng file
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
            $error[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
        // nếu $uploadOK == 1 là ok
        if ($uploadOk == 0) {
            // echo "Sorry, your file was not uploaded.";
            // bắt đầu upload file
        } else {
            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                //session_start();
                $_SESSION['file'] = $target_file;

            } else {
                // echo "Sorry, there was an error uploading your file.";
                $error[] = "Sorry, there was an error uploading your file.";
            }
        }
        return $error;
    }

    private function checkString($string) {
        $flag = true;

        if (strlen ( $string ) < $this->validation_min_username || strlen ( $string ) > $this->validation_max_username) {
            return false;
        }
        if (preg_match ( '/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $string )) {
            return false;
        }

        for($i = 0; $i < strlen ( $string ); $i ++) {

            if (is_numeric ( $string [$i] )) {
                return false;
            }
        }

        return true;
    }
    /**
     * Trả về số ngày trong tháng.
     * @param int $month
     * @param int $year
     * @return int
     * */
    private function get_days_in_month($month, $year) {
        return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
    }

    /**
     * Kiểm tra nhập liệu.
     * validation form create account
     * @param array $post
     * @return multitype:string
     * */
    private function validation_form($post) {
        $error = array();

        $firtName = $post['first_name'];
        $lastName = $post['last_name'];
        $userName = $post['user_name'];

        $password = $post['password'];

        $rePassword = $post['re_password'];
        $month = $post['month'];
        $day = $post['day'];
        $year = $post['year'];

        $gender = $post['sex'];
        $address = $post['address'];

        //session_start();
        $_SESSION['first_name'] = $firtName;
        $_SESSION['last_name'] = $lastName;
        $_SESSION['user_name'] = $userName;
        $_SESSION['password'] = $password;

        $_SESSION['month'] = $month;
        $_SESSION['day'] = $day;
        $_SESSION['year'] = $year;
        $_SESSION['sex'] = $gender;
        $_SESSION['address'] = $address;




        // check rổng
        if (isset($post['sex']) != true || $post['year'] == 'Year' || $post['day'] == 'Day' || $post['month'] == 'Month' || $firtName == '' || $lastName == '' || $userName == '' || $password == '' || $gender == '' || $address == '' || $_FILES['avatar']['name'] == "") {

            if ($firtName == '') {
                $error['first_name'][] = 'Value is not empty.';
            }
            if ($lastName == '') {
                $error['last_name'][] = 'Value is not empty.';
            }
            if ($userName == '') {
                $error['user_name'][] = 'Value is not empty.';
            }
            if ($password == '') {
                $error['password'][] = 'Value is not empty.';
            }

            if ($gender == '') {
                $error['sex'][] = 'Value is not empty.';
            }
            if ($address == '') {
                $error['address'][] = 'Value is not empty.';
            }

            if ($_POST['year'] == 'Year' || $_POST['day'] == 'Day' || $_POST['month'] == 'Month') {
                $error['date'][] = 'Date not selected.';
            }

            if (isset($_POST['sex']) != true) {
                $error['sex'][] = 'Gender not selected.';
            }

            if ($_FILES['avatar']['name'] == "") {
                $error['avatar'][] = 'Avatar not selected.';
            }


        }

        if (!is_numeric($month) || !is_numeric($day) || !is_numeric($year)) {
        	$error['date'][] = 'Day, month, year not numberic.';

        }else{
        	if (checkdate($month, $day, $year) != true) {
        		$error['date'][] = 'Date wrong format.';
        	}
        }

        // check a-Z && 4-30
        if (!$this->checkString($firtName)) {
            $error['first_name'][] = 'First name include the characters a-Z, greater than 4 characters and less than 30 characters.';
        }
        if (!$this->checkString($lastName)) {
            $error['last_name'][] = 'First name include the characters a-Z, greater than 4 characters and less than 30 characters.';
        }
        if (!$this->checkString($userName)) {
            $error['user_name'][] = 'First name include the characters a-Z, greater than 4 characters and less than 30 characters.';
        }
        if ($password != $rePassword) {
            $error['password'][] = 'Password not match.';
        }
        if ($gender != 0 && $gender != 1) {
            $error['sex'][] = 'Gender is not invalid.';
        }
        // check upload file
        $stringTemp = $this->uploadFile();
        if (count($stringTemp) > 0) {

            $error['avatar'] = $stringTemp;
        }
        return $error;
    }
    /* END function */
}
?>