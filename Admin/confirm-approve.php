<?php
	session_start();
	require_once("../config.php");
	$db_handle = new DBController();
	if(!isset($_SESSION['Admin']))
	{
		header("location:login.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>BIGSHOPE : Admin panel</title>
<link rel="icon" href="../images/favicon.png" >
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="slider/style.css" />
<script type="text/javascript" src="slider/jquery.js"></script>
<script src="../js/jquery.min.js"></script>
</head>
<body>
<div class="dash-top">
	<div class="dash-sel-tpo">
		<div class="dash-top-logo">
			<a href="index.php" id="admndash-top-logoa">ADMIN PANEL</a>
		</div>
		<div class="dash-top-uname">
			<a href="index.php">Home</a>
			<a href="apprv_requests.php" id="act-navsel">Approval Requests</a>
			<a href="categories.php">Categories</a>
			<a href="stores.php">Stores</a>
			<a href="profile.php">Setting</a>
			<a href="logout.php" id="act-navsel">Logout</a>
		</div>
	</div>
</div>
<div class="dash-main">
	<?php
		if(isset($_GET['of_id']))
		{?>
			<div class="dltt-prdctpage">
				<h2>Are Your Sure You Want To Approve This Offer ?</h2>
				<form method="post">
					<input type="submit" name="ys_deleteof" value="Yes">
					<input type="submit" name="no_deleteof" value="No">
				</form>
			</div>
		<?php
			if(isset($_POST['no_deleteof']))
			{
				header("location:apprv_requests.php");
			}
			if(isset($_POST['ys_deleteof']))
			{
				$ofid=$_GET['of_id'];
				$sql="UPDATE offers SET status='approved' WHERE of_id='$ofid'";
				mysql_query($sql) or die("update failed");
				header("location:apprv_requests.php");
			}
		}
		else
		{?>
			<div class="dltt-prdctpage">
				<h2>Are Your Sure You Want To Approve This Product ?</h2>
				<form method="post">
					<input type="submit" name="ys_delete" value="Yes">
					<input type="submit" name="no_delete" value="No">
				</form>
			</div>
		<?php	
			if(isset($_POST['no_delete']))
			{
				header("location:apprv_requests.php");
			}
			if(isset($_POST['ys_delete']))
			{
				$pid=$_GET['p_id'];
				$sql="UPDATE products SET status='approved' WHERE p_id='$pid'";
				mysql_query($sql) or die("update failed");
				header("location:apprv_requests.php");
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