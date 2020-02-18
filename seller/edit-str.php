<!DOCTYPE html>
<?php
	session_start();
	require_once("../config.php");
	$db_handle = new DBController();
	if(!isset($_SESSION['seller']))
	{
		header("location:index.php");
	}
?>
<html>
<head>
<title>BIGSHOPE : SELLER ZONE</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="dash-top">
	<div class="dash-sel-tpo">
		<div class="dash-top-logo">
			<a href="dashboard.php">BIGSHOPE</a>
		</div>
		<div class="dash-top-uname">
			<a href="dashboard.php">Home</a>
			<a href="mystore.php" id="act-navsel">My Store</a>
			<a href="add-new-product.php">Add Products</a>
			<a href="orders.php">Orders</a>
			<a href="payments.php">Payments</a>
			<a href="offers.php">Offers</a>
			<a href="profile.php">My Account</a>
			<a href="logout.php" id="act-navsel">Logout</a>
		</div>
	</div>
</div>
<div class="dash-main">
	<div class="mystore">
		<h1>Business Info</h1>
		<form method="post">
		<table cellspacing="0">
			<tr>
				<td>Name</td><td><input type="text" value="Business Name" /></td>
			</tr>
			<tr>
				<td>Email</td><td><input type="email" value="Sarjil1432@gmail.com" /></td>
			</tr>
			<tr>
				<td>Mobile</td><td><input type="text" value="9712169979" /></td>
			</tr>
			<tr>
				<td>City</td><td><input type="text" value="Vansda, India" /></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="updt" value="Update Store"
				</td>
			</tr>
		</table>
		</form>
	</div>
</div>
<div class="footer-wrap">
	<ul class="foot-menu">
		<li><a href="../index.php">Go To BIGSHOPE.COM</a></li>
		<li><a href="#">Pricing</a></li>
		<li><a href="#">FAQs</a></li>
		<li><a href="#">Contact</a></li>
		<li><a href="#">Privacy Policy</a></li>
		<li><a href="#">Help</a></li>
	</ul>
</div>
</body>
</html>	