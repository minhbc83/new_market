<?php

session_start();

$page_title = "Tạo địa chỉ mới";

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
$address->user_id = $_SESSION['user_id'];
// Submit form create new address of user
if($_POST){

    // set address property values
    $address->address_name = $_POST['address_name'];
    $address->contact_name = $_POST['contact_name'];
    $address->phone = $_POST['phone'];
    $address->province_id = $_POST['province_id'];
    $address->district = $_POST['district'];
    $address->address = $_POST['address'];
 
    // create the address
    if($address->create()){
       	header("Location: address.php");
    }
 
    // if unable to create the address, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create product.</div>";
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
    <table class='table table-hover'>
        <tr>
            <td>Tên gợi nhớ</td>
            <td><input type='text' name='address_name' class='form-control'></td>
        </tr>
        <tr>
            <td>Tên người nhận</td>
            <td><input type='text' name='contact_name' class='form-control'></td>
        </tr>
        <tr>
            <td>Điện thoại</td>
            <td><input type='text' name='phone' class='form-control'></td>
        </tr>
        <tr>
            <td>Địa chỉ</td>
            <td><textarea name='address' class='form-control' style="height:200px"></textarea></td>
        </tr>
 
        <tr>
            <td>Quận</td>
            <td><input type='text' name='district' class='form-control'></td>
        </tr>
 
        <tr>
            <td>Tỉnh/Thành phố ID</td>
            <td>
            <input type='text' name='province_id' class='form-control'>
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