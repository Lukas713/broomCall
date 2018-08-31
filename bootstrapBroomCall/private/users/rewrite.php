<?php 
include_once "../../config.php";
if(!isset($_SESSION[$appID."operater"])){
  header('location:'.$pathAPP.'logout.php');
} 


if(isset($_POST["change"])){

   try{ //try - catch logic, if breaks in try, deals with exeption in catch

        $conn->beginTransaction();
        $query = $conn->prepare("SELECT person from users where id=:id");
        $query->execute(array(
            "id" => $_POST["id"]
        ));
        $personID = $query->fetchColumn();

        $query = $conn->prepare("update person set firstName = :firstName,
                                 lastName = :lastName, email=:email
                                 where id=:id");
        $query->execute(array(
            "firstName" => $_POST["firstName"],
            "lastName" => $_POST["lastName"],
            "email" => $_POST["email"],
            "id" => $personID
        ));

        $query = $conn->prepare("update users set phoneNumber=:phoneNumber,
                                 where id=:id");
        $query->execute(array(
            "id" => $_POST["id"],
            "phoneNumber" => $_POST["phoneNumber"],
        ));



        $conn->commit(); //close beginTransaction()
        header("location: index.php"); 
   } catch(PDOexeption $e){
       $query->rollBack(); 
   }
}else {
    $query = $conn->prepare("select b.id, a.firstName, a.lastName, a.email, b.phoneNumber
                            from person a
                            inner join users b
                            on a.id=b.person
                            where b.id = :id");
    $query->execute($_GET);
    $o=$query->fetch(PDO::FETCH_OBJ);
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
            <input type="text" value="<?php echo $o->firstName;?>" class="form-control" id="firstName" name="firstName">
        <div class="form-group">
            <label for="lastName">Last name</label>
            <input type="text" value="<?php echo $o->lastName;?>" class="form-control" id="lastName" name="lastName">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" value="<?php echo $o->email;?>" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="phoneNumber">Phone number</label>
            <input type="text" value="<?php echo $o->phoneNumber;?>" class="form-control" id="phoneNumber" name="phoneNumber">
        </div>
        
        <input type="hidden" value="<?php echo $o->id;?>" name="id">

        <input type="submit" class="btn btn-primary" value="Submit" name="change">
        <a href="index.php" class="btn btn-danger">Cancel</a>
    </form>
      </div>
  </div>
  <?php include_once "../../template/scripts.php"; ?>

  <?php include_once "../../template/footer.php"; ?>
  
  </body>
</html>