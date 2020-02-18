<!DOCTYPE html>
<?php
	session_start();
	ob_start();
	require_once("config.php");
	$db = new DBController();
	include("functions.php");
	if(!isset($_SESSION['user']))
	{
		header("location: index.php");
	}
?>
<html>
<head>
<title>Big Shop</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="icon" href="images/favicon.png" >
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/dpupload.js"></script>
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
	<?php menu(); ?>
	<div class="pro-cont">
		<div class="pro-head">
			<?php
				$userenm=$_SESSION['user'];
				$ab="SELECT * FROM customer WHERE email='$userenm'";
				$bc=mysqli_fetch_assoc(mysqli_query($db->connectDB(),$ab));
			?>
			<img src="images/camera.png" id="uploaddpicon">
			<form method="post" enctype="multipart/form-data" id="dpudtfrm">
				<input type="file" name="propicinput" style="display:none;" id="propicinput">
				<input type="hidden" name="session_email" value="<?php echo $_SESSION['user']; ?>">
			</form>
			<div id="err" style="display:none; margin:1em auto; padding:.2em; width:10em; border-radius:3px; background:white;"></div>
			<div class="pro-pic" id="dpcontainer">
				<a href="images/pro_pics/<?php echo $bc['photo']; ?>"><img src="images/pro_pics/<?php echo $bc['photo']; ?>" alt="<?php echo substr($bc['f_name'],0,1); ?>"></a>
			</div>
			<div class="uname">
				<h3><?php echo $bc['f_name']." ".$bc['l_name'];?></h3>
			</div>
		</div>
		<div class="pro-nav">
			<ul>
				<div id="pro-navs"><li class="ordbtn">Orders</li></div>
				<div id="pro-navs"><li class="clasibtn">Classifieds</li></div>
				<div id="pro-navs"><li class="wishhbtn">Wishlist</li></div>
				<div id="pro-navs"><li class="setbtn">Settings</li></div>
			</ul>
		</div>
		<div class="proinfcontainer">
			<script type="text/javascript">
				$(document).ready(function()
				{
					$(".order-container").show();
					$(".add-container").hide();
					$(".wish-container").hide();
					$(".set-container").hide();
					$(".ordbtn").css("border-bottom","4px solid #2A80BA"); 
					
					$(".ordbtn").click(function()
					{
						$(".order-container").show();
						$(".add-container").hide();
						$(".wish-container").hide();
						$(".set-container").hide();
						$(".ordbtn").css("border-bottom","4px solid #2A80BA"); 
						$(".clasibtn").css("border-bottom","none"); 
						$(".wishhbtn").css("border-bottom","none"); 
						$(".setbtn").css("border-bottom","none"); 
					});
					$(".clasibtn").click(function()
					{
						$(".add-container").show();
						$(".order-container").hide();
						$(".wish-container").hide();
						$(".set-container").hide();
						$(".ordbtn").css("border-bottom","none"); 
						$(".clasibtn").css("border-bottom","4px solid #2A80BA"); 
						$(".wishhbtn").css("border-bottom","none"); 
						$(".setbtn").css("border-bottom","none");
					});
					$(".wishhbtn").click(function()
					{
						$(".wish-container").show();
						$(".order-container").hide();
						$(".add-container").hide();
						$(".set-container").hide();
						$(".ordbtn").css("border-bottom","none"); 
						$(".clasibtn").css("border-bottom","none"); 
						$(".wishhbtn").css("border-bottom","4px solid #2A80BA"); 
						$(".setbtn").css("border-bottom","none");
					});
					$(".setbtn").click(function()
					{
						$(".set-container").show();
						$(".order-container").hide();
						$(".add-container").hide();
						$(".wish-container").hide();
						$(".ordbtn").css("border-bottom","none"); 
						$(".clasibtn").css("border-bottom","none"); 
						$(".wishhbtn").css("border-bottom","none"); 
						$(".setbtn").css("border-bottom","4px solid #2A80BA");
					});
				});
			</script>
			<?php
			if(isset($_GET['set'])){
				if($_GET['set']=="saved")
					{?>
						<script type="text/javascript">
							$(document).ready(function(){
								$(".set-container").show();
								$(".order-container").hide();
								$(".add-container").hide();
								$(".wish-container").hide();
								$(".ordbtn").css("border-bottom","none"); 
								$(".clasibtn").css("border-bottom","none"); 
								$(".wishhbtn").css("border-bottom","none"); 
								$(".setbtn").css("border-bottom","4px solid #2A80BA");
							});
						</script>
					<?php
					}
					elseif($_GET['set']=="failed")
					{?>
						<script type="text/javascript">
							$(document).ready(function(){
								$(".set-container").show();
								$(".order-container").hide();
								$(".add-container").hide();
								$(".wish-container").hide();
								$(".ordbtn").css("border-bottom","none"); 
								$(".clasibtn").css("border-bottom","none"); 
								$(".wishhbtn").css("border-bottom","none"); 
								$(".setbtn").css("border-bottom","4px solid #2A80BA");
							});
						</script>
					<?php
					}
			}
			?>
			<div class="order-container">
				<center>
				<?php
					$userem=$_SESSION['user'];
					$a="SELECT * FROM customer WHERE email='$userem'";
					$b=mysqli_fetch_assoc(mysqli_query($db->connectDB(),$a));
					$userid=$b['c_id'];
					$c=mysqli_query($db->connectDB(),"SELECT * FROM orders T1 WHERE c_id='$userid' ORDER BY T1.ord_id DESC");
					$count=mysqli_num_rows($c);
					
					if($count>0)
					{?>
						<h4>Orders History</h4>
						<table width="80%">
							<tr>
								<th>Order_ID</th><th>Amount</th><th>Date-Time</th><th></th>
							</tr>
						<?php
						while($row=mysqli_fetch_assoc($c))
						{?>
								<tr>
									<td>
										<?php echo $row['ord_id']; ?>
									</td>
									<td>
										<?php echo $row['amount']; ?>
									</td>
									<td>
										<?php echo $row['date']." | ".$row['time']; ?>
									</td>
									<td>
										<a href="view-single-order.php?ord_id=<?php echo $row['ord_id']; ?>" id="vieworderbtn">View Order</a>
									</td>
								</tr>
						<?php
						}
						?>
						</table>
						<?php
					}
					else
					{
						echo "<h4>No orders yet</h4>";
					}
				?>
				</center>
			</div>
			<div class="add-container">
				<center>
				<?php
					$userem=$_SESSION['user'];
					$a="SELECT * FROM customer WHERE email='$userem'";
					$b=mysqli_fetch_assoc(mysqli_query($db->connectDB(),$a));
					$userid=$b['c_id'];
					$c=mysqli_query($db->connectDB(),"SELECT * FROM classifieds WHERE c_id='$userid' ORDER BY Ad_id DESC");
					$count=mysqli_num_rows($c);
					if($count>0)
					{?>
						<h4>Your Classifieds List</h4>
						<table width="80%">
							<tr>
								<th>Ad_ID</th><th>Title</th><th>Price</th><th>Category</th><th>Options</th>
							</tr>
					<?php
							while($adrow=mysqli_fetch_assoc($c))
							{?>
								<tr>
									<td>
										<?php echo $adrow['Ad_id']; ?>
									</td>
									<td>
										<?php echo $adrow['p_name']; ?>
									</td>
									<td>
										<?php echo $adrow['price']; ?>
									</td>
									<td>
										<?php echo $adrow['category']; ?>
									</td>
									<td>
										<a href="classifieds/edit_cl.php?Ad_ID=<?php echo $adrow['Ad_id']; ?>" id="vieworderbtn">edit</a>
										<a href="dlt_cl.php?Ad_ID=<?php echo $adrow['Ad_id']; ?>" id="vieworderbtn">Delete</a>
									</td>
								</tr>
							<?php
							}
					?>
						</table>
					<?php
					}
					else
					{
						echo "<h4>No classifieds yet</h4>";
					}
				?>
				</center>
			</div>
			<div class="wish-container">
				<center>
				<?php
					$userem=$_SESSION['user'];
					$a="SELECT * FROM customer WHERE email='$userem'";
					$b=mysqli_fetch_assoc(mysqli_query($db->connectDB(),$a));
					$userid=$b['c_id'];
					$c=mysqli_query($db->connectDB(),"SELECT * FROM wish_list T1 JOIN products T2 ON T1.p_id=T2.p_id WHERE c_id='$userid'");
					$count=mysqli_num_rows($c);
					
					if($count>0)
					{?>
						<h4>Wish List</h4>
						<table width="80%">
							<tr>
								<th>Product Name</th><th>Price</th><th>Options</th>
							</tr>
							<?php
								while($wisrow=mysqli_fetch_assoc($c))
								{?>
									<tr>
										<td>
											<?php echo $wisrow['p_name']; ?>
										</td>
										<td>
											<?php echo $wisrow['price']; ?>
										</td>
										<td>
											<a href="single.php?p_id=<?php echo $wisrow['p_id']; ?>" id="vieworderbtn">View</a>
											<a href="rmvfrmwhlst.php?p_id=<?php echo $wisrow['p_id']; ?>&c_id=<?php echo $wisrow['c_id']; ?>" id="vieworderbtn">Remove</a>
										</td>
									</tr>
								<?php
								}
							?>
						</table>
					<?php
					}
					else
					{
						echo "<h4>No product in your wish list</h4>";
					}
				?>
				</center>
			</div>
			<div class="set-container">
				<form method="POST" enctype="multipart/form-data">
					<?php
						$user=$_SESSION['user'];
						$sql="SELECT * FROM customer WHERE email='$user'";
						$query=mysqli_query($db->connectDB(),$sql);
						$row=mysqli_fetch_assoc($query);
					?>
					<div class="generalinf">
					<h4>General :</h4>
						<input type="Text" name="fname" value="<?php echo $row['f_name']; ?>" id="myprofname" placeholder="First Name" ><br>
						<input type="Text" name="lname" value="<?php echo $row['l_name']; ?>" id="myprofname" placeholder="Last Name" ><br>
					</div>
					
					<div class="billinginf">
					<h4>Billing Information :</h4>
						<input type="Text" name="city" value="<?php echo $row['city']; ?>" id="myprofhome" placeholder="Home Town" ><br>
						<input type="Text" name="pincode" value="<?php echo $row['pincode']; ?>" id="myprozip" placeholder="ZIP Code" ><br>
						<textarea placeholder="Address" name="Address"><?php echo $row['address']; ?></textarea>
					</div>
					
					<div class="prsnlinf">
					<h4>Personal Info</h4>
						<input type="Text" name="Mobile" value="<?php echo $row['mobile']; ?>" id="mypromob" placeholder="Mobile" ><br>
						<input type="Text" name="email" value="<?php echo $row['email']; ?>" id="myproemail" placeholder="Email" >
					</div>
					
					<div class="securityinf">
					<h4>Security</h4>
						<input type="password" name="currpass" id="mypropassnewold" placeholder="Old Password" ><br>
						<input type="password" name="newpass" id="mypropassnewold" placeholder="New Password" >
					</div>
					
					<input type="submit" name="saveset" value="Save Changes" class="set-sub">
					<?php
						if(isset($_POST['saveset']))
						{	
							
							$fn=$_POST['fname'];
							$ln=$_POST['lname'];
							$city=$_POST['city'];
							$pin=$_POST['pincode'];
							$add=$_POST['Address'];
							$mob=$_POST['Mobile'];
							$em=$_POST['email'];
							$old=$_POST['currpass'];
							$new=$_POST['newpass'];
							
							$user=$_SESSION['user'];
							$sql="SELECT * FROM customer WHERE email='$user'";
							$query=mysqli_query($db->connectDB(),$sql);
							$row=mysqli_fetch_assoc($query);
							$c_id=$row['c_id'];
							$oldp=$row['password'];
							
							if($old==$oldp)
							{
								if(strlen(trim($new))==0)
								{
									mysqli_query($db->connectDB(),"UPDATE customer SET f_name='$fn', l_name='$ln', email='$em', mobile='$mob', city='$city', pincode='$pin', address='$add' WHERE c_id='$c_id'")or die("updt fld");
									$_SESSION['user']=$em;
									header("location:profile.php?set=saved");
								}
								else
								{
									mysqli_query($db->connectDB(),"UPDATE customer SET f_name='$fn', l_name='$ln', email='$em', mobile='$mob', city='$city', pincode='$pin', address='$add', password='$new' WHERE c_id='$c_id'")or die("updt fld");
									$_SESSION['user']=$em;
									header("location:profile.php?set=saved");	
								}
							}
							elseif(strlen(trim($old))==0)
							{
								echo "<script>alert('You must enter your password to make changes. Fill new password field to change your password.');</script>";
							}
							elseif($old!=$oldp)
							{
								echo "<script>alert('Wrong Password...!');</script>";
							}
						}
					?>
				</form>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>  
		<div class="footer">
		<div class="footer-bottom">
			<a href="index.php"><img src="images/foot-logo.png" /></a><br/>
			<p>&copy 2017-2018 Big Shope. All rights reserved | Project by Sarjil Shaikh & Karan Tandel</p>
		<div class="clearfix"> </div>
		</div>
	</div>
</body>
</html>