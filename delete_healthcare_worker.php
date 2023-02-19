
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
$d_healthcare_worker=$_REQUEST['d_healthcare_worker'];

$sql = "UPDATE h_login
		SET active_employee = 0
		WHERE employee_id = '$d_healthcare_worker'";

// Deletes on batch_no and on v_name
if (mysqli_query($conn, $sql)){
	echo"Record deleted successfully";
	// Instantly redirects to showmovies page
	$_SESSION['text'] = "Worker inactivated successfully";
	header("Location: http://localhost/Catwoman-IMS/edit_healthcare_worker.php");
}else{
	echo"Error deleting record: " . mysqli_error($conn);
	// Instantly redirects to showmovies page
	$_SESSION['text'] = "Error inactivating record: ". mysqli_error($conn);
	header("Location: http://localhost/Catwoman-IMS/edit_healthcare_worker.php");
}
	



exit();

?>

