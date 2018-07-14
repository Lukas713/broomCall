<?php 
include_once "../../config.php"; 

if(!isset($_SESSION[$appID."operater"])){
    header('location:'.$pathAPP.'logout.php');
}

if(!isset($_GET["id"]) && !isset($_POST["change"])){
    header('location:'.$pathAPP.'logout.php');
}



if(isset($_POST["change"])){
    $query = $conn->prepare("update cleanlevel set levelName=:levelName, priceCoeficient=:priceCoef where id=:id;"); 
    unset($_POST["change"]);
    $query->execute($_POST);
    header("location: index.php"); 
}else{
    $query = $conn->prepare("select * from cleanlevel where id=:id");
    $query->execute($_GET);
    $result = $query->fetch(PDO::FETCH_OBJ);  
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
                            <h4 class="text-center">Change clean level</h4>
                            <label>Level name
                                <input value="<?php echo $result->levelName;?>" type="text"  name="levelName">
                            </label>
                            <label>Price coefficient
                                <input value="<?php echo $result->priceCoeficient;?>" type="number" step="0.01" name="priceCoef" >
                            </label>
                            <br>
                            <input type="hidden" name="id" value="<?php echo $result->id ?>" />
                            <input type="submit" name="change" class="button" value="Submit"></input>
                            <a href="index.php" class="alert button">Cancel</a>
                </form>
        </div>
    </div>
</div>
  <?php include_once "../../template/scripts.php"; ?>

  <?php include_once "../../template/footer.php"; ?>
  
  </body>
</html>