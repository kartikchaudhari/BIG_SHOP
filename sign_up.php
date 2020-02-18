<!DOCTYPE html>
<?php
	session_start();
	include("validations.php");
	require_once("config.php");
	$db = new DBController();
	include("functions.php");
	if(isset($_SESSION['user']))
	{
		header("location: index.php");
	}
?>
<html>
<head>
<title>Register to Big Shop</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="icon" href="images/favicon.png" >
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<script src="js/jquery.min.js"></script>
<link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/megamenu.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
<script type="text/javascript" src="js/livesearch.js"></script>
</head>
<body> 
	<div class="header">
	<?php
		bottomheader();
	?>
	</div>
	
	  <?php menu(); ?>
	<div class="register">
		<div class="registers1s1s">
			<h1>Create an account</h1>
			<form method="post">
			<?php validate(); ?>
				<input type="text" name="fname" id="fn" class="col-md-4" placeholder="First Name" required />
				<input type="text" name="lname" id="ln" class="col-md-4" placeholder="Last Name" required /><br><br><br>
				<input type="email" name="email" id="email" class="col-md-5" placeholder="Email" required />
				<input type="text" name="mobile" id="mobile" class="col-md-3" placeholder="Mobile" required /><br><br><br>
				<input type="text" name="city" id="city" class="col-md-4" placeholder="City" required />
				<input type="text" name="pincode" id="pincode" class="col-md-4" placeholder="Pin code" required /><br><br><br>
				<input type="text" name="add" id="add" class="address" placeholder="Address" required /><br>
				<input type="radio" name="gender" id="male" value="male" required /> Male
				<input type="radio" name="gender" id="female" value="female" required /> Female<br>
				<input type="password" name="pass" id="pass" class="col-md-4" placeholder="Password" required />
				<input type="password" name="cpass" id="cpass" class="col-md-4" placeholder="Confirm Password" required /><br><br><br>
				<input type="submit" value="Register" name="reg" class="col-md-5"/>
				<input type="reset" value="Clear form" name="reset" class="col-md-3"/>
			</form>
		</div>
	</div>
	<div class="footer">
		<div class="footer-bottom">
			<a href="index.php"><img src="images/foot-logo.png" /></a><br/>
			<p>&copy 2017-2018 Big Shope. All rights reserved | Project by Sarjil Shaikh & Karan Tandel</p>
		<div class="clearfix"> </div>
		</div>
	</div>
	</div>
</body>
</html>