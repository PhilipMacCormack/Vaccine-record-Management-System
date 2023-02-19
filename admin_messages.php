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

<?php if (isset($_GET['message'])){?>
  <div class="mailmessage"><center><b><?php echo $_GET['message']; ?></b></center></div>
<?php } ?>


<div class="block">
<h2><b>&emsp;Messages</b></h2>

<!-- Create searchbox for searching in the table -->
<form action="/Catwoman-IMS/searchbox_admin_messages.php" method="GET">
  <div class="input-group mb-3">
    <input type="text" id="messagesearch" name = "messagesearch" value="<?php if(isset($_GET['messagesearch'])){echo $_GET['messagesearch'];}?>" class="form-control" placeholder="Search">
    <button type="submit" class="btn btn-primary"> Search</button>
</form>

<label for="table"></label>
<table class = "styled-table">
    <thead>
            <tr>
                <th>From</th>
                <th>Subject</th>
                <th>Recieved</th>
                <th>Status</th>
            </tr>
    </thead>
    <tbody>
</div>

<?php
$query = "SELECT * FROM messages";
$query_run=mysqli_query($conn, $query);
if(mysqli_num_rows($query_run) > 0)
{
    foreach($query_run as $items)
    {
        $answer_link = 'http://localhost/Catwoman-IMS/answer_support.php?message_id='.$items['message_id'];
        //$answer_link = 'http://localhost/Catwoman-IMS/answer_support.php?message_id='.$items['message_id'];
        echo'<tr>';
            echo'<td>'.$items['support_email'].'</td>';
            echo '<td><a href="'.$answer_link.'">'.$items['subject'].'</a></td>';
            echo'<td>'.$items['message_time'].'</td>';
            echo'<td>'.$items['status'].'</td>';
        echo'</tr>';
    }
}

?>

<!-- Footer on bottom of page -->
<div class="footer">
    <a href="/Catwoman-IMS/privacy.html">Privacy</a>
    /
    <a href="/Catwoman-IMS/terms_conditions.html">Terms & Conditions</a>
  </div>

</body>
</html>