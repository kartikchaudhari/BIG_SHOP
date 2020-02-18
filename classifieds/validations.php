<?php
function validatead()
{
	if(isset($_POST['pstad']))
	{
		$title=$_POST['ad_title'];
		$cate=$_POST['category'];
		$desc=$_POST['addesc'];
		$brand=$_POST['brand'];
		
		$city=$_POST['city'];
		$vl_city='/^[A-Za-z]+$/';
		
		$price=$_POST['price'];
		$vl_price='/^[0-9]*$/';
		
		$mb=$_POST['mobilenum'];
		$vl_mobile='/^[789][0-9]{9}$/';
		
		$eml=$_POST['email'];
		$vl_em='/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i';
		
		if(preg_match($vl_city,$city))
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#adcity").attr("value",'<?php echo $city; ?>'); 
				}); 
			</script>
		<?php	
		}
		else
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#adcity").attr("placeholder",'Invalid City...!'); 
					$("#adcity").css("color","#15231e"); 
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
					$("#price").attr("placeholder",'Invalid Price...!'); 
					$("#price").css("color","#15231e"); 
					}); 
			</script>
		<?php	
		}
		
		if(preg_match($vl_mobile,$mb))
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#mbl").attr("value",'<?php echo $mb; ?>'); 
				}); 
			</script>
		<?php	
		}
		else
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#mbl").attr("placeholder",'Enter Valid Mobile No!'); 
					$("#mbl").css("color","#15231e"); 
					}); 
			</script>
		<?php	
		}
		
		if(preg_match($vl_em,$eml))
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#eml").attr("value",'<?php echo $eml; ?>'); 
				}); 
			</script>
		<?php	
		}
		else
		{?>
			<script type="text/javascript" language="javascript">  
				$(document).ready(function() 
				{  
					$("#eml").attr("placeholder",'Enter Valid E-mail!'); 
					$("#eml").css("color","red"); 
					}); 
			</script>
		<?php
		}
		
		if(preg_match($vl_mobile,$mb) && preg_match($vl_em,$eml) && preg_match($vl_price,$price) && preg_match($vl_city,$city))
		{
			$selid="SELECT * FROM customer WHERE email='".$_SESSION['user']."' OR mobile='".$_SESSION['user']."'";
			$id=mysql_query($selid);
			$row=mysql_fetch_assoc($id);
			$c_id=$row['c_id'];
			$sql="INSERT INTO `smartdb`.`classifieds` (`Ad_id`, `c_id`, `p_name`, `category`, `desc`, `brand`, `email`, `altmobile`, `altcity`, `price`) VALUES (NULL,'$c_id', '$title', '$cate', '$desc', '$brand', '$eml', '$mb', '$city', '$price')";
			$query=mysql_query($sql) or die("Failed");
			if($query)
			{
				$sql="SELECT Ad_id FROM classifieds T1 WHERE c_id='$c_id' ORDER BY T1.Ad_id DESC LIMIT 1";
				$query=mysql_query($sql);
				$row=mysql_fetch_assoc($query);
				$Ad_id=$row['Ad_id'];
					
				$errors= array();
				foreach($_FILES['adphotos']['tmp_name'] as $key => $tmp_name )
				{
					$file_name = $key.$_FILES['adphotos']['name'][$key];
					$file_size =$_FILES['adphotos']['size'][$key];
					$file_tmp =$_FILES['adphotos']['tmp_name'][$key];
					$file_type=$_FILES['adphotos']['type'][$key];	
					if($file_size > 2097152){
						$errors[]='File size must be less than 2 MB';
					}		
					$query="INSERT into product_photos (`Ad_id`,`photo`) VALUES('$Ad_id','$file_name'); ";
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
						mysql_query($query);			
					}
					else
					{
						print_r($errors);
					}
				}
				if(empty($error))
				{
					header("location:single.php?Ad_id=".$Ad_id);
				}
			}
		}
	}
}
function validateadupdate()
{
	if(isset($_POST['Update']))
	{
		$title=$_POST['ad_title'];
		$cate=$_POST['category'];
		$desc=$_POST['addesc'];
		$brand=$_POST['brand'];
		$city=$_POST['city'];
		$price=$_POST['price'];
		$mb=$_POST['mobilenum'];
		$eml=$_POST['email'];
		
		$Ad_id=$_GET['Ad_ID'];
		$sql="UPDATE `smartdb`.`classifieds` SET `p_name` = '$title',`category` = '$cate',`brand` = '$brand',`desc` = '$desc',`email` = '$eml',`altmobile` = '$mb',`city` = '$city',`price` = '$price' WHERE `classifieds`.`Ad_id` ='$Ad_id' LIMIT 1";
		$query=mysql_query($sql);
		header("location:single.php?Ad_id=$Ad_id");
	}
}
?>