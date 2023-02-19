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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

<script type="text/javascript" src=fetchunactivated_user.js></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
  });
</script>
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
        <p><b>Edit Unactivated Users</b></p>
    </header>
</div>

<?php
if ($_SESSION['text']){
    $deleting_text = $_SESSION['text'];
    echo "<p align=center>$deleting_text</p>";
}
    

$sql = "Select distinct p_number from unactivated_user";
$res = mysqli_query($conn, $sql);
unset($_SESSION['text']);
?>




<div class="block">
    Select User :
    
    <select id = "unactivated_user" onchange="selectUser()"> 
            <?php  
            while( $rows = mysqli_fetch_array($res)){
                ?> 
                <option value="<?php echo $rows['p_number'];  ?>"> <?php echo $rows['p_number']; ?>  </option>
            <?php
            }
            ?>
 </select>
        


    <table class = "styled-table">
        <thead>
               <th> Personal number </th>
                <th> First Name </th>
                <th> Last Number </th>
                <th> Phone Number </th>
                <th align="right"> Edit </th>
        </thead>
        <tbody id="ans"> 

        </tbody>
    </table>
</div>



<!-- Footer on bottom of page -->
<div class="footer">
    <a href="/Catwoman-IMS/privacy.html">Privacy</a>
    /
    <a href="/Catwoman-IMS/terms_conditions.html">Terms & Conditions</a>
  </div>


</body>
</html>