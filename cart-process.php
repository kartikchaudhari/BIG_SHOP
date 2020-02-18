<?php
	session_start();
	ob_start();
	require_once("config.php");
	$db = new DBController();
	
	//select product ID
	$p_id=$_GET['p_id'];

	//select user ID
	if(isset($_SESSION['user']))
	{
		$user=$_SESSION['user'];
		$select_user="SELECT * FROM customer WHERE email='$user'";
		$user_query=mysqli_query($db->connectDB(),$select_user);
		$raw=mysqli_fetch_array($user_query);
		$c_id=$raw['c_id'];
	}
	else
	{
		$c_id=$_SERVER['REMOTE_ADDR'];
	}
	
	//cart action 
	$action=$_GET['action'];
	switch($action)
	{

		case 'adtocrt':
			$sql="INSERT INTO cart(c_id,p_id,qty) VALUES('$c_id','$p_id',1)";
			mysqli_query($db->connectDB(),$sql);
			header("location:".$_SERVER['HTTP_REFERER']);
		break;
		
		case 'updtcrtminuse':
			$sql="SELECT * FROM cart WHERE c_id='$c_id' && p_id='$p_id'";
			$query=mysqli_query($db->connectDB(),$sql);
			$row=mysqli_fetch_array($query);
			$qty=$row['qty'];
			$newqty=$qty-1;
			if($newqty<=0)
			{
				header("location:cart.php");
			}
			elseif($newqty>=1)
			{
				$sql="UPDATE cart SET qty='$newqty' WHERE c_id='$c_id' && p_id='$p_id'";
				mysqli_query($db->connectDB(),$sql);
				header("location:cart.php");
			}
		break;
		
		case 'updtcrtpluse':
			$sql="SELECT * FROM cart WHERE c_id='$c_id' && p_id='$p_id'";
			$query=mysqli_query($db->connectDB(),$sql);
			$row=mysqli_fetch_array($query);
			$qty=$row['qty'];
			$newqty=$qty+1;
			if($newqty<=0)
			{
				header("location:cart.php");
			}
			elseif($newqty>=1)
			{
				$sql="UPDATE cart SET qty='$newqty' WHERE c_id='$c_id' && p_id='$p_id'";
				mysqli_query($db->connectDB(),$sql);
				header("location:cart.php");
			}
		break;
		
		case 'rmvfrmcrt':
			$sql="DELETE FROM cart WHERE c_id='$c_id' && p_id='$p_id'";
			mysqli_query($db->connectDB(),$sql);
			header("location:".$_SERVER['HTTP_REFERER']);
		break;
		
		case 'emptycart':
			$sql="DELETE FROM cart WHERE c_id='$c_id'";
			mysqli_query($db->connectDB(),$sql);
			header("location:".$_SERVER['HTTP_REFERER']);
		break;	
		
		case 'rstqty':
			$sql="UPDATE cart SET qty='1' WHERE c_id='$c_id' && p_id='$p_id'";
			mysqli_query($db->connectDB(),$sql);
			header("location:cart.php");
		break;		
	}
?>