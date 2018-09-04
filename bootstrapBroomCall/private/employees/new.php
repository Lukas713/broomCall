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


    if($error["firstName"] == "" || $error["lastName"] == "" || $error["email"] == ""
       || $error["phoneNumber"] == "" || $error["IBAN"] == ""){

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
                $query->execute(array(
                    "person" => $personID,
                    "IBAN" => $_POST["IBAN"],
                    "phoneNumber" => $_POST["phoneNumber"],
                    "squad" => $_POST["squad"],
                    "department" => $_POST["department"]
                ));
    
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
  <!-- Form for creating new  -->
  <div class="container">
  <h3>New employee</h3><hr>
      <div class="row justify-content-md-center"> 
      <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
        <div class="form-group">
            <label for="firstName">First name</label>
        <?php if(!isset($error["firstName"])): ?>
            <input type="text" id="firstName" name="firstName" class="form-control">
        </div>
        <?php else:  ?>
        <input type="text" id="lastName" name="lastName" class="form-control is-invalid" value="<?php echo $_POST["lastName"];?>">
            <div class="invalid-feedback">
                 <?php echo $error["lastName"];  ?>
            </div>
        </div>
<?php endif;  ?>
        <div class="form-group">
            <label for="lastName">Last name</label>
<?php if(!isset($error["lastName"])): ?>
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
            <?php if(!isset($error["lastName"])): ?>
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
            <?php if(!isset($error["phoneNumber"])): ?>
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
            <?php if(!isset($error["phoneNumber"])): ?>
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
                    <select class="form-control" id="department" name="department">
                        <?php
                         $query = $conn->prepare("SELECT * from department"); 
                         $query->execute();
                         $department = $query->fetchAll(PDO::FETCH_OBJ);
                        foreach($department as $row){
                            echo "<option value=".$row->id.">".$row->depName."</option>"; 
                        }
                        ?>
                    </select>
            </div>
            <?php if(!isset($error["squad"])):?>
                <div class="form-group col-md-6">
                    <label for="squad">Squad</label>
                        <select class="form-control" id="squad" name="squad">
                            <?php
                            $query = $conn->prepare("SELECT * from squad");
                            $query->execute(); 
                            $squad = $query->fetchAll(PDO::FETCH_OBJ);
                            foreach($squad as $row){
                                echo "<option value=".$row->id.">".$row->squadNumber."</option>";
                            }
                            ?>
                    </select>
                </div>
                    <?php else:  ?>
                <div class="form-group col-md-6">
                <label for="squad">Squad</label>
                    <select class="form-control" id="squad" name="squad">
                        <?php
                        $query = $conn->prepare("SELECT * from squad");
                        $query->execute(); 
                        $squad = $query->fetchAll(PDO::FETCH_OBJ);
                        foreach($squad as $row){
                            echo "<option value=".$row->id.">".$row->squadNumber."</option>";
                        }
                        ?>
                </select>
            </div>
                    <?php endif;  ?>
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