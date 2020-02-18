<!DOCTYPE html>
<?php
	session_start();
	require_once("../config.php");
	include("validations.php");
	$db_handle = new DBController();
	if(isset($_SESSION['seller']))
	{
		header("location:dashboard.php");
	}
?>
<html>
<head>
<title>Recover Account</title>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="slider/style.css" />
<script type="text/javascript" src="slider/jquery.js"></script>
</head>
<body>
<div class="sell-head">
	<div class="sell-logo">
		<a href="index.php"><img src="../images/logo.png" /></a>
	</div>
	<div class="sell-login">
		<span>Login</span>
		<a href="forg-pass.php" id="frgtslrpwd">Forgot Password ?</a>
		<form method="post">
		<?php vallogin(); ?>
			<input type="email" name="login_id" id="em" placeholder="Email" required />
			<input type="password" name="password" placeholder="Password" required />
			<input type="submit" name="login" value="Login" />
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
		<script type="text/javascript" src="slider/wowslider.js"></script>
		<script type="text/javascript" src="slider/script.js"></script>
	</div>
	<div class="seller-forg-pass">
	<h2>Recover Account</h2>
		<form method="post">
			
			<input type="email" name="email" id="email" placeholder="Email" required />
			<input type="submit" name="getpass" value="Get Passwords" />
		</form>
		<?php
			function sendpass()
			{
				$em=$_POST['email'];
				$sql="SELECT * FROM seller WHERE email='$em'";
				$query=mysql_query($sql);
				$count=mysql_num_rows($query);
				if($count==1)
				{
					$row=mysql_fetch_array($query);
					$pass=$row['password'];
					$name=$row['f_name'];
					require '../srmailer/class.phpmailer.php';
					require '../srmailer/class.smtp.php';
					
					$mail = new PHPMailer();
					$mail->IsSMTP();
					$mail->Mailer = 'smtp';
					$mail->SMTPAuth = true;
					$mail->Host = 'smtp.gmail.com';
					$mail->Port = 465;
					$mail->SMTPSecure = 'ssl';

					$mail->Username = "bigshope898@gmail.com";
					$mail->Password = "bigger898shope";

					$mail->IsHTML(true);
					$mail->SingleTo = true;

					$mail->From = "bigshope898@gmail.com";
					$mail->FromName = "BigShop.com";

					$mail->addAddress($em,"User 1");

					$mail->Subject = "Password Recovery";
					$mail->Body = "
									Hi $name,
									<br /><br />
									This message is sent from BigShop.com for your password recovery request.
									<br />Your password is :<b> $pass </b>
								  ";
					if(!$mail->Send())
					{?>
						<input type="button" value="An error occurred please try again" class="wrng-log" disabled/><br>
				<?php
					}
					else
					{?>
						<input type="button" value="Your Password has been sent to your email" class="wrng-log" disabled/><br>
				<?php
					}
				}
				elseif($count==0)
				{?>
					<input type="button" value="Please Enter Valid Email" class="wrng-log" disabled/><br>
				<?php
				}
			}
			if(isset($_POST['getpass']))
			{
				sendpass();
			}
		?>
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
</body>
</html>