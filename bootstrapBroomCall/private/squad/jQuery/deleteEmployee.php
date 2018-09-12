<?php 
include_once "../../../config.php"; 

if(!isset($_SESSION[$appID."operater"])){
    return;
}


//$query = $conn->prepare("UPDATE employees set squad = null where id = :employeeID");
$query->execute($_POST);
 
echo "good job"; 