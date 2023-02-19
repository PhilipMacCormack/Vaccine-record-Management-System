
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
$d_patient=$_REQUEST['d_patient'];

/* Tell mysqli to throw an exception if an error occurs */
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
/* Start transaction */

 mysqli_begin_transaction($conn);
try {

//Notification delete

	$sql = "DELETE
			FROM notification
			WHERE p_number = '$d_patient'";

	if (mysqli_query($conn, $sql)){
	}else{
		echo"Error deleting record: " . mysqli_error($conn);
		// Instantly redirects to showmovies page
		$_SESSION['text'] = "Error deleting record nnotification constrained by report, constrained by patient";
		header("Location: http://localhost/Catwoman-IMS/edit_patient.php");
	}

//Report delete
	$sql = "DELETE
		FROM report
		WHERE p_number = '$d_patient'";


	if (mysqli_query($conn, $sql)){
	}else{
		echo"Error deleting report record: " . mysqli_error($conn);
		// Instantly redirects to showmovies page
		$_SESSION['text'] = "Error deleting report record, report constrained by patient";
		header("Location: http://localhost/Catwoman-IMS/edit_patient.php");
	}


//Patient delete
	$sql = "DELETE
			FROM patient 
			WHERE p_number = '$d_patient'";


	// Deletes on batch_no and on v_name
	if (mysqli_query($conn, $sql)){
		echo"Record deleted successfully";
		// Instantly redirects to showmovies page
		$_SESSION['text'] = "Record deleted successfully";
		header("Location: http://localhost/Catwoman-IMS/edit_patient.php");
	}else{
		echo"Error deleting record: " . mysqli_error($conn);
		// Instantly redirects to showmovies page
		$_SESSION['text'] = "Error deleting record: ". mysqli_error($conn);
		header("Location: http://localhost/Catwoman-IMS/edit_patient.php");
	}
	
/* If code reaches this point without errors then commit the data in the database */
mysqli_commit($conn);
} catch (mysqli_sql_exception $exception) {
    mysqli_rollback($conn);

    throw $exception;
}	


exit();

?>

