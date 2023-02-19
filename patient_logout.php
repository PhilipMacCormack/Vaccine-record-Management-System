<?php
session_start();
require 'db.php';

//Log that the user is logging out
$logoutstring = 'Logout';
if ($stmt = $conn->prepare('INSERT INTO loginhistory (p_number, action) VALUES (?,?)')){
    $stmt->bind_param('is', $_SESSION['p_number'], $logoutstring);
    $stmt->execute();
    }

session_destroy();
header('location:loginpage_patient.html');
?>