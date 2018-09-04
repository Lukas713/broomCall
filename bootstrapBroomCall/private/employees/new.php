<?php 
include_once "../../config.php";
if(!isset($_SESSION[$appID."operater"])){
  header('location:'.$pathAPP.'logout.php');
} 


if(isset($_POST["add"])){

    $error = array(); 
    $error["firstName"] =  errorHandling($_POST, "firstName");
    $error["lastName"] =  errorHandling($_POST, "lastName");
    $error["email"] =  errorHandling($_POST, "email");
    $error["phoneNumber"] =  errorHandling($_POST, "phoneNumber");
    $error["IBAN"] =  errorHandling($_POST, "IBAN");

    if($_POST["department"] === "0"){
        $error["department"] = "Please select the department";
    }else {
        $query = $conn->prepare("select count(id) from department where id=:id");
        $query ->execute(array(
            "id"=>$_POST["department"]
        ));
        $result = $query->fetchColumn(); 
        if($result == 0){
            $error["department"] = "rofl"; 
        }
    }


    if(empty($error["firstName"]) && empty($error["lastName"]) 
       && empty($error["email"]) && empty($error["phoneNumber"])
       && empty($error["IBAN"]) && empty($error["department"])){
            
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
                $query = $conn->prepare("insert into employees(IBAN, phoneNumber, person, squad, department) values
                                        (:IBAN, :phoneNumber, :person, :squad, :department)");
                
                if($_POST["department"] != 1){
                    $query->bindValue(":squad", null, PDO::PARAM_INT);
                }else {
                    $query->binParam(":squad", $_POST["squad"]);
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

        <div class="form-group">
            <label for="firstName">First name</label>
        <?php if(empty($error["firstName"])): ?>
            <input type="text" id="firstName" name="firstName" class="form-control">
        </div>
        <?php else:  ?>
        <input type="text" id="firstName" name="firstName" class="form-control is-invalid" value="<?php echo $_POST["firstName"];?>">
            <div class="invalid-feedback">
                 <?php echo $error["lastName"];  ?>
            </div>
        </div>
<?php endif;  ?>


        <div class="form-group">
            <label for="lastName">Last name</label>
<?php if(empty($error["lastName"])): ?>
            <input type="text" id="lastName" name="lastName" class="form-control ">
        </div>
<?php else:  ?>
            <input type="text" id="lastName" name="lastName" class="form-control is-invalid" value="<?php echo $_POST["lastName"];?>">
            <div class="invalid-feedback">
                 <?php echo $error["lastName"];  ?>
            </div>
        </div>
<?php endif;  ?>


        <div class="form-group">
            <label for="email">Email</label>
            <?php if(empty($error["lastName"])): ?>
            <input type="email" id="email" name="email" class="form-control">
        </div>
<?php else:  ?>
            <input type="email" id="email" name="email" class="form-control is-invalid" value="<?php echo $_POST["email"];?>">
            <div class="invalid-feedback">
                 <?php echo $error["email"];  ?>
            </div>
        </div>
<?php endif;  ?>


        <div class="form-group">
            <label for="phoneNumber">Phone number</label>
            <?php if(empty($error["phoneNumber"])): ?>
            <input type="text" id="phoneNumber" name="phoneNumber" class="form-control">
        </div>
<?php else:  ?>
            <input type="text" id="phoneNumber" name="phoneNumber" class="form-control is-invalid" value="<?php echo $_POST["phoneNumber"];?>">
            <div class="invalid-feedback">
                 <?php echo $error["phoneNumber"];  ?>
            </div>
        </div>
<?php endif;  ?>


        <div class="form-group">
            <label for="IBAN">IBAN</label>
            <?php if(empty($error["phoneNumber"])): ?>
            <input type="text" class="form-control" id="IBAN" name="IBAN">
        </div>
<?php else:  ?>
<div class="form-group">
            <input type="text" id="IBAN" name="IBAN" class="form-control is-invalid" value="<?php echo $_POST["IBAN"];?>">
            <div class="invalid-feedback">
                 <?php echo $error["IBAN"];  ?>
            </div>
        </div>
<?php endif;  ?>


        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="department">Department</label>
                    <select class="form-control <?php if(isset($error["department"]))
                    echo ' is-invalid'; ?>" id="department" name="department">
                        <option value="0">Pick a department</option>
                        <?php
                         $query = $conn->prepare("SELECT * from department"); 
                         $query->execute();
                         $result = $query->fetchAll(PDO::FETCH_OBJ);
                         foreach($result as $row):?>
                         <option
                         <?php
                              if(isset($_POST["department"]) && $_POST["department"]==$row->id){
                                 echo ' selected="selected" ';
                              }
                         ?>
                         value="<?php echo $row->id ?>"><?php echo $row->depName ?></option>  
                         <?php endforeach; ?>
                 </select>
                 <?php  if(isset($error["department"])){
                     echo '<div class="invalid-feedback">'.$error["department"].'</div>'; 
                 }  ?>
            </div>
                <div class="form-group col-md-6">
                    <label for="squad">Squad</label>
                        <select class="form-control" id="squad" name="squad">
                        <option value="0">Pick a squad number</option>
                            <?php
                            $query = $conn->prepare("SELECT * from squad");
                            $query->execute(); 
                            $result = $query->fetchAll(PDO::FETCH_OBJ);
                        foreach($result as $row):?>
                            <option 
                            <?php
                                 if(isset($_POST["squad"]) && $_POST["squad"]==$row->id){
                                    echo ' selected="selected" ';
                                 }
                            ?>
                            value="<?php echo $row->id ?>"><?php echo $row->squadNumber ?></option>  
                            <?php endforeach; ?>
                    </select>
                </div>
                
        </div>
        <input type="submit" class="btn btn-primary" value="Submit" name="add">
        <a href="index.php" class="btn btn-danger">Cancel</a>
    </form>
      </div>
  </div>
  <?php include_once "../../template/scripts.php"; ?>

  <?php include_once "../../template/footer.php"; ?>
  
  </body>
</html>