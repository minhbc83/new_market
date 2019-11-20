<?php
session_start();
$page_title = "Thank you";
include_once "template/header.php";
include_once "template/navigation.php";
include_once "template/navbar.php";
?>
<div class="alert alert-success" role="alert">
  Bạn đã đặt hàng thành công !
</div>
<?php
include_once "template/footer.php";
?>
