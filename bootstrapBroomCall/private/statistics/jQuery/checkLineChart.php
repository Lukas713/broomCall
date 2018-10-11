<?php
include_once "../../../config.php";

if(isset($_SESSION["admin"])){
    return;
}

$query = $conn->prepare("select (b.priceCoeficient * c.price) as data
                        from agreement a
                        inner join cleanlevel b on a.cleanLevel = b.id
                        inner join services c on a.services = c.id
                        order by data");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);

echo json_encode($result); 
?>