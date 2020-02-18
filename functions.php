<?php
date_default_timezone_set('Asia/Kolkata');
require_once "config.php";
function bottomheader()
{	
	date_default_timezone_set('Asia/Kolkata');
	if (isset($_SESSION['user'])) {
		$db=new DBController();
		$sql="SELECT * FROM customer WHERE email='".$_SESSION['user']."' || mobile='".$_SESSION['user']."' ";
		$query=mysqli_query($db->connectDB(),$sql);
		$raw=mysqli_fetch_assoc($query);
	}
?>
	<div class="bottom-header">
			<div class="container">
				<div class="header-bottom-left">
					<div class="logo">
						<a href="index.php"><img src="images/logo.png" alt=" " /></a>
					</div>
					<div class="search">
						<form method="get" action="Search_result.php">
							<input type="text" name="keyword" id="search-box" placeholder="Search" autocomplete="off">
							<input type="submit"  value="SEARCH">
							<label id="suggesstion-box"></label>
						</form>
						
					</div>
							
					<div class="clearfix"> </div>
				</div>
				<div class="header-bottom-right">	
					<?php
					require_once "config.php";
					$db=new DBController();
						if(isset($_SESSION['user'])){ 
							echo '<div class="account">
								<a href="profile.php"><span> </span>'.$raw['f_name'] . $raw['l_name'] .'</a>
								<a href="logout.php" id="logout">Logout</a>
							</div>';
						 
						}
						else{ 
							echo '<ul class="login">
								<li><a href="login.php"><span> </span>LOGIN</a></li> |
								<li ><a href="sign_up.php">SIGNUP</a></li>
							</ul>';
						}
						
						if(isset($_SESSION['user'])){
							$cid=$raw['c_id'];
							$cart="SELECT DISTINCT p_id FROM cart WHERE c_id='$cid'";
							$cartquery=mysqli_query($db->connectDB(),$cart);
							$NoOfItem=mysqli_num_rows($cartquery);

							echo '<div class="cart">
							<a href="cart.php"><span> </span>CART (' .$NoOfItem.')</a>
							</div>
							<a href="cart-process.php?action=emptycart">Empty cart</a>';
						}
						else
						{
							if (isset($_SERVER['REMOTE_ADDR'])) {
								$cid=$_SERVER['REMOTE_ADDR'];
								$cart="SELECT DISTINCT p_id FROM cart WHERE c_id='$cid'";
								$cartquery=mysqli_query($db->connectDB(),$cart);

								if($cartquery!=NULL){
									$NoOfItem=mysqli_num_rows($cartquery);
									echo '<div class="cart">
										<a href="cart.php"><span> </span>CART ('.$NoOfItem.')</a>
									</div>
									<a href="cart-process.php?action=emptycart">Empty cart</a>';
								}else{
									echo '<div class="cart">
										<a href="cart.php"><span> </span>CART (0)</a>
									</div>
									<a href="cart-process.php?action=emptycart">Empty cart</a>';
								}

							}
						}
						?>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>	
			</div>
		</div>
<?php
}

