<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
	header('Location: ../login.php');
}
include_once "../objects/order.php";
include_once "../objects/order_detail.php";
include_once "../objects/address.php";

include_once "../config/database.php";

$database = new Database();
$db = $database->getConnection();

$order = new Order($db);
$order_detail = new Order_detail($db);

// Khoi tao object address
$address = new Address($db);

// Gan user id vao user_id cua object address
$address->user_id = $_SESSION['user_id'];

// Chon tat ca cac dia chi cua user trong bang addresses. $stmt_address la mot mang object address.
$stmt_address = $address->selectAddressByUserID();

print_r($_SESSION['cart']);
$order_count = $order->count();
if ($_POST){
	$order->id = $order_count+1;
	$order->user_id = $_SESSION['user_id'];
	$order->value = 0;
	$order->address_id = $_POST['address_id'];
	$order->invoice_info = $_POST['invoice_info'];
	if ($_POST['payment_method']=="COD"){
		$order->payment_method = 1;
	}
	elseif ($_POST['payment_method']=="credit_card"){
		$order->payment_method = 2;	
	}
	if ($order->create()){
		echo "order created <br>";
	}
	else {
		echo "Can not create order <br>";
	}

	foreach($_SESSION['cart'] as $key=>$value){
		$order_detail->product_id = $key; echo $order_detail->product_id."-";
		$order_detail->quantity = $value['quantity']; echo $order_detail->quantity."-";
		$order_detail->price = $value['price']; echo $order_detail->price."-";

		$order->value = $order->value + $order_detail->quantity*$order_detail->price;
		$order_detail->order_id = $order->id; echo $order_detail->order_id."-";
		if ($order_detail->create()){
			echo "Da chen san pham trong order vao order detail";
		}
		else {
			echo "Kiem tra lai nguyen nhan khong insert duoc";
		}
		echo "<br>";
		echo date('Y-m-d H:i:s');
	};
	if($order->updateValue()){
	$_SESSION['cart'] = array();
	header('Location: payment.php');
	}
	else {
		echo "Khong update value duoc";
	}

};

include_once "../template/header.php";
include_once "../template/navigation.php";
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
 
    <table class='table table-hover table-responsive table-bordered'>
         <tr>
            <td>Thông tin xuất hóa đơn</td>
            <td><textarea name='invoice_info' class='form-control'></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>
 
    </table>

    <?php
    // Doc cac dia chi cua user da luu trong database va list truoc khi tao order.
    echo "<h5>Chọn địa chỉ giao hàng: </h5><br>";
    foreach ($stmt_address as $value) {
    	echo $value['address'];
    	echo '<input type="radio" name="address_id" value="'.$value['id'].'"><br>';
    }
    ?>
    <hr>
    <h5>Chọn phương thức thanh toán: </h5><br>
    <input type="radio" name="payment_method" value="COD">Thanh toán sau khi nhận hàng <br>
    <input type="radio" name="payment_method" value="credit_card">Thanh toán bằng thẻ tín dụng <br>

</form>
<?php
include_once "../template/footer.php";
?>