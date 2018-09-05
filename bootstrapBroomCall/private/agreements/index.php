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
   $query =  $conn->prepare("SELECT a.id, concat(c.firstName, ' ', c.lastName) as person,  a.serviceDate,
                               concat(a.city, '-',a.adress) as adress,
                                a.mark, f.squadColor, (d.priceCoeficient * e.price) as total,
                                e.serviceName, d.levelName
                                from agreement a
                                inner join users b on a.users = b.id
                                inner join person c on b.person = c.id
                                inner join cleanlevel d on a.cleanlevel = d.id
                                inner join services e on a.services = e.id
                                inner join squad f on a.squad = f.id
                                order by total desc"
                                ); 
   $query->execute(); 
   $result = $query->fetchAll(PDO::FETCH_OBJ); 
    
  ?>

 <div class="container">
    <h3>Agreements</h3><hr>
    <a href="new.php" class="btn btn-success mb-3">Create new</a>

    <table class="table table-striped">
          <thead>
            <tr>
              <th>Person</th>
              <th>Date and time</th>
              <th>Adress</th>
              <th>Mark</th>
              <th>Squad</th>
              <th>Total amount</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($result as $row): ?>
              <tr>
                <td><?php echo $row->person; ?></td>
                <td><?php echo $row->serviceDate; ?></td>
                <td><?php echo $row->adress; ?></td>
                <td><?php echo $row->mark; ?></td>
                <td><i class="fas fa-circle" style="color:<?php echo $row->squadColor?>"></i></td>
                <td title="<?php echo $row->serviceName."*".$row->levelName; ?>"><?php echo $row->total; ?></td> 
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
