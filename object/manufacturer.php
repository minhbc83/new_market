<?php
class Manufacturer {

	// Database connection and table name
	private $conn;
	private $table_name = "makers";

	// Object properties
	public $id;
	public $name;

	// Construct
	public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        //select all data
        $query = "SELECT
                    id, name
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name";  
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }
}