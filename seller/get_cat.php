<?php
	session_start();
	require_once("../config.php");
	$db_handle = new DBController();
?>
<?php
if($_POST['main-cat'])
{
$_SESSION['main-cate']=$_POST['main-cat'];
?>
	<select class="cate" name="category">
		<option value="" selected>Category</option>
			<?php
				$sql="SELECT DISTINCT category FROM category WHERE main_cat='".$_POST['main-cat']."'";
				$query=mysql_query($sql);
				while($row=mysql_fetch_assoc($query))
				{
				?>
					<option value="<?php echo $row['category']; ?>"><?php echo $row['category'];?> </option>
				<?php }
			?>
	</select>
<?php
}
?>