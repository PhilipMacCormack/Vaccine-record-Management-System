<?php
session_start();
//If the user is not logged in redirect to the login page...
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

<head>
    <title>Home page patient</title>
</head>

<!-- Top navigation bar -->
<body>
    <div class="w3-bar w3-black w3-hide-small">
        <a href="/Catwoman-IMS/patienthome.php" class="w3-bar-item w3-button w3-left">&emsp;Home&emsp;</a>
        <a href="/Catwoman-IMS/patient_vaccinations.php" class = "w3-bar-item w3-button w3-left">My vaccinations</a>
        <a href="/Catwoman-IMS/patient_logout.php" class = "w3-bar-item w3-button w3-right">Log out</a> 
        <a href="/Catwoman-IMS/patient_profile_page.php" class = "w3-bar-item w3-button w3-right">Profile</a> 
    </div>
    
<!-- UniVaP logo -->
<div class="container">
    <header class="w3-container w3-padding-8 w3-center w3-black" id="home">
        <h1 class="w3-jumbo"><span class="w3-hide-small"></span> UniVaP</h1>
        <p><b>Unified Vaccination Platform</b></p>
    </header>
</div>

<!--Welcome message-->
<div class="welcome">
<?php
    $value = $_SESSION['p_number'];    
    include 'db.php';
    if(!$result = mysqli_query($conn, "SELECT p_first_name FROM patient WHERE p_number = $value")) {
        echo "Failed to query database";
    }
    else {
        $row = mysqli_fetch_row($result);
        echo "<h2>";
        echo "Welcome,&nbsp";
        echo $row[0]; //first name
        echo "!";
        echo "</h2>";
    }
?>
</div>

    <!--My vaccinations & Profile page-->
    <section class="all-boxes">

      <!--Vaccinations-->
      <div class="box">
        <h2>
          <b>Vaccinations</b>
        </h2>
        <p>Here you can see your upcoming vaccinations, turn on/off notifications and also see all your vaccination history.</p><br>
        <form action="/Catwoman-IMS/patient_vaccinations.php" method="post" id='form'>
          <button type="submit">Go to My vaccinations</button>
        </form>
      </div>

      <!--Profile page-->
      <div class="box">
        <h2>
          <b>Profile page</b>
        </h2>
        <p>On this page you can see your user settings. It is possible to change your email & address and you can also set a new password.</p><br>
        <form action="/Catwoman-IMS/patient_profile_page.php" method="post" id='form'>
          <button type="submit">Go to Profile</button>
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