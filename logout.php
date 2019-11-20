<?php
	$page_title = "Log Out";
	session_start();
	session_unset();
	session_destroy();
	include_once 'template/header.php';
	include_once 'template/navigation.php';
	header("Location: login.php");
	include_once 'template/footer.php';
?>