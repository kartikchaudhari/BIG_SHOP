<?php
ob_start();
require_once("../config.php");
$db = new DBController();

function validity($d1,$d2)
{
	$crnt=$d1;
	$second=date_create($d2);
	$count=0;
	while(date_create($crnt)<$second)
	{
		$crnt=gmdate("d-m-Y",strtotime("+1day",strtotime($crnt)));
		$count++;
	}
	return $count;
}
function vallogin()
{
	$db = new DBController();
	if(isset($_POST['login']))
	{
		$sql="SELECT * FROM seller WHERE email='".$_POST['login_id']."' && password='".$_POST['password']."'";
		$query=mysqli_query($db->connectDB(),$sql);
		$count=mysqli_num_rows($query);
		if($count)
		{
			$_SESSION['seller']=$_POST['login_id'];
			header("location:dashboard.php");
		}
		else
		{?>
			<script type="text/javascript" language="javascript">  
			$(document).ready(function() 
			{  
				$("#em").attr("placeholder",'Invalid Login !'); 
				$("#em").css("color","red"); 
			}); 
			</script>
		<?php
		}
	}
}
function validate()
{
	$db = new DBController();
	if(isset($_POST['reg']))
	{
		$fn=$_POST['fname'];
		$val_fn='/^[A-Za-z]+$/';
		$ln=$_POST['lname'];
		$val_ln='/^[A-Za-z]+$/';
		$em=$_POST['email'];
		$val_em='/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i';
		$cem=$_POST['cemail'];
		$cemail=$_POST['cemail'];
		$mobile=$_POST['mobile'];
		$val_mobile='/^[789][0-9]{9}$/';
		$city=$_POST['city'];
		$val_city='/^[A-Za-z]+$/';
		$pass=$_POST['pass'];
		$val_pass='/^[A-Za-z0-9!@#$%&*-_=+?]{6,14}$/';
		$confirm=$_POST['cpass'];
		$cpass=$_POST['cpass'];
		$add=$_POST['add'];
		
		if(preg_match($val_fn,$fn))
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#fn").attr("value",'<?php echo $fn; ?>'); 
				}); 
			</script>
		<?php
		}	
		else
		{
		?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#fn").attr("placeholder",'Invalid First name !'); 
					$("#fn").css("color","red"); 
				}); 
			</script>
		<?php	
		}
		
		if(preg_match($val_ln,$ln))
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#ln").attr("value",'<?php echo $ln; ?>'); 
				}); 
			</script>
		<?php
		}
		else
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#ln").attr("placeholder",'Invalid Last name!'); 
					$("#ln").css("color","red"); 
				}); 
			</script>
		<?php
		}
		
		if(preg_match($val_em,$em))
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#email").attr("value",'<?php echo $em; ?>'); 
				}); 
			</script>
		<?php	
		}
		else
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#email").attr("placeholder",'Enter Valid E-mail!'); 
					$("#email").css("color","red"); 
					}); 
			</script>
		<?php
		}
		
		if(preg_match($val_em,$cemail))
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#cemail").attr("value",'<?php echo $cem; ?>'); 
				}); 
			</script>
		<?php	
		}
		elseif($cem==$em)
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#cemail").attr("value",'<?php echo $cem; ?>'); 
				}); 
			</script>
		<?php
		}
		else
		{?>
		<script type="text/javascript" language="javascript">  
			$(document).ready(function() 
			{  
				$("#cemail").attr("placeholder","Email did not Match!"); 
				$("#cemail").css("color","red"); 
			}); 
		</script>
<?php	}
		
		if(preg_match($val_mobile,$mobile))
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#mobile").attr("value",'<?php echo $mobile; ?>'); 
				}); 
			</script>
		<?php	
		}
		else
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#mobile").attr("placeholder",'Enter Valid Mobile No!'); 
					$("#mobile").css("color","red"); 
					}); 
			</script>
		<?php	
		}
		
		if(preg_match($val_city,$city))
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#city").attr("value","<?php echo $city; ?>"); 
				}); 
			</script>
<?php	}
		else
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#city").attr("placeholder","Invalid City name!"); 
					$("#city").css("color","red"); 
				}); 
			</script>
<?php	}
		if(!empty($add))
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#add").attr("value","<?php echo $add; ?>"); 
				}); 
			</script>
