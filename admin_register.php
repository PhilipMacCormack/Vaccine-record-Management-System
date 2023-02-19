<?
session_start();
include "db.php";

// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['employee_id'], $_POST['hw_first_name'], $_POST['hw_last_name'], $_POST['ha_id'], $_POST['h_password'], $_POST['h_passwordrepeat'])) {
	// Could not get the data that should have been sent.
    $message = 'Please complete the registration form.';
    $error = 'Error: ';
    header('Location: /Catwoman-IMS/admin_registerpage.php?message='.$message.'&error='.$error);
	exit();
}

// Make sure the password and repeat password is identical.
if ($_POST['h_password'] != $_POST['h_passwordrepeat']){
    $message = 'Password and Repeat Password are not identical.';
    $error = 'Error: ';
    header('Location: /Catwoman-IMS/admin_registerpage.php?message='.$message.'&error='.$error);
    exit();
}

// We need to check if the account with that employee_id exists.
if ($stmt = $conn->prepare('SELECT employee_id, h_password FROM h_login WHERE employee_id = ?')) {
    // Check if account with p_number exists in p_login
    $stmt->bind_param('i', $_POST['employee_id']);
    $stmt->execute();
    $stmt->store_result();
    // Store the result so we can check if the account exists in the database.
    if ($stmt->num_rows > 0) {
        // p_number already exists
        $message = 'Employee ID already exists.';
        $error = 'Error: ';
        header('Location: /Catwoman-IMS/admin_registerpage.php?message='.$message.'&error='.$error);
        exit();
    } 
   
    else {

        //Check that password is between 5 and 20 characters long
        if (strlen($_POST['h_password']) > 20 || strlen($_POST['h_password']) < 5) {
            $message = 'Password must be between 5 and 20 characters long.';
            $error = 'Error: ';
            header('Location: /Catwoman-IMS/admin_registerpage.php?message='.$message.'&error='.$error);
            exit();
        }

        if ($_POST['captcha_code'] != $_SESSION['captcha_text']){
            $message = 'Incorrect captcha.';
            $error = 'Error: ';
            header('Location: /Catwoman-IMS/admin_registerpage.php?message='.$message.'&error='.$error);
            exit();
        }

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        mysqli_begin_transaction($conn);
        try{
        // employee_id does not exist, insert new account
        if ($stmt = mysqli_prepare($conn, 'INSERT INTO h_login (employee_id, h_password) VALUES (?, ?)')) {
            // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
            $h_password = password_hash($_POST['h_password'], PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, 'is', $_POST['employee_id'], $h_password);
            mysqli_stmt_execute($stmt);
            $message = 'Employee account has been created';
        }

        if ($stmt = mysqli_prepare($conn, 'INSERT INTO healthcare_worker (employee_id, hw_first_name, hw_last_name, admin_id, ha_id) VALUES (?, ?, ?, ?, ?)')) {
            mysqli_stmt_bind_param($stmt, 'issii', $_POST['employee_id'], $_POST['hw_first_name'], $_POST['hw_last_name'], $_POST['admin_id'], $_POST['ha_id']);
            mysqli_stmt_execute($stmt);
        }
        mysqli_commit($conn);
        }
        catch (mysqli_sql_exception $exception){
            mysqli_rollback($conn);
            throw $exception;
        }
    }
}

else {
	// Something is wrong with the sql statement, check to make sure p_login table exists with 2 fields.
	echo 'Could not prepare statement!';
}
$conn->close();
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
    <title>Admin Register Employee</title>
</head>

<!-- Top navigation bar -->
<body>
<div class="w3-bar w3-black w3-hide-small">
        <a href="/Catwoman-IMS/adminhome.php" class="w3-bar-item w3-button w3-left">&emsp;Logs&emsp;</a>
        <a href="/Catwoman-IMS/admin_messages.php" class = "w3-bar-item w3-button w3-left">Support Messages</a>
        <a href="/Catwoman-IMS/edit_database.php" class = "w3-bar-item w3-button w3-left">Edit Database</a>
        <a href="/Catwoman-IMS/admin_registerpage.php" class = "w3-bar-item w3-button w3-left">Register Employee</a>
        <a href="/Catwoman-IMS/worker_logout.php" class = "w3-bar-item w3-button w3-right">Log out</a> 
        <a href="/Catwoman-IMS/adminprofilepage.php" class = "w3-bar-item w3-button w3-right">Profile</a> 
    </div>
  

<!-- UniVaP logo -->
<div class="container">
    <header class="w3-container w3-padding-8 w3-center w3-black" id="home">
        <h1 class="w3-jumbo"><span class="w3-hide-small"></span> UniVaP</h1>
        <p><b>Admin Tool</b></p>
    </header>
</div>

<!-- Register text -->
<div class="mailmessage"> 
    <form action="">
        <p>&emsp;<?php echo $message; ?></p>
    </form>
</div>

<!-- Footer on bottom of page -->
<div class="footer">
    <a href="/Catwoman-IMS/privacy.html">Privacy</a>
    /
    <a href="/Catwoman-IMS/terms_conditions.html">Terms & Conditions</a>
  </div>

</html>
