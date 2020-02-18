<?php
ob_start();

function validate()
{
	if(isset($_POST['reg']))
	{
		$fn=$_POST['fname'];
		$val_fn='/^[A-Za-z]+$/';
		$ln=$_POST['lname'];
		$val_ln='/^[A-Za-z]+$/';
		$em=$_POST['email'];
		$val_em='/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i';
		$mobile=$_POST['mobile'];
		$val_mobile='/^[789][0-9]{9}$/';
		$city=$_POST['city'];
		$val_city='/^[A-Za-z]+$/';
		$pincode=$_POST['pincode'];
		$val_pincode='/^[0-9][0-9]{5}$/';
		$pass=$_POST['pass'];
		$val_pass='/^[A-Za-z0-9!@#$%&*-_=+?]{6,14}$/';
		$confirm=$_POST['cpass'];
		$add=$_POST['add'];
		$gender=$_POST['gender'];
		
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
		
		if(preg_match($val_pincode,$pincode))
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#pincode").attr("value",'<?php echo $pincode; ?>'); 
				}); 
			</script>
		<?php	
		}
		else
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#pincode").attr("placeholder",'Invalid Pincode!'); 
					$("#pincode").css("color","red"); 
					}); 
			</script>
		<?php	
		}
		
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
		
		if(preg_match($val_pass,$confirm))
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

	if(empty($gender))
	{
		echo "";
	}
	else
	{
		if($gender=='male')
		{?>
				<script type="text/javascript" language="javascript">  
					$(document).ready(function() 
					{  
						$("#male").prop('checked',true);
					}); 
				</script>

<?php	}
		else
		{?>
				<script type="text/javascript" language="javascript">  
					$(document).ready(function() 
					{  
						$("#female").prop('checked',true);
					}); 
				</script>

<?php	}


	}
		if(preg_match($val_fn,$fn) && preg_match($val_ln,$ln) && preg_match($val_em,$em) && preg_match($val_mobile,$mobile) && preg_match($val_city,$city) && preg_match($val_pincode,$pincode) && preg_match($val_pass,$pass) && $confirm==$pass)
		{
			require_once "config.php";
			$db = new DBController();
			$exemail="SELECT * FROM customer WHERE email='".$em."'";
			$queryem=mysqli_query($db->connectDB(),$exemail);
			$countem=mysqli_num_rows($queryem);
			$exmobile="SELECT * FROM customer WHERE mobile='".$mobile."'";
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
				$sql="INSERT INTO customer(f_name,l_name,email,mobile,gender,city,pincode,address,password)VALUES('$fn','$ln','$em','$mobile','$gender','$city','$pincode','$add','$pass')";
				$query=mysqli_query($db->connectDB(),$sql)or die("<script>alert('Registration Failed')</script>");
				$_SESSION['user']=$em;
				header("location: index.php");
			}
		}
	}
}
?>