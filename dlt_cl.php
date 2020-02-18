<!DOCTYPE html>
<?php
	session_start();
	ob_start();
	require_once("config.php");
	$db_handle = new DBController();
	include("functions.php");
	if(!isset($_SESSION['user']))
	{
		header("location: index.php");
	}
?>
<html>
<head>
<title>Big Shop</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="icon" href="images/favicon.png" >
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/dpupload.js"></script>
<script type="text/javascript" src="js/megamenu.js"></script>
<script type="text/javascript" src="js/livesearch.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
</head>
<body> 
	<div class="header">
	<?php
		bottomheader();
	?>
	</div>
	<?php menu(); ?>
	<div class="pro-cont">
		<center>
			<h4 style="margin-top:5em;">Are you sure you want to delete this Ad ?</h4>
			<form method="post">
			<input type="submit" name="yesdlt" value="YES" id="dltscbtns">
			<input type="submit" name="nodlt" Value="NO" id="dltscbtns">
			</form>
			<?php
				if(isset($_POST['yesdlt']))
				{
					$Ad_id=$_GET['Ad_ID'];
					mysql_query("DELETE FROM classifieds WHERE Ad_id='$Ad_id'");
					mysql_query("DELETE FROM product_photos WHERE Ad_id='$Ad_id'");
					header("location:profile.php");
				}
				elseif(isset($_POST['nodlt']))
				{
					header("location:profile.php");
				}
			?>
		</center>
	</div>
	<div class="clearfix"></div>  
		<div class="footer">
		<div class="footer-bottom">
			<a href="index.php"><img src="images/foot-logo.png" /></a><br/>
			<p>&copy 2017-2018 Big Shope. All rights reserved | Project by Sarjil Shaikh & Karan Tandel</p>
		<div class="clearfix"> </div>
		</div>
	</div>
</body>
</html>