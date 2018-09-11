<?php 
include_once "../../config.php"; 

if(!isset($_SESSION[$appID."operater"])){
    return;
}

if(!isset($_GET["term"])){
    return;
}

$query=$conn->prepare("select b.id as employeeID, a.firstName, a.lastName, a.email
                        from person a 
                        inner join employees b on a.id=b.person
                        where concat(a.firstName, ' ', a.lastName) like :condition
                        and b.department != :department
                        order by a.lastName, a.firstName
                        limit 10;");
$query->execute(array(
    "condition" => "%" . $_GET["term"] . "%",
    "department" => $_GET["id"]
));
$result = $query->fetchAll(PDO::FETCH_OBJ);
echo json_encode($result);
 


?>
