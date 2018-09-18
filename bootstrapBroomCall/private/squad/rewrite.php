<?php 
include_once "../../config.php"; 

if(!isset($_SESSION[$appID."admin"])){
    header('location:'.$pathAPP.'logout.php');
}

if(!isset($_GET["id"]) && !isset($_POST["change"])){
    header('location:'.$pathAPP.'logout.php');
}



if(isset($_POST["change"])){
    $query = $conn->prepare("update squad set squadNumber=:squadNumber, squadColor=:squadColor where id=:id;"); 
    unset($_POST["change"]);
    $query->execute($_POST);
    header("location: index.php"); 
}else{
    $query = $conn->prepare("select * from squad where id=:id");
    $query->execute($_GET);
    $result = $query->fetch(PDO::FETCH_OBJ);  
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
  <!-- Form for creating new  -->
<div class="container">
<h3>Rewrite squad</h3><hr>
    <div class="row justify-content-md-center"> 
                <form class="" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                    <div class="form-group">
                        <label for="squadNumber">Squad number</label>
                        <input type="number" class="form-control" value="<?php echo $result->squadNumber;?>" name="squadNumber">
                    </div>
                    <div class="form-group">
                        <label for="price">Squad color</label>
                        <input type="color" class="form-control" name="squadColor" value="<?php echo $result->squadColor;?>">
                    </div>
                        <input type="hidden" name="id" value="<?php echo $result->id ?>" />
                        <input type="submit" name="change" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-danger">Cancel</a>
                        <hr>
                        <input type="text" autocomplete="off" class="form-control" placeholder="Enter name or last name to move employee into squad <?php echo $result->squadNumber;?>" id="condition" name="condition">
                        <table class="table table-striped">
                            <?php
                                $query=$conn->prepare("select b.id as employeeID, 
                                                        concat(a.firstName, ' ',a.lastName) as person,
                                                        a.email
                                                        from person a 
                                                        inner join employees b on a.id = b.person
                                                        inner join squad c on c.id = b.squad
                                                        where squad = :squad
                                                        order by a.lastName, a.firstName");

                                $query->execute(array(
                                    "squad" => $_GET["id"]));
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
                                    <td> <?php echo $row->person?> </td>
                                    <td> <?php echo $row->email?> </td>
                                    <td> <i id="s_<?php echo $row->employeeID;?>" class="fas fa-2x fa-trash-alt text-danger delete"></i> </td>
                                </tr>
                                <?php endforeach;   ?>
                            </tbody>
                        </table>
                </form>
    </div>
</div>
  <?php include_once "../../template/scripts.php"; ?>
  <?php include_once "../../template/footer.php"; ?>
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
                data: "squad=<?php echo $_GET["id"];?>&employeeID="+employee.employeeID,
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