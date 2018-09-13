<?php 
include_once "../../../config.php"; 

if(!isset($_SESSION[$appID."operater"])){
    return;
}


$query = $conn->prepare("update employees 
                        set squad = 4
                        where id=:employeeID");
$query->execute($_POST);
echo "good job"; 