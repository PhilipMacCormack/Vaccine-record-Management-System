<?php
session_start();
// If the user is not logged in redirect to the login page...
if (empty($_SESSION['p_loggedin'])) {
    session_destroy();
	header('Location: /Catwoman-IMS/loginpage_patient.html');
	exit;
}
?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./style.css">

<!-- Top navigation bar -->
    <div class="w3-bar w3-black w3-hide-small">
        <a href="/Catwoman-IMS/patienthome.php" class="w3-bar-item w3-button w3-left">&emsp;Home&emsp;</a>
        <a href="/Catwoman-IMS/patient_vaccinations.php" class = "w3-bar-item w3-button w3-left">My vaccinations</a>
        <a href="/Catwoman-IMS/patient_logout.php" class = "w3-bar-item w3-button w3-right">Log out</a> 
        <a href="/Catwoman-IMS/patient_profile_page.php" class = "w3-bar-item w3-button w3-right">Profile</a> 
    </div>

<!-- UniVaP logo -->
    <div class="container">
        <header class="w3-container w3-padding-8 w3-center w3-black" id="home">
            <h1 class="w3-jumbo"><span class="w3-hide-small"></span> UniVaP</h1>
            <p><b>Unified Vaccination Platform</b></p>
        </header>
    </div>

<!-- Table 1 -->
<?php if (isset($_GET['message'])){?>
  <div class="mailmessage"><center><b><?php echo $_GET['message']; ?></b></center></div>
<?php } 
?>
        <div class="block">
            <h2><b>&emsp;Your upcoming vaccinations</b></h2>
            <table class="styled-table">
                <thead>
                    <tr>
                    <th>Vaccine name</th>
                    <th>Dose number</th>
                    <th>Planned Vaccination date</th>
                    <th>Reminder Date</th>
                    <th>Toggle reminder</th>
                    </tr>
            </thead>        

<style>
    .btn2{
        width:30px;
    }
    .btn3{
        width: 50px;
    }
</style>

<?php
include 'db.php';


$p_number = $_SESSION['p_number'];

$query = "SELECT * FROM notification WHERE p_number=$p_number";
$query_run=mysqli_query($conn, $query);
if(mysqli_num_rows($query_run) > 0)
{
    foreach($query_run as $items)
    {
        if ($items['active']==1){
            $items['active']='ON';
        }
        else{
            $items['active']='OFF';
        }
        echo'<tr>';
            echo'<td>'.$items['vaccine_name'].'</td>';
            echo '<td>'.$items['dose'].'</td>';
            echo'<td>'.$items['vac_date'].'</td>';
            echo'<td>'.$items['rem_date'].'&emsp; <a href="notification_settings.php?report_id='.$items['report_id'].'&vaccine_name='.$items['vaccine_name'].'&vac_date='.$items['vac_date'].'&rem_date='.$items['rem_date'].'"><button class="btn2"><i class="fa fa-bell"></i></button></a></td>';
            echo'<td> &emsp;&emsp;<a href="toggle_one_reminder.php?report_id='.$items['report_id'].'"><button class="btn3">'.$items['active'].'</button></a></td>'; 
        echo'</tr>';
    }
}
?>
            </table>  
        </div>

<!-- Table 2 -->
    <div class="block">
        <h2><b>&emsp;Your vaccine history</b></h2>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Vaccine name</th>
                    <th>Dose number</th>
                    <th>Batch number</th>
                    <th>Date</th>
                </tr>
            </thead>       

<?php
include 'db.php';
$query = mysqli_query($conn, "SELECT * FROM report WHERE p_number=$p_number");
if(mysqli_num_rows($query) > 0){
    foreach($query as $row){
            echo'<tr>';
                echo'<td>'.$row['v_name'].'</td>';
                echo '<td>'.$row['dose'].'</td>';
                echo'<td>'.$row['batch_no'].'</td>';
                echo'<td>'.$row['date'].'</td>';
            echo'</tr>';
    }
}
?>
        </table>  
    </div> 

<!-- Footer on bottom of page -->
<div class="footer">
    <a href="/Catwoman-IMS/privacy.html">Privacy</a>
    /
    <a href="/Catwoman-IMS/terms_conditions.html">Terms & Conditions</a>
</div>

</html>