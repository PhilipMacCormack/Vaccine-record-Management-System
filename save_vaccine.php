<?php
session_start();
//If the user is not logged in redirect to the login page...
if (empty($_SESSION['hw_loggedin'])) {
    session_destroy();
	header('Location: /Catwoman-IMS/loginpage_worker.html');
	exit;
}
include "db.php";


//Finding date for next dose
$Date = $_REQUEST['date'];
$week = $_REQUEST['week'];

//Fetching data
$vaccine_name=$_REQUEST['v_name'];
$vaccine_id=$_REQUEST['nplid'];
$batch_no = $_REQUEST['batch_no'];
$dose=$_REQUEST['dose'];
$p_num = $_REQUEST['p_number'];
$e_num = $_SESSION['employee_id'];
$next_dose = $dose + 1;

if ($week==NULL){
    $sql = "INSERT INTO report (dose, next_dose, date, p_number, nplid, batch_no, v_name, employee_id)  
        VALUES ($dose, NULL, '$Date', $p_num, '$vaccine_id', '$batch_no', '$vaccine_name', $e_num)";
        echo $sql;
    if (mysqli_query($conn, $sql)){
        $message1="Vaccine administered successfully";
        $report_id = mysqli_insert_id($conn);
        mysqli_query($conn, "DELETE FROM notification WHERE p_number=$p_num AND vaccine_name='$vaccine_name' AND dose=$dose");
        header('Location: /Catwoman-IMS/fill_vaccine_details.php?message='.$message1);
    }
    else{
        echo "Error in inserting record: " . mysqli_error($conn);
        }
}

else{
$no_days = 7*$week;
$next_dose_date= date('Y-m-d', strtotime($Date. " + $no_days days"));

//Insert query to report table
$sql = "INSERT INTO report (dose, next_dose, date, p_number, nplid, batch_no, v_name, employee_id)  
        VALUES ($dose, '$next_dose_date', '$Date', $p_num, '$vaccine_id', '$batch_no', '$vaccine_name', $e_num)";
// Requests id from delete button that was pressed
$d_patient=$_REQUEST['d_patient'];

/* Tell mysqli to throw an exception if an error occurs */
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
/* Start transaction */


 mysqli_begin_transaction($conn);
try {

if (mysqli_query($conn, $sql)){
    $report_id = mysqli_insert_id($conn);
    mysqli_query($conn, "DELETE FROM notification WHERE p_number=$p_num AND vaccine_name='$vaccine_name' AND dose=$dose");
	//$message1="Vaccine details inserted successfully";
  
    //header('Location: /Catwoman-IMS/fill_vaccine_details.php?message='.$message1);
}else{
	echo "Error in inserting record: " . mysqli_error($conn);
}


$result = "UPDATE vaccine SET v_status = 1 WHERE batch_no='$batch_no'";
if (mysqli_query($conn, $result)){
	//$message2="Vaccine status updated successfully";
    //header('Location: /Catwoman-IMS/fill_vaccine_details.php?message='.$message2);
}else{
	echo "Error in updating record: " . mysqli_error($conn);
}

$email_run = mysqli_query($conn, "SELECT p_email FROM patient WHERE p_number=$p_num");
if(mysqli_num_rows($email_run) > 0){
    foreach($email_run as $row){
        $p_email = $row['p_email'];
    }
}

$reminder_date = date('Y-m-d', strtotime($next_dose_date.'- 14 days'));
$not_sent = 'not sent';

$notification_query = "INSERT INTO notification (report_id, vac_date, rem_date, vaccine_name, dose, p_number, n_email, status) 
                        VALUES($report_id, '$next_dose_date', '$reminder_date', '$vaccine_name', $next_dose, $p_num, '$p_email', '$not_sent')";
if (mysqli_query($conn, $notification_query)){
    //$message3="Notification inserted";
    //header('Location: /Catwoman-IMS/fill_vaccine_details.php?message='.$message3);
}


/* If code reaches this point without errors then commit the data in the database */
mysqli_commit($conn);
$message4 = "Vaccine administered successfully";
header('Location: /Catwoman-IMS/fill_vaccine_details.php?message='.$message4);
} catch (mysqli_sql_exception $exception) {
    mysqli_rollback($conn);

    throw $exception;
}	

$conn->close();
}
?>

