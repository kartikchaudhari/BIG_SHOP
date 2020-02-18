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
	<div class="crt-str">
	<?php
		if($_GET['type']=="trial")
		{?>
			<h1>Start Your Free Trial</h1>
		<?php
		}
		else
		{?>
			<h2>Go Primium &amp; Get unlimited Acces for One Year</h2>
		<?php
		}
	?>
		<form method="post">
			<input type="text" placeholder="Business Name" name="bname" id="bname" required>
			<input type="Email" placeholder="Business Email" name="bemail" id="bemail" required>
			<input type="text" placeholder="Contact No." name="bcontact" id="bcontct" required>
			<input type="text" placeholder="Business City" name="bcity" id="bcity" required>
			<input type="submit" value="Create Store Now" name="create">
		</form>
		<?php
			if(isset($_POST['create']))
			{
				createStore();
			}
		?>
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