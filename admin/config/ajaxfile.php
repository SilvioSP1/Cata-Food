<?php
include "db.php";
include "config.php";
 
$userid = $_POST['userid'];
$localNomb = $_POST['localNomb'];

$sentenciaSQL = $conexion->prepare("SELECT * FROM producto WHERE Prod_Id = :Prod_Id");
$sentenciaSQL->bindParam(':Prod_Id',$userid);
$sentenciaSQL->execute();
$listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

foreach($listaProductos as $producto) {
?>
<!DOCTYPE html>
<html lang="en">
<body>

    <div class="padreTR">

        <div class="flexTR">

            <table class="tableTR">
                <tr class="containerTR">
                    <td class="contenedorImagen"><img class="imageProducto"
                            src="../img/restaurantes/productos/<?php echo $producto['Prod_Imagen']; ?>">
                    <td class="descripcionProductos">
                        <p>Nombre: <?php echo $producto['Prod_Nombre']; ?></p>
                        <p>Descripción: <?php echo $producto['Prod_Descripcion']; ?></p>
                        <p>Precio: $<?php echo $producto['Prod_Precio']; ?></p>
                    </td>
                </tr>
            </table>

        </div>

    </div>
    <br>
    <form class="modal-footer" method="post">
        <input type="hidden" name="Local_Nombre" id="Local_Nombre"
            value="<?php echo openssl_encrypt($localNomb,cod,key); ?>">
        <input type="hidden" name="Prod_Id" id="Prod_Id"
            value="<?php echo openssl_encrypt($producto['Prod_Id'],cod,key); ?>">
        <input type="hidden" name="Prod_Nombre" id="Prod_Nombre"
            value="<?php echo openssl_encrypt($producto['Prod_Nombre'],cod,key); ?>">
        <input type="hidden" name="Prod_Imagen" id="Prod_Imagen"
            value="<?php echo openssl_encrypt($producto['Prod_Imagen'],cod,key); ?>">
        <input type="hidden" name="Prod_Precio" id="Prod_Precio"
            value="<?php echo openssl_encrypt($producto['Prod_Precio'],cod,key); ?>">
        <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,cod,key); ?>">
        <div class="flexBotones">

            <input type="number" class="form-control-sm conta" name="conta" id="conta" placeholder="Unidades" value="1">
            <button class="botonAgregar btn btn-warning" name="btnAccion" value="Agregar" type="submit" id="agregarr">
                Agregar a carrito
            </button>

        </div>
    </form>

</body>



<script src="../../Cata-Food/js/toast.js"></script>

</html>
<?php } ?>