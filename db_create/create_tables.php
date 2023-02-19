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



// sql to create table patient. 
    $sql = "CREATE TABLE patient (
        p_number BIGINT(12) PRIMARY KEY,
        p_first_name VARCHAR(100) NOT NULL,
        p_last_name VARCHAR(100) NOT NULL,
        p_adress VARCHAR(100) NOT NULL, 
        p_postcode INT(10) NOT NULL,
        p_city VARCHAR(100) NOT NULL,
        p_email VARCHAR(100) NOT NULL,
        p_phonenr VARCHAR(100) NOT NULL,
        dob DATE NOT NULL,
        age INT(6)
        )";
    if (mysqli_query($conn, $sql)) {
        echo "Table patient created successfully \r\n";
        echo "<br>";
    } else {
        echo "Error creating table: " . mysqli_error($conn). "\r\n" ;
        echo "<br>";
    }  
// sql to create table p_login
    $sql = "CREATE TABLE p_login (
        p_number BIGINT(12) PRIMARY KEY,
        p_password VARCHAR(100) NOT NULL
        )";
    if (mysqli_query($conn, $sql)) {
        echo "Table p_login created successfully \r\n";
        echo "<br>";
    } else {
        echo "Error creating table: " . mysqli_error($conn). "\r\n" ;
        echo "<br>";
    }  
// sql to create table vaccine
    $sql = "CREATE TABLE vaccine (
        nplid VARCHAR(100),
        batch_no VARCHAR(100) NOT NULL,
        v_name VARCHAR(100),
        expires DATE NOT NULL,
        v_status INT(1) DEFAULT 0,
        CONSTRAINT v_pk PRIMARY KEY (nplid, batch_no, v_name)
        )";
    if (mysqli_query($conn, $sql)) {
        echo "Table vaccine created successfully \r\n";
        echo "<br>";
    } else {
        echo "Error creating table: " . mysqli_error($conn). "\r\n" ;
        echo "<br>";
    }  

// sql to create table health_authority
    $sql = "CREATE TABLE health_authority (
        ha_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        ha_name VARCHAR(100),
        ha_phonenr VARCHAR(100),
        ha_adress VARCHAR(100),
        ha_city VARCHAR(100),
        ha_postcode VARCHAR(100),
        ha_email VARCHAR(100)
        )";
    if (mysqli_query($conn, $sql))  {
        echo "Table health_authority created successfully \r\n";
        echo "<br>";
    } else {
        echo "Error creating table: " . mysqli_error($conn). "\r\n" ;
        echo "<br>";
    }  
// sql to create table h_login
    $sql = "CREATE TABLE h_login (
        employee_id INT(6) PRIMARY KEY,
        h_password VARCHAR(100) NOT NULL,
        active_employee INT(1) DEFAULT 1
        )";
    if (mysqli_query($conn, $sql)) {
        echo "Table h_login  created successfully \r\n";
        echo "<br>";
    } else {
        echo "Error creating table: " . mysqli_error($conn). "\r\n" ;
        echo "<br>";
    }  

// sql to create table healthcare_worker
    $sql = "CREATE TABLE healthcare_worker (
        employee_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        hw_first_name VARCHAR(100) NOT NULL,
        hw_last_name VARCHAR(100) NOT NULL,
        admin_id BIT(1),
        ha_id INT(6) UNSIGNED,
        FOREIGN KEY (ha_id) REFERENCES health_authority(ha_id)
        )";
    if (mysqli_query($conn, $sql)) {
        echo "Table healthcare_worker created successfully \r\n";
        echo "<br>";
    } else {
        echo "Error creating table: " . mysqli_error($conn). "\r\n" ;
        echo "<br>";
    }  
    

// sql to create table report
    $sql = "CREATE TABLE report (
        report_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        dose INT(6) NOT NULL,
        next_dose DATE,
        date DATE NOT NULL,
        p_number BIGINT(13),
        nplid VARCHAR(100),
        batch_no VARCHAR(100),
        v_name VARCHAR(100),
        employee_id INT(6) UNSIGNED,
        FOREIGN KEY (p_number) REFERENCES patient(p_number),
        FOREIGN KEY (nplid, batch_no, v_name) REFERENCES vaccine(nplid, batch_no, v_name),
        FOREIGN KEY (employee_id) REFERENCES healthcare_worker(employee_id)
        )";
    if (mysqli_query($conn, $sql)) {
        echo "Table report created successfully \r\n";
        echo "<br>";
    } else {
        echo "Error creating table: report " . mysqli_error($conn). "\r\n" ;
        echo "<br>";
    }  

// sql to create table notification.
    $sql = "CREATE TABLE notification (
        report_id INT(6) UNSIGNED,
        vac_date DATE NOT NULL,   
        rem_date DATETIME,
        vaccine_name VARCHAR(100) NOT NULL,
        dose INT(6) NOT NULL,
        p_number BIGINT(12) NOT NULL,
        n_email VARCHAR(100) NOT NULL,
        status VARCHAR(50) NOT NULL,
        active INT(1) DEFAULT 1,
        FOREIGN KEY (report_id) REFERENCES report(report_id)
        )";
    if (mysqli_query($conn, $sql)) {
        echo "Table notification created successfully \r\n";
        echo "<br>";
    } else {
        echo "Error creating table: notification " . mysqli_error($conn). "\r\n" ;
        echo "<br>";
    }  
    
// sql to create table unactivated_user
    $sql = "CREATE TABLE unactivated_user (
        p_number BIGINT(12) NOT NULL,
        p_password VARCHAR(100) NOT NULL,
        p_first_name VARCHAR(100) NOT NULL,
        p_last_name VARCHAR(100) NOT NULL,
        p_adress VARCHAR(100) NOT NULL, 
        p_postcode INT(10) NOT NULL,
        p_city VARCHAR(100) NOT NULL,
        p_email VARCHAR(100) NOT NULL,
        p_phonenr VARCHAR(100) NOT NULL,
        dob DATE NOT NULL,
        activation_key VARCHAR(100) NOT NULL,
        ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
    if (mysqli_query($conn, $sql)) {
        echo "Table unactivated_user created successfully \r\n";
        echo "<br>";   
    } else {
        echo "Error creating table: " . mysqli_error($conn). "\r\n" ;
        echo "<br>";
    }  

// sql to create table loginhistory
$sql = "CREATE TABLE loginhistory (
    p_number BIGINT(12) DEFAULT NULL,
    employee_id INT(6) DEFAULT NULL,
    action VARCHAR(10),
    time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
if (mysqli_query($conn, $sql)) {
    echo "Table loginhistory created successfully \r\n";
    echo "<br>";   
} else {
    echo "Error creating table: " . mysqli_error($conn). "\r\n" ;
    echo "<br>";
}  

// sql to create table messages
$sql = "CREATE TABLE messages (
    message_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    support_email VARCHAR(100) NOT NULL,
    message VARCHAR(2000) NOT NULL,
    subject VARCHAR(50),
    status VARCHAR(20),
    message_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
if (mysqli_query($conn, $sql)) {
    echo "Table messages created successfully \r\n";
    echo "<br>";   
} else {
    echo "Error creating table: " . mysqli_error($conn). "\r\n" ;
    echo "<br>";
}  

$conn->query('CREATE EVENT expiration_event 
ON SCHEDULE EVERY 48 HOUR
STARTS CURRENT_TIMESTAMP
DO DELETE FROM unactivated_user WHERE ts<=DATE_SUB(NOW(), INTERVAL 48 HOUR)');

mysqli_close($conn);
?>
