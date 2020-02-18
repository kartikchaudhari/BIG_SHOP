<!DOCTYPE html>
<?php
	session_start();
	require_once("../config.php");
	$db_handle = new DBController();
	if(!isset($_SESSION['seller']))
	{
		header("location:index.php");
	}
	include("validations.php");
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
			<a href="offers.php" id="act-navsel">Offers</a>
			<a href="profile.php">My Account</a>
			<a href="logout.php" id="act-navsel">Logout</a>
		</div>
	</div>
</div>
<div class="dash-main">
	<div class="pro-cont">
	<h3 style="text-align:center;">Add New offer</h3>
		<div class="proinfcontainer">
			<div class="new-pro-con">
				<form method="post" enctype="multipart/form-data">
					<input type="text" name="of_Title" placeholder="Offer Title" required>
					<input type="text" name="sub_of_name" placeholder="Sub Title" required>
					<input type="text" name="price" placeholder="Offer Price" id="price" required>
					<input type="text" name="sdate" placeholder="Start Date (e.g 12-05-2013)" id="stdate" required>
					<input type="text" name="edate" placeholder="End Date (e.g 12-05-2013)" id="endate" required>
					<div id="product-pics">
						<input type="file" name="prdctphts[]" id="prdtcpics" multiple>
						<span>Choose Product Photos</span>
					</div>
					<textarea placeholder="Short description" name="offr_desc" required><?php echo $_POST['pro_desc']; ?></textarea>
					<input type="submit" name="ad-OFFER" value="Add Offer">
					<?php
						AddNewOffer();
						if($_GET['offer']=="added")
						{?>
							<h3>New Offer Added Successfully</h3>
						<?php	
						}
					?> 
				</form>
			</div>
		</div>
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