<?php
include_once "../../../config.php";

if(isset($_SESSION["admin"])){
    return;
}

$query = $conn->prepare("select a.orderDate as o, (b.priceCoeficient * c.price) as t
                        from agreement a
                        inner join cleanlevel b on a.cleanLevel = b.id
                        inner join services c on a.services = c.id");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);

echo json_encode($result); 
?>