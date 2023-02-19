<?
session_start();
include "db.php";
/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;

/* Include the Composer generated autoload.php file */
require 'C:\MAMP\composer\vendor\autoload.php';


/* set session values */
$_SESSION['p_number'] = $_POST['p_number'];
$_SESSION['p_first_name'] = $_POST['p_first_name'];
$_SESSION['p_last_name'] = $_POST['p_last_name'];
$_SESSION['p_adress'] = $_POST['p_adress'];
$_SESSION['p_city'] = $_POST['p_city'];
$_SESSION['p_postcode'] = $_POST['p_postcode'];
$_SESSION['p_email'] = $_POST['p_email'];
$_SESSION['p_phonenr'] = $_POST['p_phonenr'];
$_SESSION['dob'] = $_POST['dob'];


// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['p_number'], $_POST['p_first_name'], $_POST['p_last_name'], $_POST['p_adress'],  $_POST['p_city'],  $_POST['p_postcode'],  $_POST['p_email'], 
$_POST['p_phonenr'], $_POST['dob'], $_POST['p_password'], $_POST['passwordrepeat'])) {
	// Could not get the data that should have been sent.
    $message = 'Please complete the registration form.';
    $error = 'Error: ';
    header('Location: /Catwoman-IMS/registerpage.php?message='.$message.'&error='.$error);
	exit();
}

// Make sure the password and repeat password is identical.
if ($_POST['p_password'] != $_POST['passwordrepeat']){
    $message = 'Password and Repeat Password are not identical.';
    $error = 'Error: ';
    header('Location: /Catwoman-IMS/registerpage.php?message='.$message.'&error='.$error);
    exit();
}

