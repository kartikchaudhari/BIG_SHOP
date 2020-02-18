<!DOCTYPE html>
<?php
	session_start();
	require_once("../config.php");
	$db_handle = new DBController();
	if(!isset($_SESSION['seller']))
	{
		header("location:index.php");
	}
	include("validations.php");
?>
<html>
<head>
<title>BIGSHOPE : SELLER ZONE</title>
<link rel="stylesheet" href="../css/style.css">
<script type="text/javascript" src="../js/jquery-1.4.1.min.js" ></script>
<script type="text/javascript">	
$(document).ready(function()
{
	$(".main_cat").change(function()
	{
		var id=$(this).val();
		var dataString = 'main-cat='+ id;
	
		$.ajax
		({
			type: "POST",
			url: "get_cat.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$(".category").html(html);
			} 
		});
	});
	$(".category").change(function()
	{
		var id=$(this).val();
		var dataString = 'cate='+ id;
	
		$.ajax
		({
			type: "POST",
			url: "get_subcat.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$(".sub_cat").html(html);
			} 
		});
	});
});
</script>
</head>
<body>
<div class="dash-top">
	<div class="dash-sel-tpo">
		<div class="dash-top-logo">
			<a href="dashboard.php">BIGSHOPE</a>
		</div>
		<div class="dash-top-uname">
			<a href="dashboard.php">Home</a>
			<a href="mystore.php">My Store</a>
			<a href="add-new-product.php" id="act-navsel">Add Products</a>
			<a href="orders.php">Orders</a>
			<a href="payments.php">Payments</a>
			<a href="offers.php">Offers</a>
			<a href="profile.php">My Account</a>
			<a href="logout.php" id="act-navsel">Logout</a>
		</div>
	</div>
</div>
<div class="dash-main">
	<div class="pro-cont">
	<h3 style="text-align:center;">Add New Product</h3>
		<div class="proinfcontainer">
			<div class="new-pro-con">
				<form method="post" enctype="multipart/form-data">
					
					<select name="main-cat" class="main_cat" required>
						<option value="">Main Category</option>
						<?php
							$sql="SELECT DISTINCT main_cat FROM category ORDER BY main_cat";
							$query=mysql_query($sql);
							while($row=mysql_fetch_array($query))
							{?>
								<option value="<?php echo $row['main_cat']; ?>" ><?php echo $row['main_cat']; ?></option>
							<?php
							}
							if(strlen(trim($_POST['main-cat']))!=0)
							{?>
								<option value="<?php echo $_POST['main-cat']; ?>" selected><?php echo $_POST['main-cat']; ?></option>
							<?php
							}
						?>
					</select>
					
					<select name="cate" class="category" required>
						<option value="">Category</option>
						<?php
							if(strlen(trim($_POST['cate']))!=0)
							{?>
								<option value="<?php echo $_POST['cate']; ?>" selected><?php echo $_POST['cate']; ?></option>
							<?php
							}
						?>
					</select>
					
					<select name="sub_cat" class="sub_cat" required>
						<option value="">Sub Category</option>
						<?php
							if(strlen(trim($_POST['sub_cat']))!=0)
							{?>
								<option value="<?php echo $_POST['sub_cat']; ?>" selected><?php echo $_POST['sub_cat']; ?></option>
							<?php
							}
						?>
					</select>
					
					<input type="text" name="p_name" value="<?php echo $_POST['p_name']; ?>" placeholder="Product Name" required>
					<input type="text" name="brand" value="<?php echo $_POST['brand']; ?>" placeholder="Product Brand" required>
					<input type="text" name="wrnty" value="<?php echo $_POST['wrnty']; ?>" placeholder="Product Warranty (e.g 1 Year, 6 Months etc.)" required>
					<input type="text" name="price" placeholder="Product Price" id="price" required>
					<input type="text" name="stock" value="<?php echo $_POST['stock']; ?>"  placeholder="Stock (Available No. of products)" required>
					<input type="text" name="discount" value="<?php echo $_POST['discount']; ?>" placeholder="Product Discount (e.g 10%, 20% etc.)" required>
					<div id="product-pics">
						<input type="file" name="prdctphts[]" id="prdtcpics" multiple>
						<span>Choose Product Photos</span>
					</div>
					<textarea placeholder="Short description" name="pro_desc" required><?php echo $_POST['pro_desc']; ?></textarea>
					<input type="submit" name="ad-prod" value="Add Product">
					<?php
						AddNewProduct();
						if($_GET['product']=='Added')
						{
							echo "<h3>New Product Added Successfully</h3>";
						}
					?>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="footer-wrap">
	<ul class="foot-menu">
		<li><a href="../index.php">Go To BIGSHOPE.COM</a></li>
		<li><a href="#">Pricing</a></li>
		<li><a href="#">FAQs</a></li>
		<li><a href="#">Contact</a></li>
		<li><a href="#">Privacy Policy</a></li>
		<li><a href="#">Help</a></li>
	</ul>
</div>
</body>
</html>	