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
			<a href="mystore.php">My Store</a>
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
	<?php
		if(isset($_GET['of_id']))
		{?>
			<div class="dltt-prdctpage">
				<h2>Are Your Sure You Want To Delete This Offer ?</h2>
				<form method="post">
					<input type="submit" name="ys_deleteof" value="Yes">
					<input type="submit" name="no_deleteof" value="No">
				</form>
			</div>
		<?php
			if(isset($_POST['no_deleteof']))
			{
				header("location:offers.php");
			}
			if(isset($_POST['ys_deleteof']))
			{
				$ofid=$_GET['of_id'];
				mysql_query("DELETE FROM offers WHERE of_id='$ofid'") or die ("Delete Failed");
				mysql_query("DELETE FROM product_photos WHERE of_id='$ofid'") or die ("Delete Failed");
				header("location:offers.php");
			}
		}
		else
		{?>
			<div class="dltt-prdctpage">
				<h2>Are Your Sure You Want To Delete This Product ?</h2>
				<form method="post">
					<input type="submit" name="ys_delete" value="Yes">
					<input type="submit" name="no_delete" value="No">
				</form>
			</div>
		<?php	
			if(isset($_POST['no_delete']))
			{
				header("location:dashboard.php");
			}
			if(isset($_POST['ys_delete']))
			{
				$pid=$_GET['p_id'];
				mysql_query("DELETE FROM products WHERE p_id='$pid'") or die ("Delete Failed");
				mysql_query("DELETE FROM product_photos WHERE p_id='$pid'") or die ("Delete Failed");
				header("location:dashboard.php");
			}
		}
	?>
	
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