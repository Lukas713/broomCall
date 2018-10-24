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


 <div class="container">
    <h3>Employees</h3><hr>
    <a href="new.php" class="btn btn-success mb-3">Create new</a>

    <input type="text" class="form-control" id="condition"><br>
<a href="#" class="btn btn-primary btn-md btn-block" id="search">Search</a>

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
          <tbody id="data">
            
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
            <li class="page-item"><a class="page-link" href="" id="previous">Previous</a></li>
            <li class="page-item"><a class="page-link" href=""> <span id="current">da</span>/<span id="total"></span></a></li>
            <li class="page-item"><a class="page-link" href="" id="next">Next</a></li>
          </ul>
        </nav>
      </div>
</div>
    <?php include_once "../../template/footer.php"; ?>
    <?php include_once "../../template/scripts.php"; ?>
    <script>
      var page = 1 ;

$("#current").html(page); 

$("#next").click(function(){
  page ++ ;
  if(page > parseInt($("#total").html())){

    page = parseInt($("#total").html());
  }
  fetchData(page, $("#condition").val());
  return false; 
});

$("#previous").click(function(){
  page --;
  if(page == 0){
    page = 1;
  }
  fetchData(page, $("#condition").val()); 
  return false;
});

$("#search").click(function(){
  page = 1;

  fetchData(page, $("#condition").val()); 
  return false;
});

function fetchData(page, condition){
  $.ajax({
    type: "POST",
    url: "jQuery/findEmployee.php",
    data: "pages=" + page + "&condition=" + condition,
    success: function(serverReturn){
      var allWeNeed = JSON.parse(serverReturn);
      $("#total").html(allWeNeed.totalPages);

      var tbody = document.getElementById("data");
      while(tbody.firstChild){
        tbody.removeChild(tbody.firstChild);
      }
      $("#current").html(allWeNeed.totalPages);

      $.each(allWeNeed.data, function(key, value){
        var tr = document.createElement("tr"); 

        tr.appendChild(createTableData(value.firstName));
        tr.appendChild(createTableData(value.lastName));
        tr.appendChild(createTableData(value.email));
        tr.appendChild(createTableData(value.phoneNumber));
        var i = document.createElement("i");
        i.setAttribute("class", "fas fa-circle");
        i.style.color = value.squadColor;  //.css() is not working
        var td = document.createElement("td");
        td.appendChild(i);
        tr.appendChild(td); 
        

        td = document.createElement("td");
        var a = document.createElement("a");
        a.setAttribute("href", "rewrite.php?id=" + value.id);
        i = document.createElement("i");
        i.setAttribute("class", "fas fa-2x text-dark fa-edit");
        a.appendChild(i);
        td.appendChild(a);
      

        a = document.createElement("a");
        a.setAttribute("onclick","return confirm('Sure delete " + value.firstName + " " + value.lastName + " ?')");
        a.setAttribute("href", "delete.php?id=" + value.id);
        i = document.createElement("i");
        i.setAttribute("class","fas fa-2x fa-trash-alt text-danger");
        i.setAttribute("style","color: red;");
        a.appendChild(i);
        td.appendChild(a);
        tr.appendChild(td);


        tbody.appendChild(tr);
      })
    }

  });
}

fetchData(page, "");
  
  function createTableData(tekst){
    var td = document.createElement("td");
    var tekst = document.createTextNode(tekst==null ? "" : tekst);

    td.appendChild(tekst);
    return td;
  }
    </script>
  
  </body>
</html>
