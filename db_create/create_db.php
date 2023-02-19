<?php
$username = 'root';
$password = 'root';
$hostname = 'localhost';

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


// If database exists then drop it?
// Create database
  $sql = "CREATE DATABASE IF NOT EXISTS univapdb";
  if (mysqli_query($conn, $sql) === TRUE) {
    echo "Database created successfully \r\n";
    echo "<br>";
  } else {
    echo "Error creating database: " . $conn->error. "\r\n";
    echo "<br>";
  }

$conn->close();
?>