<?php
// used to get mysql database connection
class Database{
 
    // specify your own database credentials
    private $host = "localhost:3306";
    private $db_name = "tru08554_new_market_1";
    private $username = "tru08554_minh";
    private $password = "Th@1nguyen~";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>