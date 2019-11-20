<?php
class Category{

    // database connection and table name
    private $conn;
    private $table_name = "categories";
 
    // object properties
    public $id;
    public $name;
    public $parentscat_id;
    public $description;
    public $image;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    function read(){
        //select all data
        $query = "SELECT id, name FROM " . $this->table_name . " ORDER BY id";  
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }
	// used to read category name by its ID
    function readName(){
         
        $query = "SELECT name FROM " . $this->table_name . " WHERE id = ? limit 0,1";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
         
        $this->name = $row['name'];
    }
    function readParentscat_id() {
        $query = "SELECT id, name, description, image FROM " .$this->table_name . " WHERE parentscat_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->parentscat_id);
        $stmt->execute();

        return $stmt;
    }
}
?>