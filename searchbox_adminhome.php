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
  <title>Search results</title>
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

<!-- Design for search result page -->
<div class = "block">
<br><h2><b>&emsp;Session Logs: Search Results</b></h2>
<table class="styled-table">
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
                                    require "db.php";
                                    //If you search for something go into if statement
                                    if(isset($_GET['logsearch']))
                                    {
                                        // Create a variable for the search input
                                        $logfiltervalues = $_GET['logsearch'];

                                        //Query everything in the table where anything matches the search input (could choose attribute to search for in concat)
                                        $query = "SELECT * FROM loginhistory WHERE CONCAT(COALESCE(`p_number`, ''), '-', COALESCE(`employee_id`, ''), '-',action, '-',time) LIKE '%$logfiltervalues%'";
                                        //$query = "SELECT * FROM loginhistory";
                                        $query_run = mysqli_query($conn, $query);

                                        //If the query get any results, print the results in a table, else print No Records Found
                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $items)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?= $items['p_number']; ?></td>
                                                    <td><?= $items['employee_id'];?></td>
                                                    <td><?= $items['action']; ?></td>
                                                    <td><?= $items['time']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                <tr>
                                                    <td colspan="4">No records found for search: <?php echo $logfiltervalues?></td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Footer on bottom of page -->
<div class="footer">
    <a href="/Catwoman-IMS/privacy.html">Privacy</a>
    /
    <a href="/Catwoman-IMS/terms_conditions.html">Terms & Conditions</a>
  </div>

</body>
</html>