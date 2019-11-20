<?php
class Order {

	private $conn;
	private $table_name = "orders";

	public $id;
	public $user_id;
	public $payment_method;
	public $payment_status;
	public $shipping_status;
	public $value;
	public $address_id;
	public $invoice_info;
	public $timestamp;

	public function __construct($db){
		$this->conn = $db;
	}
	
	// Create new order
	function create(){
		$query = "INSERT INTO ".$this->table_name." SET id=:id, user_id=:user_id, value=:value, payment_method=:payment_method, created=:created, address_id=:address_id, invoice_info=:invoice_info";
		$stmt = $this->conn->prepare($query);
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->user_id=htmlspecialchars(strip_tags($this->user_id));
		$this->value=htmlspecialchars(strip_tags($this->value));
		$this->address_id=htmlspecialchars(strip_tags($this->address_id));
		$this->invoice_info=htmlspecialchars(strip_tags($this->invoice_info));

		$this->timestamp = date('Y-m-d H:i:s');
		
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":user_id", $this->user_id);
		$stmt->bindParam(":value", $this->value);
		$stmt->bindParam(":payment_method", $this->payment_method);
		$stmt->bindParam(":address_id", $this->address_id);
		$stmt->bindParam(":invoice_info", $this->invoice_info);
		$stmt->bindParam(":created", $this->timestamp);

		if ($stmt->execute()){
			return true;
		}
		else {
			return false;
		}
	}

	// Count number of order
	function count(){
		$query = "SELECT COUNT(*) FROM ".$this->table_name;
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetchColumn();
		return $row;
	}

	function updateValue(){
		$query = "UPDATE ".$this->table_name." SET value=".$this->value." WHERE id=".$this->id;
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute()){
			return true;
		}
		else {
			return false;
		}
	}

	function selectByUserID(){
		$query = "SELECT id, value, created FROM ".$this->table_name." WHERE user_id=".$this->user_id;
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function selectByID(){
		$query = "SELECT value, address_id, payment_method, created FROM ".$this->table_name." WHERE id=".$this->id;
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->address_id = $row['address_id'];
		$this->value = $row['value'];
		$this->payment_method = $row['payment_method'];
		$this->timestamp = $row['created'];

	}
}