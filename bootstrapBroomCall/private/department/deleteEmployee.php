<?php 
include_once "../../config.php"; 

if(!isset($_SESSION[$appID."operater"])){
    return;
}

$query = $conn->prepare("delete from employees where id=:employeeID;");
$query->execute($_POST);

 echo "good job"; 