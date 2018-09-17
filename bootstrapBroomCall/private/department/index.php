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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  </head>
  <body>

  <?php include_once "../../template/navigation.php"; ?><br>

    <!-- prepare sql query, execute, fetch as object and display the result  -->
  <?php
   $query =  $conn->prepare("select a.id, a.depName, count(b.id) as numberOfEmployees 
                              from department a
                              left outer join employees b 
                              on a.id = b.department
                              group by a.depName
                              order by numberOfEmployees DESC"
                            );
   $query->execute(); 
   $result = $query->fetchAll(PDO::FETCH_OBJ); 

  ?>

 <div class="container">
    <h3>Department</h3><hr>
    <a href="new.php" class="btn btn-success mb-3">Create new</a>

    <table class="table table-striped">
          <thead>
            <tr>
              <th>Department</th>
              <th>Number of employees</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($result as $row): ?>
              <tr>
                <td><?php echo $row->depName; ?></td>
                <td><?php echo '<span class="employees" id="s_'.$row->id.'">'.$row->numberOfEmployees.'</span>'; ?></td>
                <td>
                  <a onclick="return confirm('Delete -><?php echo $row->depName; ?>?')" href="delete.php?id=<?php echo $row->id; ?>">
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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
      $(".employees").click(function(){
        var id = $(this).attr("id").split("_")[1];
        console.log(id); 
      });

      var employees;
      var department;
      function define(){
        $(document).tooltip({
          items: ".employees",
          content: function(){
            employees = parseInt($(this).html());
            department = $(this).attr("id").split("_")[1]; 
            return "Loading..."; 
          },
          open: function(evt, ui){
            var elem = $(this);
            $.ajax({
              type: "GET",
              url: "jQuery/listOfEmployees.php",
              data: "department="+department,
              success: function(serverReturn){
                elem.tooltip('option', 'content', serverReturn);

                if(employees > 7){
                  var div = $(".ui-tooltip-content").first();
                  offset = div.offset();
                  direction = "down";
                  stop = false;
                  scroll(); 
                }
              }
            });
          },
          tooltipClass: "custom-tooltip-styling",
          position: { 
            my: "left center", 
            at: "right center" 
            }
        });
      }

    define();
    var stop;
    $(".employees").mouseout(function(){
        $(document).tooltip("destroy");
        define();
        stop = true; 
    });

    var offset;
    var direction;
    function scroll(){
      if(direction==="down"){
        offset.top=offset.top-1;
      }else{
        offset.top=offset.top+1;
      }
      
      var div = $(".ui-tooltip-content").first();
        console.log(offset.top);
        if(offset.top<280){
          direction="up";
        }else if(offset.top>415){
          direction="down";
        }

        $(div).offset({ top: offset.top, left: offset.left});
          if(!stop){
            setTimeout(() => {
            scroll();
          }, 100);
          }
    }


    </script>
  
  </body>
</html>
