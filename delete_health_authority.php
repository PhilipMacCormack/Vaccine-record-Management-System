
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
$d_health_authority=$_REQUEST['d_health_authority'];

$sql = "DELETE
		FROM health_authority 
		WHERE ha_id = '$d_health_authority'";

// Deletes on batch_no and on v_name
if (mysqli_query($conn, $sql)){
	echo"Record deleted successfully";
	// Instantly redirects to showmovies page
	$_SESSION['text'] = "Record deleted successfully";
	header("Location: http://localhost/Catwoman-IMS/edit_health_authority.php");
}else{
	echo"Error deleting record: " . mysqli_error($conn);
	// Instantly redirects to showmovies page
	$_SESSION['text'] = "Error deleting record";
	header("Location: http://localhost/Catwoman-IMS/edit_health_authority.php");
}
	



exit();

?>

