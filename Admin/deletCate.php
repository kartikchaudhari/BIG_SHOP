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
			<a href="apprv_requests.php">Approval Requests</a>
			<a href="categories.php" id="act-navsel">Categories</a>
			<a href="stores.php">Stores</a>
			<a href="profile.php">Setting</a>
			<a href="logout.php" id="act-navsel">Logout</a>
		</div>
	</div>
</div>
<div class="dash-main">
	<div class="dltt-prdctpage">
				<h2>Are Your Sure You Want To Delete This Category ?</h2>
				<form method="post">
					<input type="submit" name="ys_deleteof" value="Yes">
					<input type="submit" name="no_deleteof" value="No">
				</form>
			</div>
		<?php
			if(isset($_POST['no_deleteof']))
			{
				header("location:categories.php");
			}
			if(isset($_POST['ys_deleteof']))
			{
				$cate_id=$_GET['cate_id'];
				$sql="DELETE FROM category WHERE cate_id='$cate_id'";
				mysql_query($sql) or die("delete failed");
				header("location:categories.php?category=deleted");
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