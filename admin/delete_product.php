<?php
include_once "../config/database.php";
include_once "../objects/product.php";

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
if (isset($_GET['id'])){
	$product->id = $_GET['id'];
	if ($product->delete()){
		header("Location: view_product.php");
	}
	else{
		header("Location: edit_product.php?id={$product->id}");
	}
}
else{
	header("Location: view_product.php");
}
?>