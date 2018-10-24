<?php 
include_once "../../config.php";
if(!isset($_SESSION[$appID."admin"])){
  header('location:'.$pathAPP.'logout.php');
} 

$pages = 1;
if(isset($_GET["pages"])){
  $pages = $_GET["pages"]; 
}

$condition = "";
if(isset($_GET["condition"])){
  $condition = $_GET["condition"]; 
}

$query = $conn->prepare("select count(a.id)
                        from agreement b
                        inner join users c on b.users = c.id 
                        inner join person a on c.person = a.id
                        where concat(a.firstName, ' ', a.lastName) like :condition ");
$query->execute(array(
  "condition" => "%" . $condition . "%" 
));
$totalAgreements = $query->fetchColumn();
$totalPages = ceil($totalAgreements / 10); 
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
  <style>
    #export {
          color: blue; 
          size: 2rem; 
        }
    #export:hover {
          text-decoration: underline; 
        }
  </style>
  </head>
  <body>

  <?php include_once "../../template/navigation.php"; ?><br>

    <!-- prepare sql query, execute, fetch as object and display the result  -->
  <?php
   $query =  $conn->prepare("SELECT a.id, concat(c.firstName, ' ', c.lastName) as person,  a.orderDate, a.serviceDate,
                            concat(a.city, '-',a.adress) as adress, f.squadColor, (d.priceCoeficient * e.price) as total,
                            e.serviceName, d.levelName
                            from agreement a
                            inner join users b on a.users = b.id
                            inner join person c on b.person = c.id
                            inner join cleanlevel d on a.cleanlevel = d.id
                            inner join services e on a.services = e.id
                            inner join squad f on a.squad = f.id
                            where concat(c.firstName, ' ', c.lastName, ' ', a.orderDate, ' ', concat(a.city, '-',a.adress)) like :condition
                            and a.checked = 1
                            order by total desc
                            limit :pages, 10"
                            ); 
   $query->bindValue("pages", ($pages * 10) - 10, PDO::PARAM_INT);
   $query->bindValue("condition", "%" . $condition . "%");
   $query->execute(); 
   $result = $query->fetchAll(PDO::FETCH_OBJ);
  ?>

 <div class="container">
    <h3>Agreements</h3><hr>
    <a href="new.php" class="btn btn-success mb-3">Create new</a><br>
    
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>">
      <div class="form-group">
            <label for="condition"></label>                    
            <input type="text" class="form-control" name="condition" id="condition" value="<?php echo $condition; ?>">
        </div>
            <input type="submit" class="btn btn-primary btn-md btn-block" name="find" value="Search">
    </form>
    <table class="table table-striped">
          <thead>
            <tr>
              <th>Person</th>
              <th>Order date</th>
              <th>Service date</th>
              <th>Adress</th>
              <th>Squad</th>
              <th>Total amount</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($result as $row): ?>
              <tr>
                <td><?php echo $row->person; ?></td>
                <td><?php echo $row->orderDate; ?></td>
                <td><?php echo $row->serviceDate; ?></td>
                <td><?php echo $row->adress; ?></td>
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
      <a href="exportPDF.php" id="export">Export PDF</a>
      <div class="row justify-content-center">
        <?php
          if($totalPages == 0){
            $totalPages = 1; 
          }
        ?>
        <nav aria-label="pagination">
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="index.php?pages=<?php echo $pages-1;?>">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#"><?php echo $pages.'/'.$totalPages;?></a></li>
            <li class="page-item"><a class="page-link" href="index.php?pages=<?php echo $pages+1;?>">Next</a></li>
          </ul>
        </nav>
      </div>
</div>
    <?php include_once "../../template/scripts.php"; ?>

    <?php include_once "../../template/footer.php"; ?>
  
  </body>
</html>
