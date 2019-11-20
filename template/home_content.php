<div class="container-fluid">
<?php
  $stmt = $parentscat->read();
  foreach ($stmt as $item){
    $category->parentscat_id = $item['id'];
    $cat_stmt = $category->readParentscat_id();
    echo '<h4 class="text-light text-center rounded p-2" style="background-color: #66B032" >'.$item['name'].'</h4>';
    ?>
<div class="row">
  
  <!-- Card 1 -->
<?php
foreach ($cat_stmt as $cat_item) {
echo '<div class="col-lg-3 col-md-6">';
echo '<div class="card">';
  echo '<img class="img-fluid card-img-top" src="'.$cat_item['image'].'" alt="Card image cap">'; 
  //echo '<div class="card-header"><h5>'.$cat_item['name'].'</h5></div>';

  echo '<div class="card-body" style="background-color: #EBF7E3
">';
    //echo '<h5 class="card-title"></h5>';
    //echo '<p class="card-text">'.$cat_item['description'].'</p>';

    echo '<a href="category.php?cat_id='.$cat_item['id'].'" class="btn" style="background-color: #66B032">'.$cat_item['name'].'</a>';
?>
  </div>
</div>
</div>
<?php } ?>

</div>
<hr>
<?php    
  }
?>
</div>