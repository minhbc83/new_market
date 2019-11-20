<?php

session_start();

$page_title = "Thay đổi thông tin địa chỉ";

// Kiem tra da login hay chua
if (!isset($_SESSION['logged_in'])) {
	header('Location: ../login.php');
}

// Khoi tao database va object address
include_once "../objects/address.php";
include_once "../config/database.php";

$database = new Database();
$db = $database->getConnection();

$address = new Address($db);
if (isset($_GET['id'])){
    $address->id = $_GET['id'];
}
$address->selectAddressByID();
// Submit form create new address of user
if($_POST){

    // set address property values
    $address->id = $_POST['id'];
    $address->contact_name = $_POST['contact_name'];
    $address->address_name = $_POST['address_name'];
    $address->phone = $_POST['phone'];
    $address->province_id = $_POST['province_id'];
    $address->district = $_POST['district'];
    $address->address = $_POST['address'];
    $address->user_id = $_SESSION['user_id'];
 
    // create the address
    if($address->update()){
       	header("Location: address.php");
    }
 
    // if unable to create the address, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to update product.</div>";
    }
}

// page header and navigation
include_once "template/header.php";
include_once "template/navigation.php";
include_once "template/navbar.php";
?>
<div class="row">
<div class="col-md">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<div class="form-group row"> 
    <?php echo "<input type='hidden' name='id' value='".$address->id."'>"; ?>
    <table class='table table-hover'>
        <tr>
            <td>Tên gợi nhớ</td>
            <?php echo "<td><input type='text' name='address_name' class='form-control' value='".$address->address_name."'></td>";?>
        </tr>
        <tr>
            <td>Tên người nhận</td>
            <?php echo "<td><input type='text' name='contact_name' class='form-control' value='".$address->contact_name."'></td>";?>
        </tr>
        <tr>
            <td>Điện thoại</td>
            <?php echo "<td><input type='text' name='phone' class='form-control' value='".$address->phone."'></td>";?>
        </tr>
        <tr>
            <td>Địa chỉ</td>
            <?php echo "<td><textarea name='address' class='form-control' style='height:200px'>".$address->address."</textarea></td>";?>
        </tr>
 
        <tr>
            <td>Quận</td>
            <?php echo "<td><input type='text' name='district' class='form-control' value='".$address->district."'></td>";?>
        </tr>
 
        <tr>
            <td>Tỉnh/Thành phố ID</td>
            <?php echo "<td><input type='text' name='province_id' class='form-control' value='".$address->province_id."'></td>";?>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Thay đổi</button>
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