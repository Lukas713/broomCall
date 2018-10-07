<?php
include_once "../../../config.php";

if(isset($_SESSION["admin"]) || !isset($_POST["chartID"])){
    return;
}

$query = $conn->prepare("SELECT b.levelName fro")


?>