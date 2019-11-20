<?php
include_once "config/core.php";
include_once "config/database.php";
include_once "objects/category.php";
include_once "objects/parentscat.php";
include_once "objects/manufacturer.php";
include_once "objects/product.php";
$database = new Database();
$db = $database->getConnection();
if (isset($_GET['id'])){
    $product_id = $_GET['id'];
}
else{
    $product_id = 0;
}
$product = new Product($db);
$product->id = $product_id;
$product->readOne();
$page_title = $product->name;
include_once "template/header.php";
include_once "template/navigation.php";
include_once "template/sidebar.php";
include_once "template/product_content.php";
include_once "template/footer.php";
?>