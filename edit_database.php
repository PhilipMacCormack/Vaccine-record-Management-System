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
<script type="text/javascript" src=fetchtables.js></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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
<h2><b>&emsp;Database</b></h2>
<table class = "styled-table">
    <thead>
            <tr>
                <th>Table</th>
                <th>Number of entries</th>
                <th align="right">Edit</th> 
            </tr>
    </thead>
    <tbody>

<?php
    
    $sql = "show tables from univapdb";  
    $result = mysqli_query($conn, $sql);
    if ($result){
        while($table=mysqli_fetch_array($result))
        {
            ?>
              <tr>
                    <td><?php echo $table[0]; ?></td>
                    <?php 
                        $query = "SELECT * FROM $table[0]";
                        $stmt = mysqli_query($conn, $query);
                        $count = mysqli_num_rows($stmt);
                    ?>
                    <td><?php echo $count; ?></td>  
                    <td >
                        <!-- Adding edit button for each table -->
                        <?php
                        $table_to_edit = "edit_".$table[0]. ".php";
                        ?>
                        <form action='<?php echo $table_to_edit; ?>'>
                        <button 
                        style = "background-color:yellow;border-color:black; float:right"
                        class = "btn"><i class="fa fa-edit"></i
                        > Edit</button>

                        </form>
                    </td>

                </tr>
                <?php
        }
    }
?>
 
 
 
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