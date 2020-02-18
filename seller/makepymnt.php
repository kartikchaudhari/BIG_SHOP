<!DOCTYPE html>
<?php
	session_start();
	require_once("../config.php");
	$db_handle = new DBController();
	include("validations.php");
	if(!isset($_SESSION['seller']))
	{
		header("location:index.php");
	}
?>
<html>
<head>
<title>BIGSHOPE : SELLER ZONE</title>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="slider/style.css" />
<script type="text/javascript" src="slider/jquery.js"></script>
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
	<div class="crt-aaastr">
		<center>
		<?php
			if($_GET['ugrd']="prm")
			{
			?>
				<h2 style="margin-top:5em;">You requested to upgrade your store from trial to premium. make payment to be continue with premium account.</h2>
			<?php
			}
			else
			{
			?>
				<h2 style="margin-top:5em;">Your Store has Been Created Please make Payment To Active Your Store</h2>
			<?php
			}
		?>
		</center>
		<?php
			$sql="SELECT * FROM seller WHERE email='".$_SESSION['seller']."'";
			$query=mysql_query($sql);
			$row=mysql_fetch_assoc($query);
			$sellerID=$row['s_id'];
		?>
		<iframe src="http://localhost/BIG_SHOP/seller/Online_payment/PayUMoney_form.php?amount=1500&s_id=<?php echo $sellerID; ?>" width="100%" height="500px" frameborder="0" scrolling="yes"></iframe>
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