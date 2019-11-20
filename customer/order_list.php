<?php
session_start();

$page_title = "Quản lí đơn hàng";

if (!isset($_SESSION['logged_in'])) {
	header('Location: ../login.php');
}
include_once "../objects/order.php";
include_once "../config/database.php";

$database = new Database();
$db = $database->getConnection();

$order = new Order($db);

$order->user_id = $_SESSION['user_id'];
$stmt = $order->selectByUserID();

include_once "template/header.php";
include_once "template/navigation.php";
include_once "template/navbar.php";
?>

<table class="table table-responsive table-striped mt-2">
  <tbody>
  	<thread>
  		<tr>
  			<th scope="col">STT</th>
  			<th scope="col">Mã đơn hàng</th>
  			<th scope="col">Thời gian tạo</th>
  			<th scope="col">Giá trị đơn hàng</th>
  		</tr>
  	</thread>
  	<?php
  	$i = 0;
  	foreach ($stmt as $value){
	  	$i++;
	  	echo '<tr>';
	      echo "<th scope='row'>{$i}</th>";
	      echo "<td><a href='order_detail.php?order_id=".$value['id']."'>".$value['id']."</td>";
	      echo "<td>".$value['created']."</td>";
	      echo "<td align='right'>".number_format($value['value'])."</td>";
	    echo '</tr>';
  	}
  	?>
  </tbody>
</table>

<?php
include_once "template/footer.php";
?>