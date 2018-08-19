<?php include_once "../config.php"; ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once "../template/head.php"; ?>
  </head>
  <body>

    <?php include_once "../template/navigation.php"; ?>  
    <br> <hr>
          <div class="grid-container">
            <!-- prepare sql query, execute, fetch as object and display the result  -->
            <?php
            $query =  $conn->prepare("select * from users where ;");
            $query->execute(); 
            $result = $query->fetchAll(PDO::FETCH_OBJ); 

            
            ?>
          </div>

          <div class="grid-container"> 
  <h3>Users</h3><hr> 
  <div class="grid-x grid-margin-x">
      <table>
        <thead>
          <tr style="color:#1779ba;">
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($result as $row): ?>
            <tr>
              <td><?php echo $row->firstName; ?></td>
              <td><?php echo $row->lastName; ?></td>
              <td><?php echo $row->email; ?></td>
              <td><?php echo $row->phoneNumber; ?></td>
              <td>
              <a onclick="return confirm('Delete -><?php echo $row->firstName; ?>?')" href="delete.php?id=<?php echo $row->id; ?>">
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
    <?php include_once "../template/scripts.php"; ?>

    <?php include_once "../template/footer.php"; ?>
  
  </body>
</html>
