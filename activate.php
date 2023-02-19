<?php
include "db.php";

// First we check if the email and code exists...
if (isset($_GET['activation_key'])) {
	if ($stmt = $conn->prepare('SELECT * FROM unactivated_user WHERE activation_key = ?')) {
		$stmt->bind_param('s', $_GET['activation_key']);
		$stmt->execute();
		// Store the result so we can check if the account exists in the database.
		$stmt->store_result();
		if ($stmt->num_rows > 0) { // Account exists with the code.
			if ($stmt = $conn->prepare('SELECT * FROM unactivated_user WHERE activation_key = ?')) { //Get all variables to insert in to patient and p_login
				$stmt->bind_param('s', $_GET['activation_key']);
				$stmt->execute();
				$result = $stmt->get_result();
            	$row = $result->fetch_assoc();

				function age($date){ //Calculating age from dob
					list($year,$month,$day) = explode("-",$date);
					$year_diff  = date("Y") - $year;
					$month_diff = date("m") - $month;
					$day_diff   = date("d") - $day;
					if ($day_diff < 0 && $month_diff < 0) {
						$year_diff = $year_diff - 1;
					}
						return $year_diff;
				}
				$_dob = $row['dob'];
				$age = age($_dob);

				mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
				mysqli_begin_transaction($conn);
				try{
					if ($stmt = mysqli_prepare($conn, 'INSERT INTO patient (p_number, p_first_name, p_last_name,
						p_adress, p_postcode, p_city, p_email, p_phonenr, dob, age) VALUES (?,?,?,?,?,?,?,?,?,?)')){

							mysqli_stmt_bind_param($stmt, 'isssissssi', $row['p_number'], $row['p_first_name'], $row['p_last_name'], $row['p_adress'], $row['p_postcode']
							, $row['p_city'], $row['p_email'], $row['p_phonenr'], $row['dob'], $age);
							mysqli_stmt_execute($stmt);

					}
					if ($stmt = mysqli_prepare($conn, 'INSERT INTO p_login (p_number, p_password) VALUES (?,?)')){
						mysqli_stmt_bind_param($stmt,'is', $row['p_number'], $row['p_password']);
						mysqli_stmt_execute($stmt);
						if ($stmt = mysqli_prepare($conn, 'DELETE FROM unactivated_user WHERE p_number = ?')){
							mysqli_stmt_bind_param($stmt,'i', $row['p_number']);
							mysqli_stmt_execute($stmt);
						$accountactivated =  'Your account is activated! You can now <a href="/Catwoman-IMS/loginpage_patient.html"><u>Login</u></a>.';

						mysqli_commit($conn);
						}
					}
				}
				catch (mysqli_sql_exception $exception){
					mysqli_rollback($conn);
					throw $exception;
				}
			}
		} 
		else {
			echo 'The account is already activated or doesn\'t exist!';
		}
	}
}
?>

<!-- ------------------------------------------HTML PART OF SCRIPT------------------------------------------------- -->
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./style.css">

<head>
    <title>Account Activated</title>
</head>

<!-- Top navigation bar -->
<body>
    <div class="w3-bar w3-black w3-hide-small">
      <a href="/Catwoman-IMS/index.html" class="w3-bar-item w3-button w3-left">&emsp;Home&emsp;</a>
      <a href="/Catwoman-IMS/contact.html" class="w3-bar-item w3-button w3-left">&emsp;Contact&emsp;</a>
      <a href="/Catwoman-IMS/about.html" class="w3-bar-item w3-button w3-left">&emsp;About&emsp;</a>
      <a href="#search" class="w3-bar-item w3-button w3-right"><i class="fa fa-search"></i></a>
      <a href="/Catwoman-IMS/loginpage_patient.html" class = "w3-bar-item w3-button w3-right">Patient Log in</a>
      <a href="/Catwoman-IMS/loginpage_worker.html" class = "w3-bar-item w3-button w3-right">Authenticated Log in</a> 
    </div>
  

<!-- UniVaP logo -->
<div class="container">
    <header class="w3-container w3-padding-8 w3-center w3-black" id="home">
        <h1 class="w3-jumbo"><span class="w3-hide-small"></span> UniVaP</h1>
        <p><b>Uniform Vaccination Platform</b></p>
    </header>
</div>

<!-- Register text -->
<div class="container"> 
    <form action="">
		<br>
        <p>&emsp;<?php echo $accountactivated; ?></p>
    </form>
</div>

<!-- Footer on bottom of page -->
<div class="footer">
    <a href="/Catwoman-IMS/privacy.html">Privacy</a>
    /
    <a href="/Catwoman-IMS/terms_conditions.html">Terms & Conditions</a>
  </div>

</html>