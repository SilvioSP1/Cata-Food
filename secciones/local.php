<?php include("../template/header.php"); ?>
<?php include("../admin/config/db.php"); ?>
<?php 
include("../admin/config/db.php");
$sentenciaSQL = $conexion->prepare("SELECT * FROM tipo_local");
$sentenciaSQL->execute();
$localesTipos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

switch($accion){

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
    header("Location:local.php");
    /* echo "Presionado boton Modificar"; */
    break;
  case "Cancelar":
    header("Location:local.php");
    $txtID="";
    $txtNombre="";
    $txtImagen="";
    $txtStatus="";
    $txtTelefono="";
    $txtUbicacion="";
    $txtDueño="";
    $txtTipo="";
    $txtUbiRef="";
    $txtContrasena="";
    $txtEmail="";
    break;
}
?>

<section class="backgroundProfile">
  <div class="container py-5">
    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item active" aria-current="page">Perfil Local</li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4">
      <div class="card mb-4">
          <div class="card-body text-center">
            <div class="contanedorImagen">

              <img src="../../Cata-Food/img/perfil/editar.png" alt="" class="imagen-editar" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <img src="../../Cata-Food/img/restaurantes/locales/<?php echo $_SESSION['imagen'] ?>" alt="avatar" style="width: 150px;" class="profilePicture">

            </div>
            <h5 class="my-3"><?php echo $_SESSION['nombre'];?></h5>
            <p class="text-muted mb-1">Vendedor / Local</p>
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
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Nombre Local</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION['nombreUsuario'];?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Dueño</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION['nombre'];?></p>
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
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Dirección</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION['ubicacion'];?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="text-primary font-italic me-1">Ventas</span>
                </p>
                <p class="mb-1" style="font-size: .77rem;">Zona Norte</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Zona Sur</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="45"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Zona Centro</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 95%" aria-valuenow="95"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Zona Este</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Zona Oeste</p>
                <div class="progress rounded mb-2" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="text-primary font-italic me-1">Productos más vendidos</span>
                </p>
                <p class="mb-1" style="font-size: .77rem;">Lomitos</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Hamburguesas</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Pizzas</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Milanesas</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Papas Fritas</p>
                <div class="progress rounded mb-2" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
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
                    if ($_SESSION['imagen'] !="") {?>
                    
                    <img class="img-thumbnail rounded" src="../../Cata-Food/img/restaurantes/locales/<?php echo $_SESSION['imagen'] ?>"width="100" alt="">

                  <?php }?>
                  <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Imagen">
                </div>
        
                <div class="form-group">
                  <label for="txtNombre" class="form-label">Nombre:</label>
                  <input type="text" required class="form-control" value="<?php echo $_SESSION['nombreUsuario']; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre">
                </div>

                <div class="form-group">
                  <label for="txtNombre" class="form-label">Telefono:</label>
                  <input type="tel" required class="form-control" value="<?php echo $_SESSION['telefono']; ?>" name="txtTelefono" id="txtTelefono" placeholder="Telefono">
                </div>

                <div class="form-group">
                  <label for="txtNombre" class="form-label">Ubicacion:</label>
                  <input type="text" required class="form-control" value="<?php echo $_SESSION['ubicacion']; ?>" name="txtUbicacion" id="txtUbicacion" placeholder="Ubicacion">
                </div>

                <div class="form-group">
                  <label for="txtNombre" class="form-label">Ubicacion Referencia:</label>
                  <input type="text" required class="form-control" value="<?php echo $_SESSION['ubicacionRef']; ?>" name="txtUbiRef" id="txtUbiRef" placeholder="Ubicacion Referencia">
                </div>

                <div class="form-group">
                  <label for="txtNombre" class="form-label">Dueño:</label>
                  <input type="text" required class="form-control" value="<?php echo $_SESSION['nombre']; ?>" name="txtDueño" id="txtDueño" placeholder="Dueño">
                </div>

                <div class="form-group">
                  <label for="txtNombre" class="form-label">Tipo:</label>
                  <div>
                      <select name="txtTipo" class="txtTipo" id="txtTipo" >
    
                        <option selected disabled><?php echo $_SESSION['tipo']; ?></option>
      
                        <?php foreach($localesTipos as $tipo){ ?>
                        <option><?php echo $tipo["TL_Tipo"] ?></option>

                        <?php } ?>
                    
                        </select>
                  </div>
                  <!-- <input type="text"  required class="form-control" value="<?php echo $txtTipo; ?>" name="txtTipo" id="txtTipo" placeholder="Tipo Local"> -->
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