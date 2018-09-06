<?php 
include_once "../../config.php";
if(!isset($_SESSION[$appID."operater"])){
  header('location:'.$pathAPP.'logout.php');
} 


if(isset($_POST["add"]) && $_POST["flag"] == 0){ 

     
            
            try{ //try - catch logic, if breaks in try, deals with exeption in catch

                $conn->beginTransaction();
                $query = $conn->prepare("insert into person(firstName, lastName, email)
                                        values (:firstName, :lastName, :email)");
                $query->execute(array(
                    "firstName" => $_POST["firstName"],
                    "lastName" => $_POST["lastName"],
                    "email" => $_POST["email"]
                ));
    
            
                $personID = $conn->lastInsertId();
                print_r($personID); 
                $query = $conn->prepare("insert into employees(IBAN, phoneNumber, person, squad, department) values
                                        (:IBAN, :phoneNumber, :person, :squad, :department)");
                
                if($_POST["department"] != 1){
                    $query->bindValue(":squad", null, PDO::PARAM_INT);
                }else {
                    $query->bindParam(":squad", $_POST["squad"]);
                }

                $query->bindParam(":IBAN", $_POST["IBAN"]);
                $query->bindParam(":phoneNumber", $_POST["phoneNumber"]);
                $query->bindValue(":person", $personID, PDO::PARAM_INT);
                $query->bindParam(":department", $_POST["department"]);
                $query->execute();
    
                $conn->commit(); //close beginTransaction()
                header("location: index.php"); 
    
             } catch(PDOexeption $e){
                    $query->rollBack(); 
                }

}

?>



<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
  <?php include_once "../../template/head.php"; ?>
  </head>
  <body>

  <?php include_once "../../template/navigation.php"; ?><br>
  <!-- Form for creating new  employee-->
  <div class="container">
  <h3>New employee</h3><hr>
      <div class="row justify-content-md-center"> 
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <?php
                    try{
                        $conn->beginTransaction();

                        $query = $conn->prepare("SELECT * from department"); 
                        $query->execute();
                        $department = $query->fetchAll(PDO::FETCH_OBJ);

                        $query = $conn->prepare("SELECT * from squad"); 
                        $query->execute();
                        $squad = $query->fetchAll(PDO::FETCH_OBJ);

                        $conn->commit(); 
                    }catch(PDOexeption $e){
                        $conn->rollBack(); 
                    }
                        
                        
                        $errors["firstName"] = inputError($_POST, "firstName"); 
                        $errors["lastName"] = inputError($_POST, "lastName"); 
                        $errors["email"] = inputError($_POST, "email"); 
                        $errors["IBAN"] = inputError($_POST, "IBAN"); 
                        $errors["phoneNumber"] = inputError($_POST, "phoneNumber");

                        echo '<div class="form-row">
                                <div class="form-group col-md-6">';
                                    $errors["department"] = selectErrorHandling($department, $_POST, "department", "depName");
                            echo "</div>";
                            echo '<div class="form-group col-md-6">';
                                    $errors["squad"] = selectErrorHandling($squad, $_POST, "squad", "squadNumber"); 
                            echo '</div>';
                        echo '</div>';
            
                        $flag = 0; 
                        foreach($errors as $row){
                            if($row == 1){
                                break; 
                            }

                            $flag = 1; 
                        }
                ?>
                <input type="submit" class="btn btn-primary" value="Submit" name="add">
                <input type="hidden" name="flag" value="<?php echo $flag;?>">
                <a href="index.php" class="btn btn-danger">Cancel</a>
            </form>
      </div>
  </div>
  <?php include_once "../../template/scripts.php"; ?>

  <?php include_once "../../template/footer.php"; ?>
  
  </body>
</html>