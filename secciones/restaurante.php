<?php include("../template/header.php"); ?>
<?php 
include("../admin/config/db.php");
error_reporting(0);

if (is_numeric(openssl_decrypt($_POST["Local_Id"],cod,key))) {
    $Local_Id = openssl_decrypt($_POST["Local_Id"],cod,key);
}

$sentenciaSQL = $conexion->prepare("SELECT Prod_Id,Prod_Nombre,Prod_Descripcion,Prod_Imagen,Prod_Precio,Prod_ABC,Prod_Status,Prod_LocalId,Prod_Tipo,TP_Tipo,TP_Imagen FROM producto
JOIN local ON Local_Id = :Local_Id
JOIN tipo_producto ON TP_Tipo = Prod_Tipo
ORDER BY Prod_Nombre ASC");
$sentenciaSQL->bindParam(':Local_Id',$Local_Id);
$sentenciaSQL->execute();
$listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL = $conexion->prepare("SELECT * FROM local WHERE Local_Id=:Local_Id");
$sentenciaSQL->bindParam(':Local_Id',$Local_Id);
$sentenciaSQL->execute();
$localDelProducto = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


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
                            <div class="col-12 columnas">
                                <?php foreach($localDelProducto as $local) { ?>
                                <div class="conteimerLocal">
                                    <div class="conteinerLocalImagen">
                                        <img class="imagenRestaurante" src="../img/restaurantes/locales/<?php echo $local['Local_Imagen']; ?>"
                                            alt="">
                                    </div>
                                    <div class="continerTextoBusca">
                                        <div class="contenedorTexto">
                                            <div>
                                                <p class="nombreRestaurante"><strong><?php echo $local['Local_Nombre']; ?></strong></p>
                                                <p class="ubiRestaurante"><?php echo $local['Local_Ubicacion']; ?></p>
                                            </div>
                                        </div>
                                        <div class="contenedorBuscadorRes">
                                            <form class="d-flex containerMedias">
                                                <input class="form-control me-1 buscador" type="search"
                                                    placeholder="🔍︎ Buscar " aria-label="Search">
                                                <button class="btn btn-outline-dark botonBusc text-white"
                                                    type="submit">Buscar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row justify-content-center g-2 containerColum">
                            <div class="col-3 columnas">
                                <div class="contenedorResTipo">
                                    <div class="tiposRes">
                                        <?php foreach($listaProductos as $tipoProductos) { ?>
                                        <div aria-label="" class="tipo">
                                            <div class="circulo">
                                                <img src="../img/restaurantes/categorias/<?php echo $tipoProductos['TP_Imagen']; ?>"
                                                    aria-hidden="true" class="">
                                            </div>
                                            <div aria-hidden="true" class="sc-tl2hnw-0 hNbawF"><?php echo $tipoProductos['TP_Imagen']; ?></div>
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
                            <div class="col-9 columnas">
                                <div class="conteinerProductos">
                                    <?php foreach($listaProductos as $producto) { ?>
                                    <a class="conteinerCardResta producto" href="restaurante.php">
                                        <img class="imagenRestaurante" src="../img/restaurantes/productos/<?php echo $producto['Prod_Imagen']; ?>"
                                            alt="">
                                        <div class="contenedorTexto">
                                            <p class="nombreProducto nombreRestaurante"><strong><?php echo $producto['Prod_Nombre']; ?></strong></p>
                                            <p class="ingredientes ubiRestaurante"><?php echo $producto['Prod_Descripcion']; ?></p>
                                            <h6>$<?php echo $producto['Prod_Precio']; ?></h6>
                                            <div>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            </div>
                                        </div>
                                        <input type="hidden" name="Prod_Id" id="Prod_Id" value="<?php echo openssl_encrypt($producto['Prod_Id'],cod,key); ?>">
                                    </a>
                                    <?php } ?>
                                    <a class="conteinerCardResta producto" href="restaurante.php">
                                        <img class="imagenRestaurante" src="../img/restaurantes/productos/pizzaMuzzarella.webp"
                                            alt="">
                                        <div class="contenedorTexto">
                                            <p class="nombreProducto nombreRestaurante"><strong>Pizza Muzzarella</strong></p>
                                            <p class="ingredientes ubiRestaurante">Muzzarella y salsa de tomate y nose que mas poner pero puede tener mas ingredientes</p>
                                            <h6>$930</h6>
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
                    </div>

                </div>

<?php include("../template/footer.php"); ?>