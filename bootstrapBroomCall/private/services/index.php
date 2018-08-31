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
   $query =  $conn->prepare("select * from services"); 
   $query->execute(); 
   $result = $query->fetchAll(PDO::FETCH_OBJ); 
    
  ?>

 <div class="container">
    <h3>Services</h3><hr>
    <a href="new.php" class="btn btn-success mb-3">Create new</a>

    <table class="table table-striped">
          <thead>
            <tr>
              <th>Service name</th>
              <th>Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($result as $row): ?>
              <tr>
                <td><?php echo $row->serviceName; ?></td>
                <td><?php echo $row->price; ?> €</td>
                <td>
                  <a onclick="return confirm('Delete -><?php echo $row->serviceName; ?>?')" href="delete.php?id=<?php echo $row->id; ?>">
                  <i class="fas fa-2x fa-trash-alt text-danger"></i>
                </a>  
                  <a href="rewrite.php?id=<?php echo $row->id; ?>"><i class="fas fa-2x text-dark fa-edit"></i></a>
                </td>
              </tr>
          <?php endforeach; ?>
          </tbody>
      </table>
</div>
    <?php include_once "../../template/scripts.php"; ?>

    <?php include_once "../../template/footer.php"; ?>
  
  </body>
</html>
