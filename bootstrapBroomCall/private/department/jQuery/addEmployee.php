<?php 
include_once "../../../config.php"; 

if(!isset($_SESSION[$appID."admin"])){
    return;
}

if(!isset($_POST["department"])){
    return;
}

$query = $conn->prepare("UPDATE employees 
                        set department = :department
                        where id=:employeeID");
$query->execute($_POST);
echo 'ok';