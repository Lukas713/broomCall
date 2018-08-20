<?php
session_start(); 

include_once "functions.php";

$pathAPP = "/bootstrapBroomCall/" ;
$titleAPP = "BroomCall V 1.0 - b" ;
$appID = 20082018;

$conn = new PDO("mysql:host=localhost;dbname=1broomCall", "lukas", "123456789");

$conn->exec("set names utf8");