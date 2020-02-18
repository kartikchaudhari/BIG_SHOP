<!DOCTYPE html>
<?php
	session_start();
	ob_start();
	require_once("../config.php");
	include("../suggesstion.php");
	$db = new DBController();
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

						if(isset($_SESSION['user']))
						{ 
							$sql="SELECT * FROM customer WHERE email='".$_SESSION['user']."' || mobile='".$_SESSION['user']."' ";
							$query=mysqli_query($db->connectDb(),$sql);
							$raw=mysqli_fetch_assoc($query);	
						?>
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
							$cartquery=mysqli_query($db->connectDB(),$cart);
							$NoOfItem=mysqli_num_rows($cartquery);
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
							$cartquery=mysqli_query($db->connectDB(),$cart);
							$NoOfItem=mysqli_num_rows($cartquery);
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
	<div class="cl-title">
		<h3>Search Result For <?php echo $_GET['keyword']; ?></h3>
	</div>
	<div class="cl-main">
		<div class="cl-main-sub">
	<?php
	if(strlen(trim($_GET['keyword']))==0)
	{?>
		<h3 class='notfound'>Blank Search " "</h3>
	<?php 
	}
	else
	{
		$keyword=trim($_GET["keyword"]);
		$sql="SELECT * FROM customer T3 JOIN classifieds T1 ON T3.c_id=T1.c_id JOIN product_photos T2 ON T1.Ad_id=T2.Ad_id WHERE p_name like '%" .$keyword. "%' OR brand like '%" .$keyword. "%' OR altmobile like '%" .$keyword. "%' OR mobile like '%" .$keyword. "%' ORDER BY p_name DESC LIMIT 20";
		$query=mysqli_query($db->connectDB(),$sql);
		$count=mysqli_num_rows($query);
		if($count==0)
		{?>
			<h1 class="notfound">No Result</h1>
		<?php
		}
		else
		{
		$Ad_id="";
		while($raw=mysqli_fetch_array($query))
		{
			if($Ad_id!=$raw['Ad_id'])
			{?>
			<div class="ad-box">
				<div class="ad-thumb">
					<a href="single.php?Ad_id=<?php echo $raw['Ad_id']; ?>">
						<img src="uploads/<?php echo $raw['photo']; ?>">
					</a>
				</div>
				<div class="ads-inf">
					<b><?php echo $raw['p_name']; ?></b><br>
						<table width="100%">
							<tr>
								<td>
									Location
								</td>
								<td>
									:&nbsp;&nbsp;<?php echo $raw['city']; ?>
								</td>
							</tr>
							<tr>
								<td>
									Price
								</td>
								<td>
									:&nbsp;&nbsp;<?php echo $raw['price']; ?><br>
								</td>
							</tr>
							<tr>
								<td>
									Contact
								</td>
								<td>
									:&nbsp;&nbsp;<?php echo $raw['altmobile']; ?>
								</td>
							</tr>
						</table>
				</div>
				<a href="single.php?Ad_id=<?php echo $raw['Ad_id']; ?>" id="ads-infa">View This Ad</a>
			</div>
			<?php
			$Ad_id=$raw['Ad_id'];		
			}
		}
	}}
	?>
			
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