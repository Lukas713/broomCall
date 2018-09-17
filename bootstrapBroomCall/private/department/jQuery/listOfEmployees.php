<?php 
include_once "../../../config.php"; 

if(!isset($_SESSION[$appID."operater"])){
    return;
}

if(!isset($_GET["department"])){
    return;
}

$query = $conn->prepare("select a.firstName, a.lastName
                        from department c
                        inner join employees b on c.id = b.department
                        inner join person a on a.id = b.person
                        where c.id = :department");
$query->execute($_GET); 
$result = $query->fetchAll(PDO::FETCH_OBJ);

$x = 0;
echo '<div>';
foreach($result as $row){
    echo ++$x . " . " . $row->firstName . " " . $row->lastName . '</br>';
}
echo '</div>';