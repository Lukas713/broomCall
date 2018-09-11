<?php 
include_once "../../config.php"; 

if(!isset($_SESSION[$appID."operater"])){
    return;
}

$query=$conn->prepare("select a.firstName, a.lastName
                        from person a
                        inner join employees b
                        on a.id = b.person");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
echo json_encode($result);
?>
