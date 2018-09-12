<?php 
include_once "../../../config.php"; 

if(!isset($_SESSION[$appID."operater"])){
    return;
}

if(!isset($_POST["department"])){
    return;
}

$query = $conn->prepare("update employees 
                        set department = :department
                        where id=:employeeID");
$query->execute($_POST);

echo "good job";