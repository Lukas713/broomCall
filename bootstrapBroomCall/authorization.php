<?php 

//if submit button is not sent
if(!isset($_POST["submit"])){
    header("location: login.php?msg=1");
    exit; 
}

include_once "config.php";

//if entered username is empty
if($_POST["email"] == ""){
    header("location: login.php?msg=1");
    exit; 
}
    $query = $conn->prepare(" SELECT * from person
                                inner join roles on person.roles = roles.id
                                where email=:email");
    $query->execute(array("email" => $_POST["email"]));
    $result = $query->fetch(PDO::FETCH_OBJ); 

    if($result != null && $result->passwrd==password_verify($_POST["password"], $result->passwrd)
        && $result->roleName=="admin"){

        $result->passwrd="";
        $_SESSION[$appID."admin"]= $result->email;

        header("location: private/controlBoard.php");

    }else if($result != null && $result->passwrd==password_verify($_POST["password"], $result->passwrd)
             && $result->roleName=="operater"){

                $result->passwrd="";
                $_SESSION[$appID."operater"]= $result->email;
        
                header("location: private/controlBoard.php");

        }else if($result != null && $result->passwrd==password_verify($_POST["password"], $result->passwrd)
                && $result->roleName=="user") {
                    
                    $result->passwrd="";
                    $_SESSION[$appID."user"]= $result->email;
            
                    header("location: private/index.php");
            }else {
                header("location: login.php?msg=2");
            }
   
