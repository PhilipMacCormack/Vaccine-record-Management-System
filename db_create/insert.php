<?php
//Connect
    $username = 'root';
    $password = 'root';
    $hostname = 'localhost';
    $dbname = 'univapdb';

    $conn = mysqli_connect($hostname, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

// Create script which inputs data into the system based on iteration over arrays. 

//sql to insert into table: patient ( Note: x = row)

    $patient_table = "mockdata/patient_v3.csv";
    $patient_array = array();
    if (($open = fopen($patient_table, "r")) !== FALSE)
        { 
        while (($data = fgetcsv($open, 1000, ",")) !== FALSE)
        {	
            $patient_array[] = $data;
        }

        fclose($open);
    }   

    
    for($x=1; $x<sizeof($patient_array); $x++){
        $first = $patient_array[$x][0];
        $second = $patient_array[$x][1];
        $third = $patient_array[$x][2];
        $fourth = $patient_array[$x][3];
        $fifth = $patient_array[$x][4];

        $sixth = $patient_array[$x][5];
        $sixth = str_replace(' ', '', $sixth);
        $sixth = (int)$sixth;

        $seventh = $patient_array[$x][6];
        $eigth = $patient_array[$x][7];
        $ninth = $patient_array[$x][8];
        $sql = "INSERT INTO patient (p_number,p_first_name, p_last_name, p_adress, p_postcode, p_city, p_email, p_phonenr, dob)
        VALUES ('$first', '$second', '$third', '$fourth', '$sixth', '$fifth', '$seventh', '$eigth','$ninth')";

        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn); 
            /*
            echo "New patient record created successfully.";
            echo "<br>";
            */
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            echo "<br>";
        }
      
    }
    echo "Patient records inserted.";
    echo "<br>";


//sql to insert into table: vaccine
    $vaccines_table = "mockdata/vaccines.csv";
    $vaccines_array = array();

    if (($openv = fopen($vaccines_table, "r")) !== FALSE)
        {    
        while (($datav = fgetcsv($openv, 1000, ";")) !== FALSE)
        {	        
        $vaccines_array[] = $datav;
        }

        fclose($openv);
    }

    for($x=1; $x<sizeof($vaccines_array); $x++){
        $first = $vaccines_array[$x][0];
        $second = $vaccines_array[$x][1];
        $third = $vaccines_array[$x][2];
        $fourth = $vaccines_array[$x][3];
    
        $sql = "INSERT INTO vaccine (nplid, batch_no, v_name, expires)
        VALUES ('$fourth', '$second', '$first', '$third')";

        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn); 
            /*
            echo "New vaccine record created successfully.";
            echo "<br>";
            */
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    echo "Vaccine records inserted.";
    echo "<br>"; 
    


//sql to insert into table: healthcare_worker 
    $healthcare_worker_table = "mockdata/Healthcare_workers.csv";
    $healthcare_worker_array = array();

    if (($open = fopen($healthcare_worker_table, "r")) !== FALSE)
        {    
        while (($data = fgetcsv($open, 1000, ",")) !== FALSE)
        {	        
        $healthcare_worker_array[] = $data;
        }

        fclose($open);
    }   

    for($x=1; $x<sizeof($healthcare_worker_array); $x++){
        $first = $healthcare_worker_array[$x][0];
        $second = $healthcare_worker_array[$x][1];
    
        $sql = "INSERT INTO healthcare_worker (hw_first_name, hw_last_name)
        VALUES ( '$first', '$second')";
    
        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn); 
  
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn). "\r\n";
            echo "<br>";
        }
    } 
    echo "Healthcare_worker records inserted.";
    echo "<br>";

//sql to insert into table: report
    $report_table = "mockdata/report.csv";
    $report_array = array();

    if (($openv = fopen($report_table, "r")) !== FALSE)
        {    
        while (($datav = fgetcsv($openv, 1000, ",")) !== FALSE)
        {	        
        $report_array[] = $datav;
        }

        fclose($openv);
        }

    for($x=1; $x<sizeof($report_array); $x++){    
        $first = $report_array[$x][0];
        $second = $report_array[$x][1];
        $third = $report_array[$x][2];
        
        $sql = "INSERT INTO report (dose, next_dose, date)
        VALUES ('$first', '$third', '$second')";

        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn); 
            /*
            echo "New report record created successfully.";
            echo "<br>";
            */
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }  
    echo "Report records inserted";
    echo "<br>";
    


