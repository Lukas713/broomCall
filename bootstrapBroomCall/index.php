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
        /**
        on submiting form
         */
        $("#agreementForm").submit(function( event ) {
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
            $.each(array, function( index, value ) {
                error[index] = errorHanding(value);
                if(error[index] != ""){
                    event.preventDefault(); //dont close modal
                    return false;
                }
                return true; //close moda, evrything is fine
            }); 
            
            //if there is errors in array
            var div = new Array();
            var tekst = new Array();

            if(error[0] != ""){ //create invalid class and apend it to cityControl id
                div[0] = document.createElement("div");
                $("#city").addClass("is-invalid");
                tekst[0] = document.createTextNode(error[0]);
                div[0].appendChild(tekst[0]);
                div[0].setAttribute("class", "invalid-feedback");
                $("#cityControl").append(div[0]);  
            }
            if(error[1] != ""){
                div[1] = document.createElement("div");
                $("#adress").addClass("is-invalid");
                tekst[1] = document.createTextNode(error[0]);
                div[1].appendChild(tekst[1]);
                div[1].setAttribute("class", "invalid-feedback");
                $("#adressControl").append(div[1]);
            }
            if(error[2] != ""){
                div[2] = document.createElement("div");
                $("#services").addClass("is-invalid");
                tekst[2] = document.createTextNode(error[0]);
                div[2].appendChild(tekst[2]);
                div[2].setAttribute("class", "invalid-feedback");
                $("#servicesControl").append(div[2]);
            }
            if(error[3] != ""){
                div[3] = document.createElement("div");
                $("#cleanLevel").addClass("is-invalid");
                tekst[3] = document.createTextNode(error[0]);
                div[3].appendChild(tekst[3]);
                div[3].setAttribute("class", "invalid-feedback");
                $("#cleanLevelControl").append(div[3]);
            }

        });
        </script>

    </body>
</html>