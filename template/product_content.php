
<?php
if(!isset($_SESSION['cart'])){
    $_SESSION['cart']=array();
}
?>
<div class="container-fluid">
		<div class="d-flex justify-content-center mt-2 mb-2">
		<?php echo '<h3>'.$product->name.'</h3>'; ?>
		</div>
	<div class="row">
		<div class="col-md-6">
			<?php echo '<img class="img-fluid" src="'.$product->image.'" alt="Girl in a jacket" >'; ?>
		</div>
		<div class="col-md-6">
<?php
  
  echo $product->short_description.'<hr>';
  echo 'Giá: '.number_format($product->price).' VNĐ<hr>';
	echo "<div class='m-b-10px'>";
	    if(array_key_exists($product->id, $_SESSION['cart'])){
	        echo "<a href='cart.php' class='btn btn-success w-100-pct'>";
	            echo "Update Cart";
	        echo "</a>";
	    }else{
	        echo "<a href='add_to_cart.php?id={$product->id}&price={$product->price}' class='btn btn-primary w-100-pct'>Add to Cart</a>";
	    }
	echo "</div>";
?>
		<hr>
		</div>
	</div>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mô tả</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Thông số</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Catalogue</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active mb-3 mt-3" id="home" role="tabpanel" aria-labelledby="home-tab"><?php echo $product->description; ?></div>
  <div class="tab-pane fade mb-3 mt-3" id="profile" role="tabpanel" aria-labelledby="profile-tab"><?php echo $product->spec; ?></div>
  <?php
  echo '<div class="tab-pane fade mb-3 mt-3" id="contact" role="tabpanel" aria-labelledby="contact-tab"><embed src="'.$product->catalogue.'" width="800" height="1024" type="application/pdf"></div>';
  ?>
</div>
</div>