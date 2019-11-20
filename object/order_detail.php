<?php
class Order_detail {

	private $conn;
	private $table_name = "order_detail";

	public $id;
	public $order_id;
	public $product_id;
	public $quantity;
	public $price;
	public $modified;
	public $timestamp;

	public function __construct($db){
		$this->conn = $db;
	}
	
	// Create new order
	function create(){
		$query = "INSERT INTO ".$this->table_name." SET order_id=:order_id, product_id=:product_id, quantity=:quantity, price=:price, created=:created";
		$stmt = $this->conn->prepare($query);
		$this->order_id=htmlspecialchars(strip_tags($this->order_id));
		$this->product_id=htmlspecialchars(strip_tags($this->product_id));
		$this->quantity=htmlspecialchars(strip_tags($this->quantity));
		$this->price=htmlspecialchars(strip_tags($this->price));

		$this->timestamp = date('Y-m-d H:i:s');
		
		$stmt->bindParam(":order_id", $this->order_id);
		$stmt->bindParam(":product_id", $this->product_id);
		$stmt->bindParam(":quantity", $this->quantity);
		$stmt->bindParam(":price", $this->price);
		$stmt->bindParam(":created", $this->timestamp);

		if ($stmt->execute()){
			return true;
		}
		else {
			return false;
		}
	}
	function selectByOrderID(){
		$query = "SELECT product_id, quantity, price FROM ".$this->table_name." WHERE order_id=".$this->order_id;
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
}