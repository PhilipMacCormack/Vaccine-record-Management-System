<?php
//This script creates an admin account with employee_id = 111111 and password = test123

$username = 'root';
$password = 'root';
$hostname = 'localhost';
$dbname = 'univapdb';

$conn = mysqli_connect($hostname, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


//Insert Admin account
$id = 111111;
$password = 'test123';
$first_name = 'First';
$last_name = 'Admin';
$admin = 1;
$ha = 1;

if($stmt = $conn->prepare('INSERT INTO h_login (employee_id, h_password) VALUES (?, ?)')){
    // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
    $h_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bind_param('is', $id, $h_password);
    $stmt->execute();
    echo 'Inserted admin in table h_login <br>';
}

if ($stmt = $conn->prepare('INSERT INTO healthcare_worker (employee_id, hw_first_name, hw_last_name, admin_id, ha_id) VALUES (?, ?, ?, ?, ?)')) {
    $stmt->bind_param('issii', $id, $first_name, $last_name, $admin, $ha);
    $stmt->execute();
    echo'Inserted admin in table healthcare_worker <br>';
}

//Insert Healthcare Worker account
$id = 222222;
$password = 'test123';
$first_name = 'Healthcare';
$last_name = 'Worker';
$admin = 0;
$ha = 1;

if ($stmt = $conn->prepare('INSERT INTO h_login (employee_id, h_password) VALUES (?,?)')){
    $h_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bind_param('is', $id, $h_password);
    $stmt->execute();
    echo 'Inserted healthcare_worker in table h_login <br>';
}

if ($stmt = $conn->prepare('INSERT INTO healthcare_worker (employee_id, hw_first_name, hw_last_name, admin_id, ha_id) VALUES (?, ?, ?, ?, ?)')) {
    $stmt->bind_param('issii', $id, $first_name, $last_name, $admin, $ha);
    $stmt->execute();
    echo'Inserted healthcare_worker in table healthcare_worker <br>';
}

//Insert Patient account
$p_number = '200001011234';
$password = 'test123';
$p_first_name = 'Patient';
$p_last_name = 'Account';
$p_adress = 'Testgatan 1';
$p_postcode = '75111';
$p_city = 'Uppsala';
$p_email = 'patientmail@hotmail.com';
$p_phonenr = '0701231234';
$dob = '2000-01-01';


if ($stmt = $conn->prepare('INSERT INTO p_login (p_number, p_password) VALUES (?,?)')){
    $p_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bind_param('is', $p_number, $p_password);
    $stmt->execute();
    echo 'Inserted patient account in table p_login <br>';
}

if ($stmt = $conn->prepare('INSERT INTO patient (p_number, p_first_name, p_last_name, p_adress, p_postcode, p_city, p_email, p_phonenr, dob) VALUES (?,?,?,?,?,?,?,?,?)')) {
    $stmt->bind_param('isssissss', $p_number, $p_first_name, $p_last_name, $p_adress, $p_postcode, $p_city, $p_email, $p_phonenr, $dob);
    $stmt->execute();
    echo'Inserted patient in table patient <br>';
}

?>