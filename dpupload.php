<?php
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp'); // valid extensions
$path = 'images/pro_pics/'; // upload directory

if(isset($_FILES['propicinput']))
{
	$img = $_FILES['propicinput']['name'];
	$tmp = $_FILES['propicinput']['tmp_name'];
		
	// get uploaded file's extension
	$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
	
	// can upload same image using rand function
	$final_image = rand(1000,1000000).$img;
	
	// check's valid format
	if(in_array($ext, $valid_extensions)) 
	{					
		$path = $path.strtolower($final_image);	
			
		if(move_uploaded_file($tmp,$path)) 
		{
			session_start();
			require_once("config.php");
			$db = new DBController();
			$user=$_SESSION['user'];
			$sql="SELECT * FROM customer WHERE email='$user'";
			$query=mysqli_query($db->connectDB(),$sql);
			$row=mysqli_fetch_assoc($query);
			$c_id=$row['c_id'];
			
			$old_pic=$row['photo'];
			
			if(file_exists("images/pro_pics/".$old_pic))
			{
				if(strlen(trim($old_pic))!=0)
				{
					unlink("images/pro_pics/".$old_pic);
				}
			}
			
			$sql="UPDATE customer SET photo='$final_image' WHERE c_id='$c_id'";
			mysqli_query($db->connectDB(),$sql);
			echo "<a href='$path'><img src='$path' /></a>";
		}
	} 
	else 
	{
		echo 'invalid';
	}
}


?>