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
}else{
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
                                                <?php $localNombre = $local['Local_Nombre'];?>
                                                <p class="nombreRestaurante"><strong><?php echo $local['Local_Nombre']; ?></strong></p>
                                                <?php $_SESSION['localNombre'] = $local['Local_Nombre'] ?>
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
                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-9 columnas">
                                <div class="conteinerProductos">
                                    <?php foreach($listaProductos as $producto) { ?>
                                    <form class="container__CardProd" action="" method="POST" id="" >
                                        <button class="userinfo conteinerCardResta producto botonModal" type="button" data-id="<?php echo $producto['Prod_Id']; ?>" onClick="reply_click(this.id)" data-value="<?php echo $_SESSION['localNombre']?>">
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

                </div>
                <div>
                    <script type='text/javascript'>
                        $(document).ready(function () {
                            $('.userinfo').click(function () {
                                var userid = $(this).data('id');
                                var localNomb = $(this).data('value');
                                $.ajax({
                                    url: '../admin/config/ajaxfile.php',
                                    type: 'post',
                                    data: {
                                        userid: userid,
                                        localNomb: localNomb
                                    },
                                    success: function (response) {
                                        $('.modal-body').html(response);
                                        $('#empModal').modal('show');
                                    }
                                });

                            });
                        });
                    </script>

                </div>
                



                <div class="backgroundModal">

                    <div class="modal fade" tabindex="-1" role="dialog" id="empModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Producto</h5>
                                </div>
                                <div class="modal-body">
                                </div>
                               
                            </div>
                        </div>
                    </div>

                </div>

<?php include("../template/footer.php"); ?>