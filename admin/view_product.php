<?php

$page_title = "View Products";
// View all product
include_once "../config/database.php";
include_once "../objects/product.php";
include_once "../objects/category.php";

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$category = new Category($db);

// Select all product
if (!isset($_GET['category'])||($_GET['category']==0)){
$stmt_p = $product->getall();
}
else{
	// View by category
	$product->category_id = $_GET['category'];
	$stmt_p = $product->readCategory();
}

include_once "template/header.php";
include_once "template/navigation.php";

?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
<div class="form-group row"> 
    <table class='table table-hover table-responsive'>
        <tr>
            <td>Chọn danh mục cần xem</td>
            <td>
            <!-- categories from database will be here -->
            <?php
            // read the product categories from the database
            $stmt = $category->read();
             
            // put them in a select drop-down
            echo "<select class='form-control' name='category'>";
                echo "<option value='0'>Select category...</option>";
             
                while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row_category);
                    echo "<option value='{$id}'>{$name}</option>";
                }
             
            echo "</select>";
            ?>
            </td>
            <td>
                <button type="submit" class="btn btn-primary">Xem</button>
            </td>
        </tr>

    </table>
</div>
</form>

<table class="table table-striped table-responsive">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tên</th>
      <th scope="col">Giá (VND)</th>
      <th scope="col">Thực hiện</th>
    </tr>
  </thead>
  <tbody> 
 <?php
 	$i = 0;
 	foreach ($stmt_p as $product_item){
    echo '<tr>';
    $i++;
      echo '<th scope="row">'.$i.'</th>';
      echo '<td>'.$product_item['name'].'</td>';
      echo '<td>'.number_format($product_item['price']).'</td>';
      echo '<td><a class="btn btn-primary" href="edit_product.php?id='.$product_item['id'].'" role="button">Xem</a></td>';
    echo '</tr>';

	}
 ?>
  </tbody>
</table>
<?php
include_once "template/footer.php"
?>