<?php
class Product {

	private $conn;
	private $table_name = "products";

	public $id;
	public $name;
	public $price;
	public $pn;
	public $short_description;
	public $spec;
	public $description;
	public $catalogue;
	public $category_id;
	public $image;
	public $timestamp;

	public function __construct($db){
		$this->conn = $db;
	}
	function create(){
		$query = "INSERT INTO ".$this->table_name." SET name=:name, pn=:pn, price=:price, description=:description, category_id=:category_id, image=:image, created=:created";
		$stmt = $this->conn->prepare($query);
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->pn=htmlspecialchars(strip_tags($this->pn));
		$this->price=htmlspecialchars(strip_tags($this->price));
		$this->description=htmlspecialchars(strip_tags($this->description));
		$this->category_id=htmlspecialchars(strip_tags($this->category_id));
		$this->image=htmlspecialchars(strip_tags($this->image));
		$this->timestamp = date('Y-m-d H:i:s');
		
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":pn", $this->pn);
		$stmt->bindParam(":price", $this->price);
		$stmt->bindParam(":description", $this->description);
		$stmt->bindParam(":category_id", $this->category_id);
		$stmt->bindParam(":image", $this->image);
		$stmt->bindParam(":created", $this->timestamp);

		if ($stmt->execute()){
			return true;
		}
		else {
			return false;
		}
	}

	function getall(){
		$query = "SELECT id, image, pn, name, price, description FROM ". $this->table_name;
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function readOne(){
 
    $query = "SELECT
                name, pn, price, description, short_description, spec, catalogue, category_id, image
            FROM
                " . $this->table_name . "
            WHERE
                id = ?
            LIMIT
                0,1";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    $this->name = $row['name'];
    $this->pn = $row['pn'];
    $this->price = $row['price'];
    $this->description = $row['description'];
    $this->short_description = $row['short_description'];
    $this->catalogue = $row['catalogue'];
    $this->spec = $row['spec'];
    $this->category_id = $row['category_id'];
    $this->image = $row['image'];
	}

	function readCategory(){
		$query = "SELECT id, image, pn, name, price, description FROM " .$this->table_name . " WHERE category_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->category_id);
        $stmt->execute();

        return $stmt;
	}
	public function readByIds($ids){
 
    $ids_arr = str_repeat('?,', count($ids) - 1) . '?';
 
    // query to select products
    $query = "SELECT id, name, price FROM " . $this->table_name . " WHERE id IN ({$ids_arr}) ORDER BY name";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute($ids);
 
    // return values from database
    return $stmt;
	}

	// Update product with ID
	function update(){
		$query = "UPDATE ".$this->table_name." SET name=:name, pn=:pn, price=:price, description=:description, category_id=:category_id, image=:image, modified=:modified WHERE id=".$this->id;
		$stmt = $this->conn->prepare($query);
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->pn=htmlspecialchars(strip_tags($this->pn));
		$this->price=htmlspecialchars(strip_tags($this->price));
		$this->description=htmlspecialchars(strip_tags($this->description));
		$this->category_id=htmlspecialchars(strip_tags($this->category_id));
		$this->image=htmlspecialchars(strip_tags($this->image));
		$this->timestamp = date('Y-m-d H:i:s');
		
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":pn", $this->pn);
		$stmt->bindParam(":price", $this->price);
		$stmt->bindParam(":description", $this->description);
		$stmt->bindParam(":category_id", $this->category_id);
		$stmt->bindParam(":image", $this->image);
		$stmt->bindParam(":modified", $this->timestamp);
		if ($stmt->execute()){
			return true;
		}
		else {
			return false;
		}
	}

	function delete(){
		$query = "DELETE FROM ".$this->table_name." WHERE id=".$this->id;
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute()){
			return true;
		}
		else{
			return false;
		}
	}
}
?>