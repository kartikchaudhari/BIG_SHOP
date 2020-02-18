<?php
	session_start();
	require_once("../config.php");
	$db_handle = new DBController();
	if(!isset($_SESSION['Admin']))
	{
		header("location:login.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>BIGSHOPE : Admin panel</title>
<link rel="icon" href="../images/favicon.png" >
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="slider/style.css" />
<script type="text/javascript" src="../js/jquery-1.4.1.min.js" ></script>
<script type="text/javascript" src="slider/jquery.js"></script>
</head>
<body>
<div class="dash-top">
	<div class="dash-sel-tpo">
		<div class="dash-top-logo">
			<a href="index.php" id="admndash-top-logoa">ADMIN PANEL</a>
		</div>
		<div class="dash-top-uname">
			<a href="index.php">Home</a>
			<a href="apprv_requests.php">Approval Requests</a>
			<a href="categories.php" id="act-navsel">Categories</a>
			<a href="stores.php">Stores</a>
			<a href="profile.php">Setting</a>
			<a href="logout.php" id="act-navsel">Logout</a>
		</div>
	</div>
</div>
<div class="dash-main">
	<div class="admin-dash">
		<input type="button" value="Add New Category" id="AddNewCategory">
		<?php
			if(isset($_GET['NewCate'])=="Added")
			{
				?>
					<input type="button" value="New Category Added Successfully..." id="AddNewCategoryss">
				<?php
			}
			if(isset($_GET['Cate'])=="Updated")
			{
				?>
					<input type="button" value="Category Updated Successfully..." id="AddNewCategoryss">
				<?php
			}
			if(isset($_GET['category'])=="deleted")
			{
				?>
					<input type="button" value="Category Deleted Successfully..." id="AddNewCategoryss">
				<?php
			}
		?>
		<br>
		<br>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".addNewCate").hide();
				$("#AddNewCategory").click(function(){
					$(".addNewCate").fadeIn("fast");
				});
				$(".addNewCateFormclosebtn").click(function(){
					$(".addNewCate").fadeOut("fast");
				});
			});
		</script>
		<div class="addNewCate">
			<div class="addNewCateinner">
				<h3>Add new category<input class="addNewCateFormclosebtn" type="button" value="X"></h3>
				<div class="addNewCateForm">
					<form method="post">
						<input type="text" name="main_cate" placeholder="Main_Category" required>
						<input type="text" name="cate" placeholder="Category" required>
						<input type="text" name="sub_cate" placeholder="Sub_Category" required>
						<input type="submit" name="submitCate" value="Add category">
					</form>
					<?php
						if(isset($_POST['submitCate']))
						{
							$mc=$_POST['main_cate'];
							$ct=$_POST['cate'];
							$Sc=$_POST['sub_cate'];
							
							$sql="INSERT INTO category(cate_id,main_cat,category,sub_cat) VALUES(null,'$mc','$ct','$Sc')";
							if(mysql_query($sql))
							{
								header("location:categories.php?NewCate=Added");
							}
						}
					?>
				</div>
			</div>
		</div>
		<table cellspacing="0">
			<tr>
				<th>Cate_ID</th>
				<th>Main_Category</th>
				<th>Category</th>
				<th>Sub_Category</th>
				<th>Options</th>
			</tr>
			<?php
				$sql="SELECT * FROM category";
				$query=mysql_query($sql);
				$i=0;
				while($row=mysql_fetch_assoc($query))
				{
					if(($i%2)==0)
					{
						?>
							<tr style="background:#eee;">
								<td style="text-align:center;"><?php echo $row['cate_id']; ?></td>
								<td><?php echo $row['main_cat']; ?></td>
								<td><?php echo $row['category']; ?></td>
								<td><?php echo $row['sub_cat']; ?></td>
								<td>
									<a href="editCate.php?cate_id=<?php echo $row['cate_id']; ?>" id="editCatBtn">Edit</a>
									<a href="deletCate.php?cate_id=<?php echo $row['cate_id']; ?>" id="dltCatBtn">Delete</a>
								</td>
							</tr>
						<?php
					}
					else
					{
						?>
							<tr style="background:#ddd;">
								<td style="text-align:center;"><?php echo $row['cate_id']; ?></td>
								<td><?php echo $row['main_cat']; ?></td>
								<td><?php echo $row['category']; ?></td>
								<td><?php echo $row['sub_cat']; ?></td>
								<td>
									<a href="editCate.php?cate_id=<?php echo $row['cate_id']; ?>" id="editCatBtn">Edit</a>
									<a href="deletCate.php?cate_id=<?php echo $row['cate_id']; ?>" id="dltCatBtn">Delete</a>
								</td>
							</tr>
						<?php
					}
					$i++;
				}
			?>
		</table>
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