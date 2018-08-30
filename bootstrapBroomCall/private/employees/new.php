<?php 
include_once "../../config.php";
if(!isset($_SESSION[$appID."operater"])){
  header('location:'.$pathAPP.'logout.php');
} 


if(isset($_POST["add"])){

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
}else {
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
  <!-- Form for creating new  -->
  <div class="container">
  <h3>New employee</h3><hr>
      <div class="row justify-content-md-center"> 
      <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
        <div class="form-group">
            <label for="firstName">First name</label>
            <input type="text" class="form-control" id="firstNam" name="firstName">
        <div class="form-group">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control" id="lastName" name="lastName">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="phoneNumber">Phone number</label>
            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber">
        </div>
        <div class="form-group">
            <label for="IBAN">IBAN</label>
            <input type="text" class="form-control" id="IBAN" name="IBAN">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="department">Department</label>
                    <select class="form-control" id="department" name="department">
                        <?php
                        foreach($department as $row){
                            echo "<option value=".$row->id.">".$row->depName."</option>"; 
                        }
                        ?>
                    </select>
            </div>
            <div class="form-group col-md-6">
            <label for="squad">Squad</label>
                <select class="form-control" id="squad" name="squad">
                    <?php
                    foreach($squad as $row){
                        echo "<option value=".$row->id.">".$row->squadNumber."</option>";
                    }
                    ?>
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