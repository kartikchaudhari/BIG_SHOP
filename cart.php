<!DOCTYPE html>
<?php
session_start();
ob_start();
require_once("config.php");
$db = new DBController();
include("functions.php");
if(isset($_GET['updt']))
{
	$user=$_SESSION['user'];
	$select_user="SELECT * FROM customer WHERE email='$user'";
	$user_query=mysqli_query($db->connectDB(),$select_user);
	$raw=mysqli_fetch_array($user_query);
	$newcid=$raw['c_id'];
	
	$c_id=$_SERVER['REMOTE_ADDR'];
	
	$sql="UPDATE cart SET c_id='$newcid' WHERE c_id='$c_id'";
	$query=mysqli_query($db->connectDB(),$sql);
}
?>
<html>
<head>
<title>BIGSHOPE :: Your Cart</title>
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
	<div class="cart-box">
		<form method="post">
			<?php
				$db=new DBController();
				if(isset($_SESSION['user']))
				{
					$user=$_SESSION['user'];
					$select_user="SELECT * FROM customer WHERE email='$user'";
					$user_query=mysqli_query($db->connectDB(),$select_user);
					$raw=mysqli_fetch_array($user_query);
					$c_id=$raw['c_id'];
				}
				else
				{
					$c_id=$_SERVER['REMOTE_ADDR'];
				}
				$cart='SELECT * FROM `cart` T1 Join `product_photos` T2 ON T1.p_id=T2.p_id Join products T3 on T1.p_id=T3.p_id WHERE c_id="'.$c_id.'"';
				$carts=mysqli_query($db->connectDB(),$cart);
				$i=mysqli_num_rows($carts);
				$p_id="";

				$total=0;
				if($i==0)
				{?>
					<center>
						<h1>
							YOUR CART IS EMPTY<br><br><br><br><br>
							<a href="index.php">Start Your Shopping Now</a>
						</h1>
					</center>
					<script type="text/javascript">
						$(document).ready(function()
						{
							$(".gross-total").hide();
						});
					</script>
				<?php
				}
				while($row=mysqli_fetch_array($carts))
				{
					if($p_id!=$row['p_id'])
					{
			?>
					<div class="crt-itm">
						<div class="crt-itm-img">
							<a href="single.php?p_id=<?php echo $row['p_id'];?>">
								<img src="seller/uploads/<?php echo $row['photo']; ?>" />
							</a>
						</div>
						<div class="crt-itm-inf">
							<h4><?php echo $row['p_name']; ?></h4>
							<h6>Price : <?php echo $row['price']; ?></h6>
						</div>
						<div class="crt-itm-inf">
							<h4>Quantity</h4>
							<div class="quantity"> 
								<div class="quantity-select">                           
									<a href="cart-process.php?action=updtcrtminuse&p_id=<?php echo $row['p_id']; ?>" id="updtcrtplmns">-</a>
									<?php echo $row['qty']; ?>
									<a href="cart-process.php?action=updtcrtpluse&p_id=<?php echo $row['p_id']; ?>" id="updtcrtplsmns">+</a><br><br>
									<a href="cart-process.php?action=rstqty&p_id=<?php echo $row['p_id']; ?>" id="updtcrtrstqty">Reset</a>
								</div>			
							</div>
						</div>
						<div class="amount">
							<a href="cart-process.php?action=rmvfrmcrt&p_id=<?php echo $row['p_id']; ?>">Remove</a>
						</div>
						<div class="amount">
							&#8377; <?php echo $row['price']*$row['qty']; ?>
						</div>
					</div>
					<?php
					$p_id=$row['p_id'];
					$total+=$row['price']*$row['qty'];
				}
				}
			?>
			<div class="gross-total">
			Grand Total :
			<?php
				echo $total;
				
				if(isset($_SESSION['user']))
				{
			?>
				<input type="submit" name="checkout" class="chkoutbtn" value="Checkout" id="pymntbtn">
				<?php
				}
				else
				{ 
				?>
					<a href="login.php?crt=ip" style="text-decoration:none;">
						<input type="button" onclick="alert('Please Login To Checkout')" class="chkoutbtn" value="Checkout" id="pymntbtn">
					</a>
				<?php 
				}
				?>
			</div>
			<?php
				if(isset($_POST['checkout']))
				{
					$_SESSION['amnt']=$total;
					header("location:checkout.php");
				}
			?>
		</form>
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