<div class="container-fluid">
<?php
  $product = new Product($db);
  $product_stmt = $product->getall();
?>
<table class="table table-sm table-striped">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Hình ảnh</th>
      <th scope="col">Mã sản phẩm</th>
      <th scope="col">Tên</th>
      <th scope="col">Giá (VND)</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody> 
 <?php
 	$i = 0;
 	foreach ($product_stmt as $product_item){
    echo '<tr>';
    $i++;
      echo '<th scope="row">'.$i.'</th>';
      echo '<td><img src="'.$product_item['image'].'" alt="" style="width:30px;height:30px"></td>';
      echo '<td><a href="product.php?id='.$product_item['id'].'">'.$product_item['pn'].'</a></td>';
      echo '<td>'.$product_item['name'].'</td>';
      echo '<td align="right">'.number_format($product_item['price']).'  </td>';
      echo "<div class='m-b-10px'>";
      if(array_key_exists($product_item['id'], $_SESSION['cart'])){
          echo "<td><a href='cart.php' class='btn btn-sm btn-success w-100-pct'>";
              echo "Update Cart";
          echo "</a></td>";
      }else{
          echo "<td><a href='add_to_cart.php?id={$product_item['id']}&price={$product_item['price']}' class='btn btn-sm btn-primary w-100-pct'>Add to cart</a></td>";
      }
  echo "</div>";
    echo '</tr>';
	}
 ?>
  </tbody>
</table>
</div>