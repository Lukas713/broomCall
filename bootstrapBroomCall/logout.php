<?php
include_once "config.php";
unset($_SESSION[$appID."operater"]);
header("location: index.php"); 
?>