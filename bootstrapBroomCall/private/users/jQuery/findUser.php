<?php
include_once "../../../config.php"; 

if(!isset($_SESSION[$appID."admin"])){
    return;
}

$query = $conn->prepare("SELECT  b.id, a.firstName, a.lastName, a.email, b.phoneNumber, sum((d.priceCoeficient * e.price)) as total
                        from person a 
                        inner join users b on a.id=b.person
                        inner join agreement c on b.id = c.users
                        inner join cleanlevel d on d.id = c.cleanlevel
                        inner join services e on e.id = c.services
                        where concat(a.firstName, ' ', a.lastName) like :condition
                        group by b.id
                        order by total desc
                        limit :pages, 10");

$query->bindValue("condition", "%" . $_POST["condition"] . "%");
$query->bindValue("pages", ($_POST["pages"] * 10) - 10, PDO::PARAM_INT);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ); 

$query = $conn->prepare("select count(b.id) 
                        from users b
                        inner join person a on a.id = b.person
                        where concat(a.firstName, ' ', a.lastName) like :condition");
$query->execute(array(
    "condition" => "%" . $_POST["condition"] . "%"
));
$totalUsers = $query->fetchColumn();
$totalPages = ceil($totalUsers / 10);
if($totalPages == 0){
    $totalPages = 1;
}

$return = new stdClass();

$return->data = $result;
$return->totalPages = $totalPages;

echo json_encode($return); 
?>