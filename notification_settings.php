<?php
session_start();
// If the user is not logged in redirect to the login page...
if (empty($_SESSION['p_loggedin'])) {
    session_destroy();
	header('Location: /Catwoman-IMS/loginpage_patient.html');
	exit;
}
?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./style.css">

<!-- Top navigation bar -->
    <div class="w3-bar w3-black w3-hide-small">
        <a href="/Catwoman-IMS/patienthome.php" class="w3-bar-item w3-button w3-left">&emsp;Home&emsp;</a>
        <a href="/Catwoman-IMS/patient_vaccinations.php" class = "w3-bar-item w3-button w3-left">My vaccinations</a>
        <a href="/Catwoman-IMS/index.html" class = "w3-bar-item w3-button w3-right">Log out</a> 
        <a href="/Catwoman-IMS/patient_profile_page.php" class = "w3-bar-item w3-button w3-right">Profile</a> 
    </div>

<!-- UniVaP logo -->
    <div class="container">
        <header class="w3-container w3-padding-8 w3-center w3-black" id="home">
            <h1 class="w3-jumbo"><span class="w3-hide-small"></span> UniVaP</h1>
            <p><b>Unified Vaccination Platform</b></p>
        </header>
    </div>

<section class="all-boxes">
    <div class = "box">
        <h2>
            <b>Notification Settings</b>
        </h2>
        &emsp;&emsp;<u>Vaccine:</u> <i><?php echo $_GET['vaccine_name']  ?></i> <br>&emsp;&emsp;<u>Planned Vaccination Date:</u> <i><?php echo $_GET['vac_date'] ?></i> <br>&emsp;&emsp;<u>Current Reminder Date:</u> <i><?php echo $_GET['rem_date'] ?></i><br><br>
        <form action="/Catwoman-IMS/save_notification.php" method="post">
            <label>Change reminder date:</label>
            <input type="datetime-local" name="rem_date" id="rem_date" required><br><br>
            <input type="hidden" name="report_id" value=<?php echo $_GET['report_id'] ?>>
            <button type="submit" value="save">Save</button>
            <br><br>  
        </form>
    </div>
</section>

<!-- Footer on bottom of page -->
<div class="footer">
    <a href="/Catwoman-IMS/privacy.html">Privacy</a>
    /
    <a href="/Catwoman-IMS/terms_conditions.html">Terms & Conditions</a>
</div>

</html>