<?php include_once "../config.php" ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once "../template/head.php" ?>
  </head>
  <body>
    <div class="grid-container">
      
    <?php include_once "../template/header.php" ?>

    <?php include_once "../template/navigation.php" ?>

   
    <?php
      if(isset($_SESSION["operator"])){
        echo $_SESSION["operator"].'<br>';
        echo $_SERVER["PHP_SELF"]; 
      } 
    ?>
    CRUD BOARD

    <?php include_once "../template/footer.php" ?>

    <?php include_once "../template/skripts.php" ?>
  </body>
</html>
