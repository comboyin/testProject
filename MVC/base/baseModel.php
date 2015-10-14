<?php
class baseModel
{

    private static $instance;

    private $pdo = null;

    private $registry = null;

    /**
     *
     * @return PDO
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     *
     * @param the $pdo
     */
    public function setPdo($pdo)
    {
        $this->pdo = $pdo;
    }

    function __construct($registry = null)
    {
    	if($registry != null){
    		$this->registry = $registry;
    		$this->openConnection();
    	}


    }

    public function openConnection(){
    	$database = $this->registry->database;
    	$_servername = $database['db_servername'];
    	$_dbname = $database['db_dbname'];
    	$_username = $database['db_username'];
    	$_password = $database['db_password'];
    	try {
    		if($this->pdo == null){
    			$this->pdo = new PDO (
    			    "mysql:host=$_servername;dbname=$_dbname", $_username, $_password,
    			    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );

				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		}

    		return $this->pdo;
    	} catch ( PDOException $e ) {
    		return false;
    	}
    }

    public function closeConnection(){
        if($this->pdo != null){
            $this->pdo = null;
        }
    }
    public static function getInstance($registry)
    {

        if (!self::$instance) {

            self::$instance = new baseModel($registry);

        }
        return self::$instance;
    }

    public function get($name)
    {
        $file = __SITE_PATH . '/models/' . str_replace("model", "", strtolower($name)) . "Model.php";

        if (file_exists($file)) {
            include_once $file;
            $class = str_replace("model", "", strtolower($name)) . "Model";
            $model = new $class($this->registry);
            return $model;
        }
        return NULL;
    }

    public function __destruct(){
    	if($this->pdo!=null){
    		$this->pdo=null;
    	}
    }

}