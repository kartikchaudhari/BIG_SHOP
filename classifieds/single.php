<!DOCTYPE html>
<?php
	session_start();
	ob_start();
	require_once("../config.php");
	include("../suggesstion.php");
	$db= new DBController();
?>
<html>
<head>
<title>Big Shop</title>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="icon" href="../images/favicon.png" >
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
<script src="../js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="../js/classifieds-search.js"></script>

<link rel="stylesheet" href="../css/etalage.css" type="text/css" media="all" />
<script src="../js/jquery.etalage.min.js"></script>
<script src="../js/livesearch.js"></script>
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
						{ 
						?>
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
	<div class="single-ad">
		<div class="single_grid">
			<div class="grid images_3_of_2">
				<ul id="etalage">
				<?php
					if(isset($_GET['Ad_id']))
					{
						$_SESSION['Ad_id']=$_GET['Ad_id'];
					}
					$sql='SELECT * FROM `classifieds` T1 Join `product_photos` T2 ON T1.Ad_id=T2.Ad_id WHERE T1.Ad_id="'.$_SESSION['Ad_id'].'" ORDER BY T1.Ad_id';
					$query=mysqli_query($db->connectDB(),$sql);
					while($row=mysqli_fetch_assoc($query))
					{?>
					<li>
						<a target="_blank" href="uploads/<?php echo $row['photo']; ?>">
							<img class="etalage_thumb_image" src="uploads/<?php echo $row['photo']; ?>" class="img-responsive" />
						</a>
						<img class="etalage_source_image" src="uploads/<?php echo $row['photo']; ?>" class="img-responsive" title="" />
					</li>
					<?php
					}
				?>
				</ul>
				<div class="clearfix"> </div>		
		    </div> 
			<div>
				<?php
					$sql='SELECT * FROM `classifieds` T1 Join `product_photos` T2 ON T1.Ad_id=T2.Ad_id Join `customer` T3 ON T3.c_id=T1.c_id WHERE T1.Ad_id="'.$_SESSION['Ad_id'].'" ORDER BY T1.Ad_id';
					$query=mysqli_query($db->connectDB(),$sql);
					$row=mysqli_fetch_assoc($query);
				?>
				<div class="cart-b">
					<div class="single-cl-disc">
						<h4><?php echo $row['p_name']; ?></h4>
						<h4>Location : <?php echo $row['altcity']; ?></h4>
						<div class="left-n">Price Rs. <?php echo $row['price']; ?></div><br><br>
						<h4>Interested in this Ad? <span style="color:rgb(0, 140, 230);">Contact the Seller!</span></h4>
						<h4>Contact : <?php echo $row['altmobile']; if($row['altmobile']!=$row['mobile']){ echo ", ".$row['mobile']; } ?></h4>
						<div class="sndmsg">
							<b>OR POST YOUR COMMENT</b>
							<form method="post">
								<textarea name="msg" placeholder="Write Your Comment Here...!"></textarea>
								<input type="submit" name="sndmsg" value="POST" />
							</form>
							<?php
								if(isset($_POST['sndmsg']))
								{
									if(isset($_SESSION['user']))
									{
										$sql="SELECT * FROM customer WHERE email='".$_SESSION['user']."' || mobile='".$_SESSION['user']."' ";
										$query=mysqli_query($db->connectDB(),$sql);
										$raw=mysqli_fetch_assoc($query);
										$fname=$raw['f_name'];
										$lname=$raw['l_name'];
										$name="$fname ".$lname;
										$email=$raw['email'];
										$cid=$raw['c_id'];
										$review=$_POST['msg'];
										$pid="ad";
										$pid.=$_GET['Ad_id'];
										if(strlen(trim($review))==0)
										{?>
											<script type="text/javascript">
												alert("Please enter some text");
											</script>
										<?php
										}
										else
										{
											$insert="INSERT INTO review(c_id,p_id,name,email,review) VALUES('$cid','$pid','$name','$email','$review')";
											$run=mysqli_query($db->connectDB(),$insert);
											header("location: ");
										}
									}
									else
									{?>
										<script type="text/javascript">
											alert("Please login to post comment");
										</script>
									<?php
									}
								}
								?>
								
								<div class="clcmnts">
								<?php
								$pidfr="ad";
								$pidfr.=$_GET['Ad_id'];
								$ee="SELECT * FROM review WHERE p_id='$pidfr' ORDER BY r_id DESC LIMIT 10";
								$ff=mysqli_query($db->connectDB(),$ee);
								while($gg=mysqli_fetch_assoc($ff))
								{
								?>
									<p><?php echo $gg['name']; ?></p>
									<p class="m_text"><?php echo $gg['review']; ?></p>
								<?php
								} 
							?>
						</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="clearfix"> </div>
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