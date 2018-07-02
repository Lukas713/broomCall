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
      session_start(); 
      echo $_SESSION["operater"].'<br>'; 
    ?>
    CRUD BOARD

    <?php include_once "../template/footer.php" ?>

    <?php include_once "../template/skripts.php" ?>
  </body>
</html>
