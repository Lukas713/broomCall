<?php include_once "../config.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once "../template/head.php"; ?>
    </head>

    <body>
        <?php include_once "../template/navigation.php"; ?>
        <br> <hr>
        <div class="grid-container">
        Control board
        <?php
            print_r($_SESSION);
        ?>
        </div>
        <?php include_once "../template/scripts.php"; ?>

        <?php include_once "../template/footer.php"; ?>
    </body>
</html>