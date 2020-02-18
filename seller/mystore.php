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
</head>
<body>
<div class="dash-top">
	<div class="dash-sel-tpo">
		<div class="dash-top-logo">
			<a href="dashboard.php">BIGSHOPE</a>
		</div>
		<div class="dash-top-uname">
			<a href="dashboard.php">Home</a>
			<a href="mystore.php" id="act-navsel">My Store</a>
			<a href="add-new-product.php">Add Products</a>
			<a href="orders.php">Orders</a>
			<a href="payments.php">Payments</a>
			<a href="offers.php">Offers</a>
			<a href="profile.php">My Account</a>
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
				<div class="prsnlinf">
				<form method="post">
					<?php
						function validity($d1,$d2)
						{
							$crnt=$d1;
							$second=date_create($d2);
							$count=0;
							while(date_create($crnt)<$second)
							{
								$crnt=gmdate("Y/m/d",strtotime("+1day",strtotime($crnt)));
								$count++;
							}
							return $count;
						}
						
						$exp=$row['date'];
						$type=$row['validity'];
						$Start_date=date("Y/m/d");
						
						$diff=validity($Start_date,$exp);
						if($diff<=0)
						{
							header("location:dashboard.php");
						}
						if($row['validity']=="trial")
						{
							echo "<h4>Trial Account - $diff days left / Exp : ".$row['date']." </h4>";
						}
						else
						{
							echo "<h4>Premium Account - $diff  days left / Exp : ".$row['date']." </h4>";
						}
					?>
					
						<input type="Text" name="Business_name" value="<?php echo $row['Name']; ?>" id="myprofname" placeholder="Business name" ><br>
						<input type="Text" name="Business_city" value="<?php echo $row['city']; ?>" id="myprofhome" placeholder="Business city" ><br>
						<input type="email" name="email" value="<?php echo $row['email']; ?>" id="myproemail" placeholder="Business Email" >
						<input type="Text" name="Mobile" value="<?php echo $row['telephone']; ?>" id="mypromob" placeholder="Mobile" ><br>
				</div>
						<input type="submit" name="saveset" value="Save Changes" id="mystrsavbtn">
						
						<?php
							if($row['validity']=="trial")
							{?>
								<a href="makepymnt.php?ugrd=prm" id="upgrdtprmum">Upgrade to premium</a>
							<?php
							}
							if(isset($_POST['saveset']))
							{
								$sql="SELECT * FROM seller WHERE email='".$_SESSION['seller']."'";
								$query=mysql_query($sql);
								$raw=mysql_fetch_array($query);
								$s_id=$raw['s_id'];
		
								$bname=$_POST['Business_name'];
								$bcty=$_POST['Business_city'];
								$bem=$_POST['email'];
								$bmb=$_POST['Mobile'];
								
								mysql_query("UPDATE store SET Name='$bname', email='$bem', telephone='$bmb', city='$bcty' WHERE s_id='$s_id'");
								header("location:mystore.php");
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