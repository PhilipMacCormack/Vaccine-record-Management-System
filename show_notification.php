

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
$sql = "Select *  from notification where report_id = '{$k}'";
$res = mysqli_query($conn, $sql);

while($rows = mysqli_fetch_array($res)){
?>
    <tr>    
        <td> <?php echo $rows['report_id'];
        
             ?> 
        </td>
        <td> <?php 
        $temp_sql = "Select p_number from report where report_id = $rows[report_id] ";
        $temp_res = mysqli_query($conn, $temp_sql);
        $row_temp = mysqli_fetch_array($temp_res);

        echo $row_temp['p_number'];  //Kanske fungerar men ingen har lagts in än ?> </td>
        <td> <?php echo $rows['vac_date'];  ?> </td>
        <td> <?php echo $rows['rem_date'];  ?> </td>
        <td> <?php echo $rows['vaccine_name'];  ?> </td>
        
        <td>
        <!-- Adding delete button for each record row -->
            <form action='delete_notification.php?id="<?php echo $row["report_id"]; ?>"' method="post">
            <button 
            style = "background-color:red;border-color:black; float:right"
            class = "btn"><i class="fa fa-trash"></i
            > Delete</button>
            <input type="hidden" name="d_notificaiton" value="<?php echo $rows["report_id"]; ?>"  >

            </form>
        </td>

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

