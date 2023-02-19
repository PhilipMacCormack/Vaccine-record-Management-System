
<?php
session_start();
//If the user is not logged in redirect to the login page...
if (empty($_SESSION['admin'])) {
    session_destroy();
	header('Location: /Catwoman-IMS/loginpage_worker.html');
	exit();
}
require "db.php";



// Requests id from delete button that was pressed
$d_report=$_REQUEST['d_report'];


/* Tell mysqli to throw an exception if an error occurs */
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
/* Start transaction */

 mysqli_begin_transaction($conn);
try {

//Notification delete
	$sql = "DELETE
	FROM notification
	WHERE report_id = '$d_report'";

	if (mysqli_query($conn, $sql)){
	}else{
	echo"Error deleting record: " . mysqli_error($conn);
	// Instantly redirects to showmovies page
	$_SESSION['text'] = "Error deleting record nnotification constrained by report, constrained by patient";
	header("Location: http://localhost/Catwoman-IMS/edit_patient.php");
	}
	

$sql = "DELETE
		FROM report
		WHERE report_id = '$d_report'";

// Deletes on report id
if (mysqli_query($conn, $sql)){
	echo"Record deleted successfully";
	// Instantly redirects to showmovies page
	$_SESSION['text'] = "Record deleted successfully";
	header("Location: http://localhost/Catwoman-IMS/edit_report.php");
}else{
	echo"Error deleting record: " . mysqli_error($conn);
	// Instantly redirects to showmovies page
	$_SESSION['text'] = "Error deleting record";
	header("Location: http://localhost/Catwoman-IMS/edit_report.php");
}


/* If code reaches this point without errors then commit the data in the database */
mysqli_commit($conn);
} catch (mysqli_sql_exception $exception) {
    mysqli_rollback($conn);

    throw $exception;
}	



exit();

?>

