<?php 
include_once "../../../config.php"; 

if(!isset($_SESSION[$appID."admin"])){
    return;
}

if(!isset($_POST["squad"])){
    return;
}

$query = $conn->prepare("update employees 
                        set squad = :squad
                        where id=:employeeID");
$query->execute($_POST);

echo "good job";