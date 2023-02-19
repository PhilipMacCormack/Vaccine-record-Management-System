<?php
session_start();
//If the user is not logged in redirect to the login page...
if (empty($_SESSION['admin'])) {
    session_destroy();
	header('Location: /Catwoman-IMS/loginpage_worker.html');
	exit;
}
$k = $POST['id'];
$k = trim($k);
require "db.php";
$sql = "Select * from univapdb where table='{$k}'";
$result = mysqli_query($conn, $sql);
while ($rows = mysqli_fetch_array($result)){
?>
    <tr>
        <td><?php echo $table[0]>$table[0]; ?></td>
        
    </tr>

<?php    
    }   
    
    echo $sql;
?>

