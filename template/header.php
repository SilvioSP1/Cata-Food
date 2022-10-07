<?php
error_reporting(0);
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
include("../../Cata-food/admin/config/config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cata Food</title>
  <!-- CSS only Bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

  <!-- CSS -->
  <link rel="stylesheet" href="../../Cata-Food/css/estilos.css?v=<?php echo time(); ?>">

  <!-- animation css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css?v=<?php echo time(); ?>" />

  <link rel="icon" href="../../Cata-Food/img/index/logo_redondo.png">


</head>


<body class="boiler">

  <main>



    <div id="app">

      <!-- NAV -->
      <header class="nav sticky-top">
        <a href="../../Cata-Food/index.php"><img src="../../Cata-Food/img/index/logo_small.png" alt="" class="logoCata"></a>
        <div class="menu_toggle">
          <span class="fa fa-list"></span>
        </div>
        <nav>
          <ul>
            <li><a href="../../Cata-Food/secciones/restaurantes.php" class="item_nav"><i class="fa-solid fa-bowl-food"></i> Restaurantes</a></li>
            <li><a href="../../Cata-Food/secciones/sobre_nosotros.php" class="item_nav"><i class="fa-solid fa-people-arrows"></i> Sobre Nosotros</a></li>
            <?php if($_SESSION['usuario'] != "Sin Loguearse"){ ?>
              <li><a href="../../Cata-Food/secciones/inicio_registro.php" class="item_nav"><i class="fa-solid fa-arrow-right-to-bracket"></i> Perfil</a></li>
              <li><a href="../../Cata-Food/admin/secciones/cerrar.php" class="item_nav"><i class="fa-solid fa-arrow-right-to-bracket"></i> Cerarr</a></li>
              <?php if($_SESSION['idRol'] == 3){ ?>
                <li><a href="../../Cata-Food/admin/index.php" class="item_nav"><i class="fa-solid fa-unlock"></i> Modo Admin</a></li>                                       
                <?php } ?>
                <li><a href="#" class="item_nav carritoCompras"><i class="fa-solid fa-cart-shopping"></i> Carrito <span>0</span></a></li>
                <li><a href="../../Cata-Food/secciones/registrar_negocio.php" class="item_nav"><i class="fa-solid fa-shop"></i> Iniciar/Registra tu negocio</a></li>
            <?php }else{?>
                  <li><a href="../../Cata-Food/secciones/inicio_registro.php" class="item_nav"><i class="fa-solid fa-arrow-right-to-bracket"></i> Inicio/Registro</a></li>
            <?php } ?>
          </ul>
          <!-- <div class="contenedorIcono">
            <img src="./img/Cata_Food__1.png" alt="" class="cataIcono">
          </div> -->
        </nav>
      </header>
      <!-- NAV -->

      <!-- CONTEINER -->



      <section class="containerSection">