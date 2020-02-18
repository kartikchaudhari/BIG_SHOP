<!DOCTYPE html>
<?php
	session_start();
	require_once("../config.php");
	$db_handle = new DBController();
	if(!isset($_SESSION['seller']))
	{
		header("location:index.php");
	}
	include("validations.php");
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
			<a href="mystore.php">My Store</a>
			<a href="add-new-product.php">Add Products</a>
			<a href="orders.php">Orders</a>
			<a href="payments.php">Payments</a>
			<a href="offers.php" id="act-navsel">Offers</a>
			<a href="profile.php">My Account</a>
			<a href="logout.php" id="act-navsel">Logout</a>
		</div>
	</div>
</div>
<div class="dash-main">
	<div class="pro-cont">
	<h3 style="text-align:center;">Edit offer</h3>
		<div class="proinfcontainer">
			<div class="new-pro-con">
				<?php
					$sql="SELECT * FROM offers WHERE of_id='".$_GET['of_id']."'";
					$query=mysql_query($sql);
					$row=mysql_fetch_assoc($query);
				?>
				<form method="post" enctype="multipart/form-data">
					<input type="text" name="of_Title" value="<?php echo $row['title']; ?>" placeholder="Offer Title" required>
					<input type="text" name="sub_of_name" value="<?php echo $row['sub_title']; ?>" placeholder="Sub Title" required>
					<input type="text" name="price" value="<?php echo $row['price']; ?>" placeholder="Offer Price" id="price" required>
					<input type="text" name="sdate" value="<?php echo $row['start_date']; ?>" placeholder="Start Date (e.g 12-05-2013)" id="stdate" required>
					<input type="text" name="edate" value="<?php echo $row['end_date']; ?>" placeholder="End Date (e.g 12-05-2013)" id="endate" required>
					<textarea placeholder="Short description" name="offr_desc" required><?php echo $row['desc']; ?></textarea>
					<input type="submit" name="updt-OFFER" value="Add Offer">
					<?php
						if($_GET['offer']=="Updated")
						{?>
							<h3>Offer Updated Successfully</h3>
						<?php	
						}
						if(isset($_POST['updt-OFFER']))
						{
							$title=$_POST['of_Title'];
							$sub_title=$_POST['sub_of_name'];
							$price=$_POST['price'];
							$sdate=$_POST['sdate'];
							$edate=$_POST['edate'];
							$desc=$_POST['offr_desc'];
							
							$price=$_POST['price'];
							$vl_price='/^[0-9]*$/';
							
							$diff=validity($sdate,$edate);
							$today=date('d-m-y');
							$tdy=validity($sdate,$today);
							
							if($diff<=0)
							{?>
								<script type="text/javascript" language="javascript">  
									$(document).ready(function() 
									{  
										$("#stdate").attr("placeholder",'Invalid Date...!'); 
									}); 
								</script>
							<?php
							}
							elseif($tdy<0)
							{?>
								<script type="text/javascript" language="javascript">  
									$(document).ready(function() 
									{  
										$("#stdate").attr("placeholder",'Invalid Date...!'); 
									}); 
								</script>
							<?php
							}
							else
							{?>
								<script type="text/javascript" language="javascript">  
									$(document).ready(function() 
									{  
										$("#stdate").attr("value",'<?php echo $sdate; ?>'); 
									}); 
								</script>
								<script type="text/javascript" language="javascript">  
									$(document).ready(function() 
									{  
										$("#endate").attr("value",'<?php echo $edate; ?>'); 
									}); 
								</script>
							<?php	
							}
							
							if(preg_match($vl_price,$price))
							{?>
								<script type="text/javascript" language="javascript">  
									$(document).ready(function() 
									{  
										$("#price").attr("value",'<?php echo $price; ?>'); 
									}); 
								</script>
							<?php	
							}
							else
							{?>
								<script type="text/javascript" language="javascript">  
									$(document).ready(function() 
									{  
										$("#price").attr("placeholder",'Invalid Price...! -> <?php echo $price; ?>'); 
										$("#price").css("color","red"); 
										}); 
								</script>
							<?php	
							}
							
							if(preg_match($vl_price,$price))
							{
								$status="Waiting";
								
								$sql="UPDATE `smartdb`.`offers` T1 SET `title`='$title', `sub_title`='$sub_title', `desc`='$desc', `start_date`='$sdate', `end_date`='$edate', `price`='$price', `status`='$status' WHERE T1.of_id='".$_GET['of_id']."'";
								$query=mysql_query($sql) or die("Failed");
							}
							$ofid=$_GET['of_id'];
							header("location:Edit-offer.php?offer=Updated&of_id=$ofid");
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