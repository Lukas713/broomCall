<?php 
include_once "../../config.php";
if(!isset($_SESSION[$appID."operater"])){
  header('location:'.$pathAPP.'logout.php');
}  


if(isset($_POST["add"])){ 

   $error["firstName"] = inputErrorHandling($_POST, "firstName"); 
   $error["lastName"] = inputErrorHandling($_POST, "lastName");
   $error["IBAN"] = inputErrorHandling($_POST, "IBAN");
   $error["phoneNumber"] = inputErrorHandling($_POST, "phoneNumber");
   $error["email"] = inputErrorHandling($_POST, "email");


   if($_POST["department"] === "0"){	    
    $error["department"] = "Please select the department";	        
}else {	    
    $query = $conn->prepare("select count(id) from department where id=:id");	       
    $query ->execute(array(	       
        "id"=>$_POST["department"]	            
    ));	      
     $result = $query->fetchColumn(); 	       
     if($result == 0){	       
        $erro["department"] = "rofl"; 	           
    }	       
}

        if(empty($error["firstName"]) && empty($error["lastName"]) && empty($error["IBAN"])
        && empty($error["phoneNumber"]) && empty($error["email"])){

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
                                    value="<?php echo $row->id ?>"><?php echo $row->depName ?></option>  	            
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
                                        value="<?php echo $row->id ?>"><?php echo $row->squadNumber ?></option>  	
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