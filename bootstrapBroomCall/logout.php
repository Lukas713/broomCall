<?php
include_once "config.php";
if(isset($_SESSION[$appID."operater"])){

    unset($_SESSION[$appID."operater"]);

}else if(isset($_SESSION[$appID."admin"])){

    unset($_SESSION[$appID."admin"]);

}else if(isset($_SESSION[$appID."user"])){

    unset($_SESSION[$appID."user"]);

}

header("location: login.php"); 
?>