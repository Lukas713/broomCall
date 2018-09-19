<?php 
include_once "../config.php";

if(!isset($_SESSION[$appID."admin"])){
    return;
}


$query = $conn->prepare("UPDATE agreement
                        set approved = true,
                        squad = :squadNumber
                        where id=:agreementID");
$query->execute($_POST);
echo "good job"; 