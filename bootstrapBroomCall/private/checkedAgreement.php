<?php 
include_once "../config.php";


if(!isset($_POST["id"])){
    return;
}

$query = $conn->prepare("UPDATE agreement SET checked = true, serviceDate = :serviceDate WHERE id=:id");
$query->bindValue(":serviceDate", date("Y-m-d H:i:s"), PDO::PARAM_STR);
$query->bindParam(":id", $_POST["id"], PDO::PARAM_INT);
$query->execute(); 

echo "good job"; 
?>