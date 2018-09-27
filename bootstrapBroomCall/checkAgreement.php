<?php
include_once "config.php";

if(!isset($_SESSION)){
    return; 
}

if(isset($_SESSION[$appID."admin"])){

    $email =  $_SESSION[$appID."admin"];

}else if(isset($_SESSION[$appID."operater"])){

    $email = $_SESSION[$appID."operater"];

}else{

    $email = $_SESSION[$appID."user"]; 
}

try{
    $conn->beginTransaction();

    $query = $conn->prepare("SELECT id from person where email=:email");
    $query->bindValue(":email", $email, PDO::PARAM_STR);
    $query->execute();
    $personID = $query->fetchColumn();

    $query = $conn->prepare("SELECT id from users where person=:person");
    $query->execute(array(
        "person" => $personID
    ));
    $userID = $query->fetchColumn();

    if($userID != null){
    
        $query = $conn->prepare("INSERT INTO agreement(orderDate, city, adress, users, cleanLevel, services)
                                values (:orderDate, :city, :adress:, :users, :cleanLevel, :services)");
        $query->execute(array(
            "orderDate" => date("Y-m-d H:i:s"),
            "city" => $_POST["city"],
            "adress" => $_POST["adress"],
            "users" => $userID,
            "cleanLevel" => $_POST["cleanLevel"],
            "services" => $_POST["services"]    
        ));  

    }else{

        $query = $conn->prepare("INSERT INTO users(person) VALUES(:person);");
        $query->execute(array(
            "person" => $personID
        ));
        $userID = $conn->lastInsertId();
        $query = $conn->prepare("INSERT INTO agreement(orderDate, city, adress, users, cleanLevel, services)
                                values (:orderDate, :city, :adress, :users, :cleanLevel, :services);");
        
        $query->bindValue("orderDate", date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $query->bindParam("city", $_POST["city"], PDO::PARAM_STR);
        $query->bindParam("adress", $_POST["adress"], PDO::PARAM_STR);
        $query->bindValue("users", $userID, PDO::PARAM_INT);
        $query->bindParam("cleanLevel", $_POST["cleanLevel"], PDO::PARAM_INT);
        $query->bindParam("services", $_POST["services"], PDO::PARAM_INT);

        $query->execute();  
    }

    $conn->commit();
    echo "good job"; 

}catch(PDOexeption $e){
    $conn->rollBack();
}


