<?php

$host="localhost";
$bd="u711454834_catafood123";
$usuario="u711454834_root";
$contraseña="Silvioportero12";

try {

    $conexion= new PDO("mysql:host=$host;dbname=$bd",$usuario,$contraseña);
   
} catch (Exception $ex) {
    echo $ex->getMessage();
}

?>