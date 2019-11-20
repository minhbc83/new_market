<?php
include_once "config/core.php";
include_once "config/database.php";
include_once "objects/category.php";
include_once "objects/parentscat.php";
include_once "objects/manufacturer.php";
$database = new Database();
$db = $database->getConnection();
include_once "template/header.php";
include_once "template/navigation.php";
include_once "template/sidebar.php";
include_once "template/home_content.php";
include_once "template/footer.php";
?>