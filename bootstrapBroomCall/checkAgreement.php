<?php 
if(!isset($_SESSION)){
    return; 
}
 


if(isset($_POST["submit"])){
    
     $error["city"] =  inputErrorHandling($_POST, "city");
     $error["adress"] =  inputErrorHandling($_POST, "adress");
     if($_POST["cleanLevel"] == "0"){
    
         $error["cleanLevel"] = "Please chose clean level.";
     }else {
    
         $query = $conn->prepare("select count(id) from cleanLevel where id=:id");
         $query->execute(array(
             "id" => $_POST["cleanLevel"]
         ));
         $result = $query->fetchColumn();
         if($result == 0){
    
             $error["cleanLevel"] == "rofl"; 
         }
     }
    
     if($_POST["services"] == "0"){
    
         $error["services"] = "Please chose service.";
     }else{
    
         $query = $conn->prepare("select count(id) from services where id=:id");
         $query->execute(array(
             "id" => $_POST["services"]
         ));
         $result = $query->fetchColumn();
         if($result == 0){
    
             $error["services"] == "rofl"; 
         }
     }
    /**
     * checking agreement input value errors
     */
    
    if(empty($error["city"]) && empty($error["address"])
    && empty($error["cleanLevel"]) && empty($error["services"])){

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
            $query = $conn->prepare("INSERT INTO agreement(orderDate, city, adress, users, cleanLevel, services)
                                    values (:orderDate, :city, :adress, :users, :cleanLevel, :services)");
            
            $query->execute(array(
                "orderDate" => date("Y-m-d H:i:s"),
                "city" => $_POST["city"],
                "adress" => $_POST["adress"],
                "users" => $userID,
                "cleanLevel" => $_POST["cleanLevel"],
                "services" => $_POST["services"]    
            ));
            
            $agreementId = $conn->lastInsertId(); 

            if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0){
                move_uploaded_file($_FILES["image"]["tmp_name"], 'img/agreementImages/'.$agreementId.'.jpg');
            } 
            $conn->commit(); 
          }catch(PDOexeption $e){
            $conn->rollBack();
        }
    }
}
?>