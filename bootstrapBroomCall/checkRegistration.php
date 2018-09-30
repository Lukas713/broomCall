<?php 
if(!isset($_POST["submit"])){
    return; 
}

include_once "config.php"; 

$errors["firstName"] = inputErrorHandling($_POST, "firstName");
$errors["lastName"] = inputErrorHandling($_POST, "lastName");
$errors["email"] = inputErrorHandling($_POST, "email");
$errors["password"] = inputErrorHandling($_POST, "password");
$errors["phoneNumber"] = inputErrorHandling($_POST, "phoneNumber");

if($errors["firstName"] == "" && $errors["lastName"] == "" 
    && $errors["email"] == "" && $errors["password"] == ""
    && $errors["phoneNumber"] == ""){
        
        
        try{
            $conn->beginTransaction();

            $query = $conn->prepare("SELECT id from person where email = :email");
            $query->execute(array(
                "email" => $_POST["email"]
            ));
            $personID = $query->fetchColumn();

            if($personID != null) {

                
                echo "User already exists";  
            }else {
               $hash = password_hash($_POST["password"],PASSWORD_BCRYPT,array("cost"=>12));

               $query = $conn->prepare("INSERT into person(firstName, lastName, email, passwrd, roles)
                                        VALUES (:firstName, :lastName, :email, :passwrd, :roles)"); 

                $query->bindParam(":firstName", $_POST["firstName"], PDO::PARAM_STR);
                $query->bindParam(":lastName", $_POST["lastName"], PDO::PARAM_STR);
                $query->bindParam(":email", $_POST["email"], PDO::PARAM_STR);
                $query->bindValue(":passwrd", $hash, PDO::PARAM_STR);
                $query->bindValue(":roles", 3, PDO::PARAM_INT);
                $query->execute();

                $personID = $conn->lastInsertId();
                $query = $conn->prepare("INSERT into users(phoneNumber, person)
                                            VALUES(:phoneNumber, :person)");
                $query->bindParam(":phoneNumber", $_POST["phoneNumber"], PDO::PARAM_STR);
                $query->bindValue(":person", $personID, PDO::PARAM_INT);
                $query->execute();

                echo $_POST["email"]." is registered"; 
            }

            $conn->commit(); 
        }catch(PDOexeption $e) {

            $conn->rollBack(); 
        }
    }else {
        echo "You must fill all fields."; 
     }