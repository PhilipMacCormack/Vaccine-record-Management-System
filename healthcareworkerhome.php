<?php
session_start();
// If the user is not logged in redirect to the login page...
if (empty($_SESSION['hw_loggedin'])) {
    session_destroy();
	header('Location: /Catwoman-IMS/loginpage_worker.html');
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
  <title>Home page authenticated user</title>
</head>

<!-- Top navigation bar -->
<body>
  <div class="w3-bar w3-black w3-hide-small">
    <a href="/Catwoman-IMS/healthcareworkerhome.php" class="w3-bar-item w3-button w3-left">&emsp;Home&emsp;</a>
    <a href="/Catwoman-IMS/registervaccine.php" class = "w3-bar-item w3-button w3-left">Register vaccine</a>
    <a href="/Catwoman-IMS/worker_patients_page.php" class = "w3-bar-item w3-button w3-left">Patients</a> 
    <a href="/Catwoman-IMS/statisticspage.php" class = "w3-bar-item w3-button w3-left">Statistics</a> 
    <a href="/Catwoman-IMS/worker_logout.php" class = "w3-bar-item w3-button w3-right">Log out</a> 
    <a href="/Catwoman-IMS/workerprofilepage.php" class = "w3-bar-item w3-button w3-right">Profile</a> 
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
    $value = $_SESSION['employee_id'];    
    include 'db.php';
    if(!$result = mysqli_query($conn, "SELECT hw_first_name FROM healthcare_worker WHERE employee_id = $value")) {
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


    <!--Patient & Statistics page-->
    <section class="all-boxes">

      <!--Patient-->
      <div class="box">
        <h2>
          <b>Do you need information about a patient?</b>
        </h2>
        <form action="/Catwoman-IMS/worker_patients_page.php" method="post" id='form'>
          <button type="submit">Go to Patients</button>
        </form>
      </div>

      <!--Statistics page-->
      <div class="box">
        <h2>
          <b>See statistics on vaccination data</b>
        </h2>
        <form action="/Catwoman-IMS/statisticspage.php" method="post" id='form'>
          <button type="submit">Go to Statistics</button>
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