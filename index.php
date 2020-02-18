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
<script type="text/javascript" src="js/livesearch.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
</head>
<body> 
	<div class="header">
		<div class="top-header">
			<div class="container">
				<div class="top-header-left">
					<ul class="support">
						<li class="van">
						<?php
						if(isset($_SESSION['user']))
						{
							$sql="SELECT * FROM customer WHERE email='".$_SESSION['user']."' || mobile='".$_SESSION['user']."' ";
							$query=mysqli_query($db->connectDB(),$sql);
							$raw=mysqli_fetch_assoc($query);
						?>
							<a href="">Welcome <?php echo $raw['f_name']; ?> |Start Your Shopping!</a> 
							
						<?php
						}
						else
						{?>
								<a href="sign_up.php">Sign Up Now to sell Your used products</a> 
									|
								<a href="seller/index.php">Create online store Go to seller zone</a>
						<?php
						}
						?>
						</li>
					</ul>
					<div class="clearfix"> </div>
				</div>
				<div class="top-header-right">
					<div class="down-top">		
						<a href="classifieds/index.php">VIEW CLASSIFIEDS</a>
					</div>
					<div class="down-top top-down">
						<?php
						if(isset($_SESSION['user']))
						{
						?>
							<a href="classifieds/createad.php" name="logout" class="logout">Post Free Ad</a>
						<?php
						}
						else
						{
						?>
							<a href="seller/index.php">SELLER ZONE</a>
						<?php
						}
						?>
					</div>
					<div class="clearfix"> </div>	
				</div>
				<div class="clearfix"> </div>		
			</div>
		</div>
		<?php
			bottomheader();
		?>
	</div>
	
	<!--this function calls the all category in a dropdown menu-->
	<?php menu(); ?>
	
	<div class="older">
		<h3>Classifieds</h3>
	<?php
	$ads="SELECT * FROM classifieds ORDER BY rand() DESC LIMIT 3";
	$clqry=mysqli_query($db->connectDB(),$ads);
	$Ad_id="";
	while($row=mysqli_fetch_array($clqry))
	{
		if($Ad_id!=$row['Ad_id'])
		{
			$sqlphoto="SELECT * FROM product_photos WHERE Ad_id='".$row['Ad_id']."'";
			$queryphoto=mysqli_query($db->connectDB(),$sqlphoto);
			$rowphoto=mysqli_fetch_assoc($queryphoto);
			?>
			<div class="oldprd">
				<a href="classifieds/single.php?Ad_id=<?php echo $row['Ad_id']; ?>">
					<div class="olddi">
						<img src="classifieds/uploads/<?php echo $rowphoto['photo']; ?>">
					</div>
				</a>
				<div class="olddinfo">
					<h4><?php echo substr(trim($row['p_name']),0,15)."..."; ?></h4>
					<h5><?php echo $row['altcity']; ?></h5>
					<h5>Mobile : <?php echo $row['altmobile']; ?></h5>
					<h5>Price : <?php echo $row['price']; ?></h5>
					<a href="classifieds/single.php?Ad_id=<?php echo $row['Ad_id']; ?>"><h5>VIEW ITEM</h5></a>
				</div>
			</div>
		<?php
		$Ad_id=$row['Ad_id'];		
		}
	}
	?>
		<div class="view-all">	
			<a href="classifieds/index.php"><h3>VIEW ALL</H3></a>
		</div>
	</div>
	<div class="container">
		<div class="shoes-grid">
			<div class="wrap-in">
				<div class="wmuSlider example1 slide-grid">		 
				   <div class="wmuSliderWrapper">	  
						    <?php
						    
								$sql="SELECT * FROM offers WHERE status='approved' ORDER BY RAND() DESC limit 10";
								$query=mysqli_query($db->connectDB(),$sql);
								$of_idd=0;
								while($row=mysqli_fetch_assoc($query))
								{
									if($of_idd!=$row['of_id'])
									{
										$phsql="SELECT * FROM product_photos WHERE of_id='".$row['of_id']."'";
										$phqry=mysqli_query($db->connectDB(),$phsql);
										$phrow=mysqli_fetch_assoc($phqry);
										?>
										<a href="singleOffer.php?of_id=<?php echo $row['of_id']; ?>">	
											<article style="position: absolute; width: 100%; opacity: 0;">					
												<div class="banner-matter">
													<div class="col-md-5 banner-bag">
														<img class="img-responsive " src="seller/uploads/<?php echo $phrow['photo']; ?>" alt=" " />
													</div>
													<div class="col-md-7 banner-off">							
														<h2><?php echo $row['title']; ?></h2>
														<label><?php echo $row['sub_title']; ?></label>
														<p>
															<?php
																if($row['desc']>0)
																{
																	echo $row['desc']." Discount"; 
																}
															?>
														</p>					
														<span class="on-get">GET NOW</span>
													</div>
													<div class="clearfix"> </div>
												</div>
											</article>
										</a>
									<?php
									}
									$of_idd=$row['of_id'];
								}
						    ?>
						   
					</div>
	                <ul class="wmuSliderPagination">
	                	<li><a class="">0</a></li>
	                	<li><a class="">1</a></li>
	                	<li><a class="">2</a></li>
	                </ul>
					<script src="js/jquery.wmuSlider.js"></script> 
					<script>
						$('.example1').wmuSlider();         
					</script> 
	            </div>
	        </div>
	   		<div class="clearfix"> </div>
		</div>   
	<div class="products">
	   	<h5 class="latest-product">NEW ARRIVALS</h5>	
		<a class="view-all" href="products.php?view=all">VIEW ALL<span> </span></a> 		     
	</div>  
	
	</div>
	<div class="dpmain">
	<?php
		displayPro();
	?>		
	</div>
	
	<div class="clearfix"></div>  
	
		<div class="footer">
		<?php include "footer.php"; ?>
	</div>
</body>
</html>