<?php
session_start();
// If the user is not logged in redirect to the login page...
if (empty($_SESSION['p_loggedin'])) {
    session_destroy();
	header('Location: /Catwoman-IMS/loginpage_patient.html');
	exit;
}

include 'db.php';

$rem_date = $_POST['rem_date'];
$new_rem_date = str_replace($rem_date[10], ' ',$rem_date);

$p_number = $_SESSION['p_number'];
$report_id = $_POST['report_id'];

if($stmt=$conn->prepare("UPDATE notification SET rem_date=? WHERE report_id=?")){
    $stmt->bind_param('si', $new_rem_date, $report_id);
    $stmt->execute();
    $message = 'A new date for the reminder has been set.';
    header("Location: /Catwoman-IMS/patient_vaccinations.php?message=$message");
}







?>