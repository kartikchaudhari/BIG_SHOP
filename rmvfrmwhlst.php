<?php
	require_once("config.php");
	$db_handle = new DBController();
	
	$c_id=$_GET['c_id'];
	$p_id=$_GET['p_id'];
	mysql_query("DELETE FROM wish_list WHERE c_id='$c_id' && p_id='$p_id'")or die("failed to remmove from wishlist");
	header("location:profile.php");
?>