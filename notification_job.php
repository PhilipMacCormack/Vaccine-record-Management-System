
<?php

/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;

/* Include the Composer generated autoload.php file */
require 'C:\MAMP\composer\vendor\autoload.php';

include 'db.php';

date_default_timezone_set('Europe/Berlin');
$current_time = date("Y-m-d H:i:s");

$query = "SELECT report_id, rem_date, n_email, vac_date, active, status FROM notification";
$query_run=mysqli_query($conn, $query);
if(mysqli_num_rows($query_run) > 0)
{
    foreach($query_run as $items){
        $reminder_date = $items['rem_date'];
        $vac_date = $items['vac_date'];
        $active = $items['active'];
        if ($active == 1){
            if ($current_time > $reminder_date){
                // If the reminder date is greater than the current time, send an email to the email account
                $status = $items['status'];
                if ($status == 'not sent'){
                    $email = $items['n_email'];
                    $subject = 'UniVaP Reminder: Schedule your next vaccination';
                    $message = 'Hello, It is time to schedule a vaccination. Please log in to your UniVaP account to see the details.';
                    $report_id = $items['report_id'];

                    $mail = new PHPMailer();
                    /* Set the mail sender. */
                    $mail->setFrom('univap.no-reply@outlook.com', 'Univap');
                    /* Add a recipient. */
                    $mail->addAddress($email);
                    /* Set the subject. */
                    $mail->Subject = $subject;
                    /* Set the mail message. */
                    $mail->isHTML(true);
                    $mailContent = $message;
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

                    if ($mail->send()){
                        echo 'Mail was sent';
                    }
                    else{
                        echo 'Error: Mail could not be sent';
                    }
                    //$sql = "DELETE"
                    $sent = 'sent';
                    if($stmt=$conn->prepare("UPDATE notification SET status=? WHERE report_id=?")){
                        $stmt->bind_param('si', $sent, $report_id);
                        $stmt->execute();
                    }
                }
            }
        }
    }
}