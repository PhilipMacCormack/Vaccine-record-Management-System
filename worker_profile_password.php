<?php
session_start();
include 'db.php';



// If the user is not logged in redirect to the login page...
if (empty($_SESSION['hw_loggedin'])) {
     session_destroy();
   header('Location: /Catwoman-IMS/loginpage_worker.html');
	exit;
}

// Fetching data
$e_number = $_SESSION['employee_id'];


// Fetching data pwd
$current_password = $_REQUEST["current_password"];
$newpassword = $_REQUEST["new_password"];
$confirmpassword = $_REQUEST["confirm_password"];

//Update pwd
$query = "SELECT * FROM h_login where employee_id=$e_number";
$query_run=mysqli_query($conn, $query);
if(mysqli_num_rows($query_run) > 0)
{
    foreach($query_run as $items){
      if (password_verify($current_password, $items['h_password'])) {
        if ($newpassword == $confirmpassword){
          $newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
          $sql2 = "update h_login set h_password='" .$newpassword."' where employee_id=$e_number";
          if (mysqli_query($conn,$sql2)){
            $message = 'Password updated successfully';
          }
        }
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
    <title>Edit profile</title>
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
        <p><b>Uniform Vaccination Platform</b></p>
    </header>
</div>

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