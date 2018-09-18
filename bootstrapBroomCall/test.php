<?php


$hash = password_hash("a",PASSWORD_BCRYPT,array("cost"=>12));

if($hash==password_verify("a",$hash)){
    echo "OK";
}

echo "insert into person (firstName, lastName, email, passwrd, sysRole,) " . 
" values ('admin', 'admin','admin@admin.com','" . $hash . "','admin')";