// We need to check if the account with that p_number exists.
if ($stmt = $conn->prepare('SELECT p_number, p_password FROM p_login WHERE p_number = ?')) {
    // Check if account with p_number exists in p_login
    $stmt->bind_param('i', $_POST['p_number']);
    $stmt->execute();
    $stmt->store_result();
    // Store the result so we can check if the account exists in the database.
    if ($stmt->num_rows > 0) {
        // p_number already exists
        $message = 'Personal number already exists.';
        $error = 'Error: ';
        unset($_SESSION['p_number']);
        header('Location: /Catwoman-IMS/registerpage.php?message='.$message.'&error='.$error);
        exit();
    } 
    if ($stmt = $conn->prepare('SELECT p_number, p_password FROM unactivated_user WHERE p_number = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
        $stmt->bind_param('i', $_POST['p_number']);
        $stmt->execute();
        $stmt->store_result();
        // Store the result so we can check if the account exists in the database.
        if ($stmt->num_rows > 0) {
            // p_number already exists
            $message = 'Personal number already exists.';
            $error = 'Error: ';
            unset($_SESSION['p_number']);
            header('Location: /Catwoman-IMS/registerpage.php?message='.$message.'&error='.$error);
            exit();
        } 
        else {

            // check that email is valid
            if (!filter_var($_POST['p_email'], FILTER_VALIDATE_EMAIL)) {
                $message = 'Email is not valid.';
                $error = 'Error: ';
                unset($_SESSION['p_email']);
                header('Location: /Catwoman-IMS/registerpage.php?message='.$message.'&error='.$error);
                exit();
            }

            //Check if email already exists.
            if ($stmt = $conn->prepare('SELECT p_email FROM patient WHERE p_email = ?')){
                $stmt->bind_param('s', $_POST['p_email']);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0){
                    $message = 'Email already exists.';
                    $error = 'Error: ';
                    unset($_SESSION['p_email']);
                    header('Location: /Catwoman-IMS/registerpage.php?message='.$message.'&error='.$error);
                    exit();
                }
            }

            if (strlen($_POST['p_password']) > 20 || strlen($_POST['p_password']) < 5) {
                $message = 'Password must be between 5 and 20 characters long.';
                $error = 'Error: ';
                header('Location: /Catwoman-IMS/registerpage.php?message='.$message.'&error='.$error);
                exit();
            }

            if (strlen($_POST['p_number']) > 12 || strlen($_POST['p_number']) < 12) {
                $message = 'Personal Number must be 12 characters long.';
                $error = 'Error: ';
                unset($_SESSION['p_number']);
                header('Location: /Catwoman-IMS/registerpage.php?message='.$message.'&error='.$error);
                exit();
            }

            if (strlen($_POST['p_phonenr']) > 10 || strlen($_POST['p_phonenr']) < 10){
                $message = 'Phone number must have length 10. (Format: 07XXXXXXXX)';
                $error = 'Error: ';
                unset($_SESSION['p_phonenr']);
                header('Location: /Catwoman-IMS/registerpage.php?message='.$message.'&error='.$error);
                exit();
            }

            if ($_POST['captcha_code'] != $_SESSION['captcha_text']){
                $message = 'Incorrect captcha.';
                $error = 'Error: ';
                header('Location: /Catwoman-IMS/registerpage.php?message='.$message.'&error='.$error);
                exit();
            }

            // p_number does not exist, insert new account
            if ($stmt = $conn->prepare('INSERT INTO unactivated_user (p_number, p_password, p_first_name, p_last_name, p_adress, p_postcode, p_city, p_email, 
            p_phonenr, dob, activation_key) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)')) {
                // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
                $p_password = password_hash($_POST['p_password'], PASSWORD_DEFAULT);
                $uniqid = uniqid();
                $uniqid = password_hash($uniqid, PASSWORD_DEFAULT); //Hashing activation key for use in the activation link
                $stmt->bind_param('issssssssss', $_POST['p_number'], $p_password, $_POST['p_first_name'], $_POST['p_last_name'], $_POST['p_adress'], 
                $_POST['p_postcode'], $_POST['p_city'], $_POST['p_email'], $_POST['p_phonenr'], $_POST['dob'], $uniqid);
                $stmt->execute();
                $activate_link = 'http://localhost/Catwoman-IMS/activate.php?activation_key=' . $uniqid;

                //---------Mail activation link-----------
                $mail = new PHPMailer();
                /* Set the mail sender. */
                $mail->setFrom('univap.no-reply@outlook.com', 'Univap');
                /* Add a recipient. */
                $mail->addAddress($_POST['p_email']);
                /* Set the subject. */
                $mail->Subject = 'UniVaP Account Activation';
                /* Set the mail message. */
                $mail->isHTML(true);
                $mailContent = '<p> Hello, '. $_POST['p_first_name'] .' '. $_POST['p_last_name'] .'! </p>
                <p>Please click the following link to activate your UniVaP account: <br><br><a href="' . $activate_link . '">' . $activate_link . '</a></p>';
                $mail->Body = $mailContent;
                    
                /* SMTP parameters. */
                    
                /* Tells PHPMailer to use SMTP. */
                $mail->isSMTP();
                    
                /* SMTP server address. */
                $mail->Host = 'smtp.office365.com';
                
                /* Use SMTP authentication. */
                $mail->SMTPAuth = TRUE;
                    
                /* Set the encryption system. */
                $mail->SMTPSecure = 'tls';
                    
                 /* SMTP authentication username. */
                $mail->Username = 'univap.no-reply@outlook.com';
                    
                /* SMTP authentication password. */
                $mail->Password = 'catwomanims2022';
                    
                /* Set the SMTP port. */
                $mail->Port = 587;
                
                /* Finally send the mail. */
                if ($mail->send()){
                $message = 'An account activation link has been sent to "'. $_POST['p_email'] .'"';
                }
                else{
                    $message = 'The account activation email could not be sent.';
                }       
            } 
            else {
            // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
            echo 'Could not prepare insert query statement!';
            }
        }
	$stmt->close();
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
    <title>Register new account</title>
</head>

<!-- Top navigation bar -->
<body>
    <div class="w3-bar w3-black w3-hide-small">
      <a href="/Catwoman-IMS/index.html" class="w3-bar-item w3-button w3-left">&emsp;Home&emsp;</a>
      <a href="/Catwoman-IMS/contact.html" class="w3-bar-item w3-button w3-left">&emsp;Contact&emsp;</a>
      <a href="/Catwoman-IMS/about.html" class="w3-bar-item w3-button w3-left">&emsp;About&emsp;</a>
      <a href="/Catwoman-IMS/loginpage_patient.html" class = "w3-bar-item w3-button w3-right">Patient Log in</a>
      <a href="/Catwoman-IMS/loginpage_worker.html" class = "w3-bar-item w3-button w3-right">Authenticated Log in</a> 
    </div>
  

<!-- UniVaP logo -->
<div class="container">
    <header class="w3-container w3-padding-8 w3-center w3-black" id="home">
        <h1 class="w3-jumbo"><span class="w3-hide-small"></span> UniVaP</h1>
        <p><b>Unified Vaccination Platform</b></p>
    </header>
</div>

<!-- Register text -->
<div class="container"> 
    <form action="">
        <br>
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
