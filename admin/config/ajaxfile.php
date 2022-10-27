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
<table style="border:0;" width='100%'>
<tr>
    <td width="300"><img src="images/<?php echo $producto['Prod_Imagen']; ?>">
    <td style="padding:20px;">
    <p>Nombre <?php echo $producto['Prod_Nombre']; ?></p>
    <p>Descripción<?php echo $producto['Prod_Descripcion']; ?></p>
    <p>Precio:<?php echo $producto['Prod_Precio']; ?></p>
    </td>
</tr>
</table>
<br>
<form class="modal-footer" method="post">
    <input type="hidden" name="Local_Nombre" id="Local_Nombre" value="<?php echo openssl_encrypt($localNomb,cod,key); ?>">
    <input type="hidden" name="Prod_Id" id="Prod_Id" value="<?php echo openssl_encrypt($producto['Prod_Id'],cod,key); ?>">
    <input type="hidden" name="Prod_Nombre" id="Prod_Nombre" value="<?php echo openssl_encrypt($producto['Prod_Nombre'],cod,key); ?>">
    <input type="hidden" name="Prod_Imagen" id="Prod_Imagen" value="<?php echo openssl_encrypt($producto['Prod_Imagen'],cod,key); ?>">
    <input type="hidden" name="Prod_Precio" id="Prod_Precio" value="<?php echo openssl_encrypt($producto['Prod_Precio'],cod,key); ?>">
    <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,cod,key); ?>">
    <button type="button" class="btn btn-primary">Save changes</button>
    <button class="botonAgregar btn btn-warning" name="btnAccion" value="Agregar" type="submit">
        Agregar a carrito 
    </button>
</form>
<?php } ?>