<?php 
include_once "../config.php";

if(!isset($_SESSION[$appID."admin"])){
    return;
}

$query = $conn->prepare("UPDATE agreement
                        set approved = true,
                        squad = :squadNumber,
                        approveDate = :approveDate 
                        where id=:agreementID");

$query->bindParam(":squadNumber", $_POST["squadNumber"], PDO::PARAM_INT);
$query->bindParam(":agreementID", $_POST["agreementID"], PDO::PARAM_INT);
$query->bindValue(":approveDate", date("Y-m-d H:i:s"), PDO::PARAM_STR);
$query->execute(); 

echo "good job";