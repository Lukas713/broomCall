<?php 
include_once "config.php"; 
include_once "checkAgreement.php"; 
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once "template/head.php"; ?>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <style>
            .helper{
                color: black;
            }
        </style>
    </head>

    <body>
        <?php include_once "template/navigation.php"; ?>
        <br> <hr>
        <?php print_r($_SESSION);   ?>
        <div class="grid-container">
            <div class="row justify-content-center">
                <div class="col col-md-3">
                    <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Order cleaning service
                        </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="orderAgreement">Basic informations</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <?php if(empty($_SESSION)):?>
                                <h5>You have to login first</h5><br>
                                <a href="login.php" class="btn btn-primary popover-test" data-content="Popover body content is set in this attribute.">Login</a>
                                <?php else:  ?>
                                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" id="agreementForm" enctype="multipart/form-data"> 
                                        <div class="form-group">	
                                            <label for="city">City</label>	
                                            <input type="text" id="city" name="city" <?php echo empty($error["city"]) ?  'class="form-control required"' : ' class="form-control is-invalid" ' ;?>>
                                            <?php echo empty($error["city"])? "" : ' <div class="invalid-feedback"> '.$error["city"].'</div>' ;?>
                                        </div>
                                        <div class="form-group">	
                                            <label for="adress">Adress</label>	
                                            <input type="text" id="adress" name="adress" <?php echo empty($error["adress"]) ?  'class="form-control required"' : ' class="form-control is-invalid" ' ;?>>
                                            <?php echo empty($error["adress"])? "" : ' <div class="invalid-feedback"> '.$error["adress"].'</div>' ;?>
                                        </div>
                                        <div class="form-group">
                                                <label for="service">Service</label>
                                                <a class="helper" href="#" title="Pick one service, how many rooms do we need to clean."><i class="fas fa-question-circle"></i></a>
                                                <select class="form-control <?php if(isset($error["services"]))	                        
                                                    echo ' is-invalid'; ?>" id="services" name="services">	                       
                                                    <option value="0">pick service</option>	                       
                                                    <?php	                         
                                                    $query = $conn->prepare("SELECT a.id, a.serviceName, a.price
                                                                            from services a "); 	                        
                                                    $query->execute();	
                                                    $result = $query->fetchAll(PDO::FETCH_OBJ);	                       
                                                    foreach($result as $row):?>	                                
                                                    <option value=<?php echo $row->id;?>><?php echo $row->serviceName." ".$row->price." €";?></option>  	            
                                                    <?php endforeach; ?>	                         
                                                </select>
                                                <?php  if(isset($error["services"])){                        
                                                    echo '<div class="invalid-feedback">'.$error["services"].'</div>';} 	                               
                                                ?>	
                                        </div>
                                        <div class="form-group">
                                            <label for="cleanLevel">Clean level</label>	
                                            <a class="helper" href="#" title="Clean level tells us how thoroughly your service shoud be.
                                                                             Notice that every level have different price coeficient.
                                                                             (ex. 100€ * 1.45 = 145€)"><i class="fas fa-question-circle"></i></a>                        
                                                <select class="form-control <?php if(isset($error["cleanLevel"]))	                        
                                                    echo ' is-invalid'; ?>" id="cleanLevel" name="cleanLevel">	                       
                                                    <option value="0">pick clean level</option>	                       
                                                    <?php	                         
                                                    $query = $conn->prepare("SELECT a.id, a.levelName, a.priceCoeficient
                                                                            from cleanlevel a"); 	                        
                                                    $query->execute();	
                                                    $result = $query->fetchAll(PDO::FETCH_OBJ);	                       
                                                    foreach($result as $row):?>	                                
                                                    <option value=<?php echo $row->id;?>><?php echo $row->levelName." ".$row->priceCoeficient;?></option>  	            
                                                    <?php endforeach; ?>	                         
                                                </select>
                                                <?php  if(isset($error["cleanLevel"])){                        
                                                    echo '<div class="invalid-feedback">'.$error["cleanLevel"].'</div>';} 	                               
                                                ?>
                                            </div>
                                        <div class="form-group">
                                            <label for="image">Image</label> <a class="helper" href="#" title="(dont have to) Upload image of your object where squad will do the cleaning service."><i class="fas fa-question-circle"></i></a><br>
                                            <input accept="image/jpg" autocomplete="off" type="file" name="image" id="image">            
                                        </div>
                                            <input type="submit" class="btn btn-primary" value="Submit" name="submit">
                                    </form>
                                <?php endif; ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        <?php include_once "template/footer.php"; ?>
        <?php include_once "template/scripts.php"; ?>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $(function() {
                $(document).tooltip();
            } );
        </script>
    </body>
</html>