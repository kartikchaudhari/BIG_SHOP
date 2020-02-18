<?php
require 'class.phpmailer.php';
require 'class.smtp.php';
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = 'smtp';
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';


$mail->Username = "ssaiyed173@gmail.com";
$mail->Password = "Sh2hva367";

$mail->IsHTML(true);
$mail->SingleTo = true;

$mail->From = "ssaiyed173@gmail.com";
$mail->FromName = "sarjil shaikh";

$mail->addAddress("sarjilshaikh02@gmail.com","User 1");
$mail->addAddress("sarjil1432@gmail.com","User 2");

$mail->addCC("sarjil1432@gmail.com","User 3");
$mail->addBCC("sarjil1432@gmail.com","User 4");

$mail->Subject = "Testing PHPMailer with localhost";
$mail->Body = "Hi,<br /><br />This system is working perfectly.";

if(!$mail->Send())
    echo "Message was not sent <br />PHPMailer Error: " . $mail->ErrorInfo;
else
    echo "Message has been sent"; 
?>