<?php 
if(!isset($_POST["registrationSubmit"])){
    return; 
} 

$error["registerFirstName"] = inputErrorHandling($_POST, "registerFirstName");
$error["registerLastName"] = inputErrorHandling($_POST, "registerLastName");
$error["registerEmail"] = inputErrorHandling($_POST, "registerEmail");
$error["registerPassword"] = inputErrorHandling($_POST, "registerPassword");
$error["registerPhoneNumber"] = inputErrorHandling($_POST, "registerPhoneNumber");

/**
 * checks if email is alreadyin database
 */
$query = $conn->prepare("SELECT id from person where email=:email");
$query->execute(array(
                "email" => $_POST["registerEmail"]
                ));
$result = $query->fetchColumn();

if($result != null){

    $error["registerEmail"] = "Email is already in use.";
} 


if(empty($error["registerFirstName"]) && empty($error["registerLastName"]) 
    && empty($error["registerEmail"]) && empty($error["registerPassword"])
     && empty($error["registerPhoneNumber"])){

        $hash = password_hash($_POST["registerPassword"],PASSWORD_BCRYPT,array("cost"=>12)); 
        
        try{
            $conn->beginTransaction();

            $query = $conn->prepare("INSERT INTO person(firstName, lastName, email, passwrd)
                                    VALUES (:firstName, :lastName, :email, :passwrd)"); 
            $query->bindParam(":firstName", $_POST["registerFirstName"], PDO::PARAM_STR);
            $query->bindParam(":lastName", $_POST["registerLastName"], PDO::PARAM_STR);
            $query->bindParam(":email", $_POST["registerEmail"], PDO::PARAM_STR);
            $query->bindValue(":passwrd", $hash, PDO::PARAM_STR);
            $personID = $conn->lastInsertId();

            $query->execute();

            $query = $conn->prepare("INSERT INTO users(phoneNumber, person)
                                    VALUES (:phoneNumber, :person)");
            $query->bindParam(":phoneNumber", $_POST["registerPhoneNumber"], PDO::PARAM_STR);
            $query->bindValue(":person", $personID, PDO::PARAM_INT);
            $query->execute();

            $conn->commit();

            $_SESSION[$appID."user"]= $_POST["registerEmail"];
            header("location: index.php");
        }catch(PDOexeption $e){
            $conn->rollBack();
        }
        
}


