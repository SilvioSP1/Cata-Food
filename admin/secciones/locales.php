<?php include("../template/header.php") ?>

<?php

$txtID=(isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtNombre=(isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtImagen=(isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";
$txtStatus=(isset($_POST['txtStatus'])) ? $_POST['txtStatus'] : "";
$txtTelefono=(isset($_POST['txtTelefono'])) ? $_POST['txtTelefono'] : "";
$txtUbicacion=(isset($_POST['txtUbicacion'])) ? $_POST['txtUbicacion'] : "";
$txtDueño=(isset($_POST['txtDueño'])) ? $_POST['txtDueño'] : "";
$txtTipo=(isset($_POST['txtTipo'])) ? $_POST['txtTipo'] : "";
$accion=(isset($_POST['accion'])) ? $_POST['accion'] : "";

include("../config/db.php");

switch ($accion) {
    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO local (Local_Nombre,Local_Imagen,Local_Status,Local_Telefono,Local_Ubicacion,Local_Dueno,Local_Tipo) VALUES (:Local_Nombre,:Local_Imagen,:Local_Status,:Local_Telefono,:Local_Ubicacion,:Local_Dueno,:Local_Tipo);");
          $sentenciaSQL->bindParam(':Local_Nombre',$txtNombre);

          $fecha= new DateTime();
          $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg"; 
          
          $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
          if ($tmpImagen!="") {
              move_uploaded_file($tmpImagen,"../../img/restaurantes/locales/".$nombreArchivo);
          }

          $sentenciaSQL->bindParam(':Local_Imagen',$nombreArchivo);
          $sentenciaSQL->bindParam(':Local_Status',$txtStatus);
          $sentenciaSQL->bindParam(':Local_Telefono',$txtTelefono);
          $sentenciaSQL->bindParam(':Local_Ubicacion',$txtUbicacion);
          $sentenciaSQL->bindParam(':Local_Dueno',$txtDueño);
          $sentenciaSQL->bindParam(':Local_Tipo',$txtTipo);
          $sentenciaSQL->execute();

        header("Location:locales.php");
        break;
    case "Modificar":
        $sentenciaSQL = $conexion->prepare("UPDATE local SET Local_Nombre = :Local_Nombre,Local_Status = :Local_Status, Local_Telefono= :Local_Telefono, Local_Ubicacion = :Local_Ubicacion, Local_Dueño = :Local_Dueño, Local_Tipo = :Local_Tipo WHERE Local_Id = :Local_Id");
          $sentenciaSQL->bindParam(':Local_Nombre',$txtNombre);
          $sentenciaSQL->bindParam(':Local_Status',$txtStatus);
          $sentenciaSQL->bindParam(':Local_Telefono',$txtTelefono);
          $sentenciaSQL->bindParam(':Local_Ubicacion',$txtUbicacion);
          $sentenciaSQL->bindParam(':Local_Dueño',$txtDueño);
          $sentenciaSQL->bindParam(':Local_Tipo',$txtTipo);
          $sentenciaSQL->bindParam(':Local_Id',$txtID);
          $sentenciaSQL->execute();

          if ($txtImagen!="") {
            $fecha= new DateTime();
            $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg"; 

            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
            move_uploaded_file($tmpImagen,"../../img/restaurantes/locales/".$nombreArchivo);

            $sentenciaSQL = $conexion->prepare("SELECT Local_Imagen FROM locales WHERE Local_Id=:Local_Id");
            $sentenciaSQL->bindParam(':Local_Id',$txtID);
            $sentenciaSQL->execute();
            $local = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
    
            if (isset($Producto["imagen"]) && ($local)["imagen"]!="imagen.jpg") {
                if (file_exists("../../img/restaurantes/locales/".$local["imagen"])) {
                    unlink("../../img/restaurantes/locales/".$local["imagen"]);
                }
            }

            $sentenciaSQL = $conexion->prepare("UPDATE local SET Local_Imagen=:Local_Imagen WHERE Local_Id=:Local_Id");
            $sentenciaSQL->bindParam(':Local_Imagen',$nombreArchivo);
            $sentenciaSQL->bindParam(':Local_Id',$txtID);
            $sentenciaSQL->execute();
          }
        header("Location:locales.php");
        /* echo "Presionado boton Modificar"; */
        break;
    case "Cancelar":
        header("Location:locales.php");
        break;
    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM local WHERE Local_Id = :Local_Id");
        $sentenciaSQL->bindParam(':Local_Id',$txtID);
        $sentenciaSQL->execute();
        $local = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtNombre=$local['Local_Nombre'];
        $txtImagen=$local['Local_Imagen'];
        $txtStatus=$local['Local_Status'];
        $txtTelefono=$local['Local_Telefono'];
        $txtUbicacion=$local['Local_Ubicacion'];
        $txtDueño=$local['Local_Dueño'];
        $txtTipo=$local['Local_Tipo'];
        /* echo "Presionado boton Seleccionar"; */
        break;
    case "Desabilitar":
        $sentenciaSQL = $conexion->prepare("UPDATE local SET Local_Status = 2 WHERE Local_Id = :Local_Id");
        $sentenciaSQL->bindParam(':Local_Id',$txtID);
        $sentenciaSQL->execute();
        /* echo "Presionado boton Borrar"; */
        header("Location:locales.php");
        break;

    case "Habilitar":
        $sentenciaSQL = $conexion->prepare("UPDATE local SET Local_Status = 1 WHERE Local_Id = :Local_Id");
        $sentenciaSQL->bindParam(':Local_Id',$txtID);
        $sentenciaSQL->execute();
        /* echo "Presionado boton Borrar"; */
        header("Location:locales.php");
        break;
    
    default:
        # code...
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM local");
$sentenciaSQL->execute();
$listaLocales = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
/* $sentenciaSQL = $conexion->prepare("DELETE FROM productos WHERE id=5");
$sentenciaSQL->execute(); */

?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            Datos de local
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
                    
                    <img class="img-thumbnail rounded" src="../../img/restaurantes/locales/<?php echo $txtImagen; ?>"width="100" alt="">

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
                  <label for="txtNombre" class="form-label">Telefono:</label>
                  <input type="tel" required class="form-control" value="<?php echo $txtTelefono; ?>" name="txtTelefono" id="txtTelefono" placeholder="Telefono">
                </div>

                <div class="form-group">
                  <label for="txtNombre" class="form-label">Ubicacion:</label>
                  <input type="text" required class="form-control" value="<?php echo $txtUbicacion; ?>" name="txtUbicacion" id="txtUbicacion" placeholder="Ubicacion">
                </div>

                <div class="form-group">
                  <label for="txtNombre" class="form-label">Dueño:</label>
                  <input type="text" required class="form-control" value="<?php echo $txtDueño; ?>" name="txtDueño" id="txtDueño" placeholder="Dueño">
                </div>

                <div class="form-group">
                  <label for="txtNombre" class="form-label">Tipo:</label>
                  <div>
                      <select name="txtTipo" class="txtTipo" id="txtTipo" >
    
                        <option selected disabled><?php 
                        if (empty($txtTipo)) {
                            echo "Seleccione Uno";
                        }else{
                            echo $txtTipo; 
                        }?>
                        </option>
    
                        <option>Food Track</option>
    
                        <option>Restaurante</option>
                    
                        <option>Cafeteria</option>
                    
                        </select>
                  </div>
                  <!-- <input type="text"  required class="form-control" value="<?php echo $txtTipo; ?>" name="txtTipo" id="txtTipo" placeholder="Tipo Local"> -->
                </div>

                <div class="form-group">
                  <label for="txtStatus" class="form-label">Status:</label>
                  <input type="number" required class="form-control" value="<?php echo $txtStatus; ?>" name="txtStatus" id="txtStatus" placeholder="Id Status">
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
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Telefono</th>
                <th>Ubicacion</th>
                <th>Dueño</th>
                <th>Tipo</th>
                <th>Status</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($listaLocales as $locales) { ?>
            <tr>
                <td><?php echo $locales['Local_Id']; ?></td>
                <td><?php echo $locales['Local_Nombre']; ?></td>
                <td>
                    <img src="../../img/restaurantes/locales/<?php echo $locales['Local_Imagen']; ?>" width="100" alt="" srcset="">
                </td>
                <td><?php echo $locales['Local_Telefono']; ?></td>
                <td><?php echo $locales['Local_Ubicacion']; ?></td>
                <td><?php echo $locales['Local_Dueño']; ?></td>
                <td><?php echo $locales['Local_Tipo']; ?></td>
                <td><?php echo $locales['Local_Status']; ?></td>
                <td>

                    <form action="" method="POST">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $locales['Local_Id']; ?>">
                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary">
                        <?php if ($locales['Local_Status'] == 1) { ?>
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