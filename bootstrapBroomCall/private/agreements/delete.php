<?php
include_once "../../config.php";
if(!isset($_SESSION[$appID."admin"])){
  header('location:'.$pathAPP.'logout.php');
} 

try{
    $conn->beginTransaction();

    $query=$conn->prepare("DELETE from agreement where id=:id");
    $query->execute($_GET);

    $conn->commit(); 
    header("location: index.php"); 
}catch(PDOexeption $e){
    $conn->rollBck(); 
}


?>