<?php
include_once "../../config.php";

if(isset($_SESSION["admin"]) || !isset($_POST["chartID"])){
    return;
}

         
if($_POST["chartID"] == 1){

    $query = $conn->prepare("select b.levelName as o, count(a.cleanLevel) as y,
                            (count(a.cleanLevel)/(select count(cleanLevel) from agreement)) * 100 as x
                            from agreement a
                            inner join cleanLevel b on a.cleanLevel = b.id
                            group by o"
                            );

}else if($_POST["chartID"] == 2){

    $query = $conn->prepare("select a.services as o, count(a.services) as y,
                            (count(a.services)/(select count(services) from agreement)) * 100 as x
                            from agreement a
                            inner join services b on a.services = b.id
                            group by o"
                            );  
}else {

    $query = $conn->prepare("select a.squad as o, count(a.squad) as y,
                            (count(a.squad)/(select count(squad) from agreement)) * 100 as x
                            from agreement a
                            inner join squad b on a.squad = b.id
                            group by o"
                            );
}

$query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
echo json_encode($result, JSON_NUMERIC_CHECK); 

?>