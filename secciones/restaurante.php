<?php include("../template/header.php"); ?>
<?php 
include("../admin/config/db.php");
include("carrito.php");
error_reporting(0);

if (!empty($_POST["Local_Id"])) {
    
    if (is_numeric(openssl_decrypt($_POST["Local_Id"],cod,key))) {
        $Local_Id = openssl_decrypt($_POST["Local_Id"],cod,key);
        $_SESSION['local'] = openssl_decrypt($_POST["Local_Id"],cod,key);
    }
    $Local_Id = $_SESSION['local'];
}

$sentenciaSQL = $conexion->prepare("SELECT Prod_Id,Prod_Nombre,Prod_Descripcion,Prod_Imagen,Prod_Precio,Prod_ABC,Prod_Status,Prod_LocalId,Prod_Tipo,Local_Nombre,TP_Tipo,TP_Imagen FROM producto
JOIN local ON Local_Id = :Local_Id
JOIN tipo_producto ON TP_Tipo = Prod_Tipo
WHERE Prod_LocalId = :Local_Id
ORDER BY Prod_Nombre ASC");
$sentenciaSQL->bindParam(':Local_Id',$Local_Id);
$sentenciaSQL->execute();
$listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL = $conexion->prepare("SELECT * from producto
JOIN local on Local_Id = :Local_Id
JOIN tipo_producto on TP_Tipo = Prod_Tipo
GROUP by Prod_Tipo");
$sentenciaSQL->bindParam(':Local_Id',$Local_Id);
$sentenciaSQL->execute();
$listaTipoProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL = $conexion->prepare("SELECT * FROM local WHERE Local_Id=:Local_Id");
$sentenciaSQL->bindParam(':Local_Id',$Local_Id);
$sentenciaSQL->execute();
$localDelProducto = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>

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
                                                <?php $localNombre = $local['Local_Nombre'];?>
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
                                        <?php foreach($listaTipoProductos as $tipoProductos) { ?>
                                        <div aria-label="" class="tipo">
                                            <div class="circulo">
                                                <img src="../img/restaurantes/categorias/<?php echo $tipoProductos['TP_Imagen']; ?>"
                                                    aria-hidden="true" class="">
                                            </div>
                                            <div aria-hidden="true" class="sc-tl2hnw-0 hNbawF"><?php echo $tipoProductos['TP_Tipo']; ?></div>
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
                                    <form class="container__CardProd" action="" method="POST" id="formulario" >
                                        <button class="conteinerCardResta producto botonModal" type="button" id="<?php echo $producto['Prod_Id']; ?>" onClick="reply_click(this.id)">
                                            <img class="imagenRestaurante" src="../img/restaurantes/productos/<?php echo $producto['Prod_Imagen']; ?>"
                                                alt="">
                                            <div class="contenedorTexto">
                                                <p class="nombreRestaurante nombreProducto"><strong><?php echo $producto['Prod_Nombre']; ?></strong></p>
                                                <p class="ubiRestaurante ingredientes"><?php echo $producto['Prod_Descripcion']; ?></p>
                                                <h6>$<?php echo $producto['Prod_Precio']; ?></h6>
                                            </div>
                                        </button>
                                    </form>
                                    <?php } ?>
                                </div>
                                <input type="hidden" name="id" id="id" value="">
                            </div>
                        </div>
                    </div>


                    <section class="modal ">
                        <div class="modal__container">
                            <img src="../img/restaurantes/productos/<?php echo $producto['Prod_Imagen']; ?>" class="modal__img">
                            <h2 class="modal__title"><?php echo $producto['Prod_Nombre']; ?></h2>
                            <h2 class="modal__subtitle"><?php echo $producto['Prod_Precio']; ?></h2>
                            <p class="modal__paragraph"><?php echo $producto['Prod_Descripcion']; ?></p>
                            <form class="form_modal" action="" method="post">
                                <?php  ?>
                                <input type="hidden" name="Local_Id" id="Local_Id" value="<?php echo openssl_encrypt($localDelProducto['Local_Id'],cod,key); ?>">
                                <input type="hidden" name="Local_Nombre" id="Local_Nombre" value="<?php echo openssl_encrypt($localNombre,cod,key); ?>">
                                <input type="hidden" name="Prod_Id" id="Prod_Id" value="<?php echo openssl_encrypt($producto['Prod_Id'],cod,key); ?>">
                                <input type="hidden" name="Prod_Nombre" id="Prod_Nombre" value="<?php echo openssl_encrypt($producto['Prod_Nombre'],cod,key); ?>">
                                <input type="hidden" name="Prod_Imagen" id="Prod_Imagen" value="<?php echo openssl_encrypt($producto['Prod_Imagen'],cod,key); ?>">
                                <input type="hidden" name="Prod_Precio" id="Prod_Precio" value="<?php echo openssl_encrypt($producto['Prod_Precio'],cod,key); ?>">
                                <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,cod,key); ?>">
                                <button class="botonAgregar btn btn-warning" name="btnAccion" value="Agregar" type="submit">
                                    Agregar a carrito 
                                </button>
                                <a href="#" class="modal__close btn btn-warning">Cerrar</a>
                            </form>
                                
                        </div>
                    </section>

                </div>

<?php include("../template/footer.php"); ?>