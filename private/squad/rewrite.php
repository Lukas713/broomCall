<?php 
include_once "../../config.php"; 

if(!isset($_SESSION[$appID."operater"])){
    header('location:'.$pathAPP.'logout.php');
}

if(!isset($_GET["id"]) && !isset($_POST["change"])){
    header('location:'.$pathAPP.'logout.php');
}



if(isset($_POST["change"])){
    $query = $conn->prepare("update squad set squadNumber=:squadNumber, squadColor=:squadColor where id=:id;"); 
    unset($_POST["change"]);
    $query->execute($_POST);
    header("location: index.php"); 
}else{
    $query = $conn->prepare("select * from squad where id=:id");
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
                            <label>Ordinal number
                                <input value="<?php echo $result->squadNumber;?>" step="1" type="text"  name="squadNumber">
                            </label>
                            <label>Squad color
                                <input value="<?php echo $result->squadColor;?>" type="text" name="squadColor" >
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