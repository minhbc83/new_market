<?php
class Address{

	private $conn;
	private $table_name = "addresses";

	public $id;
	public $user_id;
	public $address;
	public $address_name;
	public $district;
	public $province_id;
	public $phone;
	public $contact_name;

	// Construct new address
	public function __construct($db){
		$this->conn = $db;
	}

	// Select address by user ID
	public function selectAddressByUserID(){
		$query = "SELECT id, address, address_name, district, province_id, phone, contact_name FROM ".$this->table_name." WHERE user_id = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->user_id);
		$stmt->execute();

		return($stmt);
	}

	// Select address by ID
	public function selectAddressByID(){
		$query = "SELECT address, address_name, district, province_id, phone, contact_name FROM ".$this->table_name." WHERE id = ? LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->address = $row['address'];
		$this->address_name = $row['address_name'];
		$this->district = $row['district'];
		$this->province_id = $row['province_id'];
		$this->phone = $row['phone'];
		$this->contact_name = $row['contact_name'];
	}
	function create(){
		$query = "INSERT INTO ".$this->table_name." SET contact_name=:contact_name, phone=:phone, address=:address, address_name=:address_name, district=:district, user_id=:user_id, province_id=:province_id";
		$stmt = $this->conn->prepare($query);
		$this->contact_name=htmlspecialchars(strip_tags($this->contact_name));
		$this->address_name=htmlspecialchars(strip_tags($this->address_name));
		$this->phone=htmlspecialchars(strip_tags($this->phone));
		$this->address=htmlspecialchars(strip_tags($this->address));
		$this->district=htmlspecialchars(strip_tags($this->district));
		$this->user_id=htmlspecialchars(strip_tags($this->user_id));
		$this->province_id=htmlspecialchars(strip_tags($this->province_id));
		
		
		$stmt->bindParam(":contact_name", $this->contact_name);
		$stmt->bindParam(":address_name", $this->address_name);
		$stmt->bindParam(":phone", $this->phone);
		$stmt->bindParam(":address", $this->address);
		$stmt->bindParam(":district", $this->district);
		$stmt->bindParam(":user_id", $this->user_id);
		$stmt->bindParam(":province_id", $this->province_id);
	
		if ($stmt->execute()){
			return true;
		}
		else {
			return false;
		}
	}

	function update(){
		$query = "UPDATE ".$this->table_name." SET contact_name=:contact_name, address_name=:address_name, phone=:phone, address=:address, district=:district, user_id=:user_id, province_id=:province_id WHERE id=".$this->id;
		$stmt = $this->conn->prepare($query);
		$this->contact_name=htmlspecialchars(strip_tags($this->contact_name));
		$this->address_name=htmlspecialchars(strip_tags($this->address_name));
		$this->phone=htmlspecialchars(strip_tags($this->phone));
		$this->address=htmlspecialchars(strip_tags($this->address));
		$this->district=htmlspecialchars(strip_tags($this->district));
		$this->user_id=htmlspecialchars(strip_tags($this->user_id));
		$this->province_id=htmlspecialchars(strip_tags($this->province_id));
		
		
		$stmt->bindParam(":contact_name", $this->contact_name);
		$stmt->bindParam(":address_name", $this->address_name);
		$stmt->bindParam(":phone", $this->phone);
		$stmt->bindParam(":address", $this->address);
		$stmt->bindParam(":district", $this->district);
		$stmt->bindParam(":user_id", $this->user_id);
		$stmt->bindParam(":province_id", $this->province_id);
	
		if ($stmt->execute()){
			return true;
		}
		else {
			return false;
		}
	}

}
?>
