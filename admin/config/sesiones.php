<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    $_SESSION['usuario'] = "Sin Loguearse";
    $_SESSION['nombreUsuario']="Sin login";
    header("Location:index.php");
}
else{
  if ($_SESSION['usuario']!=="Sin Loguearse") {
    $nombreUsuario = $_SESSION["nombreUsuario"];
  }
}

?>