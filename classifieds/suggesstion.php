<?php
require_once("../config.php");
$db_handle = new DBController();
	if(!empty($_POST["keyword"])) 
	{
		$query ="SELECT * FROM classifieds T1 JOIN customer T2 ON T1.c_id=T2.c_id WHERE p_name like '%" . $_POST["keyword"] . "%' OR brand like '%" . $_POST["keyword"] . "%'  OR altmobile like '%" . $_POST["keyword"] . "%' OR mobile like '%" . $_POST["keyword"] . "%' ORDER BY p_name DESC LIMIT 6";
		$result = $db_handle->runQuery($query);
		if(!empty($result)) 
		{
		?>
			<ul id="suggesstion-list">
			<?php
				foreach($result as $suggesstion) 
				{
				?>
					<li onClick="selectsuggetion('<?php echo $suggesstion["p_name"]; ?>');"><?php echo $suggesstion["p_name"]; ?></li>
				<?php 
				}
			?>
			</ul>
		<?php 
		}
	}
?>