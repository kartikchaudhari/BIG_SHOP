<?php
require_once("../../config.php");
$db_handle = new DBController();

$sql="SELECT * FROM seller WHERE s_id='".$_GET['s_id']."'";
$query=mysql_query($sql);
$row=mysql_fetch_assoc($query);
$s_id=$row['s_id'];
$_SESSION['seller']=$row['email'];
session_start();
$date=date('d-m-Y',strtotime("$today +365 days"));
$updsql="UPDATE store SET validity='365', date='$date' WHERE s_id='$s_id'";
mysql_query($updsql);

header("location:../mystore.php");
?>