function sendpass()
{
	$db=new DBController();
	$em=$_POST['email'];
	$sql="SELECT * FROM customer WHERE email='$em'";
	$query=mysqli_query($db->connectDB(),$sql);
	$count=mysqli_num_rows($query);
	if($count==1)
	{
		$row=mysqli_fetch_array($query);
		$pass=$row['password'];
		$name=$row['f_name'];
		require 'srmailer/class.phpmailer.php';
		require 'srmailer/class.smtp.php';
		
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Mailer = 'smtp';
		$mail->SMTPAuth = true;
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 465;
		$mail->SMTPSecure = 'ssl';

		$mail->Username = "myciapps2018@gmail.com";
		$mail->Password = "Codeigniter@2018";

		$mail->IsHTML(true);
		$mail->SingleTo = true;

		$mail->From = "myciapps2018@gmail.com";
		$mail->FromName = "BigShop.com";

		$mail->addAddress($em,"User 1");

		$mail->Subject = "Password Recovery";
		$mail->Body = "
						Hi $name,
						<br /><br />
						This message is sent from BigShop.com for your password recovery request.
						<br />Your password is :<b> $pass </b>
					  ";
		if(!$mail->Send())
		{?>
			<input type="button" value="An error occurred please try again" class="wrng-log" disabled/><br>
	<?php
		}
		else
		{?>
			<input type="button" value="Your Password has been sent to your email" class="wrng-log" disabled/><br>
	<?php
		}
	}
	elseif($count==0)
	{?>
		<input type="button" value="Please Enter Valid Email" class="wrng-log" disabled/><br>
	<?php
	}
}
function sendorder()
{
	$db=new DBController();
	$em=$_POST['em'];
	$sql="SELECT * FROM customer WHERE email='$em'";
	$query=mysqli_query($db->connectDB(),$sql);
	$row=mysqli_fetch_assoc($query);
	$c_id=$row['c_id'];
	
	$sql1="SELECT * FROM orders T1 WHERE c_id='$c_id' ORDER BY T1.ord_id DESC LIMIT 1";
	$ord=mysqli_query($db->connectDB(),$sql1);
	$order=mysqli_fetch_assoc($ord);
	
	$ord_id=$order['ord_id'];
	$date=$order['date'];
	$time=$order['time'];
	require 'srmailer/class.phpmailer.php';
	require 'srmailer/class.smtp.php';
	
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Mailer = 'smtp';
	$mail->SMTPAuth = true;
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465;
	$mail->SMTPSecure = 'ssl';

	$mail->Username = "bigshope898@gmail.com";
	$mail->Password = "bigger898shope";

	$mail->IsHTML(true);
	$mail->SingleTo = true;

	$mail->From = "bigshope898@gmail.com";
	$mail->FromName = "BigShop.com";

	$mail->addAddress($em,"User 1");

	$mail->Subject = "Order Information";
	$mail->Body = "
					<div style='width:70%; margin:2em auto; border:5px solid #094251; overflow:hidden;'>
						<center>
							<h1>Thank you</h1>
							<h2>Your order was completed successfully.</h2>
							<table>
								<tr>
									<td>Order ID</td><td> : $ord_id </td>
								</tr>
								<tr>
									<td>Date</td><td> : $date </td>
								</tr>
								<tr>
									<td>Time</td><td> : $time </td>
								</tr>
							</table>
							<a href='http://localhost/BIG_SHOP/index.php' style='text-decoration:none; display:inline-block; padding:.5em; background:#1C5FAB; margin-top:3em; margin-bottom:4em; color:#fff; transition-duration:.1s; border-radius:3px;'>Continue Shopping</a>
							<a href='http://localhost/BIG_SHOP/view-single-order.php?ord_id=$ord_id' style='text-decoration:none; display:inline-block; padding:.5em; background:#1C5FAB; margin-top:3em; margin-bottom:4em; color:#fff; transition-duration:.1s; border-radius:3px;' >View Order</a>
							<b style='display:block; width:70%; text-align:justify;'>
							   This message is to notify you that your order has been received, and is being processed.
							</b>
						</center>
						
					</div>
				  ";
	if(!$mail->Send())
	{?>
		<input type="button" value="An error occurred please try again" class="wrng-log" disabled/><br>
	<?php
	}
}
function sendorderpaid()
{
	$db=new DBController();

	$em=$_SESSION['sendtothis'];
	$sql="SELECT * FROM customer WHERE email='$em'";
	$query=mysqli_query($db->connectDB(),$sql);
	$row=mysqli_fetch_assoc($query);
	$c_id=$row['c_id'];
	
	$sql1="SELECT * FROM orders T1 WHERE c_id='$c_id' ORDER BY T1.ord_id DESC LIMIT 1";
	$ord=mysqli_query($db->connectDB(),$sql1);
	$order=mysqli_fetch_assoc($ord);
	
	$ord_id=$order['ord_id'];
	$date=$order['date'];
	$time=$order['time'];
	require 'srmailer/class.phpmailer.php';
	require 'srmailer/class.smtp.php';
	
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Mailer = 'smtp';
	$mail->SMTPAuth = true;
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465;
	$mail->SMTPSecure = 'ssl';

	$mail->Username = "bigshope898@gmail.com";
	$mail->Password = "bigger898shope";

	$mail->IsHTML(true);
	$mail->SingleTo = true;

	$mail->From = "bigshope898@gmail.com";
	$mail->FromName = "BigShop.com";

	$mail->addAddress($em,"User 1");

	$mail->Subject = "Order Information";
	$mail->Body = "
					<div style='width:70%; margin:2em auto; border:5px solid #094251; overflow:hidden;'>
						<center>
							<h1>Thank you</h1>
							<h2>Your order was completed successfully.</h2>
							<table>
								<tr>
									<td>Order ID</td><td> : $ord_id </td>
								</tr>
								<tr>
									<td>Date</td><td> : $date </td>
								</tr>
								<tr>
									<td>Time</td><td> : $time </td>
								</tr>
							</table>
							<a href='http://localhost/BIG_SHOP/index.php' style='text-decoration:none; display:inline-block; padding:.5em; background:#1C5FAB; margin-top:3em; margin-bottom:4em; color:#fff; transition-duration:.1s; border-radius:3px;'>Continue Shopping</a>
							<a href='http://localhost/BIG_SHOP/view-single-order.php?ord_id=$ord_id' style='text-decoration:none; display:inline-block; padding:.5em; background:#1C5FAB; margin-top:3em; margin-bottom:4em; color:#fff; transition-duration:.1s; border-radius:3px;' >View Order</a>
							<b style='display:block; width:70%; text-align:justify;margin-bottom:2em;'>
							   This message is to notify you that your order has been received, and is being processed.
							</b>
						</center>
						
					</div>
				  ";
	if(!$mail->Send())
	{?>
		<input type="button" value="An error occurred please try again" class="wrng-log" disabled/><br>
	<?php
	}
}

