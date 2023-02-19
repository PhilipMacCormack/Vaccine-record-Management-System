
<?php
session_start();
require 'db.php';

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
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./style.css">

<head>
  <title>Profile page</title>
</head>

<!-- Top navigation bar -->
<body>
  <div class="w3-bar w3-black w3-hide-small">
    <a href="/Catwoman-IMS/patienthome.php" class="w3-bar-item w3-button w3-left">&emsp;Home&emsp;</a>
    <a href="/Catwoman-IMS/patient_vaccinations.php" class = "w3-bar-item w3-button w3-left">My vaccinations</a>
    <a href="/Catwoman-IMS/patient_logout.php" class = "w3-bar-item w3-button w3-right">Log out</a> 
    <a href="/Catwoman-IMS/patient_profile_page.php" class = "w3-bar-item w3-button w3-right">Profile</a> 
  </div>

<!-- UniVaP logo -->
  <div class="container">
    <header class="w3-container w3-padding-8 w3-center w3-black" id="home">
      <h1 class="w3-jumbo">UniVaP</h1>
      <p><b>Unified Vaccination Platform</b></p>
    </header>
  </div>

<?php if (isset($_GET['message'])){?>
  <div class="mailmessage"><center><b><?php echo $_GET['message']; ?></b></center></div>
<?php } ?>

<!-- Code to fetch data from table -->
  <?php
  $p_num = $_SESSION['p_number'];
  $result = mysqli_query($conn,"select p_number, p_first_name, p_last_name, p_adress, p_email, p_phonenr from patient where p_number=$p_num");
  $getProductList = mysqli_fetch_assoc($result);
  $result2 = mysqli_query($conn,"select p_password from p_login where p_number=$p_num");
  $getPassword = mysqli_fetch_assoc($result2);
  ?>

<!-- Code to show patient details -->
<section class="all-boxes">

    <div class = "box">
         <h2>
            <b>User Settings</b>
        </h2>

    <form action="/Catwoman-IMS/profile.php"  method ="post">
        <h3>
            <b>Your personal details</b>
        </h3>

        <label>Social Security Number</label>
        <input type="text" placeholder="Personal Number" value="<?php echo $getProductList['p_number']?>" required readonly><br>

        <label>First Name</label>
        <input type="text" id ="name" placeholder="Name" value="<?php echo $getProductList['p_first_name']?>" required readonly><br>

        <label>Last Name</label>
        <input type="text" placeholder="Name" value="<?php echo $getProductList['p_last_name']?>" required readonly><br>

        <label>Address</label>
        <input type="text" placeholder="Address" value="<?php echo $getProductList['p_adress']?>" required readonly><br>

        <label for="email">Email address</label>
        <input type="email" id= "email" name="email" placeholder="Email" value="<?php echo $getProductList['p_email']?>" required>

        <button type="button" onclick="myFunctionEmail()" value="Reset">Reset</button><br><br>
        
        <label for="phone">Phone number</label>
        <input type="text" pattern="^\d{10}$" id= "phone" name="phone" placeholder="07X-XXXXXXX" value="<?php echo $getProductList['p_phonenr']?>" required>

        <button type="button" onclick="myFunctionPhone()" value="Reset">Reset</button><br><br>

        <label for="notifications">Toggle ON/OFF all notifications</label>
        <input type="checkbox" id="notifications" name="notifications" checked><br>

        <button type="submit" value="Save">Save</button>

        <script>
          function myFunctionEmail() {
            document.getElementById("email").value="";
          }
        </script> 

        <script>
          function myFunctionPhone() {
            document.getElementById("phone").value="";
          }
        </script>  
      

    </form>
    
    <form action="/Catwoman-IMS/patient_profile_password.php"  method ="post">
        <h3>
            <b>Password settings</b>
        </h3>
        
        <label for="current_password">Change password</label><br>

        <input type="password" id= "current_password" name="current_password" placeholder="Current Password" required><br>
        <input type="password" id= "new_password" name="new_password" placeholder="New Password" required><br>
        <input type="password" id= "confirm_password" name="confirm_password" placeholder="Confirm New Password" required><br>

        <button type="submit" value="Save">Save</button>

    </form>
   
    

  </div>
  

<!-- Footer on bottom of page -->
  <div class="footer">
    <a href="/Catwoman-IMS/privacy.html">Privacy</a>
    /
    <a href="/Catwoman-IMS/terms_conditions.html">Terms & Conditions</a>
  </div>

</body>
</html>

