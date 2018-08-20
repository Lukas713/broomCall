<?php 

//if submit button is not sent
if(!isset($_POST["submit"])){
    header("location: login.php?msg=1");
    exit; 
}

include_once "config.php";

//if entered username is empty
if($_POST["username"] == ""){
    header("location: login.php?msg=1");
    exit; 
}

    if(($_POST["username"] == "username" && $_POST["password"] == "u")
    ||
    ($_POST["username"] == "admin" && $_POST["password"] == "a")){
        //let go
        $_SESSION[$appID."operater"] = $_POST["username"]; 
        header("location: private/controlBoard.php"); 
    }else {
        header("location: login.php?msg=2"); 
    }
