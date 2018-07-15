<?php 
include_once "../../config.php";

if(!isset($_SESSION[$appID."operater"])){
  header('location:'.$pathAPP.'logout.php');
} 

if(isset($_POST["add"])){
    $query = $conn->prepare("insert into squad(squadNumber, squadColor) values
                            (:squadNumber, :squadColor)");
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
<div class="grid-container">
    <div class="grid-x" style="justify-content:center;">
        <div class="cell medium-4 large-3">
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                            <h4 class="text-center">New squad</h4>
                            <label>Ordinal number
                                <input type="number"  step="1" name="squadNumber">
                            </label>
                            <label>Squad color
                                <input type="text" name="squadColor" >
                            </label>
                            <br>
                            <input type="submit" name="add" class="button" value="Submit"></input>
                            <a href="index.php" class="alert button">Cancel</a>
                </form>
        </div>
    </div>
</div>
  <?php include_once "../../template/scripts.php"; ?>

  <?php include_once "../../template/footer.php"; ?>
  
  </body>
</html>
