<?php
session_start();

// Create connection
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "univapdb";
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


// If the user is not logged in redirect to the login page...
if (empty($_SESSION['hw_loggedin'])) {
    session_destroy();
	header('Location: /Catwoman-IMS/loginpage_worker.html');
	exit;
}



?>

<!-- HTML part starts -->
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./style.css">

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<head>
    <title>Register vaccine</title>

    <script>
        $(document).ready(function () {
            var tab = $('#example').DataTable();
            $('#example tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');

                }
                else {
                    tab.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }

                
            });
                    var Row = document.getElementById("row");
                    var Cells = Row.getElementsByTagName("td");
                    var vaccine_name=Cells[0].innerText;
                    

                   
            });

            
    </script> 

    <script>
    </script>   

      
    
  
</head>

<!-- Top navigation bar -->
<body>
<div class="w3-bar w3-black w3-hide-small">
    <a href="/Catwoman-IMS/healthcareworkerhome.php" class="w3-bar-item w3-button w3-left">&emsp;Home&emsp;</a>
    <!--<a href="/Catwoman-IMS/registervaccine.php" class = "w3-bar-item w3-button w3-left">Register vaccine</a>-->
    <a href="/Catwoman-IMS/worker_patients_page.php" class = "w3-bar-item w3-button w3-left">Patients</a> 
    <a href="/Catwoman-IMS/statisticspage.php" class = "w3-bar-item w3-button w3-left">Statistics</a> 
    <a href="#search" class="w3-bar-item w3-button w3-right"><i class="fa fa-search"></i></a>
    <a href="/Catwoman-IMS/worker_logout.php" class = "w3-bar-item w3-button w3-right">Log out</a> 
    <a href="/Catwoman-IMS/workerprofilepage.php" class = "w3-bar-item w3-button w3-right">Profile</a> 
</div>

<!-- UniVaP logo -->
<div class="container">
    <header class="w3-container w3-padding-8 w3-center w3-black" id="home">
        <h1 class="w3-jumbo"><span class="w3-hide-small"></span> UniVaP</h1>
        <p><b>Uniform Vaccination Platform</b></p>
    </header>


<!-- Design for search result page -->
<div class= "block">
    <form action="/Catwoman-IMS/registervaccine.php"  method ="post">
        &emsp;<input type="text" id="vacName" name="vacName" placeholder="Vaccine name" required readonly>
        &emsp;<input type="text" id="vacID" name="vacID" placeholder="Vaccine ID" required readonly>
        &emsp;<input type="text" id="batchNo" name="batchNo" placeholder="Batch No" required readonly>
        
        &emsp;<input type="submit" value="Back">
</div>

<div class = "block">
<br><h3><b>Search Results</b></h3>
<p>Select vaccine from the below table and click on "Back" button to register that vaccine.</p>

<table id= "example" class="styled-table" style="width:100%">
            <thead>
                <tr>
                    <th>Vaccine Name</th>
                    <th>Vaccine ID </th>
                    <th>Batch Number</th>
                    <th>Expiry Date</th>
                    <th>Select</th>
                </tr>
            </thead>
            <tbody>
                            
                <?php 
                    //require "db.php";
                    //If you search for something go into if statement
                    if(isset($_GET['valueToSearch']))
                    {
                    // Create a variable for the search input
                    $filtervalues = $_GET['valueToSearch'];

                    //Query everything in the table where anything matches the search input (could change to only mname in concat)
                    $query = "SELECT * FROM vaccine WHERE CONCAT(v_name) LIKE '%$filtervalues%' ";
                    $query_run = mysqli_query($conn, $query);

                    //If the query get any results, print the results in a table, else print No Records Found
                    if(mysqli_num_rows($query_run) > 0)
                    {
                    foreach($query_run as $items)
                       {
                ?>
                <tr id= "row">
                    <td><?= $items['v_name']; ?></td>
                    <td><?= $items['nplid']; ?></td>
                    <td><?= $items['batch_no']; ?></td>
                    <td><?= $items['expires']; ?></td>
                    <td><input type="button" value="Select" onclick="show(this)"></td>
                </tr>
                
                <?php
                    }
                    }
                    else
                        {
                ?>
                    <tr>
                        <td colspan="4">No records found for: <?php echo $filtervalues?></td>
                    </tr>
                <?php
                        }
                    }
                ?>
            </tbody>
        </table>
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