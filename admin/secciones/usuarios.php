<?php include("../template/header.php") ?>

<?php

$txtID=(isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtNombre=(isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtApellido=(isset($_POST['txtApellido'])) ? $_POST['txtApellido'] : "";
$txtEmail=(isset($_POST['txtEmail'])) ? $_POST['txtEmail'] : "";
$txtContrasena=(isset($_POST['txtContrasena'])) ? $_POST['txtContrasena'] : "";
$txtTelefono=(isset($_POST['txtTelefono'])) ? $_POST['txtTelefono'] : "";
$txtIdRol=(isset($_POST['txtIdRol'])) ? $_POST['txtIdRol'] : "";
$txtStatus=(isset($_POST['txtStatus'])) ? $_POST['txtStatus'] : "";
$accion=(isset($_POST['accion'])) ? $_POST['accion'] : "";

include("../config/db.php");

switch ($accion) {
    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO usuario (Usu_Nombre,Usu_Apellido,Usu_Contrasena,Usu_Email,Usu_Telefono,Usu_RolId,Usu_Status) VALUES (:Usu_Nombre,:Usu_Apellido,:Usu_Contrasena,:Usu_Email,:Usu_Telefono,:Usu_RolId,:Usu_Status);");
          $sentenciaSQL->bindParam(':Usu_Nombre',$txtNombre);
          $sentenciaSQL->bindParam(':Usu_Apellido',$txtApellido);
          $sentenciaSQL->bindParam(':Usu_Email',$txtEmail);
          $sentenciaSQL->bindParam(':Usu_Telefono',$txtTelefono);
          $sentenciaSQL->bindParam(':Usu_Contrasena',$txtContrasena);
          $sentenciaSQL->bindParam(':Usu_RolId',$txtIdRol);
          $sentenciaSQL->bindParam(':Usu_Status',$txtStatus);
          $sentenciaSQL->execute();

        header("Location:usuarios.php");
        break;
    case "Modificar":
        $sentenciaSQL = $conexion->prepare("UPDATE usuario SET Usu_Nombre = :Usu_Nombre,Usu_Apellido = :Usu_Apellido,Usu_Contrasena = :Usu_Contrasena ,Usu_Email = :Usu_Email ,Usu_Telefono = :Usu_Telefono ,Usu_RolId = :Usu_RolId ,Usu_Status = :Usu_Status WHERE Usu_Id = :Usu_Id");
          $sentenciaSQL->bindParam(':Usu_Nombre',$txtNombre);
          $sentenciaSQL->bindParam(':Usu_Apellido',$txtApellido);
          $sentenciaSQL->bindParam(':Usu_Email',$txtEmail);
          $sentenciaSQL->bindParam(':Usu_Telefono',$txtTelefono);
          $sentenciaSQL->bindParam(':Usu_Contrasena',$txtContrasena);
          $sentenciaSQL->bindParam(':Usu_RolId',$txtIdRol);
          $sentenciaSQL->bindParam(':Usu_Status',$txtStatus);
          $sentenciaSQL->bindParam(':Usu_Id',$txtID);
          $sentenciaSQL->execute();
        header("Location:usuarios.php");
        /* echo "Presionado boton Modificar"; */
        break;
    case "Cancelar":
        header("Location:usuarios.php");
        break;
    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM usuario WHERE Usu_Id = :Usu_Id");
        $sentenciaSQL->bindParam(':Usu_Id',$txtID);
        $sentenciaSQL->execute();
        $usuario = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtNombre=$usuario['Usu_Nombre'];
        $txtApellido=$usuario['Usu_Apellido'];
        $txtContrasena=$usuario['Usu_Contrasena'];
        $txtEmail=$usuario['Usu_Email'];
        $txtTelefono=$usuario['Usu_Telefono'];
        $txtIdRol=$usuario['Usu_RolId'];
        $txtStatus=$usuario['Usu_Status'];
        /* echo "Presionado boton Seleccionar"; */
        break;
    case "Desabilitar":
        $sentenciaSQL = $conexion->prepare("UPDATE usuario SET Usu_Status = 2 WHERE Usu_Id = :Usu_Id");
        $sentenciaSQL->bindParam(':Usu_Id',$txtID);
        $sentenciaSQL->execute();
        /* echo "Presionado boton Borrar"; */
        header("Location:usuarios.php");
        break;
    
    default:
        # code...
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM usuario");
$sentenciaSQL->execute();
$listaUsuarios = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
/* $sentenciaSQL = $conexion->prepare("DELETE FROM productos WHERE id=5");
$sentenciaSQL->execute(); */

?>

<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            Datos de usuario
        </div>
        <div class="card-body">
           
            <form method="POST" enctype="multipart/form-data" action="">
                
                <div class="form-group">
                  <label for="txtID" class="form-label">Id:</label>
                  <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="Id">
                </div>
        
                <div class="form-group">
                  <label for="txtNombre" class="form-label">Nombre:</label>
                  <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre">
                </div>

                <div class="form-group">
                  <label for="txtApellido" class="form-label">Apellido:</label>
                  <input type="text" step="0.01" required class="form-control" value="<?php echo $txtApellido; ?>" name="txtApellido" id="txtApellido" placeholder="Apellido">
                </div>

                <div class="form-group">
                  <label for="txtEmail" class="form-label">Email:</label>
                  <input type="text" required class="form-control" value="<?php echo $txtEmail; ?>" name="txtEmail" id="txtEmail" placeholder="Email">
                </div>

                <div class="form-group">
                  <label for="txtContrasena" class="form-label">Contraseña:</label>
                  <input type="password" required class="form-control" value="<?php echo $txtContrasena; ?>" name="txtContrasena" id="txtContrasena" placeholder="Contraseña">
                </div>

                <div class="form-group">
                  <label for="txtTelefono" class="form-label">Telefono:</label>
                  <input type="text" required class="form-control" value="<?php echo $txtTelefono; ?>" name="txtTelefono" id="txtTelefono" placeholder="Telefono">
                </div>

                <div class="form-group">
                  <label for="txtIdRol" class="form-label">Id Rol:</label>
                  <input type="number" required class="form-control" value="<?php echo $txtIdRol; ?>" name="txtIdRol" id="txtIdRol" placeholder="Id Rol">
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
<div class="col-md-8">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Contraseña</th>
                <th>Telefono</th>
                <th>Id Rol</th>
                <th>Status</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaUsuarios as $usuario) { ?>
                <?php if($_SESSION['idUsuario'] == $usuario['Usu_Id'] ){?>
                <tr>
                    <td><?php echo $usuario['Usu_Id']; ?></td>
                    <td><?php echo $usuario['Usu_Nombre']; ?></td>
                    <td><?php echo $usuario['Usu_Apellido']; ?></td>
                    <td><?php echo $usuario['Usu_Email']; ?></td>
                    <td><?php echo $usuario['Usu_Contrasena']; ?></td>
                    <td><?php echo $usuario['Usu_Telefono']; ?></td>
                    <td><?php echo $usuario['Usu_RolId']; ?></td>
                    <td><?php echo $usuario['Usu_Status']; ?></td>
                    <td>

                        <form action="" method="POST">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $usuario['Usu_Id']; ?>">
                            <input type="submit" disabled name="accion" value="Seleccionar" class="btn btn-primary">
                            <input type="submit" disabled name="accion" value="Desabilitar" class="btn btn-danger">
                        </form>

                    </td>
                    
                </tr>
                <?php }else { ?>
                    <tr>
                    <td><?php echo $usuario['Usu_Id']; ?></td>
                    <td><?php echo $usuario['Usu_Nombre']; ?></td>
                    <td><?php echo $usuario['Usu_Apellido']; ?></td>
                    <td><?php echo $usuario['Usu_Email']; ?></td>
                    <td><?php echo $usuario['Usu_Contrasena']; ?></td>
                    <td><?php echo $usuario['Usu_Telefono']; ?></td>
                    <td><?php echo $usuario['Usu_RolId']; ?></td>
                    <td><?php echo $usuario['Usu_Status']; ?></td>
                    <td>

                        <form action="" method="POST">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $usuario['Usu_Id']; ?>">
                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary">
                            <input type="submit" name="accion" value="Desabilitar" class="btn btn-danger">
                        </form>

                    </td>
                    
                </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
    
</div>

<?php include("../template/footer.php") ?>