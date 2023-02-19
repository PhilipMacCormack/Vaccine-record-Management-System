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
    <title>Admin</title>
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

<div class="block">
<h2><b>&emsp;Session Logs</b></h2>

<!-- Create searchbox for searching in the table -->
<form action="/Catwoman-IMS/searchbox_adminhome.php" method="GET">
  <div class="input-group mb-3">
    <input type="text" id="logsearch" name = "logsearch" value="<?php if(isset($_GET['logsearch'])){echo $_GET['logsearch'];}?>" class="form-control" placeholder="Search for Logs">
    <button type="submit" class="btn btn-primary"> Search</button>
</form>
<?php
    include 'db.php';
    if(!$result = mysqli_query($conn, "SELECT * FROM `loginhistory`")) {
        echo "Failed to query database";
    }
    else {

    }
?>

<table class = "styled-table">
    <thead>
            <tr>
                <th>p_number</th>
                <th>employee_id</th>
                <th>Action</th>
                <th>Time</th>
            </tr>
    </thead>
    <tbody>
    <?php
    while($row = mysqli_fetch_row($result)) {
        echo "<tr><td>";
        echo $row[0];
        echo "</td><td>";
        echo $row[1];
        echo "</td><td>";
        echo $row[2];
        echo "</td><td>";
        echo $row[3];
        echo "</td></tr>";
    }
    ?>
    </tbody>
</div>

<!-- Footer on bottom of page -->
<div class="footer">
    <a href="/Catwoman-IMS/privacy.html">Privacy</a>
    /
    <a href="/Catwoman-IMS/terms_conditions.html">Terms & Conditions</a>
  </div>

</body>
</html>