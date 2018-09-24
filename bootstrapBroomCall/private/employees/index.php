<?php 
include_once "../../config.php";
if(!isset($_SESSION[$appID."admin"])){
  header('location:'.$pathAPP.'logout.php');
} 

$pages = 1;
if(isset($_GET["pages"])){
  $pages = $_GET["pages"]; 
}

$query = $conn->prepare("select count(a.id) 
                        from employees a
                        inner join person b 
                        on a.person = b.id"
                      );
$query->execute();
$totalEmployees = $query->fetchColumn();
$totalPages = ceil($totalEmployees / 10); 
if($pages > $totalPages){
  $pages = $totalPages; 
}

if($pages == 0){
  $pages = 1;
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
                            left outer join squad d on d.id=b.squad limit :pages,10"
                          ); 
   $query->bindValue("pages", ($pages * 10) - 10, PDO::PARAM_INT);
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
      <div class="row justify-content-center">
        <?php
          if($totalPages == 0){
            $totalPages = 1; 
          }
        ?>
        <nav aria-label="pagination">
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="index.php?pages=<?php echo $pages-1;?>">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="index.php?pages=<?php echo $pages+1;?>">Next</a></li>
          </ul>
        </nav>
      </div>
</div>
    <?php include_once "../../template/scripts.php"; ?>

    <?php include_once "../../template/footer.php"; ?>
  
  </body>
</html>
