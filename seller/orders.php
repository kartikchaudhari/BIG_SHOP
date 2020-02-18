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
			<a href="mystore.php">My Store</a>
			<a href="add-new-product.php">Add Products</a>
			<a href="orders.php" id="act-navsel">Orders</a>
			<a href="payments.php">Payments</a>
			<a href="offers.php">Offers</a>
			<a href="profile.php">My Account</a>
			<a href="logout.php" id="act-navsel">Logout</a>
		</div>
	</div>
</div>
<div class="dash-main">
	<?php
		$sql="SELECT * FROM seller WHERE email='".$_SESSION['seller']."'";
		$query=mysql_query($sql);
		$row=mysql_fetch_assoc($query);
		$s_id=$row['s_id'];
		
		$sql="SELECT * FROM orders T1 JOIN p_list T2 ON T1.ord_id=T2.ord_id JOIN products T3 ON T2.v_id=T3.p_id JOIN product_photos T4 ON T2.v_id=T4.p_id WHERE s_id='$s_id' ORDER BY T1.ord_id DESC";
		$query=mysql_query($sql);
	?>
	<table class="orderTable" cellspacing="0">
		<tr>
			<th>Product Details</th><th>Costumer Name</th><th>Address</th><th>Placed Date</th><th>Quantity</th><th>Price</th><th>Amount</th>
		</tr>
		<?php
			$pidchk;
			while($row1=mysql_fetch_assoc($query))
			{
				if($pidchk!=$row1['p_id'])
				{
			?>
				<tr>
					<td>
						<img src="uploads/<?php echo $row1['photo']; ?>" height="100px" width="80px">
						<p style="display:inline-block; vertical-align:top; text-align:left;">
							<?php 
								echo substr($row1['p_name'],0,40);
								if(strlen($row1['p_name'])>=40){ echo "..."; }
								echo "<br>Order ID - ".$row1['ord_id'];
							?>
						</p>
					</td>
					<td>
						<?php
							$cidd=$row1['c_id'];
							$sqll="SELECT * FROM customer WHERE c_id='$cidd'";
							$qry=mysql_query($sqll);
							$rww=mysql_fetch_assoc($qry);
							echo $rww['f_name']." ".$rww['l_name'];
						?>
					</td>
					<td>
						<?php echo $rww['address']; ?>
					</td>
					<td>
						<?php echo $row1['date']; ?>
					</td>
					<td>
						<?php echo $row1['qty']; ?>
					</td>
					<td>
						<?php echo $row1['price']; ?>
					</td>
					<td>
						<?php echo $row1['price']*$row1['qty']; ?>
					</td>
				</tr>
			<?php
				}
				$pidchk=$row1['p_id'];
			}
		?>
	</table>
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