<?php
session_start(); 

include_once "functions.php";

$titleAPP = "BroomCall V 1.0 - b" ;
$appID = 20082018;

switch($_SERVER["HTTP_HOST"]){
    case "lukas713.byethost17.com":
    $pathAPP = "/bootstrapBroomCall/" ;
    $server = "sql210.byethost.com";
    $dbName = "b17_22272873_broomCall";
    $userName = "b17_22272873";
    $password = "broomcall12345";
    break;
    case "localhost":
    $pathAPP = "/bootstrapBroomCall/" ;
    $server = "localhost";
    $dbName = "1broomCall";
    $userName = "lukas";
    $password = "123456789";
    break;
}

$conn = new PDO("mysql:host=$server;dbname=$dbName", "$userName", "$password");


$conn->exec("set names utf8");