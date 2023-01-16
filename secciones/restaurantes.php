<?php include("../template/header.php"); ?>
<?php 
include("../admin/config/db.php");
error_reporting(0);

$sentenciaSQL = $conexion->prepare("SELECT * FROM local");
$sentenciaSQL->execute();
$listaLocales = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL = $conexion->prepare("SELECT * FROM tipo_local");
$sentenciaSQL->execute();
$listaTipoLocales = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL = $conexion->prepare("SELECT * FROM tipo_producto");
$sentenciaSQL->execute();
$listaTipoProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

if ($_POST) {
    $sentenciaSQL = $conexion->prepare("SELECT * FROM local WHERE Local_Tipo = :Local_Tipo");
    $sentenciaSQL->bindParam(':Local_Tipo',$_POST['TL_Tipo']);
    $sentenciaSQL->execute();
    $listaLocalesPorTipo = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
}



$articulo_x_pagina = 3;

//contar locales de nuestra base de datos

$total_locales_bd = Count($listaLocales);
//echo $total_locales_bd;
$paginas = $total_locales_bd/3;

$paginas = ceil($paginas);

//echo $paginas;


?>
<?php if ($mensaje !="") {?>
<div class="alert alert-success">
        <?php
            echo $mensaje;
        ?>
</div>
<?php } ?>
                <div class="conteiner_restaurantes">

                    

                    <div class="container-fluid" id="containerFiltro">
                        <div class="row justify-content-center g-2 containerColum">
                            <div class="col-3 columnas">
                                <div class="contenedorResTipo">
                                    <div class="tiposRes">
                                    <div aria-label="" class="tipo">
                                        <form class="tipo" action="restaurantes.php" method="POST">
                                        <input type="hidden" name="TL_Tipo" id="TL_Tipo" value="">
                                            <button name="btnAccion" type="submit" class="buttonTipo">
                                                <div class="circulo">
                                                    <img src="../img/restaurantes/categorias/"
                                                        aria-hidden="true" class="">
                                                </div>
                                                <div aria-hidden="true" class="sc-tl2hnw-0 hNbawF">Todos</div>
                                            </button>
                                        </form>
                                    </div>
                                    <?php foreach($listaTipoLocales as $tipoLocal) { ?>
                                        <div aria-label="" class="tipo">
                                        <form class="tipo" action="restaurantes.php" method="POST">
                                        <input type="hidden" name="TL_Tipo" id="TL_Tipo" value="<?php echo $tipoLocal['TL_Tipo']; ?>">
                                            <button name="btnAccion" type="submit" class="buttonTipo">
                                                <div class="circulo">
                                                    <img src="../img/restaurantes/categorias/<?php echo $tipoLocal['TL_Imagen']; ?>"
                                                        aria-hidden="true" class="">
                                                </div>
                                                <div aria-hidden="true" class="sc-tl2hnw-0 hNbawF"><?php echo $tipoLocal['TL_Tipo']; ?></div>
                                            </button>
                                        </form>
                                        </div>
                                    <?php } ?>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 columnas">
                                <div>
                                    <div class="contenedorBuscadorRes">
                                        <form class="d-flex containerMedias">
                                            <input class="form-control me-1 buscador" type="search"
                                            placeholder="🔍︎ Buscar " aria-label="Search" id="buscador">
                                        </form>
                                    </div>
                                    
                                    <?php 
                                    
                                        if(!$_GET){

                                            header('Location: ../../Cata-Food/secciones/restaurantes.php?pagina=1');

                                        }

                                        if($_GET['pagina']>$paginas || $_GET['pagina'] <= 0){

                                            header('Location: ../../Cata-Food/secciones/restaurantes.php?pagina=1');
                            
                                        }

                                        $iniciar = ($_GET['pagina']-1)*$articulo_x_pagina;

                                        $sql_articulos = $conexion->prepare("SELECT * FROM local LIMIT :iniciar,:nlocales");
                                        
                                        $sql_articulos->bindParam(':iniciar',$iniciar, PDO::PARAM_INT);
                                        $sql_articulos->bindParam(':nlocales',$articulo_x_pagina, PDO::PARAM_INT);

                                        $sql_articulos->execute();

                                        $resultado_articulos = $sql_articulos->fetchAll(PDO::FETCH_ASSOC);




                                    ?>

                                    <?php if (!empty($listaLocalesPorTipo)) {?>
                                        <?php foreach($listaLocalesPorTipo as $local) { ?>
                                        <?php if ($local['Local_Status'] == 1) { ?>
                                        <form class="container__CardRest" action="restaurante.php" method="POST">
                                            <input type="hidden" name="Local_Id" id="Local_Id" value="<?php echo openssl_encrypt($local['Local_Id'],cod,key); ?>">
                                            <button class="conteinerCardResta" name="btnAccion" type="submit">
                                                <img class="imagenRestaurante" src="../img/restaurantes/locales/<?php echo $local['Local_Imagen']; ?>"
                                                    alt="">
                                                <div class="contenedorTexto">
                                                    <p class="nombreRestaurante"><strong><?php echo $local['Local_Nombre']; ?></strong></p>
                                                    <p class="ubiRestaurante"><?php echo $local['Local_Ubicacion']; ?></p>
                                                    <h6>Clasificación</h6>
                                                    <div>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                    </div>
                                                </div>
                                            </button>
                                        </form>
                                        <?php } ?>
                                        <?php } ?>
                                    <?php }else{ ?>
                                        <?php foreach($resultado_articulos as $local) { ?>
                                        <?php if ($local['Local_Status'] == 1) { ?>
                                        <form class="container__CardRest" action="restaurante.php" method="POST">
                                            <input type="hidden" name="Local_Id" id="Local_Id" value="<?php echo openssl_encrypt($local['Local_Id'],cod,key); ?>">
                                            <button class="conteinerCardResta" name="btnAccion" type="submit">
                                                <img class="imagenRestaurante" src="../img/restaurantes/locales/<?php echo $local['Local_Imagen']; ?>"
                                                    alt="">
                                                <div class="contenedorTexto">
                                                    <p class="nombreRestaurante"><strong><?php echo $local['Local_Nombre']; ?></strong></p>
                                                    <p class="ubiRestaurante"><?php echo $local['Local_Ubicacion']; ?></p>
                                                    <h6>Clasificación</h6>
                                                    <div>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                    </div>
                                                </div>
                                            </button>
                                        </form>
                                        <?php } ?>
                                        <?php } ?>
                                    <?php } ?>


                                    <div class="d-flex justify-content-center align-items-center">

                                        <nav
                                            aria-label="Page navigation example">
                                            <ul class="pagination">

                                                <li class="page-item <?php echo $_GET['pagina']<=1? 'disabled' : '' ?>">
                                                <a class="page-link" href="../../Cata-Food/secciones/restaurantes.php?pagina=<?php echo $_GET['pagina']-1 ?> ">Anterior</a>
                                                </li>

                                                <?php for($i=0;$i<$paginas;$i++): ?>

                                                <li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : '' ?>">
                                                    <a class="page-link" href="../../Cata-Food/secciones/restaurantes.php?pagina=<?php echo $i+1 ?>"><?php echo $i+1 ?></a>
                                                </li>

                                                <?php endfor ?>


                                                <li class="page-item <?php echo $_GET['pagina']>=$paginas? 'disabled' : '' ?>">
                                                    <a class="page-link"href="../../Cata-Food/secciones/restaurantes.php?pagina=<?php echo $_GET['pagina']+1 ?> ">Siguiente</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>


                                </div>
                            </div>

                            <div class="col-3 columnas">
                                <div class="flexCategorias">
                                    <div class="contenedorProductos">
                                        <div class="titulo">
                                            <p>Categoria Productos</p>
                                        </div>
                                        <div class="containerCategorias">
                                            <?php foreach($listaTipoProductos as $tipoProducto) { ?>
                                                <div class="lista">
                                                    <h6><img src="../img/restaurantes/categorias/<?php echo $tipoProducto['TP_Imagen']; ?>"  alt=""
                                                            class="imgProductos"><?php echo $tipoProducto['TP_Tipo']; ?></h6>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

<?php include("../template/footer.php"); ?>