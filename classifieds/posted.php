<!DOCTYPE html>
<?php
	session_start();
	ob_start();
	require_once("../config.php");
	$db_handle = new DBController();
	include("../suggesstion.php");
	include("../validations.php");
	if(!isset($_SESSION['user']))
	{
		header("location: ../login.php");
	}
?>
<html>
<head>
<title>Big Shop</title>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="icon" href="../images/favicon.png" >
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
<script src="../js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="../js/classifieds-search.js"></script>
</head>
<body> 
	<div class="header">
		<div class="bottom-header">
			<div class="container">
				<div class="header-bottom-left">
					<div class="logo">
						<a href="index.php"><img src="../images/logo.png" alt=" " /></a>
					</div>
					<div class="search">
						<form method="get" action="seacrh-cl.php">
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
					?>
						<div class="account">
							<a href="../profile.php"><span> </span><?php echo $raw['f_name'];?>  <?php echo $raw['l_name'];?></a>
							<a href="../logout.php" id="logout">Logout</a>
						</div>
						<?php 
							$cid=$raw['c_id'];
							$cart="SELECT * FROM cart WHERE c_id='$cid'";
							$cartquery=mysql_query($cart);
							$NoOfItem=mysql_num_rows($cartquery);
						?>
						<div class="cart">
							<a href="../cart.php"><span> </span>CART (<?php echo $NoOfItem; ?>)</a>
						</div>
						<a href="../cart-process.php?action=emptycart">Empty cart</a>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>	
			</div>
		</div>
	</div>
	<div class="cl-main">
		<div class="cl-search">
			<h3>Your advertise has been posted</h3>
		</div>
		<div class="cl-main-sub crtad">
			
		</div>
	</div>
	<div class="clearfix"></div>  
	<div class="footer">
		<div class="footer-bottom">
			<a href="../index.php"><img src="../images/foot-logo.png" /></a><br/>
			<p>&copy 2016 Big Shope. All rights reserved | Project by Sarjil Shaikh & Karan Tandel</p>
		<div class="clearfix"> </div>
		</div>
	</div>
</body>
</html>