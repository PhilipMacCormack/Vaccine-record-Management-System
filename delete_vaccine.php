
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
$d_vaccine=$_REQUEST['d_vaccine'];
$d_vaccine_batch_no = $d_vaccine[0];
$d_vaccine_v_name = $d_vaccine[1];

$sql = "DELETE
		FROM vaccine 
		WHERE batch_no = '$d_vaccine_batch_no' 
		AND v_name = '$d_vaccine_v_name' ";

// Deletes on batch_no and on v_name
if (mysqli_query($conn, $sql)){
	echo"Record deleted successfully";
	// Instantly redirects to showmovies page
	$_SESSION['text'] = "Record deleted successfully";
	header("Location: http://localhost/Catwoman-IMS/edit_vaccine.php");
}else{
	echo"Error deleting record: " . mysqli_error($conn);
	// Instantly redirects to showmovies page
	$_SESSION['text'] = "Error deleting record";
	header("Location: http://localhost/Catwoman-IMS/edit_vaccine.php");
}
	



exit();

?>

