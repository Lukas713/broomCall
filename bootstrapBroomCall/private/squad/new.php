<?php 
include_once "../../config.php";
if(!isset($_SESSION[$appID."operater"])){
  header('location:'.$pathAPP.'logout.php');
} 

$query=$conn->prepare("describe squad");
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

    $firstListBracket = "";
    $secondListBracket = "";

    foreach($array as $row){
        $firstListBracket.=$row.",";
        $secondListBracket.=":".$row.",";
    }

    $firstListBracket = substr($firstListBracket,0,strlen($firstListBracket)-1);
    $secondListBracket = substr($secondListBracket, 0, strlen($secondListBracket)-1);
    $query = $conn->prepare("insert into squad(".$firstListBracket.") values
                            (".$secondListBracket.")");
                          
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
  <h3>New squad</h3><hr>
      <div class="row justify-content-md-center"> 
      <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
        <div class="form-group">
            <label for="squadNumber">Squad number</label>
            <input type="number" class="form-control" step="1" name="squadNumber">
        <div class="form-group">
            <label for="squadColor">Squad color</label>
            <input type="color" id="squadColor" class="form-control" name="squadColor">
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