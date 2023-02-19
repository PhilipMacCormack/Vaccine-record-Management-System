<?php

session_start();
require 'db.php';

// If the user is not logged in redirect to the login page...
if (empty($_SESSION['admin'])) {
    session_destroy();
	header('Location: /Catwoman-IMS/loginpage_worker.html');
	exit;
}

//Fetching employee details
$e_num = $_SESSION['employee_id'];

if($stmt=$conn->prepare("SELECT employee_id, hw_first_name, hw_last_name, ha_id FROM healthcare_worker WHERE employee_id=?")){
    $stmt->bind_param('i', $e_num);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_array(MYSQLI_NUM)){
        $ha_id  = $row[3];
        $first_name = $row[1];
        $last_name = $row[2];
    }
}

if($stmt=$conn->prepare("SELECT ha_id, ha_name, ha_email, ha_phonenr, ha_adress FROM health_authority WHERE ha_id=?")){
    $stmt->bind_param('i', $ha_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_array(MYSQLI_NUM)){
        $ha_name = $row[1];
        $ha_email = $row[2];
        $ha_phonenr = $row[3];
        $ha_adress = $row[4];
    }
}

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
      <h1 class="w3-jumbo">UniVaP</h1>
      <p><b>Admin Tool</b></p>
    </header>
  </div>

  <!-- admin profile -->
  <section class="all-boxes">

  <div class="box">
        <h2>
            <b>User Information</b>
        </h2>

    <form action="/Catwoman-IMS/profile.php">

        <label>Employee ID</label>
        <input type="text" placeholder="Employee ID" value="<?php echo $e_num ?>" required readonly><br>
        
        <label>First Name</label>
        <input type="text" placeholder="First Name" value="<?php echo $first_name ?>" required readonly><br>

        <label>Last Name</label>
        <input type="text" placeholder="Last Name" value="<?php echo $last_name?>" required readonly><br><br>
        <h2>
            <b>Health authority</b>
        </h2>

        <label>Organization ID</label>
        <input type="text" placeholder="Organization ID" value="<?php echo $ha_id?>" required readonly><br>

        <label>Organization Name</label>
        <input type="text" placeholder="Organization Name" value="<?php echo $ha_name?>" required readonly><br>

        <label>Email</label>
        <input type="text" placeholder="Email" value="<?php echo $ha_email?>" required readonly><br>

        <label>Phone number</label>
        <input type="text" placeholder="Phone number"  value="<?php echo $ha_phonenr?>" required readonly><br>

        <label>Address</label>
        <input type="text" placeholder="Address"  value="<?php echo $ha_adress?>" required readonly><br>
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