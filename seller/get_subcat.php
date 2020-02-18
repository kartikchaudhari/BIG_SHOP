<?php
	session_start();
	require_once("../config.php");
	$db_handle = new DBController();
?>
<?php
if($_POST['cate'])
{?>
	<select class="sub_cat" name="sub_cat">
			<option value="" selected>Sub Category</option>
				<?php
					$sql="SELECT DISTINCT sub_cat FROM category WHERE category='".$_POST['cate']."' && main_cat='".$_SESSION['main-cate']."'";
					$query=mysql_query($sql);
					while($row=mysql_fetch_assoc($query))
					{
					?>
						<option value="<?php echo $row['sub_cat']; ?>"><?php echo $row['sub_cat'];?> </option>
					<?php }
				?>
			<option value="other">Other</option>
		</select>
<?php
}
?>