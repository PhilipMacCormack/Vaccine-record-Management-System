   
<?php
session_start();
include 'db.php';

// If the user is not logged in redirect to the login page...
if (empty($_SESSION['hw_loggedin'])) {
    session_destroy();
	header('Location: /Catwoman-IMS/loginpage_worker.html');
	exit;
}

//Fetching data
$batch_no = $_POST['Select'];
$e_num = $_SESSION['employee_id'];


//select query to fetch details
$result = mysqli_query($conn,"SELECT v_name, nplid, batch_no FROM vaccine WHERE batch_no='$batch_no'");
$getProductList = mysqli_fetch_assoc($result);

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

<head>
    <title>Register vaccine</title>
  </head>

<!-- Top navigation bar -->
<body>
<div class="w3-bar w3-black w3-hide-small">
    <a href="/Catwoman-IMS/healthcareworkerhome.php" class="w3-bar-item w3-button w3-left">&emsp;Home&emsp;</a>
    <a href="/Catwoman-IMS/registervaccine.php" class = "w3-bar-item w3-button w3-left">Register vaccine</a>
    <a href="/Catwoman-IMS/worker_patients_page.php" class = "w3-bar-item w3-button w3-left">Patients</a> 
    <a href="/Catwoman-IMS/statisticspage.php" class = "w3-bar-item w3-button w3-left">Statistics</a> 
    <a href="/Catwoman-IMS/worker_logout.php" class = "w3-bar-item w3-button w3-right">Log out</a> 
    <a href="/Catwoman-IMS/workerprofilepage.php" class = "w3-bar-item w3-button w3-right">Profile</a> 
</div>

<!-- UniVaP logo -->
<div class="container">
    <header class="w3-container w3-padding-8 w3-center w3-black" id="home">
        <h1 class="w3-jumbo"><span class="w3-hide-small"></span> UniVaP</h1>
        <p><b>Unified Vaccination Platform</b></p>
    </header>

<?php if (isset($_GET['message'])){?>
  <div class="mailmessage"><center><b><?php echo $_GET['message']; ?></b></center></div>
<?php } ?> 
     

<!-- Register Vaccine form -->
<section class="all-boxes">

<div class = "box">
     <h2>
        <b>Register a new vaccine for a patient</b>
    </h2>

<!--<div class = "row"> -->
    <form action="/Catwoman-IMS/save_vaccine.php" method="post">
        
        <label>Please fill in this form</label><br><br>
        
        <label for="name">Vaccine Name</label>
        <input type="text" placeholder="Vaccine Name" name="v_name" value="<?php echo $getProductList['v_name']?>"><br>
        <label for="name">nplid</label>
        <input type="text" placeholder="Vaccine ID" name="nplid" value="<?php echo $getProductList['nplid']?>"><br>
        <label for="name">Batch Number</label>
        <input type="text" placeholder="Batch number" name ="batch_no" value="<?php echo $getProductList['batch_no']?>"><br>
        <label for="date">Date</label>
        <input type="date" name="date" placeholder="Date" required><br>
        <label for="name">Patient Personal Number</label>
        <input type="text" placeholder="Patient Personal Number" name="p_number" required><br>

        <label for="dose">Dose Number:</label>
            <select type='number' name="dose" id="dose" required>
            
                <option value=1>Dose 1</option>
                <option value=2>Dose 2</option>
                <option value=3>Dose 3</option>
                <option value=4>Dose 4</option>
                
            </select>
        <br>

        <label for="dose">Next Dose</label>
        <input type="number" placeholder="Number of weeks" name = "week" value="" min=0 max = 500><br>
        <!--<input type="submit" value="Submit">&emsp;
        <input type="reset" class="btn btn-secondary ml-2" value="Reset"><br>-->
        
        <button type="submit" value="Log in">Submit</button>
        <button type="reset" class="btn btn-secondary ml-2" value="Reset"  name="reset">Reset</button>
    </form>
</div>
</section>

<!-- Footer on bottom of page -->
<div class="footer">
    <a href="/Catwoman-IMS/privacy.html">Privacy</a>
    /
    <a href="/Catwoman-IMS/terms_conditions.html">Terms & Conditions</a>
  </div>

</body>
</html>