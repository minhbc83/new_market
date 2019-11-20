<?php

session_start();

$page_title = "Sổ địa chỉ";
if (!isset($_SESSION['logged_in'])) {
	header('Location: ../login.php');
}

include_once "../objects/address.php";
include_once "../config/database.php";

$database = new Database();
$db = $database->getConnection();

$address = new Address($db);
$address->user_id = $_SESSION['user_id'];
$stmt = $address->selectAddressByUserID();

include_once "template/header.php";
include_once "template/navigation.php";
include_once "template/navbar.php";

echo "<div>";
echo '<a href="create_address.php" class="btn btn-sm btn-success mb-2">Tạo địa chỉ mới</a>';
echo "</div>";
foreach ($stmt as $value) {
	echo "<table class='table table-sm table-responsive'>";
		echo '<thead class="thead-light">';
			echo '<tr>';
				echo '<th scope="col">'.$value['address_name'].'</th>';
				echo '<th scope="col"><a href="modify_address.php?id='.$value['id'].'" class="btn btn-sm btn-success mt-2"><strong>Thay đổi</strong></a></th>';
			echo '</tr>';
		echo '</thear>';
		echo '<tbody>';
			echo '<tr>';
				echo '<th scope="row">Số nhà</th>';
				echo "<td>".$value['address']."</td>";
			echo '</tr>';
			echo '<tr>';
				echo '<th scope="row">Quận</th>';
				echo "<td>".$value['district']."</td>";
			echo '</tr>';
			echo '<tr>';
				echo '<th scope="row">Tỉnh/Thành phố</th>';
				echo "<td>".$value['province_id']."</td>";
			echo '</tr>';
			echo '<tr>';
				echo '<th scope="row">Người liên hệ</th>';
				echo "<td>".$value['contact_name']."</td>";
			echo '</tr>';
			echo '<tr>';
				echo '<th scope="row">Điện thoại liên hệ</th>';
				echo "<td>".$value['phone']."</td>";
			echo '</tr>';
		echo '</tbody>';
	echo '</table>';
}
include_once "template/footer.php";
?>