<?php	}
		
		if(preg_match($val_pass,$pass))
		{
			echo "";
		}
		else
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#pass").attr("placeholder","Invalid Password!"); 
					$("#pass").css("color","red"); 
				}); 
			</script>
<?php	}
		
		if(preg_match($val_pass,$cpass))
		{
			echo "";
		}
		elseif($confirm==$pass)
		{
			echo "";
		}
		else
		{?>
		<script type="text/javascript" language="javascript">  
			$(document).ready(function() 
			{  
				$("#cpass").attr("placeholder","Passwords did not Match!"); 
				$("#cpass").css("color","red"); 
			}); 
		</script>
<?php	}

		if(preg_match($val_fn,$fn) && preg_match($val_ln,$ln) && preg_match($val_em,$em) && $cem==$em && preg_match($val_mobile,$mobile) && preg_match($val_city,$city) && preg_match($val_pass,$pass) && $confirm==$pass)
		{
			$exemail="SELECT * FROM seller WHERE email='".$em."'";
			$queryem=mysqli_query($db->connectDB(),$exemail);
			$countem=mysqli_num_rows($queryem);
			$exmobile="SELECT * FROM seller WHERE mobile='".$mobile."'";
			$querymob=mysqli_query($db->connectDB(),$exmobile);
			$countmob=mysqli_num_rows($querymob);
			if($countem>=1)
			{?>
				<script type="text/javascript">
					alert('Email already registered');
				</script>
			<?php
			}
			else if($countmob>=1)
			{?>
				<script type="text/javascript">
					alert('Mobile already registered');
				</script>
			<?php 				
			}
			else
			{
				$sql="INSERT INTO seller(f_name,l_name,email,mobile,city,address,password)VALUES('$fn','$ln','$em','$mobile','$city','$add','$pass')";
				$query=mysqli_query($db->connectDB(),$sql)or die("<script>alert('Registration Failed')</script>");
				$_SESSION['seller']=$em;
				header("location: dashboard.php");
			}
		}
	}
}
function createStore()
{
	$db=new DBController();
	$bname=$_POST['bname'];
	
	$bem=$_POST['bemail'];
	$val_em='/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i';
	
	$bcontct=$_POST['bcontact'];
	$val_mobile='/^[789][0-9]{9}$/';
	
	$bcity=$_POST['bcity'];
	$val_city='/^[A-Za-z]+$/';
	
	if(strlen(trim($bname))!=0)
	{?>
		<script type="text/javascript" language="javascript">  
			$(document).ready(function() 
			{  
				$("#bname").attr("value",'<?php echo $bname; ?>'); 
			}); 
		</script>
	<?php
	}
	else
	{?>
		<script type="text/javascript" language="javascript">  
			$(document).ready(function() 
			{  
				$("#bname").attr("placeholder",'Business name can not be empty...!'); 
				$("#bname").css("color","red"); 
			}); 
		</script>
	<?php
	}
	?>
		<script type="text/javascript" language="javascript">  
			$(document).ready(function() 
			{  
				$("#bname").attr("value",'<?php echo $bname; ?>'); 
			}); 
		</script>
	<?php
	if(preg_match($val_mobile,$bcontct))
	{?>
		<script type="text/javascript" language="javascript">  
			$(document).ready(function() 
			{  
				$("#bcontct").attr("value",'<?php echo $bcontct; ?>'); 
			}); 
		</script>
	<?php	
	}
	else
	{?>
		<script type="text/javascript" language="javascript">  
			$(document).ready(function() 
			{  
				$("#bcontct").attr("placeholder",'Enter Valid Mobile No!'); 
				$("#bcontct").css("color","red"); 
				}); 
		</script>
	<?php	
	}
	
	if(preg_match($val_city,$bcity))
	{?>
		<script type="text/javascript" language="javascript">  
			$(document).ready(function() 
			{  
				$("#bcity").attr("value","<?php echo $bcity; ?>"); 
			}); 
		</script>
	<?php
	}
	else
	{?>
		<script type="text/javascript" language="javascript">  
			$(document).ready(function() 
			{  
				$("#bcity").attr("placeholder","Invalid City name!"); 
				$("#bcity").css("color","red"); 
			}); 
		</script>
	<?php
	}
	
	if(preg_match($val_em,$bem))
	{?>
		<script type="text/javascript" language="javascript">  
			$(document).ready(function() 
			{  
				$("#bemail").attr("value",'<?php echo $bem; ?>'); 
			}); 
		</script>
	<?php	
	}
	else
	{?>
		<script type="text/javascript" language="javascript">  
			$(document).ready(function() 
			{  
				$("#bemail").attr("placeholder",'Enter Valid E-mail!'); 
				$("#bemail").css("color","red"); 
				}); 
		</script>
	<?php
	}
	
	if(preg_match($val_em,$bem) && preg_match($val_city,$bcity) && preg_match($val_mobile,$bcontct) && strlen(trim($bname))!=0)
	{
		$sql="SELECT s_id FROM seller WHERE email='".$_SESSION['seller']."'";
		$query=mysqli_query($db->connectDB(),$sql);
		$row=mysqli_fetch_assoc($query);
		$s_id=$row['s_id'];
		
		if($_GET['type']=='trial')
		{
			$date=date('d-m-Y',strtotime("$today +30 days"));
			$valdt='trial';
			
			$sql="INSERT INTO store(s_id,Name,email,telephone,city,date,validity) VALUES('$s_id','$bname','$bem','$bcontct','$bcity','$date','$valdt')";
			mysqli_query($db->connectDB(),$sql) or die("error");
			header("location:dashboard.php");
		}
		elseif($_GET['type']=='Primeum')
		{
			$date=date('d-m-Y',strtotime("$today +365 days"));
			$valdt='pending';
			
			$sql="INSERT INTO store(s_id,Name,email,telephone,city,date,validity) VALUES('$s_id','$bname','$bem','$bcontct','$bcity','$date','$valdt')";
			mysqli_query($db->connectDB(),$sql) or die("error");
			
			$sss="SELECT * FROM seller WHERE email='".$_SESSION['seller']."'";
			$qqq=mysqli_query($db->connectDB(),$sss);
			$qwqw=mysqli_fetch_assoc($qqq);
			$sellerID=$qwqw['s_id'];
			header("location:makepymnt.php?amount=1500&s_id=$sellerID");
		}
		else
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					alert("Somthing went wrong please try again...!")
				}); 
			</script>
		<?php
		}
	}
}
function dashboard()
{
	$sql="SELECT s_id FROM seller WHERE email='".$_SESSION['seller']."'";
	$query=mysqli_query($sql);
	$row=mysqli_fetch_assoc($query);
	$s_id=$row['s_id'];
	
	$storesql="SELECT * FROM store WHERE s_id='$s_id'";
	$storequery=mysqli_query($storesql);
	$storerow=mysqli_fetch_assoc($storequery);
	
	$exp=$storerow['date'];
	$type=$storerow['validity'];
	$Start_date=date("d-m-Y");
	
	$diff=validity($Start_date,$exp);
	if($diff<=0)
	{
		if($type=='trial')
		{
			echo "<center><br><br><br><br><br><br><h1>YOUR TRIAL HAS EXPIRED. UPGRADE TO PREMIUM BY PAYING 1500/- ONLY </h1></center>";
			$sql="SELECT * FROM seller WHERE email='".$_SESSION['seller']."'";
			$query=mysqli_query($sql);
			$row=mysqli_fetch_assoc($query);
			$sellerID=$row['s_id'];
			?>
				<iframe src="http://localhost/BIG_SHOP/seller/Online_payment/PayUMoney_form.php?amount=1500&s_id=<?php echo $sellerID; ?>" width="100%" height="500px" frameborder="0" scrolling="yes"></iframe>
			<?php
		}
		else
		{
			echo "<center><h1>YOUR ACCOUNT HAS EXPIRED. PLEAS MAKE PAYMENT TO RENEW YOUR ACCOUNT</h1></center>";
			$sql="SELECT * FROM seller WHERE email='".$_SESSION['seller']."'";
			$query=mysqli_query($sql);
			$row=mysqli_fetch_assoc($query);
			$sellerID=$row['s_id'];
			?>
				<iframe src="http://localhost/BIG_SHOP/seller/Online_payment/PayUMoney_form.php?amount=1500&s_id=<?php echo $sellerID; ?>" width="100%" height="500px" frameborder="0" scrolling="yes"></iframe>
			<?php
		}
	}
	elseif($type=='pending')
	{
		echo "<center><h2 id='pymntfrstr'>PAYMENT NOT YET DONE FOR YOUR PREMIUM ACCOUNT</h2></center>";
		$sql="SELECT * FROM seller WHERE email='".$_SESSION['seller']."'";
		$query=mysqli_query($sql);
		$row=mysqli_fetch_assoc($query);
		$sellerID=$row['s_id'];
		?>
			<iframe src="http://localhost/BIG_SHOP/seller/Online_payment/PayUMoney_form.php?amount=1500&s_id=<?php echo $sellerID; ?>" width="100%" height="500px" frameborder="0" scrolling="yes"></iframe>
		<?php
	}
	else
	{?>
		<div class="pro-list">
		<?php
			$sql="SELECT * FROM seller WHERE email='".$_SESSION['seller']."' || mobile='".$_SESSION['seller']."' ";
			$query=mysqli_query($sql);
			$row=mysqli_fetch_array($query);
			$s_id=$row['s_id'];
			
			$str="SELECT * FROM store WHERE s_id='$s_id'";
			$qry=mysqli_query($str);
			$st_id=mysqli_fetch_assoc($qry);
			$rw=mysqli_num_rows($qry);
			if($rw==0)
			{
			?>
				<center>
				<h2>Create Your Store</h2>
				<a href="create-str.php?type=trial" id="try-prm">Trial - 30 days</a>
				<a href="create-str.php?type=Primeum" id="try-prm">Premium - &#8377; 1500/1 Year</a>
				</center>
				<div id="wowslider-container1">
				<div class="ws_images"><ul>
						<li><img src="slider/images/slide1.png" alt="dfgdrgydth" title="Signup today" id="wows1_0"/></li>
						<li><img src="slider/images/slide2.png" alt="fdtgrstye" title="List Your Products" id="wows1_1"/></li>
						<li><img src="slider/images/slide3.png" alt="responsive slider" title="Sell On BIGSHOPE" id="wows1_2"/></li>
						<li><img src="slider/images/slide4.png" alt="colour-cubes-hq-picture" title="make money" id="wows1_3"/></li>
					</ul></div>
					<div class="ws_bullets">
						<div>
							<a href="#" title="dfgdrgydth"></a>
							<a href="#" title="fdtgrstye"></a>
							<a href="#" title="blur-wallpaper-16"></a>
							<a href="#" title="colour-cubes-hq-picture"></a>
						</div>  
					</div>
				</div>	
				<script type="text/javascript" src="slider/wowslider.js"></script>
				<script type="text/javascript" src="slider/script.js"></script>
			<?php 
			}
			else
			{
				$sql="SELECT * FROM seller WHERE email='".$_SESSION['seller']."' || mobile='".$_SESSION['seller']."' ";
				$query=mysqli_query($sql);
				$row=mysqli_fetch_array($query);
				$s_id=$row['s_id'];
				
				$product='SELECT * FROM `products` T1 Join `product_photos` T2 ON T1.p_id=T2.p_id WHERE T1.s_id="'.$s_id.'" ORDER BY T1.p_id DESC';
				$pqry=mysqli_query($product);
				$noOfproducts=mysqli_num_rows($pqry);
				if($noOfproducts==0)
				{?>
					<center>
						<h4 ID="noproavl">NO PRODUCTS IN YOUR STORE</h4>
					</center>
				<?php
				}
				else
				{?>
					<h2>My Products</h2>
					<table cellspacing="0">
						<tr>
							<th>Product Details</th><th>Stock</th><th>Price</th><th>Status</th><th>Options</th>
						</tr>
						<?php
						$p_id='';
						while($row=mysqli_fetch_assoc($pqry))
						{
							if($p_id!=$row['p_id'])
							{?>
								
								<tr>
									<td>
										<img src="uploads/<?php echo $row['photo']; ?>">
										<p id="prd-dtl">
											<?php echo substr($row['p_name'],0,40)."..."; ?><br>
											Brand : <?php echo $row['brand']; ?>
										</p>
									</td>
									<td><?php echo $row['stock']; ?></td>
									<td><?php echo $row['price']; ?>/-</td>
									<td><?php echo $row['status']; ?></td>
									<td>
										<a href="Edit-product.php?p_id=<?php echo $row['p_id']; ?>" id="tblda">Edit</a>
										<a href="dltt-prdct.php?p_id=<?php echo $row['p_id']; ?>" id="tblda">Remove</a>
									</td>
								</tr>
							<?php
							$p_id=$row['p_id'];
							}
						}
						?>
					</table> 
				<?php
				}
			}
		?>
	</div>
	<?php
	}
}
function offers_home()
{
	?>
		<div class="pro-list">
		<?php
			
				$sql="SELECT * FROM seller WHERE email='".$_SESSION['seller']."' || mobile='".$_SESSION['seller']."' ";
				$query=mysqli_query($sql);
				$row=mysqli_fetch_array($query);
				$s_id=$row['s_id'];
				
				$product='SELECT * FROM `offers` T1 Join `product_photos` T2 ON T1.of_id=T2.of_id WHERE T1.s_id="'.$s_id.'" ORDER BY T1.of_id DESC';
				$pqry=mysqli_query($product);
				$noOfproducts=mysqli_num_rows($pqry);
				if($noOfproducts==0)
				{?>
					<center>
						<h4 ID="noproavl">NO OFFERS IN YOUR STORE</h4>
						<br>
						<a href="add-new-offer.php" id="tblda" style="display:inline-block;">Add new offer</a>
					</center>
				<?php
				}
				else
				{?>
					<h2 style="display:inline-block;">My offers - </h2>
					<a href="add-new-offer.php" id="tblda" style="display:inline-block;">Add new offer</a>
					<br>
					<table cellspacing="0">
						<tr>
							<th>Offer Details</th><th>Price</th><th>Status</th><th>Options</th>
						</tr>
						<?php
						$p_id='';
						while($row=mysqli_fetch_assoc($pqry))
						{
							if($of_id!=$row['of_id'])
							{?>
								
								<tr>
									<td>
										<img src="uploads/<?php echo $row['photo']; ?>">
										<p id="prd-dtl">
											<?php echo $row['title']; ?><br>
											<?php echo substr($row['sub_title'],0,50); if(strlen($row['sub_title'])>=50){ echo "..."; } ?>
										</p>
									</td>
									<td><?php echo $row['price']; ?>/-</td>
									<td><?php echo $row['status']; ?></td>
									<td>
										<a href="Edit-offer.php?of_id=<?php echo $row['of_id']; ?>" id="tblda">Edit</a>
										<a href="dltt-prdct.php?of_id=<?php echo $row['of_id']; ?>" id="tblda">Remove</a>
									</td>
								</tr>
							<?php
							$of_id=$row['of_id'];
							}
						}
						?>
					</table> 
				<?php
				}
		?>
	</div>
	<?php
}

