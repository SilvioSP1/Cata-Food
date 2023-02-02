<?php
session_start();
error_reporting(0);

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
<!doctype html>
<html lang="en">
  <head>
    <title>Cata Food Admin</title>
    <meta name="google" content="notranslate">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <link rel="icon" href="../../img/index/logo_redondo2.png">
    
  </head>
  <body>

    <?php $url="http://".$_SERVER['HTTP_HOST']."/Cata-food" ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="--bs-navbar-padding-y: 1.5rem;">
        <div class="container">
            <a class="navbar-brand" href="#">Cata Food Administrador</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="admin/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="admin/secciones/locales.php">Locales</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="admin/secciones/productos.php">Productos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="admin/secciones/usuarios.php">Usuarios</a>
                    </li>
                    <li class="nav-item dropdown">
                        <!-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            View More
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Web Development</a></li>
                            <li><a class="dropdown-item" href="#">Web Designing</a></li>
                            <li><a class="dropdown-item" href="#">Android Development</a></li>
                        </ul> -->
                    </li>
                    <li class="nav-item">
                        <!-- <a class="nav-link" href="#">Contact Us</a> -->
                    </li>
                </ul>
                <div class="d-flex">
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" name="perfil" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="bi bi-person-circle"></i>    
                          Perfil
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="#"><?php echo $nombreUsuario; ?></a></li>
                            <li><a class="dropdown-item" href="../../Cata-Food/admin/secciones/cerrar.php">Cerrar Sesion</a></li>
                            <?php if($_SESSION['idRol'] == 3){ ?>
                              <li><a class="dropdown-item" href="<?php echo $url; ?>">Ver sitio</a></li>                                       
                            <?php } ?>
                        </ul>
                    </div>
                    <a class="btn btn-light ms-3" href="../index.php">Login/Sing up</a>
                </div>
            </div>
        </div>
    </nav>

    
    
    <div class="container">
        <br>
        <div class="row">