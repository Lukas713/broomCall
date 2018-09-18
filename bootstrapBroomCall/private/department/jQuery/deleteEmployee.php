<?php 
include_once "../../../config.php"; 

if(!isset($_SESSION[$appID."admin"])){
    return;
}



$query = $conn->prepare("UPDATE employees set department = 5 where id = :employeeID");
$query->execute($_POST);
 
echo "good job"; 