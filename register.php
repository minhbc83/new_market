<?php
include_once "template/header.php";
include_once "template/navigation.php";
?>
<form action="index.php" method="post">
    <input type="text" class="form-control" name = "email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
    <input type="password" class="form-control" name = "password" id="password" placeholder="Password">
    <input type="submit" class="btn btn-primary" value="Submit">
</form>
<?php
   include_once "template/footer.php";
?>