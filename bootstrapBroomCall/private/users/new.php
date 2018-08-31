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
        $query = $conn->prepare("insert into users(phoneNumber, person) values
                                (:phoneNumber, :person)");
        $query->execute(array(
            "person" => $personID,
            "phoneNumber" => $_POST["phoneNumber"]
        ));



        $conn->commit(); //close beginTransaction()
        header("location: index.php"); 
   } catch(PDOexeption $e){
       $query->rollBack(); 
   }
}else {
   
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
  <h3>New user</h3><hr>
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
        
        <input type="submit" class="btn btn-primary" value="Submit" name="add">
        <a href="index.php" class="btn btn-danger">Cancel</a>
    </form>
      </div>
  </div>
  <?php include_once "../../template/scripts.php"; ?>

  <?php include_once "../../template/footer.php"; ?>
  
  </body>
</html>