<!DOCTYPE html>
<?php
	session_start();
	ob_start();
	require_once("config.php");
	$db = new DBController();
	include("functions.php");
	if(!isset($_SESSION['user']))
	{
		header("location: index.php");
	}
?>
<html>
<head>
<title>Big Shop</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="icon" href="images/favicon.png" >
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/dpupload.js"></script>
<script type="text/javascript" src="js/megamenu.js"></script>
<script type="text/javascript" src="js/livesearch.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
</head>
<body> 
	<div class="header">
	<?php
		bottomheader();
	?>
	</div>
	<?php menu(); ?>
	<div class="pro-cont">
		<?php
			$email=$_SESSION['user'];
			$sql="SELECT * FROM customer WHERE email='$email'";
			$query=mysqli_query($db->connectDb(),$sql);
			$row=mysqli_fetch_assoc($query);
			$c_id=$row['c_id'];
			$ord_id=$_GET['ord_id'];
			$ordqry="SELECT * FROM orders WHERE c_id='$c_id' && ord_id='$ord_id'";
			$ordq=mysqli_query($db->connectDb(),$ordqry);
		?>
		<center><h3>Order Details</h3></center>
		<?php
			while($ordrow=mysqli_fetch_assoc($ordq))
			{?>
				<div class="ordcntainer">
					<table>
						<tr>
							<td>Order ID&nbsp;</td>
							<td>
								:&nbsp;<?php echo $ordrow['ord_id']; ?>
							</td>
						</tr>
						<tr>
							<td>Date&nbsp;</td>
							<td>
								:&nbsp;<?php echo $ordrow['date']; ?>
							</td>
						</tr>
						<tr>
							<td>Time&nbsp;</td>
							<td>
								:&nbsp;<?php echo $ordrow['time']; ?>
							</td>
						</tr>
						<tr>
							<td>Amount&nbsp;</td>
							<td>
								:&nbsp;<?php echo $ordrow['amount']; ?>
							</td>
						</tr>
					</table>
					<br>
					<table border="1" width="100%" style="text-align:center;">
						<tr>
							<th>Product Image</th><th>Name</th><th>Price</th><th>Quantity</th>
						</tr>
						<?php
							$ord_id=$ordrow['ord_id'];
							$ordStus=substr($ordrow['order_status'],0,5);
							if($ordStus=="Offer")
							{
								$ofsql="SELECT * FROM p_list WHERE ord_id='$ord_id'";
								$ofqry=mysqli_query($db->connectDb(),$ofsql);
								$ofraw=mysqli_fetch_assoc($ofqry);
								$ofId=$ofraw['of_id'];
								
								$p_listsql="SELECT * FROM offers WHERE of_id='$ofId'";
								$p_listqry=mysqli_query($db->connectDb(),$p_listsql);
							
								$p_listsqlpht="SELECT * FROM product_photos WHERE of_id='$ofId'";
								$p_listqrypht=mysqli_query($db->connectDb(),$p_listsqlpht);
								$listrowpht=mysqli_fetch_assoc($p_listqrypht);
								
								while($listrow=mysqli_fetch_assoc($p_listqry))
								{
									if($of_id!=$listrow['of_id'])
									{
								?>
									<tr>
										<td>
											<img src="seller/uploads/<?php echo $listrowpht['photo']; ?>" height="150px" width="150px">
										</td>
										<td><?php echo $listrow['title']; ?></td>
										<td><?php echo $listrow['price']; ?></td>
										<td><?php echo $listrow['qty']; ?></td>
									</tr>
								<?php
									$of_id=$listrow['of_id'];
									}
								}
							}
							else
							{
								$p_listsql='SELECT * FROM `p_list` T1 Join `product_photos` T2 ON T1.v_id=T2.p_id Join products T3 on T1.v_id=T3.p_id WHERE ord_id="'.$ord_id.'"';
								$p_listqry=mysqli_query($db->connectDb(),$p_listsql);
							
								while($listrow=mysqli_fetch_assoc($p_listqry))
								{
									
									if($p_id!=$listrow['p_id'])
									{
								?>
									<tr>
										<td>
											<img src="seller/uploads/<?php echo $listrow['photo']; ?>" height="150px" width="150px">
										</td>
										<td><?php echo $listrow['p_name']; ?></td>
										<td><?php echo $listrow['price']; ?></td>
										<td><?php echo $listrow['qty']; ?></td>
									</tr>
								<?php
									$p_id=$listrow['p_id'];
									}
								}
							}
							
						?>
					</table>
				</div>
			<?php
			}
		?>
	</div>
	<div class="clearfix"></div>  
		<div class="footer">
		<?php 
			include "footer.php"
		?>
	</div>
</body>
</html>