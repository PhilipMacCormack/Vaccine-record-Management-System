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


<div class="block2">
<h2><b>&emsp;Messages</b></h2>

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

<?php
$message_id = $_GET['message_id'];
$query = "SELECT * FROM messages WHERE message_id = $message_id";
$query_run=mysqli_query($conn, $query);
if(mysqli_num_rows($query_run) > 0)
{
    foreach($query_run as $items)
    {
    $message = $items['message'];
    $subject = $items['subject'];
    echo'<tr>';
        echo'<td>'.$items['support_email'].'</td>';
        echo'<td>'.$items['subject'].'</td>';
        echo'<td>'.$items['message_time'].'</td>';
        echo'<td>'.$items['status'].'</td>';
    echo'</tr>';
    echo'</table>';
    ?>
        <label for="message">Message:</label><br>
        <div class="textarea" role="textbox"><?php echo $message; ?></div><br><br>
        

        <form action="/Catwoman-IMS/answer_submit.php" method="post">
          <label for="answer">Answer:</label><br>
          <textarea name="answer" id="answer" required></textarea><br>
          <input type="hidden" name="support_email" id="support_email" value= <?php echo $items['support_email']; ?>>
          <input type="hidden" name="subject" id = "subject" value= '<?php echo $subject; ?>'>
          <input type="hidden" name="message_id" id= "message_id" value= <?php echo $items['message_id']; ?>>
          <button type="submit">Send</button>
        </form>
    <?php
    }
}
else{
    echo'no records found';
}
?>
</div>
<!-- Footer on bottom of page -->
<div class="footer">
    <a href="/Catwoman-IMS/privacy.html">Privacy</a>
    /
    <a href="/Catwoman-IMS/terms_conditions.html">Terms & Conditions</a>
  </div>

</body>
</html>