<!DOCTYPE html>
<?php
session_start();
ob_start();
require_once("config.php");
$db = new DBController();
include("functions.php");
if(!isset($_SESSION['user']))
{
	header("location:cart.php");
}
?>
<html>
<head>
<title>BIGSHOPE :: Order Placed</title>
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
	<div class="CODsuccess">
		<center>
			<h1>Thank you</h1>
			<h2>Your order was completed successfully.</h2>
			<table>
				<?php
					$oid=$_GET['oid'];
					$ordsql="SELECT * FROM orders WHERE ord_id='$oid'";
					$ordqry=mysqli_query($db->connectDb(),$ordsql);
					$ordrow=mysqli_fetch_assoc($ordqry);
				?>
				<tr>
					<td>Order ID</td><td> : <?php echo $ordrow['ord_id']; ?></td>
				</tr>
				<tr>
					<td>Date</td><td> : <?php echo $ordrow['date']; ?></td>
				</tr>
				<tr>
					<td>Time</td><td> : <?php echo $ordrow['time']; ?></td>
				</tr>
			</table>
			<a href="index.php" id="CODdoneBUtn">Continue Shopping</a>
			<a href="view-single-order.php?ord_id=<?php echo $oid; ?>" id="CODdoneBUtn" >View Order</a>
			<b>
			<img src="images/626293-200.png" />
			   An email receipt including details about your order
			   has been sent to the email address provided. Please keep it for your records.
			</b>
		</center>
		
	</div>
	<div class="footer">
		<?php 
			include "footer.php";
		?>
	</div>
</body>
</html>