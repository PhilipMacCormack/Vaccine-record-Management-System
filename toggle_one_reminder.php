<?php
include 'db.php';

session_start();
// If the user is not logged in redirect to the login page...
if (empty($_SESSION['p_loggedin'])) {
    session_destroy();
	header('Location: /Catwoman-IMS/loginpage_patient.html');
	exit;
}

$report_id = $_GET['report_id'];
$sql = "SELECT * FROM notification WHERE report_id=$report_id";
$query_run_select=mysqli_query($conn,$sql);
if(mysqli_num_rows($query_run_select) > 0){
    foreach($query_run_select as $items){
        if ($items['active']==1){
            $query1 = "UPDATE notification SET active=0 WHERE report_id=$report_id";
            mysqli_query($conn, $query1);
        }
        else{
            $query0 = "UPDATE notification SET active=1 WHERE report_id=$report_id";
            mysqli_query($conn, $query0);
        }
    }
}

header("Location: /Catwoman-IMS/patient_vaccinations.php");