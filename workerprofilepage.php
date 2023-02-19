<?php

session_start();
include "db.php";

// If the user is not logged in redirect to the login page...
if (empty($_SESSION['hw_loggedin'])) {
    session_destroy();
	header('Location: /Catwoman-IMS/loginpage_worker.html');
	exit;
}

//Fetching employee details
$e_num = $_SESSION['employee_id'];

$query ="SELECT employee_id, hw_first_name, hw_last_name, ha_id FROM healthcare_worker WHERE employee_id=$e_num";
$result = mysqli_query($conn, $query);
$row=mysqli_fetch_row($result);
$health_id=$row[3];

$query1 ="SELECT ha_id, ha_name, ha_email, ha_phonenr, ha_adress FROM health_authority WHERE ha_id=$health_id";
$res_query1= mysqli_query($conn, $query1);
$row1=mysqli_fetch_row($res_query1);

?>

<!-- HTML part Starts -->
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./style.css">

<head>
  <title>Profile page</title>
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
      <h1 class="w3-jumbo">UniVaP</h1>
      <p><b>Unified Vaccination Platform</b></p>
    </header>
  </div>

<!-- profile page -->
<section class="all-boxes">

    <div class="box">
      <h2>
          <b>User Information</b>
      </h2>
    <form action="/Catwoman-IMS/profile.php">
        <label>Employee ID</label>
        <input type="text" placeholder="Employee ID" value="<?php echo $row[0]?>" required readonly><br>
        <label>First Name</label>
        <input type="text" placeholder="First Name" value="<?php echo $row[1]?>" required readonly><br>
        <label>Last Name</label>
        <input type="text" placeholder="Last Name" value="<?php echo $row[2]?>" required readonly><br>

      <h2>
          <b>Health authority</b>
      </h2>
        <label>Organization ID</label>
        <input type="text" placeholder="Organization ID" value="<?php echo $row1[0]?>" required readonly><br>
        <label>Organization Name</label>
        <input type="text" placeholder="Organization Name" value="<?php echo $row1[1]?>" required readonly><br>
        <label>Email</label>
        <input type="text" placeholder="Email" value="<?php echo $row1[2]?>" required readonly><br>
        <label>Phone number</label>
        <input type="text" placeholder="Phone number"  value="<?php echo $row1[3]?>" required readonly><br>
        <label>Address</label>
        <input type="text" placeholder="Address"  value="<?php echo $row1[4]?>" required readonly><br>
    </form>

    <form action="/Catwoman-IMS/worker_profile_password.php"  method ="post">
        <h3>
            <b>Password settings</b>
        </h3>
        
        <label for="current_password">Change password</label><br>

        <input type="password" id= "current_password" name="current_password" placeholder="Current Password" required><br>
        <input type="password" id= "new_password" name="new_password" placeholder="New Password" required><br>
        <input type="password" id= "confirm_password" name="confirm_password" placeholder="Confirm New Password" required><br>

        <button type="submit" value="Save">Save</button>

    </form>
   
</div>

<!-- Footer on bottom of page -->
  <div class="footer">
    <a href="/Catwoman-IMS/privacy.html">Privacy</a>
    /
    <a href="/Catwoman-IMS/terms_conditions.html">Terms & Conditions</a>
  </div>

</body>
</html>