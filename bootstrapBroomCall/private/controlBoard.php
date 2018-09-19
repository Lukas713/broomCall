<?php include_once "../config.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once "../template/head.php"; ?>
    </head>

    <body>
        <?php include_once "../template/navigation.php"; ?>
        <br>
        <div class="container">
            <h3>Pending agreements</h3><hr>
                <?php
                $query = $conn->prepare("SELECT a.id, concat(c.firstName, ' ', c.lastName) as person, a.approved, a.serviceDate, a.city, a.adress, b.phoneNumber, d.levelName, d.priceCoeficient, e.serviceName, e.price, (d.priceCoeficient * e.price) as total
                                            from agreement a
                                            inner join users b on a.users = b.id
                                            inner join person c on b.person = c.id
                                            inner join cleanlevel d on a.cleanlevel = d.id
                                            inner join services e on a.services = e.id
                                            where approved = false;");
                $query->execute();
                $result=$query->fetchAll(PDO::FETCH_OBJ);  
                ?>
                <div class="row justify-content-center">
                    <?php foreach($result as $row): ?>
                    <div class="card-deck mb-4 text-center">
                            <div class="card md-4 shadow-sm">
                                <div class="card-header">
                                    <h4 class="my-0 font-weight-normal"><?php echo $row->person;?></h4>
                                </div>
                                <div class="card-body">
                                    <h1 class="card-title pricing-card-title"><?php echo $row->total;?> €</h1>
                                    <ul class="list-unstyled mt-3 mb-4">
                                    <li><b>Date and time: </b><?php echo $row->serviceDate; ?></li>
                                    <li><b>Adress: </b><?php echo $row->city.', '.$row->adress; ?></li>
                                    <li><b>Phone: </b> <?php echo $row->phoneNumber; ?></li>
                                    <li><b>Clean level: </b><?php echo $row->levelName.': '.$row->priceCoeficient; ?></li>
                                    <li><b>Service: </b><?php echo $row->serviceName.': '.$row->price; ?> €</li>
                                    <li><b>Chose a squad:</b></li>
                                    <li>
                                        <div class="input-group mb-3 justify-content-center" id="approveItem">
                                            <?php
                                            
                                                $query = $conn->prepare("select * from squad");
                                                $query->execute();
                                                $result = $query->fetchAll(PDO::FETCH_OBJ); 
                                                foreach($result as $li){  
                                                    
                                                    if($li->squadNumber == 4){
                                                        echo "";
                                                    }else {
                                                        echo '<input type="button" class="btn btn-secondary squadColor" style=background-color:'.$li->squadColor.' value='.$li->squadNumber.' id='.$li->squadNumber.'-'.$row->id.'>';
                                                    }
                                                } 
                                            ?>
                                        </div>
                                    </li>
                                    </ul>   
                                </div>
                            </div>
                    </div>
                    <?php endforeach;?> 
                    </div> 
                </div>
        </div>           
        <?php include_once "../template/scripts.php"; ?>
        <?php include_once "../template/footer.php"; ?>

        <script>

            $(".squadColor").click(function(){
                var o = $(this); 
                var x = $(this).attr('id');
                x = x.split('-'); 

                $.ajax({
                    type: "POST",
                    url: "approveSquad.php",
                    data: "squadNumber=" + x[0] + "& agreementID=" + x[1], 
                    success: function(serverReturn){
                        if(serverReturn === "good job"){
                        
                            o.parent().parent().parent().parent().parent().remove(); 
                        }
                    }
                });

            });

            

        </script>
    </body>
</html>
