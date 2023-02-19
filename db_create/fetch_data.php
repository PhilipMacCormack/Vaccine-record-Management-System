<?php
$username = 'root';
$password = 'root';
$hostname = 'localhost';
$dbname = 'univapdb';

$conn = mysqli_connect($hostname, $username, $password, $dbname);

// Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }




# data files
$Health_authorities = "/Catwoman-IMS/tree/mock_data/mockdata/Health_authorities.csv";
$Healthcare_workers = "/Catwoman-IMS/tree/mock_data/mockdata/Healthcare_workers.csv";
$Notification = "/Catwoman-IMS/tree/mock_data/mockdata/notification.csv";
$Patient = "/Catwoman-IMS/tree/mock_data/mockdata/patient.csv";
$Report = "/Catwoman-IMS/tree/mock_data/mockdata/report.csv";
$Vaccine = "/Catwoman-IMS/tree/mock_data/mockdata/vaccines.csv";

#$Mock = array (
#    array("Health_authorities"),
 #   array("Healthcare_workers"),
  #  array("Notification"), 
   # array("Patient"),
   # array("Report"), 
    #array("Vaccine")
#);

$Mock = array($Health_authorities, $Healthcare_workers, $Notification, $Patient, $Report, $Vaccine);


foreach ($Mock as $data) {
$Open= fopen($data, "r");
$data = fgetcsv($Open, 1000, ",");
    while (($data = fgetcsv($Open, 1000, ",")) !== FALSE) 
    {
  // Reading the data -> send to insert??
    }
fclose($Open);
}

mysqli_close($conn);
?>
