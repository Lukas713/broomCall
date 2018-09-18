<?php 
include_once "../../config.php";
if(!isset($_SESSION[$appID."admin"])){
  header('location:'.$pathAPP.'logout.php');
} 

$query = $conn->prepare("describe department");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
$array = array();  

foreach($result as $row){
    if($row->Field == "id"){
        continue;
    }

    $array[] = $row->Field; 
}


if(isset($_POST["add"])){

    $firstLineBracket = "";
    $secondLineBracket = "";

    foreach($array as $row){
        $firstLineBracket = $row.",";
        $secondLineBraket = ":".$row.",";
    }

    $firstLineBracket = substr($firstLineBracket, 0, strlen($firstLineBracket)-1);
    $secondLineBraket = substr($secondLineBraket, 0, strlen($secondLineBraket)-1);


    $query = $conn->prepare("insert into department(".$firstLineBracket.") values
                            (".$secondLineBraket.")");
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
  <h3>Add new department</h3><hr>
      <div class="row justify-content-md-center"> 
      <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
<?php foreach($array as $row):  ?>
        <div class="form-group">
            <label for="<?php echo $row;?>"><?php echo $row;?></label>
            <input type="text" class="form-control" id="<?php echo $row;?>" name="<?php echo $row;?>">
        </div>
<?php endforeach;?>
        <input type="submit" class="btn btn-primary" value="Submit" name="add">
        <a href="index.php" class="btn btn-danger">Cancel</a>
    </form>
      </div>
  </div>
  <?php include_once "../../template/scripts.php"; ?>

  <?php include_once "../../template/footer.php"; ?>
  
  </body>
</html>