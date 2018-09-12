<?php 
include_once "../../config.php"; 

if(!isset($_SESSION[$appID."operater"])){
    header('location:'.$pathAPP.'logout.php');
}

if(!isset($_GET["id"]) && !isset($_POST["change"])){
    header('location:'.$pathAPP.'logout.php');
}



if(isset($_POST["change"])){
    $query = $conn->prepare("update department set depName=:depName where id=:id;"); 
    unset($_POST["change"]);
    $query->execute($_POST);
    header("location: index.php"); 
}else{
    $query = $conn->prepare("select * from department where id=:id");
    $query->execute($_GET);
    $result = $query->fetch(PDO::FETCH_OBJ);  
}



?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
        <?php include_once "../../template/head.php"; ?>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <style>
            .delete:hover{
                cursor:pointer; 
            }
        </style>
  </head>
  <body>

  <?php include_once "../../template/navigation.php"; ?><br>
  <!-- Form for creating new  -->
<div class="container">
    <div class="row justify-content-center">
                <form class="" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                    <div class="form-group">
                        <label for="depName">Department name</label>
                        <input type="depName" class="form-control" value="<?php echo $result->depName;?>" name="depName" >
                    </div>
                    <br>
                        <input type="hidden" name="id" value="<?php echo $result->id ?>" />
                        <input type="submit" name="change" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-danger">Cancel</a>
                        <hr>
                            <input type="text" autocomplete="off" class="form-control" placeholder="Enter name or last name to move employee into <?php echo $result->depName;?>" id="condition" name="condition">
                        <table class="table table-striped">
                            <?php
                                $query=$conn->prepare("select b.id as employeeID, concat(a.firstName, ' ', a.lastName) as person, a.email
                                                        from person a
                                                        inner join employees b on a.id = b.person
                                                        inner join department c on c.id = b.department
                                                        where department = :department 
                                                        order by a.lastName, a.firstName");

                                $query->execute(array(
                                    "department" => $_GET["id"]));
                                $result = $query->fetchAll(PDO::FETCH_OBJ); 
                            ?>
                            <thead>
                                <tr>
                                    <th>Person</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="data">
                                <?php foreach($result as $row):?>
                                <tr>
                                    <td> <?php echo $row->person; ?> </td>
                                    <td> <?php echo $row->email; ?> </td>
                                    <td> <i id="s_<?php echo $row->employeeID;?>" class="fas fa-2x fa-trash-alt text-danger delete"></i> </td>
                                </tr>
                                <?php endforeach;   ?>
                            </tbody>
                        </table>
                    </form>
        </div><hr>
</div>

 <?php include_once "../../template/footer.php"; ?>
 <?php include_once "../../template/scripts.php"; ?>


  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
    $("#condition").autocomplete({
        source:"jQuery/findEmployee.php?id=<?php echo $_GET["id"];?>",
        focus: function(event,ui){
    			event.preventDefault();
    	},
    	select: function(event,ui){
    			event.preventDefault();
                saveRecord(ui.item);
    	}
      }).data("ui-autocomplete")._renderItem=function(ul,objekt){
        return $("<li>").append("<a>" + objekt.firstName + " " + objekt.lastName + "</a>").appendTo(ul); 
        }

    function saveRecord(employee){
        $.ajax({
            type: "POST",
            url: "jQuery/addEmployee.php",
            data: "department=<?php echo $_GET["id"];?>&employeeID="+employee.employeeID,
            success: function(serverReturn){
                if(serverReturn === "good job"){
                    $("#data").append("<tr>" + 
                    "<td>" + employee.firstName + "</td>" + 
                    "<td>" + employee.lastName + "</td>" +
                    "<td>" + '<i id="s_"' + employee.employeeID + ' class="fas fa-2x fa-trash-alt text-danger delete" style="color: red;"></i></td>' + 
                    + '</tr>');
                    deleteRecord();
                } 
            }
        });
    }

    function deleteRecord(){
        $(".delete").click(function(){
            var x = $(this);
          $.ajax({
            type: "POST",
            url: "jQuery/deleteEmployee.php",
            data: "employeeID="+x.attr("id").split("_")[1],
            success: function(serverReturn){
              if (serverReturn === "good job"){
                x.parent().parent().remove();
              }
              
            }
          });
        });
      }

      deleteRecord();
  </script>


  </body>
</html>