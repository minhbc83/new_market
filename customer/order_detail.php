<?php
session_start();

$page_title = "Order Information";
if (!isset($_SESSION['logged_in'])) {
	header('Location: ../login.php');
}

include_once "../objects/order_detail.php";
include_once "../objects/address.php";
include_once "../objects/order.php";
include_once "../config/database.php";

$database = new Database();
$db = $database->getConnection();

$order_detail = new Order_detail($db);

$order_detail->order_id = $_GET['order_id'];
$stmt = $order_detail->selectByOrderID();


$order = new Order($db);
$order->id = $_GET['order_id'];
$order->selectByID();

$address = new Address($db);
$address->id = $order->address_id;

$address->selectAddressByID();

include_once "template/header.php";
include_once "template/navigation.php";
include_once "template/navbar.php";
?>

<table class="table table-striped">
	  <thead style="background-color: lemonchiffon">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Mã sản phẩm</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Đơn giá </th>
      <th scope="col">Thành tiền</th>
    </tr>
  </thead>
  <tbody>
  	<?php
  	$i = 0;
  	foreach ($stmt as $value){
	  	$i++;
	  	echo '<tr>';
	      echo "<th scope='row'>{$i}</th>";
	      echo "<td><a href='../product.php?id=".$value['product_id']."'>".$value['product_id']."</td>";
	      echo "<td>".$value['quantity']."</td>";
	      echo "<td>".number_format($value['price'])."</td>";
	      echo "<td>".number_format($value['price']*$value['quantity'])."</td>";
	    echo '</tr>';
  	}
  echo "</tbody>";
echo "</table>";
echo "Tong gia tri don hang: ".number_format($order->value)." VND<br>";
echo "<p>Hang se duoc giao toi dia chi: ".$address->address."</p>";
echo "<p>Phuong thuc thanh toan: ".$order->payment_method."</p>";

include_once "template/footer.php";
?>