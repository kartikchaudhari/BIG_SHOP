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
<title>BIGSHOPE :: Make Payment</title>
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
	<div class="pymnt-box">
		<center>
			<h3>Total Amount : <?php $sesamnt=$_SESSION['amnt']; echo $sesamnt; ?></h3>
		</center>
		<script type="text/javascript">
			$(document).ready(function()
			{
				$(".cashondelfrm").hide();
				$(".pyleft").css("border-bottom","5px solid red"); 
				$(".pyleft").click(function()
				{
					$(".pyonlinfrm").show();
					$(".cashondelfrm").hide();	
					$(".pyleft").css("border-bottom","5px solid red"); 
					$(".pyright").css("border-bottom","none"); 
				});
				$(".pyright").click(function()
				{
					$(".cashondelfrm").show();
					$(".pyonlinfrm").hide();
					$(".pyright").css("border-bottom","5px solid red"); 			
					$(".pyleft").css("border-bottom","none"); 			
				});
			});
		</script>
		<div class="tab">
			<input type="button" class="pyleft" value="Pay Online">
			<input type="button" class="pyright" value="Cash on delivery">
		</div>
		<div class="pyonlinfrm">
			<?php
				$sql="SELECT c_id FROM customer WHERE email='".$_SESSION['user']."'";
				$row=mysqli_fetch_assoc(mysqli_query($db->connectDB(),$sql));
				$sessionID=$row['c_id'];
			?>
			<iframe src="http://localhost/BIG_SHOP/Online_payment/PayUMoney_form.php?amount=<?php echo $sesamnt; ?>&c_id=<?php echo $sessionID; ?>" width="100%" height="500px" frameborder="0" scrolling="yes"></iframe>
		</div>
		<div class="cashondelfrm">
			<div class="payment-box">
				<form method="post" name="cashondelform">
				<?php
				$user=$_SESSION['user'];
				$sql="SELECT * FROM customer WHERE email='$user'";
				$query=mysqli_query($db->connectDB(),$sql);
				$row=mysqli_fetch_assoc($query);
				?>
					<input type="text" placeholder="City" name="city" value="<?php echo $row['city']; ?>" class="eml" required />
					<input type="text" placeholder="Mobile" name="mob" value="<?php echo $row['mobile']; ?>" class="eml" required />
					<input type="text" placeholder="Pin Code" name="pincode" value="<?php echo $row['pincode']; ?>" class="eml" required />
					<input type="email" placeholder="Email - Order information will be sent to this email" value="<?php echo $row['email']; ?>" name="em" class="eml" required/>
					<textarea placeholder="Billing Address..." id="blladd" required name="biiladd"><?php echo $row['address']; ?></textarea>
					<input type="submit" value="Place Order" name="placeorder" id="pymntbutton" />
					<?php
						if(isset($_POST['placeorder']))
						{
							$city=$_POST['city'];
							$mob=$_POST['mob'];
							$pincode=$_POST['pincode'];
							$addr=$_POST['biiladd'];
							$c_id=$row['c_id'];
							
							mysqli_query($db->connectDB(),"UPDATE customer SET mobile='$mob', city='$city', pincode='$pincode' WHERE c_id='$c_id'")or die("updt fld");
							
							$total=$_SESSION['amnt'];
							$date=date("d-m-Y");
							$time=date("h:i:sa");
							$pstatus="COD";
							$ostatus="Placed";
							$ord="INSERT INTO orders(c_id,amount,date,time,address,payment_status,order_status) VALUES('$c_id','$total','$date','$time','$addr','$pstatus','$ostatus')";
							mysqli_query($db->connectDB(),$ord) or die("ord fld");
							
							$ord_id=mysqli_query($db->connectDB(),"SELECT * FROM orders T1 WHERE c_id='$c_id' ORDER BY T1.ord_id DESC LIMIT 1");
							$ord=mysqli_fetch_assoc($ord_id);
							
							$oid=$ord['ord_id'];
							
							$sql="INSERT INTO p_list(ord_id,v_id,qty) SELECT '$oid',p_id,qty FROM cart";
							mysqli_query($db->connectDB(),$sql) or die("mov fld");
							
							mysqli_query($db->connectDB(),"DELETE FROM cart WHERE c_id='$c_id'") or die("cart dlt fld");
							
							sendorder();
							
							header("location:success.php?pymth=COD&oid=$oid");
						}
					?>
				</form>
			</div>
		</div>
	</div>
	<div class="footer">
		<div class="footer-bottom">
			<a href="index.php"><img src="images/foot-logo.png" /></a><br/>
			<p>&copy 2017-2018 Big Shope. All rights reserved | Project by Sarjil Shaikh & Karan Tandel</p>
		<div class="clearfix"> </div>
		</div>
	</div>
</body>
</html>