<?php
session_start();
require 'db.php';
$incorrect='';

if ( !isset($_POST['employee_id'], $_POST['h_password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill in all of the fields!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $conn->prepare('SELECT employee_id, h_password, active_employee FROM h_login WHERE employee_id = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('i', $_POST['employee_id']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

	if ($stmt->num_rows > 0) {
		$stmt->bind_result($employee_id, $h_password, $active_employee);
		$stmt->fetch();

        // Check if the user is active
        if ($active_employee == 1){
            //Verify hashed password
            if (password_verify($_POST['h_password'], $h_password)){
                // Verification success
            
                //Log that the user is logging in
                $loginstring = 'Login';
                if ($stmt = $conn->prepare('INSERT INTO loginhistory (employee_id, action) VALUES (?,?)')){
                $stmt->bind_param('is', $_POST['employee_id'], $loginstring);
                $stmt->execute();
                } 
                
                //Check if employee user is an admin or not
                if ($stmt = $conn->prepare('SELECT employee_id, admin_id FROM healthcare_worker WHERE employee_id = ?')){
                    $stmt->bind_param('i', $_POST['employee_id']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    
                    //Is an admin
                    if($row['admin_id']==1){
                        session_regenerate_id(TRUE);
                        $_SESSION['employee_id'] = $_POST['employee_id'];
                        $_SESSION['admin'] = TRUE;
                        header('Location: /Catwoman-IMS/adminhome.php');
                    }

                    else{
                        //Not an admin
                        // Account exists, now we verify the password.
                        
                        // Verification success
                        // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
                        session_regenerate_id(TRUE);
                        $_SESSION['employee_id'] = $_POST['employee_id'];
                        $_SESSION['hw_loggedin'] = TRUE;
                        header('Location: /Catwoman-IMS/healthcareworkerhome.php');
                    }

                }
            }
            else {
                // Incorrect password
                $incorrect = 'Incorrect Personal Number and/or Password!';
            }
         }else{
        // Unactive user
        $incorrect = "Unactivated User!";
    }

	} 
	else {
		// Incorrect Employee ID
		$incorrect = 'Incorrect Employee ID and/or Password!';
	}
	$stmt->close();
}
else{
	$incorrect = 'Incorrect Employee ID and/or Password!';
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

<head>
    <title>Log in as authenticated user</title>
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
.ul {
  text-decoration: underline;
  -webkit-text-decoration-color: red; /* Safari */  
  text-decoration-color: black;
  color: red;
  padding: 12px 20px;
  margin: 6px 0;
}
</style>

<!-- login box -->
<section class="all-boxes">

    <div class="box">
        <h2>
            <b>Authenticated Log in</b>
        </h2>
        <form action="/Catwoman-IMS/loginhealthcare.php" method="post">
        <div class = "ul"><p><?php echo $incorrect ?> Try Again.</ul></p></div>
        <label>Please enter your Employee ID and password</label><br><br>
        <label>Employee ID</label>
        <input type="text" placeholder="Your employee ID" name="employee_id" id="employee_id" required><br><br>
        <label>Password</label>
        <input type="password" placeholder="Your password" name="h_password" id="h_password" required><br><br>
        <button type="submit" value="Log in">Login</button>
        <button type="reset" value="Reset" name="reset">Reset</button>
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