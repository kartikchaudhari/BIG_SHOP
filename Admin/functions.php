<?php
	session_start();
	require_once("../config.php");
	$db_handle = new DBController();
	
	function AdminLogin()
	{
		if(isset($_POST['login']))
		{
			$sql="SELECT * FROM admin  WHERE email='".$_POST['Email']."' && password='".$_POST['Password']."'";
			$query=mysql_query($sql);
			$count=mysql_num_rows($query);
			
			if($count==1)
			{
				$_SESSION['Admin']=$_POST['Email'];
				session_start();
				header("location:index.php");
			}
			else
			{
				?>
					<input type="submit" value="Invalid Login" disabled>
				<?php
			}
		}
	}
	function sendAdminpass()
	{
		if(isset($_POST['get-pass']))
		{
			$em=$_POST['Email'];
			$sql="SELECT * FROM admin WHERE email='$em'";
			$query=mysql_query($sql);
			$count=mysql_num_rows($query);
			if($count==1)
			{
				$row=mysql_fetch_array($query);
				$pass=$row['password'];
				require '../srmailer/class.phpmailer.php';
				require '../srmailer/class.smtp.php';
				
				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->Mailer = 'smtp';
				$mail->SMTPAuth = true;
				$mail->Host = 'smtp.gmail.com';
				$mail->Port = 465;
				$mail->SMTPSecure = 'ssl';

				$mail->Username = "bigshope898@gmail.com";
				$mail->Password = "bigger898shope";

				$mail->IsHTML(true);
				$mail->SingleTo = true;

				$mail->From = "bigshope898@gmail.com";
				$mail->FromName = "BigShop.com";

				$mail->addAddress($em,"User 1");

				$mail->Subject = "Password Recovery";
				$mail->Body = "
								Hi BigShope Admin,
								<br /><br />
								This message is sent from BigShop.com for your password recovery request.
								<br />Your password is :<b> $pass </b>
							  ";
				if(!$mail->Send())
				{
					header("location:login.php?pass=err");
				}
				else
				{
					header("location:login.php?pass=sent");
				}
			}
			elseif($count==0)
			{
				header("location:login.php?pass=invalid");
			}
		}
	}
?>