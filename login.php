<!DOCTYPE html>
<?php
session_start();
ob_start();
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
<title>Login to Big Shop</title>
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
		<div class="clogin">
		<div class="clog1">
		<h1>SIGN IN</h1>
		<form method="post">
			<input type="email" name="login_id" placeholder="Your Email" required /> <br/><br/>
			<input type="password" name="password" placeholder="Password" required /><br> <br/>
		<?php
			if(isset($_POST['login']))
			{
				$sql="SELECT * FROM customer WHERE email='".$_POST['login_id']."' && password='".$_POST['password']."' || mobile='".$_POST['login_id']."' && password='".$_POST['password']."' ";
				$query=mysqli_query($db->connectDB(),$sql);
				$count=mysqli_num_rows($query);
				if($count==1)
				{
					$_SESSION['user']=$_POST['login_id'];
					if(isset($_GET['crt']))
					{
						header("location:cart.php?updt=ip");
					}
					else
					{
						header("location:index.php");
					}
				}
				else
				{?>
					<input type="button" value="WRONG EMAIL OR PAASWORD" class="wrng-log" disabled/><br>
				<?php 
				}
			}
		?>
		<input type="submit" value="Login" name="login" />
		</form>
		<br><br>
		<center>
			<a href="forg-pass.php">Forgot Password ?</a>
			<h6>Not a Member Yet? <a href="sign_up.php">Sign Up Now</a></h6>
		</center>
		</div><div class="clearfix"> </div>	
	</div><div class="clearfix"> </div>	
	<div class="footer">
		<div class="footer-bottom">
			<a href="index.php"><img src="images/foot-logo.png" /></a><br/>
			<p>&copy 2017-2018 Big Shope. All rights reserved | Project by Sarjil Shaikh & Karan Tandel</p>
		<div class="clearfix"> </div>
		</div>
	</div>
</body>
</html>