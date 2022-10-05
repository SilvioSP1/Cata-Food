<?php

session_start();
session_destroy();
session_start();
if (!isset($_SESSION['usuario'])) {
    $_SESSION['usuario'] = "Sin Loguearse";
    $_SESSION['nombreUsuario']="Sin login";
    header("Location:../../index.php");
}

?>