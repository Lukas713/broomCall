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
   $query =  $conn->prepare("SELECT b.id, concat(a.firstName, ' ', a.lastName) as person, a.email, b.phoneNumber, c.depName, d.squadColor, b.squad
                            from person a 
                            inner join employees b on a.id=b.person
                            left outer join department c on c.id=b.department
                            left outer join squad d on d.id=b.squad"
                          ); 
   $query->execute(); 
   $result = $query->fetchAll(PDO::FETCH_OBJ); 
    
  ?>

 <div class="container">
    <h3>Employees</h3><hr>
    <a href="new.php" class="btn btn-success mb-3">Create new</a>

    <table class="table table-striped">
          <thead>
            <tr>
              <th>Person</th>
              <th>Email</th>
              <th>Phone number</th>
              <th>Department</th>
              <th>Squad</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($result as $row): ?>
              <tr>
                <td><?php echo $row->person; ?></td>
                <td><?php echo $row->email; ?></td>
                <td><?php echo $row->phoneNumber; ?></td>
                <td><?php echo $row->depName; ?></td>
                   <?php if($row->squad === null): ?>
                <td></td> 
                        <?php else:?>
                <td><?php echo ($row->squad == 4) ? '<i class="far fa-circle"' : '<i class="fas fa-circle ?>';?><i class="fas fa-circle" style="color:<?php echo $row->squadColor?>"></i></td>
                        <?php endif; ?>
                <td>
                  <a onclick="return confirm('Are you sure?')" href="delete.php?id=<?php echo $row->id; ?>">
                    <i class="fas fa-2x fa-trash-alt text-danger"></i>
                  </a>  
                  <a href="rewrite.php?id=<?php echo $row->id; ?>">
                    <i class="fas fa-2x text-dark fa-edit"></i>
                  </a>
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
