<?php
session_start(); 

include_once "function.php"; 
$pathAPP = "/broomCall/";
$appID = 25082017;
$titleAPP = "broomCall V1";  

switch($_SERVER["HTTP_HOST"]){
    case "lukas713.byethost17.com":
    $pathAPP = "/broomCall/" ;
    $server = "sql210.byethost.com";
    $dbName = "b17_22272873_broomCall";
    $userName = "b17_22272873";
    $password = "broomcall12345";
    break;
    case "localhost":
    $pathAPP = "/BroomCall/" ;
    $server = "localhost";
    $dbName = "1broomCall";
    $userName = "lukas";
    $password = "123456789";
    break;
}

$conn = new PDO("mysql:host=$server;dbname=$dbName", "$userName", "$password");

$conn->exec("set names utf8");
?>