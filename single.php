<!DOCTYPE html>
<?php
	session_start();
	ob_start();
	require_once("config.php");
	$db= new DBController();
	include("functions.php");
?>
<html>
<head>
<title>Big shop</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="icon" href="images/favicon.png" >
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/megamenu.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
<link rel="stylesheet" href="css/etalage.css" type="text/css" media="all" />
<script src="js/jquery.etalage.min.js"></script>
<script src="js/livesearch.js"></script>
<script>
jQuery(document).ready(function($){

	$('#etalage').etalage({
		thumb_image_width: 300,
		thumb_image_height: 400,
		source_image_width: 900,
		source_image_height: 1200,
		show_hint: true,
		
	});

});
</script>
</head>
<body> 
	<div class="header">
	<?php
		bottomheader();
	?>
	</div>
	 <?php menu(); ?>
	<div class="clearfix">
	</div>
	<?php
		if(isset($_GET['p_id']))
		{
			$_SESSION['p_id']=$_GET['p_id'];
		}
		$sql='SELECT * FROM `products` T1 Join `product_photos` T2 ON T1.p_id=T2.p_id WHERE T1.p_id="'.$_SESSION['p_id'].'" ORDER BY T1.p_id';
		$query=mysqli_query($db->connectDb(),$sql);
		$siNcounT=mysqli_num_rows($query);
		if($siNcounT==0)
		{
			header("location:index.php");
		}
	?>
	 <div class="container"> 
	 	<div class="single_top">
	        <div class="single_grid">
				<div class="grid images_3_of_2">
					<ul id="etalage">
					<?php
						while($row=mysqli_fetch_assoc($query))
						{?>
						<li>
							<img class="etalage_thumb_image" src="seller/uploads/<?php echo $row['photo']; ?>" class="img-responsive" />
							<img class="etalage_source_image" src="seller/uploads/<?php echo $row['photo']; ?>" class="img-responsive" title="" />
						</li>	
						<?php
						}
					?>
					</ul>
					<div class="clearfix"> </div>		
				</div> 
				<div>
					<?php
						$sql='SELECT * FROM `products` T1 Join `product_photos` T2 ON T1.p_id=T2.p_id WHERE T1.p_id="'.$_SESSION['p_id'].'" ORDER BY T1.p_id';
						$query=mysqli_query($db->connectDb(),$sql);
						$row=mysqli_fetch_assoc($query);
						$pidfr=$row['p_id'];
						$s_id=$row['s_id'];
						
						$sesql="SELECT * FROM seller WHERE s_id='$s_id'";
						$seqry=mysqli_query($db->connectDb(),$sesql);
						$seRow=mysqli_fetch_assoc($seqry);
					?>
					
					<h4><?php echo $row['p_name']; ?></h4>
				<div class="cart-b">
					<div class="left-n ">Rs. <?php echo $row['price']; ?></div>
					<div class="sellerInfo">
						<h4>Seller Information</h4>
						<table>
							<tr>
								<td valign="top">Contact</td>
								<td valign="top"> : </td>
								<td>
									<?php echo $seRow['email']; ?>
									<br>
									<?php echo $seRow['mobile']; ?>
								</td>
							</tr>
							<tr>
								<td valign="top">Address</td>
								<td valign="top"> : </td>
								<td>
									<?php echo $seRow['address']; ?>
								</td>
							</tr>
						</table>
					</div>
					<br><br>
					<br><br>
					<?php
						$user='';
						if(isset($_SESSION['user'])){
							$user=$_SESSION['user'];		
						}
					
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
								<a href="cart-process.php?action=rmvfrmcrt&p_id=<?php echo $row['p_id']; ?>" class="now-get get-cart-in" >Remove from cart</a>
							<?php
							}
							else
							{?>
								<a href="cart-process.php?action=adtocrt&p_id=<?php echo $row['p_id']; ?>" class="now-get get-cart-in" >Add to cart</a>
								<?php
									$sql="SELECT * FROM wish_list WHERE c_id='".$raw_user['c_id']."' && p_id='".$row['p_id']."'";
									$query=mysqli_query($db->connectDb(),$sql);
									$count=mysqli_num_rows($query);
									if($count>0)
									{?>
										<a href="wish.php?action=rmfrmwishlist&p_id=<?php echo $row['p_id']; ?>" style="background:white;height:100%;" class="now-get get-cart-in" >
											<img src="images/wished.png" />
										</a>
									<?php
									}
									else
									{?>
										<a href="wish.php?action=adtowish&p_id=<?php echo $row['p_id']; ?>" style="background:white;height:100%;" class="now-get get-cart-in" >
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
								<a href="cart-process.php?action=rmvfrmcrt&p_id=<?php echo $row['p_id']; ?>" class="now-get get-cart-in" >Remove from cart</a>
							<?php
							}
							else
							{?>
								<a href="cart-process.php?action=adtocrt&p_id=<?php echo $row['p_id']; ?>" class="now-get get-cart-in" >Add to cart</a>
								<a href="#" onclick="alert('Please Login To Add item To Your Wish list')" style="background:white;height:100%;" class="now-get get-cart-in" >
									<img src="images/wish.png" />
								</a>
							<?php
							}
						}
					?>
				<br><br>
				<h6><?php echo $row['stock']; ?> items in stock</h6>
			   	<?php 
					$str=trim($row['desc']);
				?>
				<br>
				<h4>Product Description</h4>
			   	<textarea rows="14" readonly id="productDiscSingle"><?php echo $str; ?></textarea>
				<div class="clearfix"></div>
				</div>
				</div>
          	    <div class="clearfix"> </div>
            </div>
			<br>
		<h3>Similar Products</h3>
        <ul id="flexiselDemo1">
		<?php
			$aa="SELECT * FROM products T1 Join category T2 ON T1.cate_id=T2.cate_id WHERE T1.p_id='".$_GET['p_id']."'";
			$bb=mysqli_query($db->connectDb(),$aa);
			$cc=mysqli_fetch_assoc($bb);
			$subcat=$cc['cate_id'];
			$cate=$cc['category'];
			$dd="SELECT * FROM `products` T1 Join `product_photos` T2 ON T1.p_id=T2.p_id Join `category` T3 ON T1.cate_id=T3.cate_id WHERE T3.category Like '%" . $cc["category"] . "%' && status='approved'";
			$ee=mysqli_query($db->connectDb(),$dd);
			$p_id="";
			while($raw1=mysqli_fetch_assoc($ee))
			{
				if($p_id!=$raw1['p_id'])
				{
				?>
					<a href="single.php?p_id=<?php echo $raw1['p_id']; ?>">
						<li>
							<img height="210" width="150" src="seller/uploads/<?php echo $raw1['photo']; ?>" />
							<div class="grid-flex">
								<a href="single.php?p_id=<?php echo $raw1['p_id']; ?>">
								<?php
									if(strlen($raw1['p_name'])<=40)
									{
										echo $raw1['p_name'];
									}
									else
									{
										echo substr($raw1['p_name'],0,30)."...";
									}
								?>
								
								</a>
								<p>Rs. <?php echo $raw1['price']; ?></p>
							</div>
						</li>
					</a>
				<?php 
				$p_id=$raw1['p_id']; 
				}
			} 
		?>
		</ul>
	    <script type="text/javascript">
		 $(window).load(function() {
			$("#flexiselDemo1").flexisel({
				visibleItems: 5,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,    		
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
		    	responsiveBreakpoints: { 
		    		portrait: { 
		    			changePoint:480,
		    			visibleItems: 1
		    		}, 
		    		landscape: { 
		    			changePoint:640,
		    			visibleItems: 2
		    		},
		    		tablet: { 
		    			changePoint:768,
		    			visibleItems: 3
		    		}
		    	}
		    });
		    
		});
	</script>
	<script type="text/javascript" src="js/jquery.flexisel.js"></script>
			<div class="toogle">
				<h3 class="m_3">Reviews</h3>
				<form method="post">
				<?php
					if(!isset($_SESSION['user']))
					{?>
						<input type="text" name="name" placeholder="Name" required><br><br>
						<input type="email" name="email" placeholder="Email" required/><br><br>
					<?php 
					}
				?>
					<textarea class="rwvv-txt" placeholder="Write Your Review About <?php echo $row['p_name'] ?>" name="review" required></textarea>
					<br><input type="submit" value="POST REVIEW" name="pst-rw" class="pst-rw" />
				<?php
					if(isset($_POST['pst-rw']))
					{
						if(isset($_SESSION['user']))
						{
							$sql="SELECT * FROM customer WHERE email='".$_SESSION['user']."' || mobile='".$_SESSION['user']."' ";
							$query=mysqli_query($db->connectDb(),$sql);
							$raw=mysqli_fetch_assoc($query);
							$fname=$raw['f_name'];
							$lname=$raw['l_name'];
							$name="$fname ".$lname;
							$email=$raw['email'];
							$cid=$raw['c_id'];
							$review=$_POST['review'];
							$pid=$_GET['p_id'];
							$insert="INSERT INTO review(c_id,p_id,name,email,review) VALUES('$cid','$pid','$name','$email','$review')";
							$run=mysqli_query($db->connectDb(),$insert);
							header("location: ");
						}
						else
						{
							$name=$_POST['name'];
							$email=$_POST['email'];
							$cid="unreg";
							$cid.=rand(10000,999999);
							$review=$_POST['review'];
							$pid=$_GET['p_id'];
							$insert="INSERT INTO review(c_id,p_id,name,email,review) VALUES('$cid','$pid','$name','$email','$review')";
							$run=mysqli_query($db->connectDb(),$insert);
							header("location: ");
						}
					}
				?>
				</form>
				<?php
					$ee="SELECT * FROM review WHERE p_id='$pidfr' ORDER BY r_id DESC LIMIT 10";
					$ff=mysqli_query($db->connectDb(),$ee);
					while($gg=mysqli_fetch_assoc($ff))
					{
					?>
						<p><?php echo $gg['name']; ?></p>
						<p class="m_text"><?php echo $gg['review']; ?></p>
				<?php } ?>
			</div>	
        </div>
		<div class="clearfix"> </div>			
		</div>
	<!---->
		<div class="footer">
			<?php include "footer.php"; ?> 
	</div>
</body>
</html>