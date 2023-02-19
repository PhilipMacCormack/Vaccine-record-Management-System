<html>
<?php
include "../db.php";

# Health authority
if(!$ha_fk = mysqli_query($conn, "SELECT `ha_id` FROM `health_authority`"))
    echo "RIP ha_fk";

if(!$id = mysqli_query($conn, "SELECT `employee_id` FROM `healthcare_worker`"))
    echo "RIP ha_fk 2";

$num_rows = mysqli_num_rows($ha_fk);
$array = [];
while ($row = mysqli_fetch_assoc($ha_fk)){
    $array[] = $row['ha_id'];
}

while($row = mysqli_fetch_assoc($id)){
    $rv = rand(0, $num_rows - 1);
    $fk = $array[$rv];
    $eid = $row['employee_id'];
    mysqli_query($conn, "UPDATE `healthcare_worker` SET `ha_id` = '$fk' WHERE `employee_id`= '$eid'");
}

# Vaccine
if (!$v_fk = mysqli_query($conn, "SELECT `nplid`, `batch_no`, `v_name` FROM `vaccine`"))
    echo "RIP v_fk";

if(!$id = mysqli_query($conn, "SELECT `report_id` FROM `report`"))
    echo "RIP v_fk 2";

$num_rows = mysqli_num_rows($v_fk);
$array = [];
while ($row = mysqli_fetch_assoc($v_fk)){
    $array[] = array($row['nplid'], $row['batch_no'], $row['v_name']);
}

while($row = mysqli_fetch_assoc($id)){
    $rv = rand(0, $num_rows - 1);
    $fk = $array[$rv];
    $nplid = $fk[0];
    $batch_no = $fk[1];
    $v_name = $fk[2];
    $rid = $row['report_id'];
    mysqli_query($conn, "UPDATE `report` SET `nplid` = '$nplid', `batch_no` = '$batch_no', `v_name` = '$v_name' WHERE `report_id`= '$rid'");
}

# Patient
if(!$p_fk = mysqli_query($conn, "SELECT `p_number` FROM `patient`"))
    echo "RIP p_fk";

if(!$id = mysqli_query($conn, "SELECT `report_id` FROM `report`"))
    echo "RIP p_fk 2";

$num_rows = mysqli_num_rows($p_fk);
$array = [];
while ($row = mysqli_fetch_assoc($p_fk)){
    $array[] = $row['p_number'];
}

while($row = mysqli_fetch_assoc($id)){
    $rv = rand(0, $num_rows - 1);
    $fk = $array[$rv];
    $rid = $row['report_id'];
    mysqli_query($conn, "UPDATE `report` SET `p_number` = '$fk' WHERE `report_id`= '$rid'");
}

# Healthcare worker
if(!$hw_fk = mysqli_query($conn, "SELECT `employee_id` FROM `healthcare_worker`"))
    echo "RIP hw_fk";

if(!$id = mysqli_query($conn, "SELECT `report_id` FROM `report`"))
    echo "RIP hw_fk 2";

$num_rows = mysqli_num_rows($hw_fk);
$array = [];
while ($row = mysqli_fetch_assoc($hw_fk)){
    $array[] = $row['employee_id'];
}

while($row = mysqli_fetch_assoc($id)){
    $rv = rand(0, $num_rows - 1);
    $fk = $array[$rv];
    $rid = $row['report_id'];
    mysqli_query($conn, "UPDATE `report` SET `employee_id` = '$fk' WHERE `report_id`= '$rid'");
}

# Report
// if (!$r_fk = mysqli_query($conn, "SELECT `report_id` FROM `report`"))
//     echo "RIP r_fk";
// else
//     echo "r_fk success!";

// if(!$id = mysqli_query($conn, "SELECT `n_id` FROM `notification`")) {
//     echo "RIP r_fk 2";
// }

// $num_rows = mysqli_num_rows($r_fk);
// $array = [];
// while ($row = mysqli_fetch_assoc($r_fk)){
//     $array[] = $row['r_id'];
// }

?>
</html>