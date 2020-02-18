<?php
require_once("../../config.php");
$db_handle = new DBController();
?>
<table border="1" cellspacing="0" cellpadding="3">
	<tr><th>Main Category</th><th>Category</th><th>Cub Category</th><th>Cate_ID</th></tr>
	<?php 
		$sql1=$sql = 'SELECT DISTINCT sub_cat FROM `category`'; 
		$query1=mysql_query($sql1);
		$count1=mysql_num_rows($query1);
		echo "$count1  sub_cat inserted";
		$sql="SELECT * FROM category";
		$query=mysql_query($sql);
		$count=mysql_num_rows($query);
		echo "$count  rows inserted";
		while($row=mysql_fetch_assoc($query))
		{ 
		?>
			<tr>	
				<td><?php echo $row['main_cat']; ?></td>
				<td><?php echo $row['category']; ?></td>
				<td><?php echo $row['sub_cat']; ?></td>
				<td><?php echo $row['cate_id']; ?></td>
			</tr>
			
		<?php 
		}
	?>
</table>