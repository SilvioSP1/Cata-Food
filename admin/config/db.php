<?php

$host="localhost";
$bd="u400786869_catafood";
$usuario="SilvioPortero";
$contraseña="SilvioPortero123";

try {

    $conexion= new PDO("mysql:host=$host;dbname=$bd",$usuario,$contraseña);
   
} catch (Exception $ex) {
    echo $ex->getMessage();
}

?>