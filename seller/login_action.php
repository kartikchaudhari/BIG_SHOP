<?php 
include_once "../config.php";
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
		{
			header("location:index.php");	
		}
	}
?>