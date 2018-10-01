<?php 
include_once "../../config.php";
if(!isset($_SESSION[$appID."admin"])){
  header('location:'.$pathAPP.'logout.php');
}  


if(isset($_POST["add"])){ 

   $error["firstName"] = inputErrorHandling($_POST, "firstName"); 
   $error["lastName"] = inputErrorHandling($_POST, "lastName");
   $error["IBAN"] = inputErrorHandling($_POST, "IBAN");
   $error["phoneNumber"] = inputErrorHandling($_POST, "phoneNumber");
   $error["email"] = inputErrorHandling($_POST, "email");
   $error["passwrd"] = inputErrorHandling($_POST, "passwrd");

    if($_POST["department"] === "0"){	    
                $error["department"] = "Please select the department";	        
            }else {	    
                $query = $conn->prepare("select count(id) from department where id=:id");	       
                $query ->execute(array(	       
                    "id"=>$_POST["department"]	            
                ));	      
                $result = $query->fetchColumn(); 	       
                if($result == 0){	       
                    $error["department"] = "rofl"; 	           
                }	       
            }

   if(empty($error["firstName"]) && empty($error["lastName"]) && empty($error["IBAN"]) 
      && empty($error["phoneNumber"])  && empty($error["email"]) && empty($error["passwrd"])
      && empty($error["department"])){

            try{
                $hash = password_hash($_POST["passwrd"],PASSWORD_BCRYPT,array("cost"=>12));
                
                $conn->beginTransaction();
                
                $query = $conn->prepare("insert into person(firstName, lastName, email, passwrd)
                                        values (:firstName, :lastName, :email, :passwrd)");
                $query->execute(array(
                    "firstName" => $_POST["firstName"],
                    "lastName" => $_POST["lastName"],
                    "email" => $_POST["email"],
                    "passwrd" => $hash
                ));
                $personID = $conn->lastInsertId();

                $query = $conn->prepare("insert into employees(person, phoneNumber, IBAN, department, squad) values 
                                                              (:person, :phoneNumber, :IBAN, :department, :squad )");
                
                $query->bindParam(":person", $personID, PDO::PARAM_INT);                                                
                $query->bindParam(":phoneNumber", $_POST["phoneNumber"], PDO::PARAM_STR);   
                $query->bindParam(":IBAN", $_POST["IBAN"], PDO::PARAM_STR);   
                $query->bindParam(":department", $_POST["department"], PDO::PARAM_INT);
                if($_POST["department"] != 1){
                    $query->bindValue(":squad", 4, PDO::PARAM_INT);
                } else {
                    $query->bindParam(":squad", $_POST["squad"], PDO::PARAM_INT);
                }                                              
                                                            
                $query->execute(); 

                $conn->commit(); 
                header("location: index.php"); 
            }catch(PDOexeption $e){
                $conn->rollBack();
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
  <h3>New employee</h3><hr>
      <div class="row justify-content-md-center"> 

             <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">


        <div class="form-group">	
            <label for="firstName">First name</label>	
            <input type="text" id="firstName" name="firstName" <?php echo empty($error["firstName"]) ?  'class="form-control"' : ' class="form-control is-invalid" ' ;?>>
            <?php echo empty($error["firstName"])? "" : ' <div class="invalid-feedback"> '.$error["firstName"].'</div>' ;?>
        </div>
           

         <div class="form-group">	
            <label for="lastName">Last name</label>	
            <input type="text" id="lastName" name="lastName" <?php echo empty($error["lastName"])? ' class="form-control" ' : ' class="form-control is-invalid" ' ;?>>
            <?php echo empty($error["lastName"])?  "" : ' <div class="invalid-feedback"> '.$error["lastName"].'</div>' ;?>	
        </div>

        <div class="form-group">	           
            <label for="email">Email</label>	
            <input type="email" id="email" name="email" <?php echo empty($error["email"])? ' class="form-control" ' : ' class="form-control is-invalid" ' ;?>>	
            <?php echo empty($error["email"])?  "" : ' <div class="invalid-feedback"> '.$error["email"].'</div>' ;?>	
        </div>

        <div class="form-group">	           
            <label for="passwrd">Password</label>	
            <input type="text" id="passwrd" value="<?php echo getPassword(); ?>" name="passwrd" <?php echo empty($error["passwrd"])? ' class="form-control" ' : ' class="form-control is-invalid" ' ;?>>	
            <?php echo empty($error["passwrd"])?  "" : ' <div class="invalid-feedback"> '.$error["passwrd"].'</div>' ;?>	
        </div>

        <div class="form-group">	       
            <label for="phoneNumber">Phone Number</label>	
            <input type="text" id="phoneNumber" name="phoneNumber" <?php echo empty($error["phoneNumber"])? ' class="form-control" ' : ' class="form-control is-invalid" ' ;?>>	
            <?php echo empty($error["phoneNumber"])?  "" : ' <div class="invalid-feedback"> '.$error["phoneNumber"].'</div>' ;?>	
        </div>

        <div class="form-group">	          
            <label for="IBAN">IBAN</label>	    
            <input type="text" id="IBAN" name="IBAN" <?php echo empty($error["IBAN"])? ' class="form-control" ' : ' class="form-control is-invalid" ' ;?>>	
            <?php echo empty($error["IBAN"])?  "" : ' <div class="invalid-feedback"> '.$error["IBAN"].'</div>' ;?>	
        </div>

                    <div class="form-row">	                
                        <div class="form-group col-md-6">	                        
                            <label for="department">Department</label>	                        
                                <select class="form-control <?php if(isset($error["department"]))	                        
                                echo ' is-invalid'; ?>" id="department" name="department">	                       
                                    <option value="0">Pick a department</option>	                       
                                    <?php	                         
                                    $query = $conn->prepare("SELECT * from department"); 	                        
                                    $query->execute();	
                                    $result = $query->fetchAll(PDO::FETCH_OBJ);	                       
                                    foreach($result as $row):?>	                                
                                    <option	                                    
                                    <?php	                           
                                        if(isset($_POST["department"]) && $_POST["department"]==$row->id){	                           
                                            echo ' selected="selected" ';	                                   
                                        }	                           
                                    ?>	                      
                                    value="<?php echo $row->id ?>"><?php echo ($row->id==5) ? "without department" :  $row->depName; ?></option>  	            
                                    <?php endforeach; ?>	                         
                            </select>	                       
                            <?php  if(isset($error["department"])){                        
                                echo '<div class="invalid-feedback">'.$error["department"].'</div>';} 	                               
                            ?>	                            
                        </div>	
                            <div class="form-group col-md-6">	                            
                                <label for="squad">Squad</label>	                        
                                    <select class="form-control" id="squad" name="squad">	                
                                    <option value="0">Pick a squad number</option>	               
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
                                        value="<?php echo $row->id;?>"><?php echo ($row->id==4) ? "without squad" :  $row->squadNumber; ?></option>  	
                                        <?php endforeach; ?>	
                                </select>	
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
