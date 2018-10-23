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
            .warningBorder {
                border: 1px solid red;
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
                                        <div class="form-group" id="cityControl">	
                                            <label for="city">City</label>	
                                            <input class="form-control" type="text" id="city" name="city" >
                                            
                                        </div>
                                        <div class="form-group" id="adressControl">	
                                            <label for="adress">Adress</label>	
                                            <input class="form-control" type="text" id="adress" name="adress" >
                                        </div>
                                        <div class="form-group" id="servicesControl">
                                                <label for="service">Service</label>
                                                <a class="helper" href="#" title="Pick one service, how many rooms do we need to clean."><i class="fas fa-question-circle"></i></a>
                                                <select class="form-control" id="services" name="services">	                       
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
                                        </div>
                                        <div class="form-group" id="cleanLevelControl">
                                            <label for="cleanLevel">Clean level</label>	
                                            <a class="helper" href="#" title="Clean level tells us how thoroughly your service shoud be.
                                                                             Notice that every level have different price coeficient.
                                                                             (ex. 100€ * 1.45 = 145€)"><i class="fas fa-question-circle"></i></a>                        
                                                <select class="form-control" id="cleanLevel" name="cleanLevel">	                       
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
                                            </div>
                                        <div class="form-group">
                                            <label for="image">Image</label> <a class="helper" href="#" title="(dont have to) Upload image of your object where squad will do the cleaning service."><i class="fas fa-question-circle"></i></a><br>
                                            <input accept="image/jpg" autocomplete="off" type="file" name="image" id="image">            
                                        </div>
                                        <p id="msg"></p>
                                            <!--<a href="#" class="btn btn-primary" id="submit">Submitt</a>-->
                                             <input type="submit" class="btn btn-primary" id="submit" name="submit" value="submit">
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




            /*
                string as parameter
                returns string if...
             */
        function errorHanding(string){
            if(string == ""){
                return "Input is empty!" ;
            }else if(string.length > 50){
                return "You entered "+string.length+" characters, maximum is 50!"; 
            }else if(string == 0){
                return "Wrong option!";
            }
            return ""; 
        }
            /*
                param string
                creates text node
                append to div
                set class
                return div
             */
        function invalidFeedback(errorString){
                
                var div = document.createElement("div");
                var tekst = document.createTextNode(errorString);
                div.appendChild(tekst);
                div.setAttribute("class", "invalid-feedback");
                return div;
        }


        /**
        on submiting form
         */
        $("#agreementForm").submit(function( event ) {

            if($("#city").hasClass("is-invalid")){
                $("#city").removeClass("is-invalid"); 
                $("#cityControl").remove("invalid-feedback");
            }

            
            var error = new Array();
            var array = new Array();
            //push inputs in array
            array[0] = $("#city").val()
            array[1] = $("#adress").val()
            array[2] = $("#services").val()
            array[3] = $("#cleanLevel").val()
            
            /*
            *iterate through array and call function to check errors
             */
              
            $.each(array, function(value) {
                error[value] = errorHanding(array[value]); 
                
                if(error[value] != ""){
                    event.preventDefault(); //dont close modal
                }
                return true; //close moda, evrything is fine
            }); 
            
            //if there is errors in array

            if(error[0] != ""){ //create invalid class and apend it to cityControl id
                $("#city").addClass("is-invalid");
                $("#cityControl").append(invalidFeedback(error[0]));   
            }
            if(error[1] != ""){
                $("#adress").addClass("is-invalid");
                $("#adressControl").append(invalidFeedback(error[1]));
            }
            if(error[2] != ""){
                $("#services").addClass("is-invalid");
                $("#servicesControl").append(invalidFeedback(error[2]));
            }
            if(error[3] != ""){
                $("#cleanLevel").addClass("is-invalid");
                $("#cleanLevelControl").append(invalidFeedback(error[3]));
            }

        });
        </script>

    </body>
</html>