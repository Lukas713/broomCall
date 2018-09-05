<?php
include_once "../../config.php";
if(!isset($_SESSION[$appID."operater"])){
  header('location:'.$pathAPP.'logout.php');
} 


if(isset($_POST["add"])){

    $error = array(); 
    $error["firstName"] =  errorHandling($_POST, "firstName");
    $error["lastName"] =  errorHandling($_POST, "lastName");
    $error["email"] =  errorHandling($_POST, "email");
    $error["city"] =  errorHandling($_POST, "city");
    $error["adress"] =  errorHandling($_POST, "adress");

    if($_POST["cleanlevel"] === "0"){
        $error["cleanlevel"] = "Please select the clean level";
    }else {
        $query = $conn->prepare("select count(id) from cleanlevel where id=:id");
        $query ->execute(array(
            "id"=>$_POST["cleanlevel"]
        ));
        $result = $query->fetchColumn(); 
        if($result == 0){
            $error["cleanlevel"] = "rofl"; 
        }
    }

    if($_POST["squad"] === "0"){
        $error["squad"] = "Please select squad";
    }else {
        $query = $conn->prepare("select count(id) from squad where id=:id");
        $query ->execute(array(
            "id"=>$_POST["squad"]
        ));
        $result = $query->fetchColumn(); 
        if($result == 0){
            $error["squad"] = "rofl"; 
        }
    }

    if($_POST["services"] === "0"){
        $error["services"] = "Please select services";
    }else {
        $query = $conn->prepare("select count(id) from services where id=:id");
        $query ->execute(array(
            "id"=>$_POST["services"]
        ));
        $result = $query->fetchColumn(); 
        if($result == 0){
            $error["services"] = "rofl"; 
        }
    }

    if(!empty($_POST["serviceDate"])){
        $dateTime = DateTime::createFromFormat('Y-m-d', $_POST["serviceDate"]);
        if(!$dateTime){
          $error["serviceDate"]="Date format is not correct, please enter dd.MM.yyyy. (e.g. for today " . date("d.m.Y.") . ")";
        }
      }


    if(empty($error["firstName"]) && empty($error["lastName"]) 
       && empty($error["serviceDate"]) && empty($error["services"])
       && empty($error["city"]) && empty($error["adress"])
       && empty($error["cleanlevel"]) && empty($error["squad"])
       && empty($error["email"])){
            
            try{ //try - catch logic, if breaks in try, deals with exeption in catch

                $conn->beginTransaction();
                $query = $conn->prepare("insert into person(firstName, lastName, email)
                                        values (:firstName, :lastName, :email)");
                $query->execute(array(
                    "firstName" => $_POST["firstName"],
                    "lastName" => $_POST["lastName"],
                    "email" => $_POST["email"]
                ));
    
            
                $personID = $conn->lastInsertId();
                $query = $conn->prepare("insert into users(person) values (:person)");
                
                $query->execute(array(
                    "person"=>$personID
                ));
                $userID = $conn->lastInsertId();

                $query = $conn->prepare("insert into agreement(serviceDate, city, adress, squad, users, cleanlevel, services) values
                (:serviceDate, :city, :adress, :squad, :users, :cleanlevel, :services)");

                $query->execute(array(
                    "serviceDate" => $_POST["serviceDate"],
                    "city"=> $_POST["city"],
                    "adress"=> $_POST["adress"],
                    "squad"=> $_POST["squad"],
                    "users"=> $userID,
                    "cleanlevel" => $_POST["cleanlevel"],
                    "services" => $_POST["services"]
                ));

    
                $conn->commit(); //close beginTransaction()
                header("location: index.php"); 
    
             } catch(PDOexeption $e){
                    $query->rollBack(); 
                }
                
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
  <!-- Form for creating new  employee-->
  <div class="container">
  <h3>New agreement</h3><hr>
      <div class="row justify-content-md-center"> 
      <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">

        <div class="form-group">
            <label for="firstName">First name</label>
        <?php if(empty($error["firstName"])): ?>
            <input type="text" id="firstName" name="firstName" class="form-control">
        </div>
        <?php else:  ?>
        <input type="text" id="firstName" name="firstName" class="form-control is-invalid" value="<?php echo $_POST["firstName"];?>">
            <div class="invalid-feedback">
                 <?php echo $error["lastName"];  ?>
            </div>
        </div>
<?php endif;  ?>

        <div class="form-group">
            <label for="lastName">Last name</label>
<?php if(empty($error["lastName"])): ?>
            <input type="text" id="lastName" name="lastName" class="form-control ">
        </div>
<?php else:  ?>
            <input type="text" id="lastName" name="lastName" class="form-control is-invalid" value="<?php echo $_POST["lastName"];?>">
            <div class="invalid-feedback">
                 <?php echo $error["lastName"];  ?>
            </div>
        </div>
<?php endif;  ?>

<div class="form-group">
            <label for="email">Email</label>
            <?php if(empty($error["lastName"])): ?>
            <input type="email" id="email" name="email" class="form-control">
        </div>
<?php else:  ?>
            <input type="email" id="email" name="email" class="form-control is-invalid" value="<?php echo $_POST["email"];?>">
            <div class="invalid-feedback">
                 <?php echo $error["email"];  ?>
            </div>
        </div>
<?php endif;  ?>


        <div class="form-group">
            <label for="serviceDate">Date</label>
            <?php if(empty($error["serviceDate"])): ?>
            <input type="date" id="serviceDate" name="serviceDate" class="form-control">
        </div>
<?php else:  ?>
            <input type="serviceDate" id="serviceDate" name="serviceDate" class="form-control is-invalid" value="<?php echo $_POST["serviceDate"];?>">
            <div class="invalid-feedback">
                 <?php echo $error["serviceDate"];  ?>
            </div>
        </div>
<?php endif;  ?>


        <div class="form-group">
            <label for="city">City</label>
            <?php if(empty($error["city"])): ?>
            <input type="text" id="city" name="city" class="form-control">
        </div>
<?php else:  ?>
            <input type="text" id="city" name="city" class="form-control is-invalid" value="<?php echo $_POST["city"];?>">
            <div class="invalid-feedback">
                 <?php echo $error["city"];  ?>
            </div>
        </div>
<?php endif;  ?>


        <div class="form-group">
            <label for="adress">Adress</label>
            <?php if(empty($error["adress"])): ?>
            <input type="text" class="form-control" id="adress" name="adress">
        </div>
<?php else:  ?>
<div class="form-group">
            <input type="text" id="adress" name="adress" class="form-control is-invalid" value="<?php echo $_POST["adress"];?>">
            <div class="invalid-feedback">
                 <?php echo $error["adress"];  ?>
            </div>
        </div>
<?php endif;  ?>


        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="cleanlevel">Clean level</label>
                    <select class="form-control <?php if(isset($error["cleanlevel"]))
                    echo ' is-invalid'; ?>" id="cleanlevel" name="cleanlevel">
                        <option value="0">Levels:</option>
                        <?php
                         $query = $conn->prepare("SELECT * from cleanlevel"); 
                         $query->execute();
                         $result = $query->fetchAll(PDO::FETCH_OBJ);
                         foreach($result as $row):?>
                         <option
                         <?php
                              if(isset($_POST["cleanlevel"]) && $_POST["cleanlevel"]==$row->id){
                                 echo ' selected="selected" ';
                              }
                         ?>
                         value="<?php echo $row->id ?>"><?php echo $row->levelName ?></option>  
                         <?php endforeach; ?>
                 </select>
                 <?php  if(isset($error["cleanlevel"])){
                     echo '<div class="invalid-feedback">'.$error["cleanlevel"].'</div>'; 
                 }  ?>
            </div>

                <div class="form-group col-md-4">
                    <label for="squad">Squad</label>
                    <select class="form-control <?php if(isset($error["squad"]))
                    echo ' is-invalid'; ?>" id="squad" name="squad">
                        <option value="0">Squads:</option>
                            <?php
                            $query = $conn->prepare("SELECT * from squad");
                            $query->execute(); 
                            $result = $query->fetchAll(PDO::FETCH_OBJ);
                        foreach($result as $row):?>
                            <option 
                            <?php
                                 if(isset($_POST["squad"]) && $_POST["squad"]==$row->id){
                                    echo ' selected="selected" ';
                                 }
                            ?>
                            value="<?php echo $row->id ?>"><?php echo $row->squadNumber ?></option>  
                            <?php endforeach; ?>
                    </select>
                    <?php  if(isset($error["squad"])){
                     echo '<div class="invalid-feedback">'.$error["squad"].'</div>'; 
                 }  ?>
                </div>
                <div class="form-group col-md-4">
                    <label for="services">Service</label>
                    <select class="form-control <?php if(isset($error["services"]))
                    echo ' is-invalid'; ?>" id="services" name="services">
                        <option value="0">Services:</option>
                            <?php
                            $query = $conn->prepare("SELECT * from services");
                            $query->execute(); 
                            $result = $query->fetchAll(PDO::FETCH_OBJ);
                        foreach($result as $row):?>
                            <option 
                            <?php
                                 if(isset($_POST["services"]) && $_POST["services"]==$row->id){
                                    echo ' selected="selected" ';
                                 }
                            ?>
                            value="<?php echo $row->id ?>"><?php echo $row->serviceName."=".$row->price." €"; ?></option>  
                            <?php endforeach; ?>
                    </select>
                    <?php  if(isset($error["services"])){
                     echo '<div class="invalid-feedback">'.$error["services"].'</div>'; 
                 }  ?>
                </div>
                
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