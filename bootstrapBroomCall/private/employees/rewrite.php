<?php 
include_once "../../config.php";
if(!isset($_SESSION[$appID."operater"])){
  header('location:'.$pathAPP.'logout.php');
} 

if(!isset($_GET["id"]) && !isset($_POST["id"])){
    header("location: " . $pathAPP . "logout.php"); 
}

if(isset($_POST["change"])){

    try{
        $conn->beginTransaction();

        $query = $conn->prepare("select person from employees where id=:id");
        $query->execute(array(
            "id" => $_POST["id"]
        )); 
        $personID = $query->fetchColumn();

        $query = $conn->prepare("update person set firstName=:firstName,
                                 lastName=:lastName, email=:email
                                 where id=:id;");
        $query->execute(array(
            "firstName" => $_POST["firstName"],
            "lastName" => $_POST["lastName"],
            "email" => $_POST["email"],
            "id" => $personID
        ));


        $query = $conn->prepare("update employees set phoneNumber=:phoneNumber,
                                IBAN=:IBAN where id=:id");
        $query->execute(array(
            "id" => $_POST["id"],
            "phoneNumber" => $_POST["phoneNumber"],
            "IBAN" => $_POST["IBAN"]
        ));

        $conn->commit(); 
        header("location: index.php");                             
    }catch(PDOexeption $e){
        $conn->rollBack(); 
    }

}else {
    $query = $conn->prepare("select a.id, a.firstName, a.lastName, a.email, b.phoneNumber, b.IBAN
                            from person a
                            inner join employees b
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
  <h3>Rewrite employee</h3><hr>
      <div class="row justify-content-md-center"> 
      <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
        <div class="form-group">
            <label for="firstName">First name</label>
            <input type="text" class="form-control" value="<?php echo $o->firstName;?>" id="firstName" name="firstName">
        <div class="form-group">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control" value="<?php echo $o->lastName;?>" id="lastName" name="lastName">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" value="<?php echo $o->email;?>" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="phoneNumber">Phone number</label>
            <input type="text" class="form-control" value="<?php echo $o->phoneNumber;?>" id="phoneNumber" name="phoneNumber">
        </div>
        <div class="form-group">
            <label for="IBAN">IBAN</label>
            <input type="text" class="form-control" value="<?php echo $o->IBAN;?>" id="IBAN" name="IBAN">
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