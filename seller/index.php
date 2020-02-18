<!DOCTYPE html>
<?php
	session_start();
	ob_start();
	require_once("../config.php");
	include_once("validations.php");
	$db = new DBController();
	if(isset($_SESSION['seller']))
	{
		header("location:dashboard.php");
	}
?>
<html>
<head>
<title>Sell with BIGSHOPE</title>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="slider/style.css" />
</head>
<body>
<div class="sell-head">
	<div class="sell-logo">
		<a href="index.php"><img src="../images/logo.png" /></a>
	</div>
	<div class="sell-login">
		<span>Login</span>
		<a href="forg-pass.php" id="frgtslrpwd">Forgot Password ?</a>
		<form method="post" action="login_action.php">
			<input type="email" name="login_id" id="em" placeholder="Email" required />
			<input type="password" name="password" placeholder="Password" required />
			<input type="submit" name="login" value="Login" />
			<?php
				// if (isset($_POST['login'])) {
				// 	vallogin();
				// }
			 ?>
		</form>
	</div>
</div>
<div class="sell-main">
	<div class="sell-m-lf">
		<div id="wowslider-container1">
		<div class="ws_images"><ul>
				<li><img src="slider/images/slide1.png" alt="dfgdrgydth" title="Signup today" id="wows1_0"/></li>
				<li><img src="slider/images/slide2.png" alt="fdtgrstye" title="List Your Products" id="wows1_1"/></li>
				<li><img src="slider/images/slide3.png" alt="responsive slider" title="Sell On BIGSHOPE" id="wows1_2"/></li>
				<li><img src="slider/images/slide4.png" alt="colour-cubes-hq-picture" title="make money" id="wows1_3"/></li>
			</ul></div>
			<div class="ws_bullets">
				<div>
					<a href="#" title="dfgdrgydth"></a>
					<a href="#" title="fdtgrstye"></a>
					<a href="#" title="blur-wallpaper-16"></a>
					<a href="#" title="colour-cubes-hq-picture"></a>
				</div>  
			</div> 
		</div>	
		
	</div>
	<div class="reg-tdy">
	<h2>Register today</h2>
		<form method="post">
		<?php // ?>
			<input type="text" name="fname" id="fn" placeholder="First Name" required />
			<input type="text" name="lname" id="ln" placeholder="Last Name" required />
			<input type="email" name="email" id="email" placeholder="Email" required />
			<input type="email" name="cemail" id="cemail" placeholder="Confirm Email" required />
			<input type="text" name="mobile" id="mobile" placeholder="Mobile" required />
			<input type="text" name="city" id="city" placeholder="City" required />
			<textarea placeholder="Address"  name="add" id="add" required></textarea>
			<input type="password" name="pass" id="pass" placeholder="Password" required />
			<input type="password" name="cpass" id="cpass" placeholder="Confirm Password" required />
			<input type="submit" name="reg" value="Start Selling" />
			<?php 
				if (isset($_POST['reg'])) {
					validate();	
				}
			?>
		</form>
	</div>
</div>
<div class="footer-wrap">
	<ul class="foot-menu">
		<li><a href="../index.php">Back To BIGSHOPE.COM</a></li>
		<li><a href="#">Pricing</a></li>
		<li><a href="#">FAQs</a></li>
		<li><a href="#">Contact</a></li>
		<li><a href="#">Privacy Policy</a></li>
		<li><a href="#">Help</a></li>
	</ul>
</div>
<script type="text/javascript" src="slider/jquery.js"></script>
<script type="text/javascript" src="slider/wowslider.js"></script>
<script type="text/javascript" src="slider/script.js"></script>
</body>
</html>