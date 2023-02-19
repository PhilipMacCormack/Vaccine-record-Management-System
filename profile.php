<?php
session_start();
include 'db.php';



// If the user is not logged in redirect to the login page...
if (empty($_SESSION['p_loggedin'])) {
     session_destroy();
   header('Location: /Catwoman-IMS/loginpage_patient.html');
	exit;
}

// Fetching data
$p_num = $_SESSION['p_number'];
$newemail = $_REQUEST["email"];
$newemail = stripslashes($newemail);
$newemail = str_replace("'", "&#39", "$newemail");
$phone = $_REQUEST['phone'];
$notification = $_REQUEST['notifications'];


/* Tell mysqli to throw an exception if an error occurs */
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
/* Start transaction */

 mysqli_begin_transaction($conn);
try {


// Update query
$sql = "update patient set p_email='" .$newemail."', p_phonenr='$phone' where p_number='$p_num'";
$result=mysqli_query($conn,$sql);

if ($conn->query($sql) === TRUE) {
    $message= "Record updated successfully";
    header('Location: /Catwoman-IMS/patient_profile_page.php?message='.$message);
  } else {
    echo "Error updating record: " . $conn->error;
  }
  
if(isset($_POST['notifications'])){
  $sqlquery = "UPDATE notification SET active=1 WHERE p_number='$p_num'";
  $conn->query($sqlquery);
}
else{
  $sqlquery = "UPDATE notification SET active=0 WHERE p_number='$p_num'";
  $conn->query($sqlquery);
}

/* If code reaches this point without errors then commit the data in the database */
mysqli_commit($conn);
} catch (mysqli_sql_exception $exception) {
    mysqli_rollback($conn);

    throw $exception;
}	


    
?>

