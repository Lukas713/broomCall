<?php 
include_once "../../config.php";
if(!isset($_SESSION[$appID."operater"])){
  header('location:'.$pathAPP.'logout.php');
} 

?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
  <?php include_once "../../template/head.php"; ?>
  </head>
  <body>

  <?php include_once "../../template/navigation.php"; ?><br>

    <!-- prepare sql query, execute, fetch as object and display the result  -->
  <?php
   $query =  $conn->prepare("select * from cleanLevel a;");
   $query->execute(); 
   $result = $query->fetchAll(PDO::FETCH_OBJ); 

  ?>
  <h3>Clean levels</h3><hr>
  <div class="grid-container"> 
  <a href="new.php" class="button">Create new</a> 
  <div class="grid-x grid-margin-x">
      <table>
        <thead>
          <tr>
            <th>Level name</th>
            <th>Price coefficient</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($result as $row): ?>
            <tr>
              <td><?php echo $row->levelName; ?></td>
              <td><?php echo $row->priceCoeficient; ?></td>
              <td>
              <a onclick="return confirm('Delete -><?php echo $row->levelName; ?>?')" href="delete.php?id=<?php echo $row->id; ?>">
               <i class="fas fa-2x fa-trash-alt"></i>
              </a>  
                <a href="rewrite.php?id=<?php echo $row->id; ?>"><i class="fas fa-2x fa-edit"></i></a>
              </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
  </div>
</div>
  <?php include_once "../../template/scripts.php"; ?>

  <?php include_once "../../template/footer.php"; ?>
  
  </body>
</html>
