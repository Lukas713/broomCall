<?php include_once "../config.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once "../template/head.php"; ?>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <style>
            .noImage:hover {
                cursor: pointer;
            }
        </style>
    </head>

    <body>
        <?php include_once "../template/navigation.php"; ?>
        <br>
        <div class="container">
            <h3>Pending agreements</h3><hr>
                <?php
                $query = $conn->prepare("SELECT a.id, concat(c.firstName, ' ', c.lastName) as person, a.approved, a.orderDate, a.city, a.adress, b.phoneNumber, d.levelName, d.priceCoeficient, e.serviceName, e.price, (d.priceCoeficient * e.price) as total
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
                                        <li><b>Date and time: </b><?php echo $row->orderDate; ?></li>
                                        <li><b>Adress: </b><?php echo $row->city.', '.$row->adress; ?></li>
                                        <li><b>Phone: </b> <?php echo $row->phoneNumber; ?></li>
                                        <li><b>Clean level: </b><?php echo $row->levelName.': '.$row->priceCoeficient; ?></li>
                                        <li><b>Service: </b><?php echo $row->serviceName.': '.$row->price; ?> €</li>
                                        <li><b>Chose squad:</b></li>
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
                                        <?php if(file_exists('../img/agreementImages/' . $row->id . '.jpg')):?>
                                        <li>
                                        <button class="btn btn-info" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-2x fa-image"></i></button>
                                        <?php include_once "imageModal.php"; ?>
                                        </li>
                                        <?php else: ?>
                                        <li><button class="btn btn-danger noImage" disabled><i class="fas fa-2x fa-times-circle" title="There is no image"></i></button></li> 
                                        <?php endif; ?>
                                    </ul>   
                                </div>
                            </div>
                    </div>
                    <?php endforeach;?> 
                </div>
        </div>           
        <?php include_once "../template/footer.php"; ?>
        <?php include_once "../template/scripts.php"; ?>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="../js/jquery.elevatezoom.js"></script>
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

            $(function() {
                $(document).tooltip();
            } );

            $("#zoom_08").elevateZoom({
                zoomWindowFadeIn: 500,
                zoomWindowFadeOut: 500,
                lensFadeIn: 500,
                lensFadeOut: 500
            });
    </script>
    </body>
</html>