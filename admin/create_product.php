<?php
$page_title = "Tạo sản phẩm mới";

include_once "../config/database.php";
include_once "../objects/product.php";
include_once "../objects/category.php";

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$category = new Category($db);
 
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){

    // Insert feature image to product
    $target_dir = "../images/";
    if ($_FILES['fileToUpload']['error']>0){
        echo "upload loi roi";
    }
    else{

        // Upload file to folder images/
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_dir . $_FILES['fileToUpload']['name']);

        // Add image url to $product->image
        $product->image = "images/" . $_FILES['fileToUpload']['name'];
    }
    // set product property values
    $product->name = $_POST['name'];
    $product->pn = $_POST['pn'];
    $product->price = $_POST['price'];
    $product->description = $_POST['description'];
    $product->category_id = $_POST['category_id'];
 
    // create the product
    if($product->create()){
        echo "<div class='alert alert-success'>Product was created.</div>";
    }
 
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create product.</div>";
    }
}

include_once "template/header.php";
include_once "template/navigation.php";
?>
<div class="row">
<div class="col-md">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
<div class="form-group row"> 
    <table class='table table-hover'>
 
        <tr>
            <td>Tên SP</td>
            <td><input type='text' name='name' class='form-control' /></td>
        </tr>
        <tr>
            <td>Mã SP</td>
            <td><input type='text' name='pn' class='form-control' /></td>
        </tr>
        <tr>
            <td>Đơn giá</td>
            <td><input type='text' name='price' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Mô tả</td>
            <td><textarea name='description' class='form-control' style="height:200px;"></textarea></td>
        </tr>
 
        <tr>
            <td>Loại</td>
            <td>
            <!-- categories from database will be here -->
            <?php
            // read the product categories from the database
            $stmt = $category->read();
             
            // put them in a select drop-down
            echo "<select class='form-control' name='category_id'>";
                echo "<option>Select category...</option>";
             
                while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row_category);
                    echo "<option value='{$id}'>{$name}</option>";
                }
             
            echo "</select>";
            ?>
            </td>
        </tr>
        <tr>
            <td>Hình ảnh</td>
            <td>
                <input type="file" name="fileToUpload" class="form-control" id="fileToUpload">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Tạo mới</button>
            </td>
        </tr>
 
    </table>
</div>
</form>
</div>
</div>
<?php
include_once "template/footer.php";
?>