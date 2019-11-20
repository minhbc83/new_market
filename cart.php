<?php
// Session start
session_start();

// Connect to database
include_once 'config/database.php';

// Include object
include_once 'objects/product.php';
include_once 'objects/product_image.php';

// Get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$product = new Product($db);
$product_image = new ProductImage($db);

// Set page title
$page_title = "Cart";

include 'template/header.php';
include 'template/navigation.php';

if (count($_SESSION['cart'])>0) {

	// Get product ids
	$ids = array(); // initial array of id
	// take in array $_SESSION['cart'] value of $id, push $id into array $ids
	foreach ($_SESSION['cart'] as $id => $value) {
		array_push($ids, $id);
	}

	$stmt = $product->readByIds($ids);

	$total = 0;
	$item_count = 0;


	// =================
echo "<div class='container'>";
?>
    <div class="row">
        <div class="col-md-9">
            <table class="table table-responsive">
              <thead>
                <tr>
                  <th scope="col">Sản phẩm</th>
                  <th scope="col">Đơn giá</th>
                  <th scope="col">Số lượng</th>
                  <th scope="col">Số tiền</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    foreach ($stmt as $cart_item) {
                        $quantity = $_SESSION['cart'][$cart_item['id']]['quantity'];
                        $sub_total = $cart_item['price'] * $quantity;
                        $item_count += $quantity;
                        $total += $sub_total;
                    echo '<tr>';
                        echo "<td>{$cart_item['name']}</td>";
                        echo "<td>VND ".number_format($cart_item['price'])."</td>";
                        echo "<td>";
                        echo "<form class='update-quantity-form'>";
                        echo "<div class='product-id' style='display:none;'>".$cart_item['id']."</div>";
                        echo "<input class='product-price' type='number' name='price' value='".$cart_item['price']."' style='display:none'>";
                        echo "<input type='number' name='quantity' value='".$quantity."' class='form-control cart-quantity mb-2' min='1'>";
                        echo "<span class='input-group-btn'><button class='btn btn-sm btn-success' type='submit'>Cập nhật</button></span>";
                        echo "<a href='remove_from_cart.php?id={$cart_item['id']}' class='btn btn-sm btn-success ml-2'>Xóa</a>"; 
                        echo "</form>";
                        echo "</td>";
                        echo '<td>'.number_format($sub_total).'</td>';
                    echo '</tr>';
                    
                }
                ?>
              </tbody>
            </table>
        </div>
        <div class="col-md-3 mt-2 bg-white">
            Tổng cộng : <?php echo $item_count; ?> sản phẩm<br>
            Giá trị đơn hàng: <?php echo number_format($total); ?> VND<br>
            <a href='customer/create_order.php' class='btn btn-sm btn-success m-b-10px mt-2'><span class='glyphicon glyphicon-search'></span> Proceed to Checkout</a>
        </div>
    </div>
</div>
<?php
}
else {
    echo "<div class='col-md-12'>";
        echo "<div class='alert alert-danger'>";
            echo "No products found in your cart!";
        echo "</div>";
    echo "</div>";
}

include 'template/footer.php';
?>