<!DOCTYPE html>
<?php
	session_start();
	require_once("config.php");
	$db_handle = new DBController();
	include("functions.php");
	if(isset($_SESSION['user']))
	{
		header("location: index.php");
	}
?>
<html>
<head>
<title>Recover Password</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="icon" href="images/favicon.png" >
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/megamenu.js"></script>
<script type="text/javascript" src="js/livesearch.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
</head>
<body> 
<script type="text/javascript">
	$(window).load(function(){
		$(".mailloader").fadeOut("fast");
	})
</script>
<div class="mailloader"></div>
	<div class="header">
	<?php
		bottomheader();
	?>
	</div>
	<?php menu(); ?>
		<div class="clogin">
		<div class="clog1">
		<h1>Recover Account</h1>
		<form method="post">
			<input type="email" name="email" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} ?>" placeholder="Enter your email" class="col-md-4" required />
			<br>
			<br>
			<br>
			<?php
				if(isset($_POST['getpass']))
				{
					sendpass();
				}
			?>
			<input type="submit" value="Get Password" name="getpass" class="col-md-4" />
		</form>
		<br><br><br>
		<center>Password will be sent to your email</center>
		</div><div class="clearfix"> </div>
	</div>
<div class="clearfix"> </div>
	
	<div class="footer">
		<?php 
			include "footer.php"
		?>
	</div>
</body>
</html>