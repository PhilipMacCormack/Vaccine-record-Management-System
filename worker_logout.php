<?php
session_start();
require 'db.php';

//Log that the user is logging out
$logoutstring = 'Logout';
if ($stmt = $conn->prepare('INSERT INTO loginhistory (employee_id, action) VALUES (?,?)')){
    $stmt->bind_param('is', $_SESSION['employee_id'], $logoutstring);
    $stmt->execute();
    }

session_unset();
session_destroy();
header('location:loginpage_worker.html');
?>