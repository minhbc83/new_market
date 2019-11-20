<?php
// start session
session_start();

// Get product id
$id = isset($_GET['id']) ? $_GET['id'] : "";
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
$price = isset($_GET['price']) ? $_GET['price'] : 0;
// Make quantity a minimum
$quantity = $quantity<=0 ? 1 : $quantity;

// add new item on array
$cart_item = array('quantity'=>$quantity, 'price'=>$price);

/* Check if the cart session array was created.
If it is NOT, create the cart session array */
if (!isset($_SESSION['cart'])){
	$_SESSION['cart'] = array();
}

// Check if the item is in the array, if it is, do not add.
if (array_key_exists($id, $_SESSION['cart'])){
	// redirect to product list and tell user it was added to cart
	header('Location: product.php?action=exist&id=' . $id);
}
else {
	$_SESSION['cart'][$id] = $cart_item;

	// redirect to product list and tell the user it was added to cart.
	header('Location: products.php?action=added');
}
?>