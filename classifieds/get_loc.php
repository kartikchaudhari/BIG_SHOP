<?php
	session_start();
	require_once("../config.php");
	$db_handle = new DBController();
?>
<?php
if($_POST['cate'])
{?>
	<select name="location" class="srchloc">
		<option value="" selected>Select Location</option>
		<option value="">All</option>
		<?php
			$sql="SELECT DISTINCT altcity FROM classifieds WHERE category='".$_POST['cate']."'";
			$query=mysql_query($sql);
			while($row=mysql_fetch_assoc($query))
			{
			?>
				<option value="<?php echo $row['altcity']; ?>"><?php echo $row['altcity'];?> </option>
			<?php }
		?>
	</select>
<?php
}
?>