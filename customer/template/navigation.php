
<nav class="navbar navbar-expand navbar-dark bg-dark">
	<ul class="navbar-nav ml-auto">
		<li class="nav-item">
			<a class="nav-link" href="../cart.php">
				<?php
				$cart_count = count($_SESSION['cart']);
				?>
				Cart <span class="badge badge-light" id="comparison-count"><?php echo $cart_count; ?></span>
			</a>
		</li>
<?php
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true && $_SESSION['access_level']=="Customer"){
			echo '<li class="nav-item">';
			echo  '<a class="nav-link" href="index.php">'.$_SESSION['firstname'].'</a>';
			echo "</li>";
			echo '<li class="nav-item">';
			echo  '<a class="nav-link" href="../logout.php">Logout</a>';
			echo "</li>";
		}
		else {
			echo '<li class="nav-item">';
			echo  '<a class="nav-link" href="../login.php">Login</a>';
			echo "</li>";
			echo '<li class="nav-item">';
			echo  '<a class="nav-link" href="../register.php">Register</a>';
			echo "</li>";
		}
?>
    </ul>
</nav>

<nav class="navbar navbar-light bg-light justify-content-between">
  <a class="navbar-brand">Navbar</a>
  <form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav>

	<nav class="navbar navbar-expand navbar-light justify-content-center" style="background-color: #9BD770
">
	<div>
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link" href="../index.php">HOME</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="../products.php">SẢN PHẨM</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php">DỊCH VỤ</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php">ĐÀO TẠO</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php">LIÊN HỆ</a>
			</li>
		</ul>
	</nav>
<?php
// show page header
echo "<div class='page-header'>
        <h1>{$page_title}</h1>
    </div>";
?>