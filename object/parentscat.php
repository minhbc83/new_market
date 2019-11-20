<?php
class ParentsCat {
	// Database table name & connection
	private $conn;
	private $table_name = "parentscat";

	// Object properties
	public $id;
	public $name;

	// Construct object ParentsCat
	public function __construct($db) {
		$this->conn = $db;
	}

	// Reead all parent categories
	function read() {
		$query = "SELECT id, name FROM ". $this->table_name . " ORDER by name";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}
}