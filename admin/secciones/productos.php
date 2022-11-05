<?php include("../template/header.php") ?>

<?php

$txtID=(isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtNombre=(isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtDescripcion=(isset($_POST['txtDescripcion'])) ? $_POST['txtDescripcion'] : "";
$txtImagen=(isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";
$txtPrecio=(isset($_POST['txtPrecio'])) ? $_POST['txtPrecio'] : "";
$txtABC=(isset($_POST['txtABC'])) ? $_POST['txtABC'] : "";
$txtStatus=(isset($_POST['txtStatus'])) ? $_POST['txtStatus'] : "";
$txtLocalId=(isset($_POST['txtLocalId'])) ? $_POST['txtLocalId'] : "";
$txtTipo=(isset($_POST['txtTipo'])) ? $_POST['txtTipo'] : "";
$accion=(isset($_POST['accion'])) ? $_POST['accion'] : "";

include("../config/db.php");

$sentenciaSQL = $conexion->prepare("SELECT * FROM tipo_producto");
$sentenciaSQL->execute();
$productosTipos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

switch ($accion) {
    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO producto (Prod_Nombre , Prod_Descripcion , Prod_Imagen , Prod_Precio , Prod_ABC , Prod_Status , Prod_LocalId , Prod_Tipo) VALUES (:Prod_Nombre,:Prod_Descripcion,:Prod_Imagen,:Prod_Precio,:Prod_ABC,:Prod_Status,:Prod_LocalId,:Prod_Tipo);");
          $sentenciaSQL->bindParam(':Prod_Nombre',$txtNombre);
          $sentenciaSQL->bindParam(':Prod_Descripcion',$txtDescripcion);
          
          $fecha= new DateTime();
          $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg"; 
          
          $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
          if ($tmpImagen!="") {
              move_uploaded_file($tmpImagen,"../../img/restaurantes/productos/".$nombreArchivo);
          }
            
          $sentenciaSQL->bindParam(':Prod_Imagen',$nombreArchivo);
          $sentenciaSQL->bindParam(':Prod_Precio',$txtPrecio);
          $sentenciaSQL->bindParam(':Prod_ABC',$txtABC);
          $sentenciaSQL->bindParam(':Prod_Status',$txtStatus);
          $sentenciaSQL->bindParam(':Prod_LocalId',$txtLocalId);
          $sentenciaSQL->bindParam(':Prod_Tipo',$txtTipo);
          $sentenciaSQL->execute();

        header("Location:productos.php");
        break;
    case "Modificar":
        $sentenciaSQL = $conexion->prepare("UPDATE producto SET Prod_Nombre = :Prod_Nombre,Prod_Descripcion = :Prod_Descripcion, Prod_Precio= :Prod_Precio, Prod_ABC = :Prod_ABC, Prod_Status = :Prod_Status, Prod_LocalId = :Prod_LocalId , Prod_Tipo = :Prod_Tipo WHERE Prod_Id = :Prod_Id");
          $sentenciaSQL->bindParam(':Prod_Nombre',$txtNombre);
          $sentenciaSQL->bindParam(':Prod_Descripcion',$txtDescripcion);
          $sentenciaSQL->bindParam(':Prod_Precio',$txtPrecio);
          $sentenciaSQL->bindParam(':Prod_ABC',$txtABC);
          $sentenciaSQL->bindParam(':Prod_Status',$txtStatus);
          $sentenciaSQL->bindParam(':Prod_LocalId',$txtLocalId);
          $sentenciaSQL->bindParam(':Prod_Tipo',$txtTipo);
          $sentenciaSQL->bindParam(':Prod_Id',$txtID);
          $sentenciaSQL->execute();

          if ($txtImagen!="") {
            $fecha= new DateTime();
            $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg"; 

            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
            move_uploaded_file($tmpImagen,"../../img/restaurantes/productos/".$nombreArchivo);

            $sentenciaSQL = $conexion->prepare("SELECT Prod_Imagen FROM producto WHERE Prod_Id=:Prod_Id");
            $sentenciaSQL->bindParam(':Prod_Id',$txtID);
            $sentenciaSQL->execute();
            $producto = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
    
            if (isset($producto["Prod_Imagen"]) && ($producto)["Prod_Imagen"]!="imagen.jpg") {
                if (file_exists("../../img/restaurantes/productos/".$producto["Prod_Imagen"])) {
                    unlink("../../img/restaurantes/productos/".$producto["Prod_Imagen"]);
                }
            }

            $sentenciaSQL = $conexion->prepare("UPDATE producto SET Prod_Imagen=:Prod_Imagen WHERE Prod_Id=:Prod_Id");
            $sentenciaSQL->bindParam(':Prod_Imagen',$nombreArchivo);
            $sentenciaSQL->bindParam(':Prod_Id',$txtID);
            $sentenciaSQL->execute();
        }
        header("Location:productos.php");
        $txtID="";
        $txtNombre="";
        $txtDescripcion="";
        $txtImagen="";
        $txtPrecio="";
        $txtABC="";
        $txtStatus="";
        $txtLocalId="";
        $txtTipo="";
        /* echo "Presionado boton Modificar"; */
        break;
    case "Cancelar":
        header("Location:productos.php");
        $txtID="";
        $txtNombre="";
        $txtDescripcion="";
        $txtImagen="";
        $txtPrecio="";
        $txtABC="";
        $txtStatus="";
        $txtLocalId="";
        $txtTipo="";
        break;
    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM producto WHERE Prod_Id = :Prod_Id");
        $sentenciaSQL->bindParam(':Prod_Id',$txtID);
        $sentenciaSQL->execute();
        $producto = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtNombre=$producto['Prod_Nombre'];
        $txtDescripcion=$producto['Prod_Descripcion'];
        $txtImagen=$producto['Prod_Imagen'];
        $txtPrecio=$producto['Prod_Precio'];
        $txtABC=$producto['Prod_ABC'];
        $txtStatus=$producto['Prod_Status'];
        $txtLocalId=$producto['Prod_LocalId'];
        $txtTipo=$producto['Prod_Tipo'];
        /* echo "Presionado boton Seleccionar"; */
        break;
    case "Desabilitar":
        $sentenciaSQL = $conexion->prepare("UPDATE producto SET Prod_Status = 2 WHERE Prod_Id = :Prod_Id");
        $sentenciaSQL->bindParam(':Prod_Id',$txtID);
        $sentenciaSQL->execute();
        /* echo "Presionado boton Borrar"; */
        header("Location:productos.php");
        break;

    case "Habilitar":
        $sentenciaSQL = $conexion->prepare("UPDATE local SET Prod_Status = 1 WHERE Prod_Id = :Prod_Id");
        $sentenciaSQL->bindParam(':Prod_Id',$txtID);
        $sentenciaSQL->execute();
        /* echo "Presionado boton Borrar"; */
        header("Location:productos.php");
        break;
    
    default:
        # code...
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM producto");
$sentenciaSQL->execute();
$listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
/* $sentenciaSQL = $conexion->prepare("DELETE FROM productos WHERE id=5");
$sentenciaSQL->execute(); */

?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            Datos de producto
        </div>
        <div class="card-body">
           
            <form method="POST" enctype="multipart/form-data" action="">
                
                <div class="form-group">
                  <label for="txtID" class="form-label">Id:</label>
                  <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="Id">
                </div>

                <div class="form-group">
                  <label for="txtNombre" class="form-label">Imagen:</label>
                  <?php echo $txtImagen; ?>
                  <br>
                  <?php
                    if ($txtImagen!="") {
                    ?>
                    
                    <img class="img-thumbnail rounded" src="../../img/restaurantes/productos/<?php echo $txtImagen; ?>"width="100" alt="">

                    <?php 
                    } 
                    ?>
                  <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Imagen">
                </div>

                <div class="form-group">
                  <label for="txtNombre" class="form-label">Nombre:</label>
                  <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre">
                </div>
        
                <div class="form-group">
                  <label for="txtDescripcion" class="form-label">Descripcion:</label>
                  <input type="text" required class="form-control" value="<?php echo $txtDescripcion; ?>" name="txtDescripcion" id="txtDescripcion" placeholder="Decripcion">
                </div>

                <div class="form-group">
                  <label for="txtPrecio" class="form-label">Precio:</label>
                  <input type="number" step="any" required class="form-control" value="<?php echo $txtPrecio; ?>" name="txtPrecio" id="txtPrecio" placeholder="Precio">
                </div>

                <div class="form-group">
                  <label for="txtABC" class="form-label">ABC:</label>
                  <input type="text" maxlength="1" required class="form-control" value="<?php echo $txtABC; ?>" name="txtABC" id="txtABC" placeholder="ABC">
                </div>

                <div class="form-group">
                  <label for="txtStatus" class="form-label">Status:</label>
                  <input type="number" required class="form-control" value="<?php echo $txtStatus; ?>" name="txtStatus" id="txtStatus" placeholder="Id Status">
                </div>

                <div class="form-group">
                  <label for="txtNombre" class="form-label">Tipo:</label>
                  <div>
                      <select name="txtTipo" class="txtTipo" id="txtTipo" >
    
                        <?php if(empty($txtTipo)) {?>
                            <option selected disabled>Seleccione uno</option>
                        <?php }else { ?>
                            <option selected><?php echo $txtTipo; ?></option>
                        <?php } ?>
      
                        <?php foreach($productosTipos as $tipo){ ?>
                        <option><?php echo $tipo["TP_Tipo"] ?></option>

                        <?php } ?>
                    
                        </select>
                  </div>

                <div class="form-group">
                  <label for="txtLocalId" class="form-label">Local Id:</label>
                  <input type="number" required class="form-control" value="<?php echo $txtLocalId; ?>" name="txtLocalId" id="txtLocalId" placeholder="Local Id">
                </div>

                <br>
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
                </div>
        
            </form>

        </div>
        <!-- <div class="card-footer text-muted">
            Footer
        </div> -->
    </div>


</div>
<div class="col-md-12">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Decripcion</th>
                <th>Precio</th>
                <th>ABC</th>
                <th>Status</th>
                <th>Local id</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($listaProductos as $productos) { ?>
            <tr>
                <td><?php echo $productos['Prod_Id']; ?></td>
                <td>
                    <img src="../../img/restaurantes/productos/<?php echo $productos['Prod_Imagen']; ?>" width="100" alt="" srcset="">
                </td>
                <td><?php echo $productos['Prod_Nombre']; ?></td>
                <td><?php echo $productos['Prod_Descripcion']; ?></td>
                <td><?php echo $productos['Prod_Precio']; ?></td>
                <td><?php echo $productos['Prod_ABC']; ?></td>
                <td><?php echo $productos['Prod_Status']; ?></td>
                <td><?php echo $productos['Prod_LocalId']; ?></td>
                <td><?php echo $productos['Prod_Tipo']; ?></td>
                <td>

                    <form action="" method="POST">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $productos['Prod_Id']; ?>">
                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary">
                        <?php if ($productos['Prod_Status'] == 1) { ?>
                            <input type="submit" name="accion" value="Desabilitar" class="btn btn-danger">
                        <?php }else{ ?>
                            <input type="submit" name="accion" value="Habilitar" class="btn btn-success">
                        <?php } ?>
                    </form>

                </td>
                
            </tr>
            <?php } ?>
        </tbody>
    </table>
    
</div>

<?php include("../template/footer.php") ?>