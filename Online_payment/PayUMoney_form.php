<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />	
<script src="../js/jquery.min.js"></script>
<div class="mailloader"></div>
<script type="text/javascript">
	$(document).ready(function(){
		$(".mailloader").hide();
	});
</script>
<?php
session_start();
require_once("../config.php");
$db = new DBController();

// Merchant key here as provided by Payu
$MERCHANT_KEY = "gEdmunJx";

// Merchant Salt as provided by Payu
$SALT = "eCwWELxi";

// End point - change to https://secure.payu.in for LIVE mode
$PAYU_BASE_URL = "https://test.payu.in";

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) 
{
	$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
	$hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
	$hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
	$hash_string .= '|';
	}

	$hash_string .= $SALT;


	$hash = strtolower(hash('sha512', $hash_string));
	$action = $PAYU_BASE_URL . '/_payment';
}
elseif(!empty($posted['hash']))
{
	$hash = $posted['hash'];
	$action = $PAYU_BASE_URL . '/_payment';
}
?>
<html>
	<head>
	<script src="../js/jquery.min.js"></script>
	<script>
	var hash = '<?php echo $hash ?>';
	function submitPayuForm() {
	  if(hash == '') {
		return;
	  }
	  var payuForm = document.forms.payuForm;
	  payuForm.submit();
	  $(".mailloader").show();
	}
	</script>
</head>
<body onload="submitPayuForm()">
<form action="<?php echo $action; ?>" method="post" target="_top" name="payuForm">
<?php
	$user=$_GET['c_id'];
	$sql="SELECT * FROM customer WHERE c_id='$user'";
	$query=mysqli_query($db->connectDB(),$sql);
	$row=mysqli_fetch_assoc($query);
?>
	<input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
	<input type="hidden" name="hash" value="<?php echo $hash ?>"/>
	<input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
	<input type="hidden" name="amount" value="<?php echo $_GET['amount']; ?>" />	
	<input type="hidden" name="firstname" id="firstname" value="Any Name" />
	<input type="hidden" name="email" id="email" value="abc@abc.abc" />
	<input type="hidden" name="phone" value="8585659685" />
	<textarea name="productinfo" style="display:none;"><?php echo (empty($posted['productinfo'])) ? '' : $posted['productinfo'] ?></textarea>
	<input type="hidden" name="surl" value="http://localhost/BIG_SHOP/Online_payment/success.php?ssid=<?php echo $row['c_id']; ?>" size="64" />
	<input type="hidden" name="furl" value="http://localhost/BIG_SHOP/Online_payment/failure.php?ssid=<?php echo $row['c_id']; ?>" size="64" />
		<?php 
		if(!$hash) 
		{ ?>
			<style>
				#pymntbutton
				{
					border:none;
					padding:1em;
					width:50%;
					background:#1b1433;
					color: white;
					font-size: larger;
					margin-bottom:.5em;
					cursor: pointer;
					transition-duration:.5s;
				}
				#pymntbutton:hover
				{
					background:#6445cf;
				}
				.payment-box
				{
					margin:1em;
					padding:1em;
					text-align:center;
				}
				#blladd
				{
					resize:none;
					height:5em;
					width:50%;
					margin-bottom:1em;
					border:1px solid #1b1433;
					padding:.5em;
				}
				.eml
				{
					width:50%;
					margin-bottom:1em;
					border:1px solid #1b1433;
					padding:.5em;
				}
			</style>
			<div class="payment-box">
			<?php
				$user=$_GET['c_id'];
				$sql="SELECT * FROM customer WHERE c_id='$user'";
				$query=mysqli_query($db->connectDB(),$sql);
				$row=mysqli_fetch_assoc($query);
				$sessnemail=$row['email'];
				$_SESSION['user']=$sessnemail;
			?>
				<input type="text" placeholder="City" name="city" value="<?php echo $row['city']; ?>" class="eml" required />
				<input type="text" placeholder="Mobile" name="mob" value="<?php echo $row['mobile']; ?>" class="eml" required />
				<input type="text" placeholder="Pin Code" name="pincode" value="<?php echo $row['pincode']; ?>" class="eml" required />
				<input type="email" placeholder="Email - Order information will be sent to this email" value="<?php echo $row['email']; ?>" name="em" class="eml" required/>
				<textarea placeholder="Billing Address..." name="deladd" id="blladd" required><?php echo $row['address']; ?></textarea>
				<input type="submit" value="Continue to Payment" id="pymntbutton" />
			</div>
		<?php 
		} 
			if ($_POST) {
				$_SESSION['sendtothis']=$_POST['em'];
				$_SESSION['delcity']=$_POST['city'];
				$_SESSION['delmob']=$_POST['mob'];
				$_SESSION['delpin']=$_POST['pincode'];
				$_SESSION['deladd']=$_POST['deladd'];
			}
		?>
</form>
</body>
</html>
