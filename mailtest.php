<?php

/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;

/* Include the Composer generated autoload.php file */
require 'C:\MAMP\composer\vendor\autoload.php';

/* Create a new PHPMailer object. */
$mail = new PHPMailer();

 /* Set the mail sender. */
$mail->setFrom('univap.no-reply@outlook.com', 'Univap');
/* Add a recipient. */
$mail->addAddress('philipmaccormack7@hotmail.com', 'Philip');
/* Set the subject. */
$mail->Subject = 'Force TESTTESTTEST';
/* Set the mail message body. */
$mail->Body = 'There is a great disturbance in the Force.';
    
/* SMTP parameters. */
    
/* Tells PHPMailer to use SMTP. */
$mail->isSMTP();
    
/* SMTP server address. */
$mail->Host = 'smtp.office365.com';
 
/* Use SMTP authentication. */
$mail->SMTPAuth = TRUE;
    
/* Set the encryption system. */
$mail->SMTPSecure = 'tls';
    
/* SMTP authentication username. */
$mail->Username = 'univap.no-reply@outlook.com';
    
/* SMTP authentication password. */
$mail->Password = 'catwomanims2022';
    
/* Set the SMTP port. */
$mail->Port = 587;
    
/* Finally send the mail. */
if ($mail->send()){
   echo 'An activation link has been sent to your email!';
}
else{
   echo 'Message failed to send: ' . $mail->ErrorInfo;
}
?>