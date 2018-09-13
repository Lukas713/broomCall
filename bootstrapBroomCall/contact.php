<?php include_once "config.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once "template/head.php"; ?>
    </head>

    <body>
        <?php include_once "template/navigation.php"; ?>

        <div class="container">
            <div class="row">
                <div class="col-md">
                    <h3>Map</h3> <hr>
                        <div id="googleMap" style="width:100%;height:400px;"></div>
                         <hr>
                    </div>
            <div>
        </div>
        <br>
        <?php include_once "template/scripts.php"; ?>

        <?php include_once "template/footer.php"; ?>

    </body>
</html>