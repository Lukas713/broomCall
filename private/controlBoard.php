<?php include_once "../config.php"; ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once "../template/head.php"; ?>
  </head>
  <body>

    <?php include_once "../template/navigation.php"; ?>  

          Control board
          <?php print_r($_SESSION);  ?>
    <?php include_once "../template/scripts.php"; ?>

    <?php include_once "../template/footer.php"; ?>
  
  </body>
</html>
