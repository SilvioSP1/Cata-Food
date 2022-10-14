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

?>
<?php if ($mensaje !="") {?>
<div class="alert alert-success">
        <?php
            echo $mensaje;
        ?>
</div>
<?php } ?>
                <div class="conteiner_restaurantes">

                    <div class="container-fluid">
                        <div class="row justify-content-center g-2 containerColum">
                            <div class="col-3 columnas">
                                <div class="contenedorResTipo">
                                    <div class="tiposRes">
                                    <?php foreach($listaTipoLocales as $tipoLocal) { ?>
                                        <div aria-label="" class="tipo">
                                            <div class="circulo">
                                                <img src="../img/restaurantes/categorias/<?php echo $tipoLocal['TL_Imagen']; ?>"
                                                    aria-hidden="true" class="">
                                            </div>
                                            <div aria-hidden="true" class="sc-tl2hnw-0 hNbawF"><?php echo $tipoLocal['TL_Tipo']; ?></div>
                                        </div>
                                        <?php } ?>
                                        <div aria-label="" class="tipo">
                                            <div class="circulo">
                                                <img src="../img/restaurantes/categorias/hamburguesa.png"
                                                    aria-hidden="true" class="">
                                            </div>
                                            <div aria-hidden="true" class="sc-tl2hnw-0 hNbawF">Lomitos</div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 columnas">
                                <div>
                                    <div class="contenedorBuscadorRes">
                                        <form class="d-flex containerMedias">
                                            <input class="form-control me-1 buscador" type="search"
                                            placeholder="🔍︎ Buscar " aria-label="Search">
                                            <button class="btn btn-outline-dark botonBusc text-white"
                                            type="submit">Buscar</button>
                                        </form>
                                    </div>
                                    <?php foreach($listaLocales as $local) { ?>
                                    <form class="container__CardRest" action="restaurante.php" method="POST">
                                        <input type="hidden" name="Local_Id" id="Local_Id" value="<?php echo openssl_encrypt($GLOBALS['Local'] = $local['Local_Id'],cod,key); ?>">

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
                                    <div class="container__CardRest">
                                        <a class="conteinerCardResta" href="">
                                            <img class="imagenRestaurante" src="../img/restaurantes/locales/medialunascalentitas.png"
                                                alt="">
                                            <div class="contenedorTexto">
                                                <p class="nombreRestaurante"><strong>Betos Lomos</strong></p>
                                                <p class="ubiRestaurante">Republica Rivadavia</p>
                                                <h6>Clasificación</h6>
                                                <div>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>
                                            </div>
                                        </a>
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
                                            <div class="lista">
                                                <h6><img src="../img/restaurantes/categorias/hamburguesa.png"  alt=""
                                                        class="imgProductos">Hamburguesas</h6>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

<?php include("../template/footer.php"); ?>