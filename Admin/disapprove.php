<?php
	session_start();
	require_once("../config.php");
	$db_handle = new DBController();
	if(!isset($_SESSION['Admin']))
	{
		header("location:login.php");
	}
	
	if(isset($_GET['of_id']))
	{
		$of_id=$_GET['of_id'];
		$sql="UPDATE offers SET status='Denied' WHERE of_id='$of_id'";
		mysql_query($sql);
		header("location:apprv_requests.php?offer=denied");
	}
	elseif(isset($_GET['p_id']))
	{
		$p_id=$_GET['p_id'];
		$sql="UPDATE products SET status='Denied' WHERE p_id='$p_id'";
		mysql_query($sql);
		header("location:apprv_requests.php?product=denied");
	}
?>