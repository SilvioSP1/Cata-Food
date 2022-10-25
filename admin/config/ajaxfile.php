<?php
include "db.php";
 
$userid = $_POST['userid'];

$sentenciaSQL = $conexion->prepare("SELECT * FROM producto WHERE Prod_Id = :Prod_Id");
$sentenciaSQL->bindParam(':Prod_Id',$userid);
$sentenciaSQL->execute();
$listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

foreach($listaProductos as $producto) {
?>
<table border='0' width='100%'>
<tr>
    <td width="300"><img src="images/<?php echo $producto['Prod_Imagen']; ?>">
    <td style="padding:20px;">
    <p>Nombre <?php echo $producto['Prod_Nombre']; ?></p>
    <p>Descripción<?php echo $producto['Prod_Descripcion']; ?></p>
    <p>Precio:<?php echo $producto['Prod_Precio']; ?></p>
    </td>
</tr>
</table>
<?php } ?>