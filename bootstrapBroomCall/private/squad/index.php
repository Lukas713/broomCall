<?php 
include_once "../../config.php";
if(!isset($_SESSION[$appID."admin"])){
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
   $query =  $conn->prepare("select a.id, a.squadNumber, a.squadColor, count(b.id) as numberOfMembers
                            from squad a
                            left outer join employees b
                            on a.id = b.squad
                            group by a.squadNumber
                            order by numberOfMembers DESC;"
                          );
   $query->execute(); 
   $result = $query->fetchAll(PDO::FETCH_OBJ); 

  ?>

 <div class="container">
    <h3>Squads</h3><hr>
    <a href="new.php" class="btn btn-success mb-3">Create new</a>

    <table class="table table-striped">
          <thead>
            <tr>
              <th>Squad Number</th>
              <th>Squad Color</th>
              <th>Number of members</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($result as $row): ?>
              <tr>
                <td><?php echo $row->squadNumber; ?></td>
                <td><?php echo ($row->id == 4) ? '<i class="far fa-circle"' : '<i class="fas fa-circle ?>';?><i class="fas fa-circle" style="color:<?php echo $row->squadColor?>"></i></</td>
                <td><?php echo $row->numberOfMembers; ?></td>
                <td>
                  <a onclick="return confirm('Delete -><?php echo $row->squadNumber; ?>?')" href="delete.php?id=<?php echo $row->id; ?>">
                  <i class="fas fa-2x fa-trash-alt text-danger"></i>
                </a>  
                  <a href="rewrite.php?id=<?php echo $row->id; ?>"><i class="fas fa-2x text-dark fa-edit"></i></a>
                </td>
              </tr>
          <?php endforeach; ?>
          </tbody>
      </table>
</div>
    <?php include_once "../../template/footer.php"; ?>
    <?php include_once "../../template/scripts.php"; ?>                      
  </body>
</html>
