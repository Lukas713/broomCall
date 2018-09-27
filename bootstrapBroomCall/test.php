<?php


$hash = password_hash("a",PASSWORD_BCRYPT,array("cost"=>12));

if($hash==password_verify("a",$hash)){
    echo "OK";
}

echo "<hr>"; 

echo date("Y-m-d H:i:s");


echo "<hr>";