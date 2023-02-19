<?php
session_start();
// If the user is not logged in redirect to the login page...
if (empty($_SESSION['hw_loggedin'])) {
    session_destroy();
	header('Location: /Catwoman-IMS/loginpage_worker.html');
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>


<!-- Top navigation bar -->
<body>
    <div class="w3-bar w3-black w3-hide-small">
      <a href="/Catwoman-IMS/healthcareworkerhome.php" class="w3-bar-item w3-button w3-left">&emsp;Home&emsp;</a>
      <a href="/Catwoman-IMS/registervaccine.php" class = "w3-bar-item w3-button w3-left">Register vaccine</a>
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
</div>

<head>
    <title>All Patients</title>
</head>

<script>
    $(document).ready(function () {
        $('#table_id').DataTable({"pagingType": "full"});
    });
</script>

<!-- Patient table header -->
<div class="block">
<h2><b>Patients </b></h2>
<table id= "table_id" class = "styled-table" style="width:100%">
    <thead>
            <tr>
                <th>Personal Number</th>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Age</th>
                <th>DOB</th>
                <th>Select</th>
            </tr>
    </thead>
    <tbody>
    <?php

    include 'db.php';
    $filtervalues = $_GET['valueToSearch'];
    $query = "SELECT * FROM patient WHERE CONCAT(p_number) LIKE '%$filtervalues%'";
    $query_run = mysqli_query($conn, $query);

    //If the query get any results, print the results in a table, else print No Records Found
    if(mysqli_num_rows($query_run) > 0)
    {
    foreach($query_run as $items)
    {
        ?>
        <tr>
        <?php $pID = $items['p_number']; ?>
        <td><?= $items['p_number']; ?></td>
        <td><?= $items['p_first_name']; ?> <?= $items['p_last_name'] ?></td>
        <td><?= $items['p_email']; ?></td>
        <td><?= $items['p_phonenr']; ?></td>
        <td><?= $items['p_adress']; ?>, <?= $items['p_postcode'] ?> <?= $items['p_city'] ?></td>
        <td><?= $items['age']; ?></td>
        <td><?= $items['dob']; ?></td>
        <td>
            <form action='/Catwoman-IMS/select_patientlist.php?p_number="<?php echo $items["p_number"]; ?>"' method="post">
            <button type="submit" value="<?=$items['batch_no']?>"
            class = "btn" name="Select">
            Select</button>
        </form>
        </td>
        </tr>
        <?php
    }
    }
    else{
        ?><tr><td colspan='4'>";
        No records found </td><tr> <?php
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