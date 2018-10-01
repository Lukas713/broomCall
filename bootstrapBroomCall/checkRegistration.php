<?php 
if(!isset($_POST["submit"])){
    return; 
}

include_once "config.php"; 

$errors = array(); 
$errors["firstName"] = inputErrorHandling($_POST, "firstName");
$errors["lastName"] = inputErrorHandling($_POST, "lastName");
$errors["email"] = inputErrorHandling($_POST, "email");
$errors["password"] = inputErrorHandling($_POST, "password");
$errors["phoneNumber"] = inputErrorHandling($_POST, "phoneNumber");

$x = array_values($errors); 
$i = 0;
foreach($x as $row){
    echo $i.".".$row;
    $i++;
} 

