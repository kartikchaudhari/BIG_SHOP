<?php
require_once("config.php");
$db_handle = new DBController();
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM products WHERE (p_name like '%" . $_POST["keyword"] . "%' OR brand like '%" . $_POST["keyword"] . "%') && status like 'approved' ORDER BY p_name DESC LIMIT 6";
$result = $db_handle->runQuery($query);
if(!empty($result)) {
?>
<ul id="suggesstion-list">
<?php
foreach($result as $suggesstion) {
?>
<li onClick="selectsuggetion('<?php echo $suggesstion["p_name"]; ?>');"><?php echo $suggesstion["p_name"]; ?></li>
<?php } ?>
</ul>
<?php } } ?>