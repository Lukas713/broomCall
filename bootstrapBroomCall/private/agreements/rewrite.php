<?php 
include_once "../../config.php";
if(!isset($_SESSION[$appID."operater"])){
  header('location:'.$pathAPP.'logout.php');
} 

if(!isset($_GET["id"]) && !isset($_POST["change"])){
    header('location:'.$pathAPP.'logout.php');
}

if(isset($_POST["change"])){

            $query = $conn->prepare("UPDATE agreement set city=:city, adress=:adress, cleanLevel=:cleanLevel, services=:services
                             where id=:id;");
            $query->execute(array(
                "city"=>$_POST["city"],
                "adress"=>$_POST["adress"],
                "cleanLevel"=>$_POST["cleanLevel"],
                "services"=>$_POST["services"],
                "id"=>$_POST["id"]
            )); 

            header("location: index.php");
}else {

    try{
        $conn->beginTransaction();
        $query=$conn->prepare("select b.id, a.firstName, a.lastName, b.serviceDate,  b.city, b.adress, d.levelName,
                                e.serviceName, (d.priceCoeficient * e.price) as total
                                from agreement b
                                inner join users c on b.users = c.id
                                inner join person a on a.id = c.person
                                inner join cleanlevel d on b.cleanLevel = d.id
                                inner join services e on b.services = e.id
                                where  b.id=:id;");
        $query->execute($_GET);
        $result = $query->fetch(PDO::FETCH_OBJ);

        $query = $conn->prepare("SELECT * from cleanlevel");
        $query->execute();
        $cleanLevel = $query->fetchAll(PDO::FETCH_OBJ); 

        $query = $conn->prepare("SELECT * from services");
        $query->execute();
        $services = $query->fetchAll(PDO::FETCH_OBJ);

        $conn->commit(); 
        
    }catch(PDOexeption $e){
        $conn->rollBack(); 
    }  
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
  <h3>Rewrite agreement</h3><hr>
      <div class="row justify-content-md-center"> 
      <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
      <div class="form-group">
            <label for="user"></label>
            <input type="text" readonly class="form-control-plaintext" value="<?php echo $result->firstName." ".$result->lastName."--".$result->total;?> €" id="user">
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" class="form-control" value="<?php echo $result->city;?>" id="city" name="city">
        </div>
        <div class="form-group">
            <label for="adress">Street</label>
            <input type="text" class="form-control" value="<?php echo $result->adress;?>" id="adress" name="adress">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="cleanLevel">Clean level</label>
                    <select class="form-control" id="cleanLevel" name="cleanLevel">
                        <?php
                        foreach($cleanLevel as $row){
                            echo "<option value=".$row->id." selected>".$row->levelName."</option>"; 
                        }
                        ?>
                    </select>
            </div>
            <div class="form-group col-md-6">
            <label for="services">Service</label>
                <select class="form-control" id="services" name="services">
                    <?php
                    foreach($services as $row){
                        echo "<option value=".$row->id." selected>".$row->serviceName."</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <input type="hidden" value="<?php echo $result->id;?>" name="id">

        <input type="submit" class="btn btn-primary" value="Submit" name="change">
        <a href="index.php" class="btn btn-danger">Cancel</a>
    </form>
      </div>
  </div>
  <?php include_once "../../template/scripts.php"; ?>

  <?php include_once "../../template/footer.php"; ?>
  
  </body>
</html>