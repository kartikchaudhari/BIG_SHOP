<?php
session_start();
ob_start();
require_once("../config.php");
$db_handle = new DBController();
include("../functions.php");

$user=$_GET['ssid'];
$sql="SELECT * FROM customer WHERE c_id='$user'";
$query=mysql_query($sql);
$row=mysql_fetch_assoc($query);
$_SESSION['user']=$row['email'];

if(!isset($_SESSION['user']))
{
	header("location:../cart.php");
}

$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="GQs7yium";

If(isset($_POST["additionalCharges"]))
{
	$additionalCharges=$_POST["additionalCharges"];
	$retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
}
else
{
	$retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
}
$hash = hash("sha512", $retHashSeq);                    

	$eml=$_SESSION['sendtothis'];
	
	$sel_cid=mysql_fetch_assoc(mysql_query("SELECT c_id FROM customer WHERE email='$eml'"));
	$c_id=$sel_cid['c_id'];
	
	$city=$_SESSION['delcity'];
	$mob=$_SESSION['delmob'];
	$pincode=$_SESSION['delpin'];
	
	mysql_query("UPDATE customer SET mobile='$mob', city='$city', pincode='$pincode' WHERE c_id='$c_id'")or die("updt fld");
	
	$total=$_SESSION['amnt'];
	$addr=$_SESSION['deladd'];
	$date=date("d-m-Y");
	$time=date("h:i:sa");
	$pstatus="Done";
	$ostatus="Confirmed";
	$ord="INSERT INTO orders(c_id,amount,date,time,address,payment_status,order_status) VALUES('$c_id','$total','$date','$time','$addr','$pstatus','$ostatus')";
	mysql_query($ord) or die("ord fld");
	
	$ord_id=mysql_query("SELECT ord_id FROM orders T1 WHERE c_id='$c_id' ORDER BY T1.ord_id DESC LIMIT 1");
	$ord=mysql_fetch_assoc($ord_id);
	
	$oid=$ord['ord_id'];
	
	$sql="INSERT INTO p_list(ord_id,v_id,qty) SELECT '$oid',p_id,qty FROM cart";
	mysql_query($sql) or die("mov fld");
	
	mysql_query("DELETE FROM cart WHERE c_id='$c_id'") or die("cart dlt fld");

sendorderpaid();
?>

<!DOCTYPE html>
<html>
<head>
<title>BIGSHOPE :: Order Placed</title>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="icon" href="../images/favicon.png" >
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />	
<script src="../js/jquery.min.js"></script>
<link href="../css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="../js/megamenu.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
<script type="text/javascript">
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "../suggesstion.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
});

function selectsuggetion(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>
</head>
<body> 
	<div class="header">
		<div class="bottom-header">
			<div class="container">
				<div class="header-bottom-left">
					<div class="logo">
						<a href="../index.php"><img src="../images/logo.png" alt="" /></a>
					</div>
					<div class="search">
						<form method="get" action="../Search_result.php">
							<input type="text" name="keyword" id="search-box" placeholder="Search" autocomplete="off">
							<input type="submit"  value="SEARCH">
							<label id="suggesstion-box"></label>
						</form>
					</div>
							
					<div class="clearfix"> </div>
				</div>
				<div class="header-bottom-right">	
					<?php
						$sql="SELECT * FROM customer WHERE email='".$_SESSION['user']."' || mobile='".$_SESSION['user']."' ";
						$query=mysql_query($sql);
						$raw=mysql_fetch_assoc($query);
						if(isset($_SESSION['user']))
						{ ?>
							<div class="account">
								<a href="../profile.php"><span> </span><?php echo $raw['f_name'];?>  <?php echo $raw['l_name'];?></a>
								<a href="../logout.php" id="logout">Logout</a>
							</div>
						<?php 
						}
						else 
						{ ?>
							<ul class="login">
								<li><a href="../login.php"><span> </span>LOGIN</a></li> |
								<li ><a href="../sign_up.php">SIGNUP</a></li>
							</ul>
						<?php 
						}
						if(isset($_SESSION['user']))
						{
							$cid=$raw['c_id'];
							$cart="SELECT * FROM cart WHERE c_id='$cid'";
							$cartquery=mysql_query($cart);
							$NoOfItem=mysql_num_rows($cartquery);
						?>
						<div class="cart">
							<a href="../cart.php"><span> </span>CART (<?php echo $NoOfItem; ?>)</a>
						</div>
						<a href="../cart-process.php?action=emptycart">Empty cart</a>
						<?php 
						}
						else
						{
							$cid=$_SERVER['REMOTE_ADDR'];
							$cart="SELECT * FROM cart WHERE c_id='$cid'";
							$cartquery=mysql_query($cart);
							$NoOfItem=mysql_num_rows($cartquery);
						?>
						<div class="cart">
							<a href="../cart.php"><span> </span>CART (<?php echo $NoOfItem; ?>)</a>
						</div>
						<a href="../cart-process.php?action=emptycart">Empty cart</a>
						<?php 
						}
						?>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>	
			</div>
		</div>
	</div> 
	<div class="CODsuccess">
		<center>
			<h1>Thank you</h1>
			<h2>Your order was completed successfully.</h2>
			<table>
			<?php
				$disorder=mysql_query("SELECT * FROM orders T1 WHERE c_id='$c_id' ORDER BY T1.ord_id DESC LIMIT 1");
				$disorderqry=mysql_fetch_assoc($disorder);
			?>
				<tr>
					<td>Order ID</td><td>&nbsp; : &nbsp; <?php echo $disorderqry['ord_id']; ?></td>
				</tr>
				<tr>
					<td>Transaction ID</td><td>&nbsp; : &nbsp; <?php echo $txnid; ?></td>
				</tr>
				<tr>
					<td>Amount</td><td>&nbsp; : &nbsp; <?php echo $amount; ?></td>
				</tr>
				<tr>
					<td>Date-Time</td><td>&nbsp; : &nbsp; <?php echo $disorderqry['date']." - ".$disorderqry['time']; ?></td>
				</tr>
			</table>
			<a href="../index.php" id="CODdoneBUtn">Continue Shopping</a>
			<a href="../view-single-order.php?ord_id=<?php echo $oid; ?>" id="CODdoneBUtn" >View Order</a>
			<b>
			<img src="../images/626293-200.png" />
			   An email receipt including details about your order
			   has been sent to the email address provided. Please keep it for your records.
			</b>
		</center>
		
	</div>
	<div class="footer">
		<div class="footer-bottom">
			<a href="../index.php"><img src="../images/foot-logo.png" /></a><br/>
			<p>&copy 2016 Big Shope. All rights reserved | Project by Sarjil Shaikh & Karan Tandel</p>
		<div class="clearfix"> </div>
		</div>
	</div>
</body>
</html>