<?php 
include_once "../../config.php";
if(!isset($_SESSION[$appID."operater"])){
  header('location:'.$pathAPP.'logout.php');
} 
if(isset($_POST["add"])){
    $query = $conn->prepare("insert into cleanlevel(levelName, priceCoeficient) values
                            (:levelName, :priceCoef)");
    unset($_POST["add"]);
    $query->execute($_POST); 
    header("location: index.php"); 
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
  <h3>Add new clean level</h3><hr>
      <div class="row justify-content-md-center"> 
      <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
        <div class="form-group">
            <label for="levelName">Level name</label>
            <input type="levelName" class="form-control" id="levelName" name="levelName" aria-describedby="emailHelp" placeholder="Enter level name">
        </div>
        <div class="form-group">
            <label for="priceCoefficient">Price coefficient</label>
            <input type="number" step="0.01" class="form-control" id="priceCoefficient" name="priceCoef" placeholder="0.00">
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