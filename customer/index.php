<?php

session_start();

if (!isset($_SESSION['logged_in'])) {
	header('Location: ../login.php');
}

$page_title = "Customer";
include_once "../objects/users.php";
include_once "../config/database.php";

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$user->id = $_SESSION['user_id'];
$user->selectByUserID();

include_once "template/header.php";
include_once "template/navigation.php";
include_once "template/navbar.php";
?>

<table class="table table-striped">
  <tbody>
    <tr>
      <th scope="row">First Name</th>
      <?php echo "<td>{$user->firstname}</td>"; ?>
    </tr>
    <tr>
      <th scope="row">Last Name</th>
      <?php echo "<td>{$user->lastname}</td>"; ?>
    </tr>
    <tr>
      <th scope="row">Email</th>
      <?php echo "<td>{$user->email}</td>"; ?>
    </tr>
    <tr>
      <th scope="row">Contact Number</th>
      <?php echo "<td>{$user->contact_number}</td>"; ?>
    </tr>
  </tbody>
</table>

<?php
include_once "template/footer.php";
?>