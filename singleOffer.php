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
		if(isset($_GET['of_id']))
		{
			$_SESSION['of_id']=$_GET['of_id'];
		}
		$sql='SELECT * FROM `offers` T1 Join `product_photos` T2 ON T1.of_id=T2.of_id WHERE T1.of_id="'.$_SESSION['of_id'].'" ORDER BY T1.of_id';
		$query=mysqli_query($db->connectDb(),$sql);
		$siNcounT=mysqli_num_rows($query);
		if($siNcounT==0)
		{
			header("location:index.php");
		}
	?>
	 <div class="container"> 
	 	<div class=" single_top">
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
						$sql='SELECT * FROM `offers` T1 Join `product_photos` T2 ON T1.of_id=T2.of_id WHERE T1.of_id="'.$_SESSION['of_id'].'" ORDER BY T1.of_id';
						$query=mysqli_query($db->connectDb(),$sql);
						$row=mysqli_fetch_assoc($query);
						$pidfr=$row['of_id'];
					?>
					
					<h4><?php echo $row['title']; ?></h4>
					<h5><?php echo $row['sub_title']; ?></h5>
				<div class="cart-b">
					<div class="left-n ">Rs. <?php echo $row['price']; ?></div><br><br>
					<a href="checkoutOffer.php?action=BuyNow&of_id=<?php echo $row['of_id']; ?>" class="now-get get-cart-in" >Buy Now</a>
				<br><br>
				<br><br>
			   	<?php 
					$str=trim($row['desc']);
				?>
				<br>
				<h4>Offer Description</h4>
			   	<textarea rows="14" readonly id="productDiscSingle"><?php echo $str; ?></textarea>	
				<div class="clearfix"></div>
				
				</div>
				</div>
          	    <div class="clearfix"> </div>
            </div>
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
		</div>
		<h3>New Offers</h3>
        <ul id="flexiselDemo1">
		<?php
			$sqll='SELECT * FROM `offers` WHERE status="approved" ORDER BY RAND() DESC limit 10';
			$queryy=mysqli_query($db->connectDb(),$sqll);
			$of_id="";
			while($raw1=mysqli_fetch_assoc($queryy))
			{
				if($of_id!=$raw1['of_id'])
				{
					$phsql="SELECT * FROM product_photos WHERE of_id='".$raw1['of_id']."'";
					$phqry=mysqli_query($db->connectDb(),$phsql);
					$phrow=mysqli_fetch_assoc($phqry);
				?>
					<a href="singleOffer.php?of_id=<?php echo $phrow['of_id']; ?>">
						<li>
							<img height="210" width="150" src="seller/uploads/<?php echo $phrow['photo']; ?>" />
							<div class="grid-flex">
								<a href="singleOffer.php?of_id=<?php echo $phrow['of_id']; ?>"><?php echo $raw1['sub_title']; ?></a>
								<p><?php echo $raw1['price']; ?></p>
							</div>
						</li>
					</a>
				<?php 
				$of_id=$raw1['of_id']; 
				}
			} 
		?>
		</ul>
        <div class="clearfix"> </div>			
		</div>
	
	<div class="footer">
		<?php
			include "footer.php";
		?>
	</div>
</body>
</html>