//sql to insert into table: notification
    $notification_table = "mockdata/notification.csv";
    $notification_array = array();

    if (($open = fopen($notification_table, "r")) !== FALSE)
        {    
        while (($data = fgetcsv($open, 1000, ",")) !== FALSE)
        {	        
        $notification_array[] = $data;
        }

        fclose($open);
    }   

        for($x=1; $x<sizeof($notification_array); $x++){
            $zero = fmod($x,2)+1;
            $first = $notification_array[$x][0];
            $second = $notification_array[$x][1];
            $third = $notification_array[$x][2];
            
    
            $sql = "INSERT INTO notification (report_id, n_id, vac_date,rem_date,vaccine_name)
            VALUES ('$x','$zero','$first', '$second', '$third')"; #N_ID refer to which notification 
            if (mysqli_query($conn, $sql)) {
                $last_id = mysqli_insert_id($conn); 
                /*
                echo "New notification record created successfully. ";
                echo "<br>";
                */
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } 
        echo " Notification records  inserted. ";
        echo "<br>";


//sql to insert into table: health_authority
    $ha_table = "mockdata/Health_authorities.csv";
    $ha_array = array();

    if (($openv = fopen($ha_table, "r")) !== FALSE)
        {    
        while (($datav = fgetcsv($openv, 1000, ",")) !== FALSE)
        {	        
        $ha_array[] = $datav;
        }

        fclose($openv);
        }

    for($x=1; $x<sizeof($ha_array); $x++){
        $first = $ha_array[$x][0]; //mail
        $second = $ha_array[$x][1]; //Contact_no
        $third = $ha_array[$x][2]; // Adress
        $fourth = $ha_array[$x][3]; // City
        $fifth = $ha_array[$x][4]; // postcode

        $sql = "INSERT INTO health_authority (ha_name,ha_email, ha_phonenr, ha_adress, ha_city, ha_postcode)
        VALUES ('Name', '$first', '$second', '$third', '$fourth', '$fifth' )";

        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            /* 
            echo "New health_authority record created successfully.";
            echo "<br>";
            */
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }  
    echo "Health_authority records inserted.";
    echo "<br>";


//sql to insert into table: h_login 

$query = $conn->query("SELECT employee_id FROM healthcare_worker") or die($conn->error);
$employee_id_array = array();
$i = 0;
$count = count($employee_id_array);
$result = $query->fetch_assoc();
do {
    if ($i<3) {
        $employee_id_array[] = $result['employee_id'];
        ++$i;
    }
} while($result = $query->fetch_assoc());

foreach ($employee_id_array as $employee_id) {
    $password = uniqid();
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO h_login (employee_id,h_password)
            VALUES ('$employee_id', '$hashed_password')";    
    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);           
       
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        echo "<br>";
    }
}
echo "Healthcare login records inserted.";
echo "<br>";


//sql to insert into table: p_login 

    for($x=1; $x<10; $x++){
        $first = $patient_array[$x][0];
        $password = uniqid();
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); 
        $sql = "INSERT INTO p_login (p_number,p_password)
        VALUES ('$first', '$hashed_password')";

        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);           
           
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            echo "<br>";
        }
      
    }
    echo "Patient login records inserted.";
    echo "<br>";
    
/*
//sql to insert into table: unactivated patient
    $unactivated_patient_table = "mockdata/patient_v3.csv";
    $unactivated_patient_array = array();
    if (($open = fopen($unactivated_patient_table, "r")) !== FALSE)
        { 
        while (($data = fgetcsv($open, 1000, ",")) !== FALSE)
        {	
            $unactivated_patient_array[] = $data;
        }

        fclose($open);
    }   

    //Format: 199704276113,"Felix","Waern","Studentvägen 13","75243","Uppsala","Felix.wae@gmail.com","0725355455","1997-04-27"));
    for($x=1; $x<sizeof($unactivated_patient_array); $x++){
        $first = $unactivated_patient_array[$x][0];
        $second = $unactivated_patient_array[$x][1];
        $third = $unactivated_patient_array[$x][2];
        $fourth = $unactivated_patient_array[$x][3];
        $fifth = $unactivated_patient_array[$x][4];

        $sixth = $unactivated_patient_array[$x][5];
        $sixth = str_replace(' ', '', $sixth);
        $sixth = (int)$sixth;

        $seventh = $unactivated_patient_array[$x][6];
        $eigth = $unactivated_patient_array[$x][7];
        $ninth = $unactivated_patient_array[$x][8];
        
        $sql = "INSERT INTO unactivated_user (p_number,p_password, p_first_name, p_last_name, p_adress, p_postcode, p_city, p_email, p_phonenr, dob, activation_key) 
        VALUES ('$first','pwd','$second', '$third', '$fourth', '$sixth', '$fifth', '$seventh', '$eigth','$ninth', 'activation key')";

        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn); 
            
            echo "New patient record created successfully.";
            echo "<br>";
            
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            echo "<br>";
        }
    
    }
    echo "Unactivated users record inserted.";
    echo "<br>";
*/
 mysqli_close($conn);
    
?>