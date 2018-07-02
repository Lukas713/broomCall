<?php
session_start(); 

$nameAPP="BroomCall V1";
include_once "function.php"; 

switch($_SERVER["HTTP_HOST"]){
    case "localhost":
    $pathAPP="/class-project/";
    break;
    case "lukas713.byethost17.com":
    $pathAPP="/class-project/";
    $colorMenu="";
    break;
}



