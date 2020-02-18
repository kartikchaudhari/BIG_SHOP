<?php
	session_start();
	ob_start();
	require_once("config.php");
	$db= new DBController();
	
	//select product ID
	$p_id=$_GET['p_id'];

	//select user ID
	$user=$_SESSION['user'];
	$select_user="SELECT * FROM customer WHERE email='$user'";
	$user_query=mysqli_query($db->connectDb(),$select_user);
	$raw=mysqli_fetch_array($user_query);
	$c_id=$raw['c_id'];
	
	//wish action 
	$action=$_GET['action'];
	switch($action)
	{
		case adtowish:
			$sql="SELECT * FROM wish_list WHERE c_id='$c_id' && p_id='$p_id'";
			$query=mysqli_query($db->connectDb(),$sql);
			$count=mysqli_num_rows($query);
			if($count>0)
			{
				header("location:".$_SERVER['HTTP_REFERER']);
			}
			else
			{
				$sql="INSERT INTO wish_list(c_id,p_id) VALUES('$c_id','$p_id')";
				mysqli_query($db->connectDb(),$sql);
				header("location:".$_SERVER['HTTP_REFERER']);
			}
		break;
		
		case rmfrmwishlist:
			$sql="DELETE FROM wish_list WHERE c_id='$c_id' && p_id='$p_id'";
			mysqli_query($db->connectDb(),$sql);
			header("location:".$_SERVER['HTTP_REFERER']);
	}
?>