function AddNewProduct()
{
	if(isset($_POST['ad-prod']))
	{
		$p_name=$_POST['p_name'];
		$warrenty=$_POST['wrnty'];
		$brand=$_POST['brand'];
		$discount=$_POST['discount'];
		$desc=$_POST['pro_desc'];
		
		$price=$_POST['price'];
		$vl_price='/^[0-9]*$/';
		
		if(preg_match($vl_price,$price))
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#price").attr("value",'<?php echo $price; ?>'); 
				}); 
			</script>
		<?php	
		}
		else
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#price").attr("placeholder",'Invalid Price...! -> <?php echo $price; ?>'); 
					$("#price").css("color","red"); 
					}); 
			</script>
		<?php	
		}
		
		if(preg_match($vl_price,$price))
		{
			$selid="SELECT * FROM seller WHERE email='".$_SESSION['seller']."' OR mobile='".$_SESSION['seller']."'";
			$id=mysqli_query($selid) or die("fld to select s_id");
			$row=mysqli_fetch_assoc($id);
			$s_id=$row['s_id'];
			
			
			
			if($_POST['sub_cat']=="other")
			{
				$mcate=$_POST['main-cat'];
				$category=$_POST['cate'];
				$subcate=$_POST['brand'];
				$ncsql="INSERT INTO category(cate_id,main_cat,category,sub_cat)VALUES(NULL,'$mcate','$category','$subcate')";
				mysqli_query($ncsql);
				
				$csql="SELECT * FROM category ORDER BY category.cate_id DESC LIMIT 1";
				$catqry=mysqli_query($csql);
				$caterw=mysqli_fetch_assoc($catqry);
				$cate_id=$caterw['cate_id'];
			}
			else
			{
				$csql="SELECT * FROM category WHERE main_cat='".$_POST['main-cat']."' &&  category='".$_POST['cate']."' &&  sub_cat='".$_POST['sub_cat']."'";
				$catqry=mysqli_query($csql);
				$caterw=mysqli_fetch_assoc($catqry);
				$cate_id=$caterw['cate_id'];
			}
			
			$p_methd="both";
			$status="Waiting";
			$price=$_POST['price'];
			$stock=$_POST['stock'];
			
			$sql="INSERT INTO `smartdb`.`products` (`p_id`, `s_id`, `cate_id`, `p_name`, `brand`, `warranty`, `py_method`, `discount`, `desc`,`price`,`stock`,`status`) VALUES (NULL,'$s_id', '$cate_id', '$p_name', '$brand', '$warrenty', '$p_methd', '$discount', '$desc','$price','$stock','$status')";
			$query=mysqli_query($sql) or die("Failed");
			
			$errors= array();
			foreach($_FILES['prdctphts']['tmp_name'] as $key => $tmp_name )
			{
				$file_name = $key.$_FILES['prdctphts']['name'][$key];
				$file_size =$_FILES['prdctphts']['size'][$key];
				$file_tmp =$_FILES['prdctphts']['tmp_name'][$key];
				$file_type=$_FILES['prdctphts']['type'][$key];	
				if($file_size > 2097152){
					$errors[]='File size must be less than 2 MB';
				}	
				
				$sqlpid="SELECT * FROM products T1 WHERE s_id='$s_id' ORDER BY T1.p_id DESC LIMIT 1";
				$querypid=mysqli_query($sqlpid);
				$row=mysqli_fetch_assoc($querypid);
				$p_id=$row['p_id'];
				
				$queryimg="INSERT INTO smartdb.product_photos(`p_id`,`Ad_id`,`of_id`,`photo`) VALUES('$p_id',NULL,NULL,'$file_name')";
				$desired_dir="uploads";
				if(empty($errors)==true)
				{
					if(is_dir($desired_dir)==false)
					{
						mkdir("$desired_dir", 0700);
					}
					if(is_dir("$desired_dir/".$file_name)==false)
					{
						move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
					}
					else
					{									
						$new_dir="$desired_dir/".$file_name.time();
						rename($file_tmp,$new_dir) ;				
					}
					mysqli_query($queryimg) or die("pic upload fld");			
				}
				else
				{
					print_r($errors);
				}
			}
			if(empty($error))
			{
				header("location:add-new-product.php?product=Added");
			}
		}
	}
}
function updateProduct()
{
	if(isset($_POST['update-prod']))
	{
		$p_name=$_POST['p_name'];
		$warrenty=$_POST['wrnty'];
		$brand=$_POST['brand'];
		$discount=$_POST['discount'];
		$desc=$_POST['pro_desc'];
		
		$price=$_POST['price'];
		$vl_price='/^[0-9]*$/';
		
		if(preg_match($vl_price,$price))
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#price").attr("value",'<?php echo $price; ?>'); 
				}); 
			</script>
		<?php	
		}
		else
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#price").attr("placeholder",'Invalid Price...! -> <?php echo $price; ?>'); 
					$("#price").css("color","red"); 
					}); 
			</script>
		<?php	
		}
		
		if(preg_match($vl_price,$price))
		{
			$selid="SELECT * FROM seller WHERE email='".$_SESSION['seller']."' OR mobile='".$_SESSION['seller']."'";
			$id=mysqli_query($selid) or die("fld to select s_id");
			$row=mysqli_fetch_assoc($id);
			$s_id=$row['s_id'];
			
			
			
			if($_POST['sub_cat']=="other")
			{
				$mcate=$_POST['main-cat'];
				$category=$_POST['cate'];
				$subcate=$_POST['brand'];
				$ncsql="INSERT INTO category(cate_id,main_cat,category,sub_cat)VALUES(NULL,'$mcate','$category','$subcate')";
				mysqli_query($ncsql);
				
				$csql="SELECT * FROM category ORDER BY category.cate_id DESC LIMIT 1";
				$catqry=mysqli_query($csql);
				$caterw=mysqli_fetch_assoc($catqry);
				$cate_id=$caterw['cate_id'];
			}
			else
			{
				$csql="SELECT * FROM category WHERE main_cat='".$_POST['main-cat']."' &&  category='".$_POST['cate']."' &&  sub_cat='".$_POST['sub_cat']."'";
				$catqry=mysqli_query($csql);
				$caterw=mysqli_fetch_assoc($catqry);
				$cate_id=$caterw['cate_id'];
			}
			
			$p_methd="both";
			$status="Waiting";
			$price=$_POST['price'];
			$stock=$_POST['stock'];
			$p_id=$_GET['p_id'];
			$sql="UPDATE `smartdb`.`products` SET `cate_id`='$cate_id', `p_name`='$p_name', `brand`='$brand', `warranty`='$warrenty', `discount`='$discount', `desc`='$desc', `price`='$price', `stock`='$stock', `status`='$status' WHERE p_id='$p_id'";
			mysqli_query($sql) or die("Failed");
			
			header("location:Edit-product.php?product=Updated&p_id=$p_id");
		}
	}
}
function AddNewOffer()
{
	if(isset($_POST['ad-OFFER']))
	{
		$title=$_POST['of_Title'];
		$sub_title=$_POST['sub_of_name'];
		$price=$_POST['price'];
		$sdate=$_POST['sdate'];
		$edate=$_POST['edate'];
		$desc=$_POST['offr_desc'];
		
		$price=$_POST['price'];
		$vl_price='/^[0-9]*$/';
		
		$diff=validity($sdate,$edate);
		$today=date('d-m-Y');
		$tdy=validity($sdate,$today);
		
		if($diff<=0)
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#stdate").attr("placeholder",'Invalid Date...!'); 
				}); 
			</script>
		<?php
		}
		elseif($tdy<0)
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#stdate").attr("placeholder",'Invalid Date...!'); 
				}); 
			</script>
		<?php
		}
		else
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#stdate").attr("value",'<?php echo $sdate; ?>'); 
				}); 
			</script>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#endate").attr("value",'<?php echo $edate; ?>'); 
				}); 
			</script>
		<?php	
		}
		
		if(preg_match($vl_price,$price))
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#price").attr("value",'<?php echo $price; ?>'); 
				}); 
			</script>
		<?php	
		}
		else
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#price").attr("placeholder",'Invalid Price...! -> <?php echo $price; ?>'); 
					$("#price").css("color","red"); 
					}); 
			</script>
		<?php	
		}
		
		if(preg_match($vl_price,$price))
		{
			$selid="SELECT * FROM seller WHERE email='".$_SESSION['seller']."' OR mobile='".$_SESSION['seller']."'";
			$id=mysqli_query($selid) or die("fld to select s_id");
			$row=mysqli_fetch_assoc($id);
			
			$s_id=$row['s_id'];
			$status="Waiting";
			
			$sql="INSERT INTO `smartdb`.`offers`(`of_id`, `s_id`, `title`, `sub_title`, `desc`, `start_date`, `end_date`, `price`,`status`) VALUES(NULL,'$s_id', '$title', '$sub_title', '$desc', '$sdate', '$edate','$price','$status')";
			$query=mysqli_query($sql) or die("Failed");
			
			$errors= array();
			
			$sqlpid="SELECT * FROM offers T1 WHERE s_id='$s_id' ORDER BY T1.of_id DESC LIMIT 1";
			$querypid=mysqli_query($sqlpid);
			$row=mysqli_fetch_assoc($querypid);
			$of_id=$row['of_id'];
			
			foreach($_FILES['prdctphts']['tmp_name'] as $key => $tmp_name )
			{
				$file_name = $key.$_FILES['prdctphts']['name'][$key];
				$file_size =$_FILES['prdctphts']['size'][$key];
				$file_tmp =$_FILES['prdctphts']['tmp_name'][$key];
				$file_type=$_FILES['prdctphts']['type'][$key];	
				if($file_size > 2097152)
				{
					$errors[]='File size must be less than 2 MB';
				}	
				
				$queryimg="INSERT INTO product_photos(p_id,Ad_id,of_id,photo) VALUES(null,null,'$of_id','$file_name')";
				$desired_dir="uploads";
				if(empty($errors)==true)
				{
					if(is_dir($desired_dir)==false)
					{
						mkdir("$desired_dir", 0700);
					}
					if(is_dir("$desired_dir/".$file_name)==false)
					{
						move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
					}
					else
					{									
						$new_dir="$desired_dir/".$file_name.time();
						rename($file_tmp,$new_dir) ;				
					}
					mysqli_query($queryimg) or die("pic upload fld");			
				}
				else
				{
					print_r($errors);
				}
			}
		}
		header("location:add-new-offer.php?offer=added");
	}
}
?>