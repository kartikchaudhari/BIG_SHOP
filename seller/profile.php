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
<link rel="icon" href="../images/favicon.png" >
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
			<a href="profile.php" id="act-navsel">My Account</a>
			<a href="logout.php" id="act-navsel">Logout</a>
		</div>
	</div>
</div>
<div class="dash-main">
	<div class="pro-cont">
	<?php
		$sql="SELECT * FROM seller WHERE email='".$_SESSION['seller']."'";
		$query=mysql_query($sql);
		$raw=mysql_fetch_array($query);
		$s_id=$raw['s_id'];
		
		$sql2="SELECT * FROM store WHERE s_id='$s_id'";
		$query2=mysql_query($sql2);
		$row=mysql_fetch_array($query2);
		$countstr=mysql_num_rows($query2);
		if($countstr==0)
		{
			header("location:dashboard.php");
		}
	?>
	<h3 style="text-align:center;"><?php echo $row['Name']; ?></h3>
		<div class="proinfcontainer">
			<div class="set-container">
				<form method="POST" enctype="multipart/form-data">
					<input type="Text" name="fname" value="<?php echo $raw['f_name']; ?>" id="myprofname" placeholder="First Name" ><br>
					<input type="Text" name="lname" value="<?php echo $raw['l_name']; ?>" id="myprofname" placeholder="Last Name" ><br>
					<input type="Text" name="city" value="<?php echo $raw['city']; ?>" id="myprofhome" placeholder="Home Town" ><br>
					<textarea placeholder="Address" name="Address"><?php echo $raw['address']; ?></textarea>
					<input type="Text" name="Mobile" value="<?php echo $raw['mobile']; ?>" id="mypromob" placeholder="Mobile" ><br>
					<input type="Text" name="email" value="<?php echo $raw['email']; ?>" id="myproemail" placeholder="Email" >
					<input type="password" name="currpass" id="mypropassnewold" placeholder="Old Password" ><br>
					<input type="password" name="newpass" id="mypropassnewold" placeholder="New Password" >
					<input type="submit" name="saveset" value="Save Changes" class="set-sub" id="mystrsavbtn">
				</form>
				<?php
					if(isset($_POST['saveset']))
					{
						if($raw['password']==$_POST['currpass'])
						{
							$f_name=$_POST['fname'];
							$l_name=$_POST['lname'];
							$eml=$_POST['email'];
							$mob=$_POST['Mobile'];
							$city=$_POST['city'];
							$addr=$_POST['Address'];
							$pass=$_POST['currpass'];
							$newpass=$_POST['newpass'];
							
							if(strlen(trim($_POST['newpass']))==0)
							{
								$updt="UPDATE seller SET f_name='$f_name', l_name='$l_name', email='$eml', mobile='$mob', city='$city', address='$addr' WHERE s_id='$s_id'";
								mysql_query($updt);
								$_SESSION['seller']=$eml;
								session_start();
								header("location:profile.php");
							}
							else
							{
								$updt="UPDATE seller SET f_name='$f_name', l_name='$l_name', email='$eml', mobile='$mob', city='$city', address='$addr', password='$newpass' WHERE s_id='$s_id'";
								mysql_query($updt);
								$_SESSION['seller']=$eml;
								header("location:profile.php");
							}
						}
						elseif(strlen(trim($_POST['currpass']))==0)
						{
							echo "<script>alert('You must enter your password to make changes. Fill new password field to change your password.');</script>";
						}
						elseif($_POST['currpass']!=$raw['password'])
						{
							echo "<script>alert('Wrong Password...!');</script>";
						}
					}
				?>
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