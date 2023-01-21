<?php
include "db.php";
include "config.php";
 
session_start();
error_reporting(0);
$userid = $_POST['userid'];
$localNomb = $_POST['localNomb'];

$sentenciaSQL = $conexion->prepare("SELECT * FROM producto WHERE Prod_Id = :Prod_Id");
$sentenciaSQL->bindParam(':Prod_Id',$userid);
$sentenciaSQL->execute();
$listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL = $conexion->prepare("SELECT * FROM tipo_producto");
$sentenciaSQL->execute();
$tipoProducto = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$abierto = date("Y-m-d",time());
$sentenciaSQL = $conexion->prepare("SELECT * FROM horario WHERE Horario_LocalId = :Horario_LocalId AND Horario_Fecha = :Horario_Fecha");
$sentenciaSQL->bindParam(':Horario_LocalId',$_SESSION['idUsuario']);
$sentenciaSQL->bindParam(':Horario_Fecha',$abierto);
$sentenciaSQL->execute();
$tipoProducto = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL = $conexion->prepare("SELECT * FROM stock_producto WHERE Stock_ProdId = :Stock_ProdId AND Stock_LocalId = :Stock_LocalId AND Stock_HorarioId = :Stock_HorarioId");
$sentenciaSQL->bindParam(':Stock_ProdId',$userid);
$sentenciaSQL->bindParam(':Stock_LocalId',$_SESSION['idUsuario']);
$sentenciaSQL->bindParam(':Stock_HorarioId',$tipoProducto['Horario_Id']);
$sentenciaSQL->execute();
$stockProducto = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

$sentenciaSQL = $conexion->prepare("SELECT * FROM horario WHERE Horario_LocalId = :Horario_LocalId AND Horario_Fecha = :Horario_Fecha");
$sentenciaSQL->bindParam(':Horario_LocalId',$txtID);
$sentenciaSQL->bindParam(':Horario_Fecha',$fechaActual);
$sentenciaSQL->execute();
$localAbierto = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

foreach($listaProductos as $producto) {
?>
<!DOCTYPE html>
<html lang="en">
<body>

    <?php if ($_SESSION['idRol'] == 1) { ?>

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

                
                <?php if ($producto['Prod_Status'] == 3 && $stockProducto['Stock_Cantidad'] > 0 && $localAbierto != null) {?>
                    <?php if($localAbierto['Horario_Fecha'] == date("Y-m-d",time()) && $localAbierto['Horario_Cierre'] > date("(H:i:s)", time())){ ?>
                <input type="number" class="form-control-sm conta" name="conta" id="conta" placeholder="Unidades" value="1">
                <button class="botonAgregar btn btn-warning" name="btnAccion" value="Agregar" type="submit" id="agregarr">
                    Agregar a carrito
                </button>
                    <?php } ?>
                <?php } else if ($producto['Prod_Status'] != 3 || $stockProducto['Stock_Cantidad'] < 0 || $stockProducto == null || $localAbierto == null || $localAbierto['Horario_Fecha'] != date("Y-m-d",time()) && $localAbierto['Horario_Cierre'] < date("(H:i:s)", time())) { ?>
                <input disabled type="number" class="form-control-sm conta" name="conta" id="conta" placeholder="Unidades" value="1">
                <button disabled class="botonAgregar btn btn-warning" name="btnAccion" value="Agregar" type="submit" id="agregarr">
                    Agregar a carrito
                </button>
                <?php } ?>
            </div>
        </form>
    <?php }else if($_SESSION['idRol'] == 2 || $_SESSION['idRol'] == 3){ ?>
        <form method="POST" enctype="multipart/form-data" action="">
            <input type="hidden" name="txtID" id="txtID" value="<?php echo $producto['Prod_Id']; ?>">
            <div class="form-group">
            <label for="txtNombre" class="form-label">Imagen:</label>
            <?php echo $producto['Prod_Imagen']; ?>
            <br>
            <?php
                if ($producto['Prod_Imagen'] !="") {?>
                
                <img class="img-thumbnail rounded" src="../img/restaurantes/productos/<?php echo $producto['Prod_Imagen'];?>"width="100" alt="">

            <?php }?>
            <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Imagen">
            </div>

            <div class="form-group">
            <label for="txtNombre" class="form-label">Nombre:</label>
            <input type="text" required class="form-control" value="<?php echo $producto['Prod_Nombre']; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre">
            </div>

            <div class="form-group">
            <label for="txtNombre" class="form-label">Descripciom:</label>
            <input type="tel" required class="form-control" value="<?php echo $producto['Prod_Descripcion']; ?>" name="txtDescripcion" id="txtDescripcion" placeholder="Telefono">
            </div>

            <div class="form-group">
            <label for="txtNombre" class="form-label">Precio:</label>
            <input type="number" step="any" required class="form-control" value="<?php echo $producto['Prod_Precio']; ?>" name="txtPrecio" id="txtPrecio" placeholder="Ubicacion">
            </div>

            <div class="form-group">
            <label for="txtNombre" class="form-label">Tipo:</label>
            <div>
                <select name="txtTipo" class="txtTipo" id="txtTipo" >

                    <?php if(empty($producto['Prod_Tipo'])) {?>
                        <option selected disabled>Seleccione uno</option>
                    <?php }else { ?>
                        <option selected><?php echo $producto['Prod_Tipo']; ?></option>
                    <?php } ?>

                    <?php foreach($tipoProducto as $tipo){ ?>
                    <option><?php echo $tipo["TP_Tipo"]; ?></option>

                    <?php } ?>
                
                    </select>
            </div>
            <!-- <input type="text"  required class="form-control" value="<?php echo $txtTipo; ?>" name="txtTipo" id="txtTipo" placeholder="Tipo Local"> -->
            </div>

            <br>
            <div class="btn-group" role="group" aria-label="">
                <!-- <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success">Agregar</button> -->
                <button type="submit" name="accion2" value="Modificar" class="btn btn-warning">Modificar</button>
                <button type="submit" name="accion2" value="Cancelar" class="btn btn-danger">Cancelar</button>
            </div>
        </form>
    <?php }else{ ?>
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

                <input disabled type="number" class="form-control-sm conta" name="conta" id="conta" placeholder="Unidades" value="1">
                <button disabled class="botonAgregar btn btn-warning" name="btnAccion" value="Agregar" type="submit" id="agregarr">
                    Agregar a carrito
                </button>
            </div>
        </form>
    <?php } ?>
    <br>
    

</body>



<script src="../../Cata-Food/js/toast.js"></script>

</html>
<?php } ?>