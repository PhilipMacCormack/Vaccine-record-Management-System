<?php
session_start();
//If the user is not logged in redirect to the login page...
if (empty($_SESSION['admin'])) {
    session_destroy();
	header('Location: /Catwoman-IMS/loginpage_worker.html');
	exit;
}

require "db.php";

?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./style.css">
<meta http-equiv="refresh" content="900;url=worker_logout.php" />  <!-- Idle check, logout after 15 minutes of idle -->

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

 

<!-- register box -->
<section class="all-boxes">

<div class= "box_register">
    <h1>
        <b>Register a new Employee</b>
    </h1>
    
    <form action="/Catwoman-IMS/admin_register.php" method="post">
        <p><u><font color="red"><?php echo $_GET['error']; ?></font></u> <i><?php echo $_GET['message']; ?></i></p>
        <label>Fill in this form to create an  Employee/Admin account.</label><br><br>
        <div class="row">
            <div class="column">  
                <label for="employee_id">Employee ID</label>
                <input type="text" placeholder="Enter Employee ID" name="employee_id" id="employee_id" required><br>
                <label for="hw_first_name">First Name</label>
                <input type="text" placeholder="Enter first name" name="hw_first_name" id="hw_first_name" required><br>
                <label for="hw_last_name">Last Name</label>
                <input type="text" placeholder="Enter last name" name="hw_last_name" id="hw_last_name" required><br>
                <label for="admin_id">Admin ID (1 or blank)</label>
                <input type="text" placeholder="Enter Admin ID" name="admin_id" id="admin_id"><br><br>
            </div>
            <div class="column">
                <label for="ha_id">Health Authority ID</label>
                <input type="text" placeholder="Enter Health Authority ID" name="ha_id" id="ha_id" required><br>
                <label for="h_password">Password</label>
                <input type="password" placeholder="Enter Password" name="h_password" id="h_password" required> <br>
                <label for="h_passwordrepeat">Repeat Password</label>
                <input type="password" placeholder="Repeat Password" name="h_passwordrepeat" id="h_passwordrepeat" required><br>
                <label for="captcha_code">Captcha</label>
                <input name="captcha_code" type="text" placeholder="Enter below image text"><br>
                <label for="captchaimage"></label>
                <img src="db_create/captcha.php" alt="CAPTCHA" name="captchaimage" class="captcha-image"><i class="fas fa-redo refresh-captcha"></i><br><br>
            </div>
        </div>
        <button type="submit" value="Register">Register</button>
        <button type="reset" value="Reset" name="reset">Reset</button>
    </form>
</div>
</section>

<!-- Footer on bottom of page -->
<div class="footer">
    <a href="/Catwoman-IMS/privacy.html">Privacy</a>
    /
    <a href="/Catwoman-IMS/terms_conditions.html">Terms & Conditions</a>
  </div>

</body>

</html>