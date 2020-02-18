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
			<a href="apprv_requests.php" id="act-navsel">Approval Requests</a>
			<a href="categories.php">Categories</a>
			<a href="stores.php">Stores</a>
			<a href="profile.php">Setting</a>
			<a href="logout.php" id="act-navsel">Logout</a>
		</div>
	</div>
</div>
<div class="dash-main">
	<br>
		<script type="text/javascript">
			$(document).ready(function()
			{
				$("#ofrapprtbl").hide();
				$(".pyleft1").css("border-bottom","5px solid green"); 
				$(".pyleft1").click(function()
				{
					$("#prapprtbl").show();
					$("#ofrapprtbl").hide();	
					$(".pyleft1").css("border-bottom","5px solid green"); 
					$(".pyright1").css("border-bottom","none"); 
				});
				$(".pyright1").click(function()
				{
					$("#ofrapprtbl").show();
					$("#prapprtbl").hide();
					$(".pyright1").css("border-bottom","5px solid green"); 			
					$(".pyleft1").css("border-bottom","none"); 			
				});
			});
		</script>
	<div class="tab" style="margin-bottom:;">
		<input type="button" class="pyleft1" value="Products Approval Requests">
		<input type="button" class="pyright1" value="Offers Approval Requests">
	</div>
	<div class="pro-list" id="prapprtbl">
		<?php
			$product='SELECT * FROM `products` T1 Join `product_photos` T2 ON T1.p_id=T2.p_id WHERE T1.status="waiting" ORDER BY T1.p_id DESC';
			$pqry=mysql_query($product);
			$noOfproducts=mysql_num_rows($pqry);
			if($noOfproducts==0)
			{?>
				<center>
					<h4 ID="noproavl">NO APPROVAL REQUESTS</h4>
				</center>
			<?php
			}
			else
			{?>
				<table cellspacing="0">
					<tr>
						<th>Product Details</th><th>Stock</th><th>Price</th><th>Status</th><th>Options</th>
					</tr>
					<?php
					$p_id='';
					while($row=mysql_fetch_assoc($pqry))
					{
						if($p_id!=$row['p_id'])
						{?>
							
							<tr>
								<td>
									<img src="../seller/uploads/<?php echo $row['photo']; ?>">
									<p id="prd-dtl">
										<?php echo substr($row['p_name'],0,40)."..."; ?><br>
										Brand : <?php echo $row['brand']; ?>
									</p>
								</td>
								<td><?php echo $row['stock']; ?></td>
								<td><?php echo $row['price']; ?>/-</td>
								<td><?php echo $row['status']; ?></td>
								<td>
									<a href="confirm-approve.php?p_id=<?php echo $row['p_id']; ?>" id="tblda">Approve</a>
									<a href="disapprove.php?p_id=<?php echo $row['p_id']; ?>" id="tblda">Disapprove</a>
								</td>
							</tr>
						<?php
						$p_id=$row['p_id'];
						}
					}
					?>
				</table> 
			<?php
			}
		?>
	</div>
	<div class="pro-list" id="ofrapprtbl">
		<?php
			$product='SELECT * FROM `offers` T1 Join `product_photos` T2 ON T1.of_id=T2.of_id WHERE T1.status="waiting" ORDER BY T1.of_id DESC';
			$pqry=mysql_query($product);
			$noOfproducts=mysql_num_rows($pqry);
			if($noOfproducts==0)
			{?>
				<center>
					<h4 ID="noproavl">NO APPROVAL REQUESTS</h4>
				</center>
			<?php
			}
			else
			{?>
				<br>
				<table cellspacing="0">
					<tr>
						<th>Offer Details</th><th>Price</th><th>Status</th><th>Options</th>
					</tr>
					<?php
					$p_id='';
					while($row=mysql_fetch_assoc($pqry))
					{
						if($of_id!=$row['of_id'])
						{?>
							
							<tr>
								<td>
									<img src="../seller/uploads/<?php echo $row['photo']; ?>">
									<p id="prd-dtl">
										<?php echo $row['title']; ?><br>
										<?php echo substr($row['sub_title'],0,50); if(strlen($row['sub_title'])>=50){ echo "..."; } ?>
									</p>
								</td>
								<td><?php echo $row['price']; ?>/-</td>
								<td><?php echo $row['status']; ?></td>
								<td>
									<a href="confirm-approve.php?of_id=<?php echo $row['of_id']; ?>" id="tblda">Approve</a>
									<a href="disapprove.php?of_id=<?php echo $row['of_id']; ?>" id="tblda">Disapprove</a>
								</td>
							</tr>
						<?php
						$of_id=$row['of_id'];
						}
					}
					?>
				</table> 
			<?php
			}
		?>
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