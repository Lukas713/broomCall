<?php
session_start(); 

include_once "function.php"; 
$pathAPP = "/broomCall/";
$appID = 25082017;
$titleAPP = "broomCall V1"; 


$conn = new PDO("mysql:host=localhost;dbname=1broomCall", "lukas", "123456789");
$conn->exec("set names utf8");
?>