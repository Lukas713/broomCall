<?php
if(!isset($_POST["email"])){
    exit; 
}

    if($_POST["email"] === ""){
        header("location: login.php");
        exit;
    }

    if($_POST["email"] === "admin@broomCall.com" && $_POST["password"] === "admin" 
    || $_POST["email"] === "lukas.scharmitzer@gmail.com" && $_POST["password"] === "123" ) {

        //pusti dalje
        session_start();
        $_SESSION["operater"] = $_POST["email"]; 
        header("location: private/crudBoard.php");
    }else {
        header("location: login.php"); 
    }

?>