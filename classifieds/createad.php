<!DOCTYPE html>
<?php
	session_start();
	ob_start();
	require_once("../config.php");
	$db = new DBController();
	include("../suggesstion.php");
	include("validations.php");
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
						$query=mysqli_query($db->connectDB(),$sql);
						$raw=mysqli_fetch_assoc($query);
					?>
						<div class="account">
							<a href="../profile.php"><span> </span><?php echo $raw['f_name'];?>  <?php echo $raw['l_name'];?></a>
							<a href="../logout.php" id="logout">Logout</a>
						</div>
						<?php 
							$cid=$raw['c_id'];
							$cart="SELECT * FROM cart WHERE c_id='$cid'";
							$cartquery=mysqli_query($db->connectDB(),$cart);
							$NoOfItem=mysqli_num_rows($cartquery);
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
			<h3>Create Your Free Advertise</h3>
		</div>
		<div class="cl-main-sub crtad">
			<form method="POST" id="adform" enctype="multipart/form-data">
				<table width="100%">
					<tr>
						<td class="crtadlabel"><label>Select Category <span>*</span></label></td>
						<td>
							<select name="category" required>
								<option value="">Select Category</option>
								<option value="mobile">Mobiles</option>
								<option value="Electronics and Appliances">Electronics and Appliances</option>
								<option value="Cars">Cars</option>
								<option value="Bikes">Bikes</option>
								<option value="Furniture">Furniture</option>
								<option value="Pets">Pets</option>
								<option value="Books, Sports and hobbies">Books, Sports and hobbies</option>
								<option value="Fashion">Fashion</option>
								<option value="Kids">Kids</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="crtadlabel">
							<label>Ad Title <span>*</span></label>
						</td>
						<td>
							<input type="text" name="ad_title" value="<?php if(($_POST)){ echo $_POST['ad_title'];} ?>" required>
						</td>
					</tr>
					<tr>
						<td class="crtadlabel">
							<label>Brand <span>*</span></label>
						</td>
						<td>
							<input type="text" name="brand" value="<?php if(($_POST)){ echo $_POST['brand'];} ?>" required>
						</td>
					</tr>
					<tr>
						<td class="crtadlabel">
							<label>City <span>*</span></label>
						</td>
						<td>
							<input type="text" id="adcity" name="city" required>
						</td>
					</tr>
					<tr>
						<td class="crtadlabel">
							<label>Price <span>*</span></label>
						</td>
						<td>
							<input type="text" id="price" name="price" required>
						</td>
					</tr>
					<tr>
						<td class="crtadlabel">
							<label>Ad Description <span>*</span></label>
						</td>
						<td>
							<textarea name="addesc" placeholder="Write few lines about your product" required><?php if(($_POST)){ echo $_POST['addesc'];} ?></textarea>
						</td>
					</tr>
					<tr>
						<td class="crtadlabel">
							<label>Photos for your ad <span>*</span></label>
						</td>
						<td>
							<div class="phtsfruyrad">
								<input type="file" name="adphotos[]" multiple="multiple"   required/>
							</div>
						</td>
					</tr>
					<tr>
						<td class="crtadlabel">
							<label>Your Mobile No <span>*</span></label>
						</td>
						<td>
							<input type="text" name="mobilenum" id="mbl" required/>
						</td>
					</tr>
					<tr>
						<td class="crtadlabel">
							<label>Your Email Address <span>*</span></label>
						</td>
						<td>
							<input type="email" id="eml" name="email" required/>
						</td>
					</tr>
					<tr>
						<td></td>
						<td class="postad">
							<input type="submit" name="pstad" value="Post">					
						</td>
					</tr>
				</table>
			</form>
			<?php
				validatead();
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