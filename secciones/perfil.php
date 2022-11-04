<?php include("../template/header.php"); ?>
<?php include("../admin/config/db.php"); ?>
<?php 
include("../admin/config/db.php");
switch ($accion) {
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

        if ($txtImagen!="") {
          $fecha= new DateTime();
          $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg"; 

          $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
          move_uploaded_file($tmpImagen,"../../img/perfil/".$nombreArchivo);

          $sentenciaSQL = $conexion->prepare("SELECT Usu_Imagen FROM usuario WHERE Usu_Id=:Usu_Id");
          $sentenciaSQL->bindParam(':Usu_Id',$txtID);
          $sentenciaSQL->execute();
          $usuarios = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
  
          if (isset($usuarios["imagen"]) && ($usuarios)["imagen"]!="imagen.jpg") {
              if (file_exists("../../img/perfil/".$usuarios["imagen"])) {
                  unlink("../../img/perfil/".$usuarios["imagen"]);
              }
          }

          $sentenciaSQL = $conexion->prepare("UPDATE local SET Usu_Imagen=:Usu_Imagen WHERE Usu_Id=:Usu_Id");
          $sentenciaSQL->bindParam(':Usu_Imagen',$nombreArchivo);
          $sentenciaSQL->bindParam(':Usu_Id',$txtID);
          $sentenciaSQL->execute();
      }
      header("Location:usuarios.php");
      /* echo "Presionado boton Modificar"; */
      break;
  case "Cancelar":
      header("Location:usuarios.php");
      $txtID="";
      $txtNombre="";
      $txtApellido="";
      $txtEmail="";
      $txtContrasena="";
      $txtTelefono="";
      $txtIdRol="";
      $txtStatus="";
      $txtImagen="";
      break;
  default:
      # code...
      break;
}
?>
<section class="backgroundProfile">
  <div class="container py-5">
    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item active" aria-current="page">Perfil Usuario</li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <div class="contanedorImagen">

              <img src="../../Cata-Food/img/perfil/editar.png" data-bs-toggle="modal" data-bs-target="#exampleModal" alt="" class="imagen-editar">
              <img src="../../Cata-Food/img/perfil/<?php echo $_SESSION['imagen'] ?>" alt="avatar" style="width: 150px;" class="profilePicture">

            </div>
            <h5 class="my-3"><?php echo $_SESSION['nombreUsuario'];?></h5>
            <p class="text-muted mb-1"><?php switch ($_SESSION['idRol']) {
              case 1:
                echo 'Usuario';
                break;
              
              case 2:
                echo 'Vendedor - Dueño de Local';
                break;

              case 3:
                echo 'Administrador';
                break;
              
              default:
                echo 'Sin Usuario';
                break;
            } ?></p>
            <div class="d-flex justify-content-center mb-2">
              <button type="button" class="btn btn-outline-primary ms-1 botonModal" data-bs-toggle="modal" data-bs-target="#exampleModal">Modificar</button>
            </div>
          </div>
        </div>
        <!-- <div class="card mb-4 mb-lg-0">
          <div class="card-body p-0">
            <ul class="list-group list-group-flush rounded-3">
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fas fa-globe fa-lg text-warning"></i>
                <p class="mb-0">https://JohnSmith.com</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                <p class="mb-0">@JohnSmith123</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                <p class="mb-0">_JohnSmith</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                <p class="mb-0">Jonathan Smith</p>
              </li>
            </ul>
          </div>
        </div> -->
      </div>
      <div class="col-lg-8">
        <div class="card mb-4 datos">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Nombre</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION['nombre'];?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Apellido</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION['apellido'];?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION['email'];?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Telefono</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION['telefono'];?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Local</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" enctype="multipart/form-data" action="">
              <div class="form-group">
                <label for="txtNombre" class="form-label">Imagen:</label>
                <?php echo $_SESSION['imagen']; ?>
                <br>
                <?php
                  if ($_SESSION['imagen'] !="") {
                  ?>
                  
                  <img class="img-thumbnail rounded" src="../img/restaurantes/locales/<?php echo $_SESSION['imagen'] ?>"width="100" alt="">

                  <?php }?>
                  
                <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Imagen">
              </div>
      
              <div class="form-group">
                <label for="txtNombre" class="form-label">Nombre:</label>
                <input type="text" required class="form-control" value="<?php echo $_SESSION['nombre']; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre">
              </div>

              <div class="form-group">
                <label for="txtNombre" class="form-label">Apellido:</label>
                <input type="text" required class="form-control" value="<?php echo $_SESSION['apellido']; ?>" name="txtApellido" id="txtApellido" placeholder="Nombre">
              </div>

              <div class="form-group">
                <label for="txtNombre" class="form-label">Telefono:</label>
                <input type="tel" required class="form-control" value="<?php echo $_SESSION['telefono']; ?>" name="txtTelefono" id="txtTelefono" placeholder="Telefono">
              </div>

              <br>
              <div class="btn-group" role="group" aria-label="">
                  <button type="submit" name="accion" value="Modificar" class="btn btn-primary">Modificar</button>
                  <button type="submit" name="accion" value="Cancelar" class="btn btn-secondary">Cancelar</button>
              </div>
        
          </form>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> -->
      </div>
  </div>
  </div>
</section>


<?php include("../template/footer.php"); ?>