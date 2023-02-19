

<?php

if (isset($_POST['id'])) {
    $k = $_POST['id'];
    $k = trim($k);
}

session_start();
//If the user is not logged in redirect to the login page...
if (empty($_SESSION['admin'])) {
    session_destroy();
	header('Location: /Catwoman-IMS/loginpage_worker.html');
	exit;
}
require "db.php";
$sql = "Select *  from healthcare_worker where employee_id = '{$k}'";
$res = mysqli_query($conn, $sql);

while($rows = mysqli_fetch_array($res)){
?>
    <tr>    
        <td> <?php echo $rows['employee_id']; 
        
             ?> 
        </td>
        <td> <?php echo $rows['hw_first_name'];    ?> </td>
        <td> <?php echo $rows['hw_last_name'];  ?> </td>
        <td> <?php echo $rows['ha_id'];  //Hämta namn? Just nu har de inte namn i H_A table så kan få de. Fanns inte i mockdata ?> </td>
        
        <td> <?php 
        
        $temp_sql = "Select active_employee from h_login where employee_id = '$rows[employee_id]' ";
        $temp_res = mysqli_query($conn, $temp_sql);
        $row_temp = mysqli_fetch_array($temp_res);
        if($row_temp[0]==1){
            echo "Active";
        }else{
            echo "Unactive";
        }

        ?> </td>
       
        <!-- Adding delete button for each record row -->
        <?php
        if($row_temp[0]==1){
        ?>
        <td>
            <form action='delete_healthcare_worker.php?id="<?php echo $rows["employee_id"]; ?>"' method="post">
            <button 
            style = "background-color:red;border-color:black; float:right"
            class = "btn"><i class="fa fa-edit"></i
            > Inactivate</button>
            <input type="hidden" name="d_healthcare_worker" value="<?php echo $rows["employee_id"]; ?>"  >
            </form>
        </td>
        <?php
        }else{
            ?>
            <td>
            <form action='activate_healthcare_worker.php?id="<?php echo $rows["employee_id"]; ?>"' method="post">
            <button 
            style = "background-color:green;border-color:black; float:right"
            class = "btn"><i class="fa fa-edit"></i
            > Activate</button>
            <input type="hidden" name="d_healthcare_worker" value="<?php echo $rows["employee_id"]; ?>"  >
            </form>
        </td>
        <?php
        }
?>


    </tr>
<?php
}
if($k ==""){
    echo "Seach for number";
}

/*
$sql = "DELETE FROM vaccine WHERE nplid=$rows['nplid'] OR (batch_no=$rows[batch_no] AND v_name=$rows['v_name']) ";
$sql = "DELETE FROM vaccine WHERE batch_no=$rows[batch_no]";
if (mysqli_query($conn, "DELETE FROM vaccine WHERE batch_no=$rows[batch_no]";))
{echo"Record deleted successfully";}else{echo"Error deleting record: " . mysqli_error($conn);}

<button 
        style = "background-color:red;border-color:black; float:right"
        onclick = alert("<?php echo $rows['batch_no'];    ?>");
        >Delete</button> </td>









/*
<?php $sql = "DELETE FROM vaccine
            WHERE nplid = '{$rows['nplid']}' AND v_name = '{$rows['v_name']}' AND batch_no = '{$rows['batch_no']}'";
             if (mysqli_query($conn, $sql)) {
            echo "Record deleted successfully";
            }else{ 
            echo "Error deleting record: " . mysqli_error($conn);} ?>
*/  

?>

