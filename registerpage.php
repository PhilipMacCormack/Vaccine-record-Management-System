<?php
session_start();
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
    <title>Register new account</title>
</head>


<!-- Top navigation bar -->
<body>
    <div class="w3-bar w3-black w3-hide-small">
      <a href="/Catwoman-IMS/index.html" class="w3-bar-item w3-button w3-left">&emsp;Home&emsp;</a>
      <a href="/Catwoman-IMS/contactpage.php" class="w3-bar-item w3-button w3-left">&emsp;Contact&emsp;</a>
      <a href="/Catwoman-IMS/about.html" class="w3-bar-item w3-button w3-left">&emsp;About&emsp;</a>
      <a href="/Catwoman-IMS/loginpage_patient.html" class = "w3-bar-item w3-button w3-right">Patient Log in</a>
      <a href="/Catwoman-IMS/loginpage_worker.html" class = "w3-bar-item w3-button w3-right">Authenticated Log in</a> 
    </div>
  

<!-- UniVaP logo -->
<div class="container">
    <header class="w3-container w3-padding-8 w3-center w3-black" id="home">
        <h1 class="w3-jumbo"><span class="w3-hide-small"></span> UniVaP</h1>
        <p><b>Unified Vaccination Platform</b></p>
    </header>
</div>

<style>
    [type='resetbtn']{
        width: 25%;
        background-color: whitesmoke;
         color: black;
         padding: 14px 20px;
         margin: 8px 0;
         border: 1px solid rgb(104, 104, 104);
         border-radius: 20px;
         cursor: pointer;
    }
</style>

<!-- register box -->
<section class="all-boxes">

<div class = "box_register">
     <h1>
        <b>Register</b>
    </h1>

    <form action="/Catwoman-IMS/registerpatient.php" method="post">
        <p><u><font color="red"><?php echo $_GET['error']; ?></font></u> <i><?php echo $_GET['message']; ?></i></p>
        <label>Please fill in this form to create an account</label><br><br>
        <div class="row">
            <div class="column">           
                <label for="p_number">Personal number</label>
                <input type="text" placeholder="YYYYMMDDXXXX" name="p_number" id="p_number" value="<?php if(isset($_SESSION['p_number'])){ echo $_SESSION['p_number'];}?>" required><br>
                <label for="p_first_name">First Name</label>
                <input type="text" placeholder="Enter first name" name="p_first_name" id="p_first_name" value="<?php if(isset($_SESSION['p_first_name'])){ echo $_SESSION['p_first_name'];}?>" required><br>
                <label for="p_last_name">Last Name</label>
                <input type="text" placeholder="Enter last name" name="p_last_name" id="p_last_name" value="<?php if(isset($_SESSION['p_last_name'])){ echo $_SESSION['p_last_name'];}?>" required> <br>
                <label for="p_adress">Address</label>
                <input type="text" placeholder="Enter Address" name="p_adress" id="p_adress" value="<?php if(isset($_SESSION['p_adress'])){ echo $_SESSION['p_adress'];}?>" required> <br>
                <label for="p_city">City </label>
                <input type="text" placeholder="Enter City" name="p_city" id="p_city" value="<?php if(isset($_SESSION['p_city'])){ echo $_SESSION['p_city'];}?>" required> <br>
                <label for="p_postcode">Postal Code </label>
                <input type="text" placeholder="Enter Postal Code" name="p_postcode" id="p_postcode" value="<?php if(isset($_SESSION['p_postcode'])){ echo $_SESSION['p_postcode'];}?>" required> <br>
                <label>By creating an account you agree to our<br><a href="policy.html">Terms & Conditions</a></label><br><br>
            </div>
            <div class="column">
                <label for="p_email">Email </label>
                <input type="text" placeholder="Enter Email" name="p_email" id="p_email" value="<?php if(isset($_SESSION['p_email'])){ echo $_SESSION['p_email'];}?>" required> <br>
                <label for="p_phonenr">Phone Number </label>
                <input type="text" placeholder="07XXXXXXXX" name="p_phonenr" id="p_phonenr" value="<?php if(isset($_SESSION['p_phonenr'])){ echo $_SESSION['p_phonenr'];}?>" required><br>
                <label for="dob">Date of Birth</label>
                <input type="date" name="dob" id="dob" value="<?php if(isset($_SESSION['dob'])){ echo $_SESSION['dob'];}?>" required> <br>
                <label for="p_password">Password </label>
                <input type="password" placeholder="Enter Password" name="p_password" id="p_password" required> <br>
                <label for="passwordrepeat">Repeat Password</label>
                <input type="password" placeholder="Repeat Password" name="passwordrepeat" id="passwordrepeat" required><br>
                <label for="captcha_code">Verify that you're not a robot</label>
                <input name="captcha_code" type="text" placeholder="Enter the text in the image below"><br>
                <label for="captchaimage"></label>
                <img src="db_create/captcha.php" alt="CAPTCHA" name="captchaimage" class="captcha-image"><i class="fas fa-redo refresh-captcha"></i><br><br>

            </div>
        </div>
        <button type="submit" value="Register">Register</button>
        <button type="resetbtn" onclick="this.form.querySelectorAll('input[type=text]').forEach(function(input,i){input.value='';})" id="reset" name="reset">Reset</button>
    </form>
</div>
</section>

<!-- Footer on bottom of page -->
<div class="footer">
    <a href="/Catwoman-IMS/privacy.html">Privacy</a>
    /
    <a href="/Catwoman-IMS/terms_conditions.html">Terms & Conditions</a>
  </div>

</html>