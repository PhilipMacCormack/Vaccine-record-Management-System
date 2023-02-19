<?php
session_start();

/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;

/* Include the Composer generated autoload.php file */
require 'C:\MAMP\composer\vendor\autoload.php';

//If the user is not logged in redirect to the login page...
if (empty($_SESSION['admin'])) {
    session_destroy();
	header('Location: /Catwoman-IMS/loginpage_worker.html');
	exit;
}

require "db.php";

$message_id = $_POST['message_id'];
$answer = $_POST['answer'];
$email = $_POST['support_email'];
$subject = $_POST['subject'];
$resolved = 'Resolved';

if($stmt = $conn->prepare("UPDATE messages SET status=? WHERE message_id=?")){
    $stmt->bind_param('si', $resolved,$message_id);
    $stmt->execute();
}


//---------Mail-----------
$mail = new PHPMailer();
/* Set the mail sender. */
$mail->setFrom('univap.no-reply@outlook.com', 'Univap');
/* Add a recipient. */
$mail->addAddress($email);
/* Set the subject. */
$mail->Subject = "UniVaP Support: $subject";
/* Set the mail message. */
$mail->isHTML(true);
$mailContent = $answer;
$mail->Body = $mailContent;
    
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
$message = 'A support mail has been sent to "'. $email .'"';
}
else{
    $message = 'The account activation email could not be sent.';
}

header('Location: /Catwoman-IMS/admin_messages.php?message='.$message);

?>