function displayPro()
{
	$db=new DBController();
	
	$product='SELECT * FROM `products` T1 Join `product_photos` T2 ON T1.p_id=T2.p_id WHERE status="approved" ORDER BY T1.p_id DESC LIMIT 200';
	$pqry=mysqli_query($db->connectDB(),$product);
	$p_id="";
	while($row=mysqli_fetch_array($pqry))
	{
		if($p_id!=$row['p_id'])
		{?>
		<div class="d-product">
			<div class="pbox">
				<form method="post">
					<a href="single.php?p_id=<?php echo $row['p_id']; ?>">
						<div class="pimage">
							<img src="seller/uploads/<?php echo $row['photo']; ?>">
						</div>
					</a>
					<div class="pinfo">
						<h5><?php echo $row['p_name']; ?></h5>
					</div>
					<div class="add-tocart">
						<h3> &#8377; <?php echo $row['price']; ?></h3>
								<?php 
									$db=new DBController();
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
										{
										?>
											<a href="cart-process.php?action=adtocrt&p_id=<?php echo $row['p_id']; ?>" class="add-to-cart" >Add to cart</a>
										<?php
											$db=new DBController();
											$sql="SELECT * FROM wish_list WHERE c_id='".$raw_user['c_id']."' && p_id='".$row['p_id']."'";
											$query=mysqli_query($db->connectDB(),$sql);
											$count=mysqli_num_rows($query);
											if($count>0)
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
		<?php
			$p_id=$row['p_id'];		
		}
	}
}
function menu()
{
	$db=new DBController();
?>
	
<div class="container">
	<div class="header">
	  
		<!--start-header-menu-->
		<ul class="megamenu skyblue">
			<li class="active grid"><a class="color1" href="index.php">Home</a></li>
			<li class="grid"><a class="color2" href="#">Electronics</a>
				<div class="megapanel">
					<div class="row">
						<div class="col1">
							<div class="h_nav">
								<h4>Mobiles</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='electronics' && category='mobile'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>		
							</div>							
						</div>
					
						<div class="col1">
							<div class="h_nav">
								<h4>Mobile Accessories</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='electronics' && category='mobile accessories'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>
							</div>							
						</div>
							<div class="col1">
							<div class="h_nav">
								<h4>Wearables</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='electronics' && category='wearables'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>		
								<h4>Computer Accessories</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='electronics' && category='computer accessories'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>		
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Laptops</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='electronics' && category='laptops'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>
								<h4>Computer Peripherals</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='electronics' && category='Computer Peripherals'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
									
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
	
							</div>
						</div>
						<div class="col1">
							<div class="h_nav">							
								<h4>Network Components</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='electronics' && category='Network Components'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
								<h4>TVs</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='electronics' && category='tv'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>
							</div>	
				
					</div>			<div class="col1">
							<div class="h_nav">		
								<h4>Camera</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='electronics' && category='camera'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>		
								<h4>Camera Accessories</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='electronics' && category='camera accessories'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
							</div>
						</div>
					<div class="row">
						<div class="col2"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
					</div>
    				</div>
				</li>
			<li><a class="color4" href="#">Appliances</a>
				<div class="megapanel">
					<div class="row">
							<div class="col1">
							<div class="h_nav">
								<h4>Kitchen Appliances</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='appliances' && category='kitchen appliances'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
							</div>
						</div>
						<div class="col1">
							<div class="h_nav">	
								<h4>Home Entertainment</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='appliances' && category='Home Entertainment'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
								<h4>Air Conditioners</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='appliances' && category='ac'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>		
							</div>							
						</div>
						
						<div class="col1">
							<div class="h_nav">
								<h4>Refrigerators</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='appliances' && category='refrigerators'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>		
								<h4>Small Home Appliances</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='appliances' && category='small appliances'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>		
							</div>						
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Washing Machine</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='appliances' && category='Washing Machine'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
							</div>
						</div>
					
					</div>
					<div class="row">
						<div class="col2"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
					</div>
    				</div>
				</li>				
				<li><a class="color5" href="#">Men</a>
				<div class="megapanel">
					<div class="row">
						<div class="col1">
							<div class="h_nav">
								<h4>Footwear</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='men' && category='footwear'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>		
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Clothing</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='men' && category='clothing'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Watches</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='men' && category='watches'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
							</div>												
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Accessories</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='men' && category='accessories'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
							</div>						
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Care Appliances</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='men' && category='care appliances'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>		
							</div>
						</div>
						
					</div>
					<div class="row">
						<div class="col2"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
					</div>
    				</div>
				</li>
				<li><a class="color6" href="#">Women</a>
				<div class="megapanel">
					<div class="row">
						<div class="col1">
							<div class="h_nav">
								<h4>Clothing</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='women' && category='clothing'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Footwear</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='women' && category='footwear'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Accessories</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='women' && category='accessories'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
							</div>												
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Watches</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='women' && category='watches'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
							</div>						
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Beauty & Care</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='women' && category='beauty and care'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>
							</div>
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Jewellery</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='women' && category='jewellery'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
							</div>
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Care Appliances</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='women' && category='care appliances'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col2"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
					</div>
    				</div>
				</li>				
			
				<li><a class="color7" href="#">Baby & kids</a>
				<div class="megapanel">
					<div class="row">
						<div class="col1">
							<div class="h_nav">
								<h4>Clothing</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='kids' && category='kids clothing'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Footwear</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='kids' && category='footwear'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>School Supplies</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='kids' && category='school supplies'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>
							</div>												
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Toys</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='kids' && category='toys'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
							</div>						
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Baby Care</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='kids' && category='baby care'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
							</div>
						</div>
						
					</div>
					<div class="row">
						<div class="col2"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
					</div>
    				</div>
				</li>				
			
				<li><a class="color8" href="#">Home & Furniture</a>
				<div class="megapanel">
					<div class="row">
						<div class="col1">
							<div class="h_nav">
								<h4>Kitchen & Dining</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='home and furniture' && category='kitchen and dining'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>
								<h4>Dining & Serving</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='home and furniture' && category='Dining and Serving'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>
								<h4>Kitchen Storage</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='home and furniture' && category='Kitchen Storage'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>
							</div>							
						</div>
						
						<div class="col1">
							<div class="h_nav">
								<h4>Furniture</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='home and furniture' && category='furniture'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
							</div>						
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Furnishing</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='home and furniture' && category='furnishing'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
							</div>
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Tools & Hardware</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='home and furniture' && category='tools and hardware'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>
								<h4>Home Decor</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='home and furniture' && category='home decor'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>
							</div>
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Lighting</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='home and furniture' && category='lighting'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
								<h4>Other</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='home and furniture' && category='other'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col2"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
					</div>
    				</div>
				</li>
				<li><a class="color9" href="#">Books & More</a>
				<div class="megapanel">
					<div class="row">
						<div class="col1">
							<div class="h_nav">
								<h4>Books</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='Books and More' && category='Books'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>		
							</div>							
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Stationery</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='Books and More' && category='Stationery'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
								<h4>Gaming</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='Books and More' && category='Gaming'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
							</div>							
						</div>
						
						<div class="col1">
							<div class="h_nav">
								<h4>Music</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='Books and More' && category='Music'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>
								<h4>Automobiles</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='Books and More' && category='automobiles'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>
							</div>						
						</div>
						
						<div class="col1">
							<div class="h_nav">
								<h4>For Your Car</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='Books and More' && category='For Your Car'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
								<h4>For Your Bike</h4>
								<ul>
								<?php
								$db=new DBController();
									$sql="SELECT * FROM category where main_cat='Books and More' && category='For Your Bike'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>	
							</div>
						</div>
						<div class="col1">
							<div class="h_nav">
									
								<h4>Sports</h4>
								<ul>
								<?php
								$db=new DBController();
									$sql="SELECT * FROM category where main_cat='Books and More' && category='Sports'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>
							</div>
						</div>
						<div class="col1">
							<div class="h_nav">
								<h4>Fitness Accessories</h4>
								<ul>
								<?php
									$db=new DBController();
									$sql="SELECT * FROM category where main_cat='Books and More' && category='Fitness Accessories'";
									$query=mysqli_query($db->connectDB(),$sql);
									while($row=mysqli_fetch_assoc($query))
									{
										
									
									?>
									<li><a href="products.php?product=<?php echo $row['cate_id']; ?> "><?php echo $row['sub_cat']; ?></a></li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col2"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
						<div class="col1"></div>
					</div>
    				</div>
				</li>
		 </ul> 
	</div>
</div>
</div>
<?php 
} 
?>