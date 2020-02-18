<!DOCTYPE html>
<?php
	session_start();
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
<script src="js/jquery-1.11.1.min.js"></script>
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
	<?php
	if(strlen(trim($_GET['keyword']))==0)
	{?>
		<h3 class='notfound'>Please Enter Some Keyword</h3>
	<?php }
	else
	{
		$approved="approved";
		$search=trim($_GET['keyword']);
		$sql='SELECT * FROM `products` T1 Join `product_photos` T2 ON T1.p_id=T2.p_id WHERE (p_name LIKE "%'.$search.'%" OR brand LIKE "%'.$search.'%") && status like "%'.$approved.'%" ORDER BY T1.p_id DESC LIMIT 12';
		$query=mysqli_query($db->connectDB(),$sql);
		$count=mysqli_num_rows($query);
		if($count==0)
		{?>
			<h1 class="notfound">Sorry ! No Results Found</h1>
		<?php
		}
		else
		{?>
			<div class="dpmain"> <h3>Search Results For <?php echo $_GET['keyword']; ?></h3>
			<?php
			$p_id="";
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
								<h3>&#8377; <?php echo $row['price']; ?></h3>
							<?php
								if(isset($_SESSION['user']))
								{
									$db=new DBController();
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
										$db=new DBController();
										$wish="SELECT * FROM wish_list WHERE c_id='".$raw_user['c_id']."' && p_id='".$row['p_id']."'";
										$wishquery=mysqli_query($db->connectDB(),$wish);
										$wcount=mysqli_num_rows($wishquery);
										if($wcount>0)
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
									$db=new DBController();				
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
			</div>
			</div>
				<?php
					$p_id=$row['p_id'];		
				} 
			}
		}
	}
	?>
	</div>
	<div class="clearfix"> </div>        	         
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