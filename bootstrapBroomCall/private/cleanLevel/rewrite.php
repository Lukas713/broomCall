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
<div class="container">
    <div class="row justify-content-md-center">

                <form class="" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                    <div class="form-group">
                        <label for="levelName">Level name</label>
                        <input type="levelName" class="form-control" value="<?php echo $result->levelName;?>" name="levelName" >
                    </div>
                    <div class="form-group">
                        <label for="priceCoef">Price coefficient</label>
                        <input type="number" step="0.01" class="form-control" id="priceCoef" name="priceCoef" value="<?php echo $result->priceCoeficient;?>">
                    </div>
                        <input type="hidden" name="id" value="<?php echo $result->id ?>" />
                        <input type="submit" name="change" class="btn btn-primary" value="Submit"></input>
                        <a href="index.php" class="btn btn-danger">Cancel</a>
                </form>
    </div>
</div>
  <?php include_once "../../template/scripts.php"; ?>

  <?php include_once "../../template/footer.php"; ?>
  
  </body>
</html>