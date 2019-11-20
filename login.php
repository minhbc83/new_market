<?php
include_once "config/core.php";
$page_title = "Login";
$require_login = false;
$access_denied = false;
include_once "config/login_checker.php";

if ($_POST){
   include_once 'config/database.php';
   include_once 'objects/users.php';
   $database = new Database();
   $db = $database->getConnection();

   $user = new user($db);
   $user->email = $_POST['email'];
   $email_exist = $user->emailExists();
   if ($email_exist && password_verify($_POST['password'], $user->password) && $user->status==1){
      $_SESSION['logged_in'] = true;
      $_SESSION['user_id'] = $user->id;
      $_SESSION['access_level'] = $user->access_level;
      $_SESSION['firstname'] = $user->firstname;
      $_SESSION['lastname'] = $user->lastname; 
      if ($user->access_level=="Admin"){
         header("Location: admin/index.php?action=login_success");
      }
      else {
         header("Location: index.php?action=login_success");
      }
   }
   else {
      $access_denied = true;
   }
}  

include_once "template/header.php";
include_once "template/navigation.php";
?>
<div class="container">
<div class="row justify-content-center">
<?php echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">' ?>
  <div class="form-group">
    <img src="images/logo.png" style="width: 300px">
    <h3 style="text-align: center">Please Login</h3>
    <label for="email">Email address</label>
    <input type="email" class="form-control" name = "email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name = "password" id="password" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary" value="Submit">Submit</button> 
</form>
</div>
</div>
<?php
   include_once "template/footer.php";
?>