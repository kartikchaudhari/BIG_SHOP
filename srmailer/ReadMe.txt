step 1 :enable following extension for php

 1 : php_openssl
 2 : php_smtp
 3 : php_sockets

step 2 :replace all php.ini code with newphp.ini file's code 

step 3: you will need to change following configurations in send-mail.php file

    $mail->Port
    $mail->Host
    $mail->Mailer
    $mail->SMTPSecure
    $mail->Username
    $mail->Password
    $mail->From
    $mail->FromName

step 4 : exit wamp server and restart it again

step 5 : now run send-mail.php


done danaa done whoooooohhhhh