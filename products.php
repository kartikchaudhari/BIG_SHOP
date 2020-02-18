<!DOCTYPE html>
<?php
	session_start();
	ob_start();
	require_once("config.php");
	$db = new DBController();
	include("functions.php");
?>
<html>
<head>
<title>Big Shop</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="icon" href="images/favicon.png" >
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<script src="js/jquery.min.js"></script>
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
	<?php menu(); 
	if(isset($_GET['view']))
	{
	?>
		<div class="path">
			<p>All Latest Products</p>
		</div>
		<div class="dpmain">
	<?php
		$sql='SELECT * FROM `products` T1 Join `product_photos` T2 ON T1.p_id=T2.p_id WHERE status="approved" ORDER BY T1.p_id DESC LIMIT 200';
		$query=mysqli_query($db->connectDb(),$sql);
		$p_id="";
		$row=mysqli_fetch_array($query);
		$count=mysqli_num_rows($query);
		if($count==0)
		{?>
			<h1 class="notfound">Product Not Found</h1>
		<?php
		}
		while($row=mysqli_fetch_array($query))
		{
			if($p_id!=$row['p_id'])
			{?>
				<div class="d-product">
				<div class="pbox">
					<form>	
						<a href="single.php?p_id=<?php echo $row['p_id']; ?>">
							<div class="pimage">
								<img src="seller/uploads/<?php echo $row['photo']; ?>">
							</div>
						</a>
						<div class="pinfo">
							<h5><?php echo $row['p_name']; ?></h5>
						</div>
							<div class="add-tocart">
							<h3> &#8377;  <?php echo $row['price']; ?></h3>
							<?php
								$user=$_SESSION['user'];
								$select_user="SELECT * FROM customer WHERE email='$user'";
								$user_query=mysqli_query($db->connectDb(),$select_user);
								$raw_user=mysqli_fetch_assoc($user_query);
							
								$already="SELECT * FROM cart WHERE c_id='".$raw_user['c_id']."' && p_id='".$row['p_id']."'";
								$already_query=mysqli_query($db->connectDb(),$already);
								$raw_already=mysqli_fetch_assoc($already_query);
								if(isset($_SESSION['user']))
								{	
									if($row['p_id']==$raw_already['p_id'])
									{?>
										<a href="cart-process.php?action=rmvfrmcrt&p_id=<?php echo $row['p_id']; ?>" class="add-to-cart" >Remove from cart</a>
									<?php
									}
									else
									{?>
										<a href="cart-process.php?action=adtocrt&p_id=<?php echo $row['p_id']; ?>" class="add-to-cart" >Add to cart</a>
									<?php
										$w="SELECT * FROM wish_list WHERE c_id='".$raw_user['c_id']."' && p_id='".$row['p_id']."'";
										$wl=mysqli_query($db->connectDb(),$w);
										$now=mysqli_num_rows($wl);
										if($now>0)
										{?>
											<a href="wish.php?action=rmfrmwishlist&p_id=<?php echo $row['p_id']; ?>" class="add-to-wish" >
												<img src="images/wished.png" />
											</a>
										<?php
										}
										else
										{?>
											<a href="wish.php?action=adtowish&p_id=<?php echo $row['p_id']; ?>" class="add-to-wish" >
												<img src="images/wish.png" />
											</a>
										<?php
										}
									}
								}
								else
								{									
									$already="SELECT * FROM cart WHERE c_id='".$_SERVER['REMOTE_ADDR']."' && p_id='".$row['p_id']."'";
									$already_query=mysqli_query($db->connectDb(),$already);
									$raw_already=mysqli_fetch_assoc($already_query);
									if($row['p_id']==$raw_already['p_id'])
									{?>
										<a href="cart-process.php?action=rmvfrmcrt&p_id=<?php echo $row['p_id']; ?>" class="add-to-cart" >Remove from cart</a>
									<?php
									}
									else
									{?>
										<a href="cart-process.php?action=adtocrt&p_id=<?php echo $row['p_id']; ?>" class="add-to-cart" >Add to cart</a>
										<a href="#" onclick="alert('Please Login To Add item To Your Wish list')" class="add-to-wish" >
											<img src="images/wish.png" />
										</a>
									<?php
									}
								}
							?>
							</div>
					</form>
				</div>
			</div>
			<?php
			$p_id=$row['p_id'];		
			}
		}
		?>
		</div>
		<?php
	}
	else
	{
	?>
	
	<div class="path"> 
	<?php
	   $subcat=$_GET['product'];
	   $sql="SELECT * FROM  category WHERE cate_id='$subcat'";
	   $query=mysqli_query($db->connectDB(),$sql);
	   $row=mysqli_fetch_assoc($query);
	?>
	<p>   
		<?php echo $row['main_cat']; ?>
		>
		<?php echo $row['category']; ?>
		>
		<?php echo $row['sub_cat']; ?>
	</p>	
	</div>
	<div class="dpmain">
	<?php
	$sql='SELECT * FROM `products` T1 Join `product_photos` T2 ON T1.p_id=T2.p_id WHERE cate_id="'.$_GET['product'].'" && status="approved" ORDER BY T1.p_id DESC LIMIT 12';
	$query=mysqli_query($db->connectDB(),$sql);
	$p_id="";
	$row=mysqli_fetch_array($query);
	$count=mysqli_num_rows($query);
	if($count==0)
	{?>
		<h1 class="notfound">Product Not Found</h1>
	<?php
	}
	while($row=mysqli_fetch_array($query))
	{
			if($p_id!=$row['p_id'])
			{?>
			<div class="d-product">
			<div class="pbox">
				<form>	
					<a href="single.php?p_id=<?php echo $row['p_id']; ?>">
						<div class="pimage">
							<img src="seller/uploads/<?php echo $row['photo']; ?>">
						</div>
					</a>
					<div class="pinfo">
							<h5><?php echo $row['p_name']; ?></h5>
					</div>
					<div class="add-tocart">
						<h3> &#8377;  <?php echo $row['price']; ?></h3>
						<?php
							if(isset($_SESSION['user']))
							{
								$user=$_SESSION['user'];
								$select_user="SELECT * FROM customer WHERE email='$user'";
								$user_query=mysqli_query($db->connectDB(),$select_user);
								$raw_user=mysqli_fetch_assoc($user_query);
						
								$already="SELECT * FROM cart WHERE c_id='".$raw_user['c_id']."' && p_id='".$row['p_id']."'";
								$already_query=mysqli_query($db->connectDB(),$already);
								$raw_already=mysqli_fetch_assoc($already_query);

								if($row['p_id']==$raw_already['p_id'])
								{?>
									<a href="cart-process.php?action=rmvfrmcrt&p_id=<?php echo $row['p_id']; ?>" class="add-to-cart" >Remove from cart</a>
								<?php
								}
								else
								{?>
									<a href="cart-process.php?action=adtocrt&p_id=<?php echo $row['p_id']; ?>" class="add-to-cart" >Add to cart</a>
									<?php
									$w="SELECT * FROM wish_list WHERE c_id='".$raw_user['c_id']."' && p_id='".$row['p_id']."'";
									$wl=mysqli_query($db->connectDB(),$w);
									$now=mysqli_num_rows($wl);
									if($now>0)
									{?>
										<a href="wish.php?action=rmfrmwishlist&p_id=<?php echo $row['p_id']; ?>" class="add-to-wish" >
											<img src="images/wished.png" />
										</a>
									<?php
									}
									else
									{?>
										<a href="wish.php?action=adtowish&p_id=<?php echo $row['p_id']; ?>" class="add-to-wish" >
											<img src="images/wish.png" />
										</a>
									<?php
									}
								}
							}
							else
							{									
								$already="SELECT * FROM cart WHERE c_id='".$_SERVER['REMOTE_ADDR']."' && p_id='".$row['p_id']."'";
								$already_query=mysqli_query($db->connectDB(),$already);
								$raw_already=mysqli_fetch_assoc($already_query);
								if($row['p_id']==$raw_already['p_id'])
								{?>
									<a href="cart-process.php?action=rmvfrmcrt&p_id=<?php echo $row['p_id']; ?>" class="add-to-cart" >Remove from cart</a>
								<?php
								}
								else
								{?>
									<a href="cart-process.php?action=adtocrt&p_id=<?php echo $row['p_id']; ?>" class="add-to-cart" >Add to cart</a>
									<a href="#" onclick="alert('Please Login To Add item To Your Wish list')" class="add-to-wish" >
										<img src="images/wish.png" />
									</a>
								<?php
								}
							}
						?>
					</div>
				</form>
			</div>
		</div>
			<?php
				$p_id=$row['p_id'];		
			}
	}
	}
	?>
	</div>
	<div class="clearfix"> </div>        	         
		<div class="footer">
		<?php include "footer.php"; ?>
	</div>
</body>
</html>