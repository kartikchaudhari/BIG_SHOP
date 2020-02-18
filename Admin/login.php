<?php
	session_start();
	require_once("../config.php");
	require_once("functions.php");
	$db_handle = new DBController();
	if(isset($_SESSION['Admin']))
	{
		header("location:index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>BIGSHOPE : Admin Login</title>
<link rel="icon" href="../images/favicon.png" >
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all">
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".forg-pass-container").hide();
		$("#forg-pass").click(function(){
			$(".forg-pass-container").fadeIn("fast");
		});
		$("#login").click(function(){
			$(".forg-pass-container").fadeOut("fast");
		});
	});
</script>
<?php
	if($_GET['pass']=="err")
	{
		?>
			<script type="text/javascript">
				$(document).ready(function(){
					$(".forg-pass-container").show();
				});
			</script>
		<?php
	}
	elseif($_GET['pass']=="invalid")
	{
		?>
			<script type="text/javascript">
				$(document).ready(function(){
					$(".forg-pass-container").show();
				});
			</script>
		<?php
	}
	elseif($_GET['pass']=="sent")
	{
		?>
			<script type="text/javascript">
				$(document).ready(function(){
					$(".forg-pass-container").show();
				});
			</script>
		<?php
	}
?>
<style>
.w3layouts-main
{
	background:rgb(19, 81, 150) none repeat scroll 0% 0%;
	box-shadow:0px 40px 40px rgb(24, 61, 84);
	animation:admin-login 7s infinite;
	-webkit-animation:admin-login 5s infinite;
	border-radius:3px;
	height:20em;
}
@keyframes admin-login
{
	0%, 100% {
		background: rgb(19, 81, 150) none repeat scroll 0% 0%
		box-shadow:0px 40px 40px rgb(24, 61, 84);
	}
	25% {
		background: rgb(103, 114, 134) none repeat scroll 0% 0%;
		box-shadow:0px 40px 40px rgb(0, 71, 116);
	}
	50% {
		background: rgb(0, 71, 116) none repeat scroll 0% 0%;
		box-shadow:0px 40px 40px rgb(103, 114, 134);
	}
	75% {
		background: rgb(86, 96, 107) none repeat scroll 0% 0%;
		box-shadow:0px 40px 40px rgb(54, 89, 128);
	}
}
.forg-pass-container
{
	position:fixed;
	background:white;
	left:0px;
	top:0px;
	width:100%;
	height:100%;
	z-index:9999;
}
.close-btn
{
	float:right;
	height:50px;
	width:50px;
	background:#00e623;
	border-radius:100%;
	border:1px solid #00e623;
	color:white;
	font-size:1.5em;
	cursor:pointer;
	margin:-2.5em;
}
</style>
</head>
<body>
<div class="w3layouts-main" id="ad-login">
	<h2>Admin Login</h2>
		<form method="post">
			<input value="E-MAIL" name="Email" type="email" required="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E-Mail';}"/>
			<input value="PASSWORD" name="Password" type="password" required="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'password';}"/>
			<span><input type="checkbox" name="rememberMe" />Remember Me</span>
			<h6><a href="#" id="forg-pass">Forgot Password?</a></h6>
				<div class="clear"></div>
				<input type="submit" value="login" name="login">
				<?php
					AdminLogin();
				?>
		</form>
</div>
<div class="forg-pass-container">
<div class="w3layouts-main" id="recover">
	<input type="button" value="X" class="close-btn" id="login" />
	<h2>Recover Password</h2>
		<form method="post">
			<input value="E-MAIL" name="Email" type="email" required="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E-Mail';}"/>
				<div class="clear"></div>
				<input type="submit" value="Get Password" name="get-pass">
				<p style="color:white;">
				<?php
					sendAdminpass(); 
					
					if($_GET['pass']=="err")
					{
						echo "An error occurred please try again";
					}
					elseif($_GET['pass']=="invalid")
					{
						echo "Please Enter Valid Email";
					}
					elseif($_GET['pass']=="sent")
					{
						echo "Your Password has been sent to your email";
					}
				?>
				</p>
		</form>
</div>
</div>
</body>
</html>