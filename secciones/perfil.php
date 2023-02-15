<?php include("../template/header.php"); ?>
<?php include("../admin/config/db.php"); ?>
<?php 
date_default_timezone_set('America/Argentina/Buenos_Aires');

$sentenciaSQL = $conexion->prepare("SELECT * FROM venta WHERE Venta_UsuId=:Venta_UsuId ORDER BY Venta_Id DESC LIMIT 5");
$sentenciaSQL->bindParam(':Venta_UsuId',$_SESSION['idUsuario']);
$sentenciaSQL->execute();
$listaUltimasVentas = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


$txtID=(isset($_POST['txtID'])) ? $_POST['txtID'] : $_SESSION['idUsuario'];
$txtNombre=(isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : $_SESSION['nombre'];
$txtApellido=(isset($_POST['txtApellido'])) ? $_POST['txtApellido'] : $_SESSION['apellido'];
$txtTelefono=(isset($_POST['txtTelefono'])) ? $_POST['txtTelefono'] : $_SESSION['telefono'];
$txtImagen=(isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : $_SESSION['imagen'];
$accion=(isset($_POST['accion'])) ? $_POST['accion'] : "";


switch ($accion) {
  case "Modificar":
      $sentenciaSQL = $conexion->prepare("UPDATE usuario SET Usu_Nombre = :Usu_Nombre,Usu_Apellido = :Usu_Apellido,Usu_Telefono = :Usu_Telefono  WHERE Usu_Id = :Usu_Id");
      $sentenciaSQL->bindParam(':Usu_Nombre',$txtNombre);
      $sentenciaSQL->bindParam(':Usu_Apellido',$txtApellido);
      $sentenciaSQL->bindParam(':Usu_Telefono',$txtTelefono);
      $sentenciaSQL->bindParam(':Usu_Id',$txtID);
      $sentenciaSQL->execute();

      if ($txtImagen!="") {
        $fecha= new DateTime();
        $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg"; 

        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
        move_uploaded_file($tmpImagen,"../img/perfil/".$nombreArchivo);

        $sentenciaSQL = $conexion->prepare("SELECT Usu_Imagen FROM usuario WHERE Usu_Id=:Usu_Id");
        $sentenciaSQL->bindParam(':Usu_Id',$txtID);
        $sentenciaSQL->execute();
        $usuarios = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if (isset($usuarios["Usu_Imagen"]) && ($usuarios)["Usu_Imagen"]!="imagen.jpg") {
            if (file_exists("../img/perfil/".$usuarios["Usu_Imagen"])) {
                unlink("../img/perfil/".$usuarios["Usu_Imagen"]);
            }
        }

        $sentenciaSQL = $conexion->prepare("UPDATE usuario SET Usu_Imagen=:Usu_Imagen WHERE Usu_Id=:Usu_Id");
        $sentenciaSQL->bindParam(':Usu_Imagen',$nombreArchivo);
        $sentenciaSQL->bindParam(':Usu_Id',$txtID);
        $sentenciaSQL->execute();
        $_SESSION['imagen'] = $nombreArchivo;
      }

      $_SESSION['nombre'] = $txtNombre;
      $_SESSION['apellido'] = $txtApellido;
      $_SESSION['nombreUsuario'] = $txtNombre." ".$txtApellido;
      $_SESSION['telefono'] = $txtTelefono;
      header("Location:perfil.php");
      /* echo "Presionado boton Modificar"; */
      break;
  case "Cancelar":
      header("Location:perfil.php");
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
        <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4 breadcrumbDark breadcrumbLight">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item" aria-current="page">Perfil Usuario</li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4 cardProfile__dark">
          <div class="card-body text-center">
            <div class="contanedorImagen">

              <img src="../../Cata-Food/img/perfil/<?php echo $_SESSION['imagen']; ?>" alt="avatar" style="width: 150px;" class="profilePicture">
              <i class="bi bi-pencil-fill imagen-editar" data-bs-toggle="modal" data-bs-target="#exampleModal1" alt=""></i>

            </div>
            <h5 class="my-3"><?php echo $_SESSION['nombreUsuario'];?></h5>
            <p class="mb-1"><?php switch ($_SESSION['idRol']) {
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
              <button type="button" class="btn btn-secondary ms-1 botonModal" data-bs-toggle="modal" data-bs-target="#exampleModal1">Modificar</button>
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
          <div class="card-body cuerpoDark">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Nombre</p>
              </div>
              <div class="col-sm-9">
                <p class="mb-0 parraDark"><?php echo $_SESSION['nombre'];?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Apellido</p>
              </div>
              <div class="col-sm-9">
                <p class="mb-0 parraDark"><?php echo $_SESSION['apellido'];?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="mb-0 parraDark"><?php echo $_SESSION['email'];?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Telefono</p>
              </div>
              <div class="col-sm-9 parradark">
                <p class="mb-0 parraDark"><?php echo $_SESSION['telefono'];?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="text-primary font-italic me-1">Ultimas Compras</span>
                </p>
                <div id="lista">
                  <ol class="lista2">
                    <?php 
                    foreach ($listaUltimasVentas as $ventas){?>
                      <?php
                        $sentenciaSQL = $conexion->prepare("SELECT * FROM venta_detalle WHERE VD_VentaId=:VD_VentaId LIMIT 10");
                        $sentenciaSQL->bindParam(':VD_VentaId',$ventas['Venta_Id']);
                        $sentenciaSQL->execute();
                        $listaVentasProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
                      ?>
                      <?php foreach ($listaVentasProductos as $productos){ ?>
                      <?php 
                          $sentenciaSQL = $conexion->prepare("SELECT * FROM producto WHERE Prod_Id=:Prod_Id");
                          $sentenciaSQL->bindParam(':Prod_Id',$productos['VD_ProdId']);
                          $sentenciaSQL->execute();
                          $listaComprados = $sentenciaSQL->fetchall(PDO::FETCH_ASSOC); 
                      ?>
                      <?php foreach ($listaComprados as $lista){ ?>
                      <?php 
                        $sentenciaSQL = $conexion->prepare("SELECT * FROM local WHERE Local_Id=:Local_Id");
                        $sentenciaSQL->bindParam(':Local_Id',$lista['Prod_LocalId']);
                        $sentenciaSQL->execute();
                        $local = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);   
                      ?>
                      <form action="restaurante.php" method="post">
                        <input type="hidden" name="Local_Id" id="Local_Id" value="<?php echo openssl_encrypt($local['Local_Id'],cod,key); ?>">
                        <button type="submit">
                          <li><span>Producto: </span><?php echo $lista['Prod_Nombre']; ?> - <span>Local: </span> <?php echo $local['Local_Nombre']; ?></li>
                        </button>
                      </form>
                      <?php } ?>
                      <?php } ?>
                    <?php }?>
                      <!-- <li>Contraseña: Nose24a_</li>
                      <li>Observaciones: Esta es una observacion dentro de una lista
                        <ol>
                            <li>Esta es una observacion dentro de una lista</li>
                            <li>List sub item</li>
                            <li>List sub item</li>
                        </ol> -->
                      </li>
                  </ol>
              </div>
              </div>
            </div>
          </div>
      </div>
    </div>
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Perfil</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" enctype="multipart/form-data" action="">
              <div class="form-group">
                <label for="txtNombre" class="form-label">Imagen:</label>
                <?php echo $txtImagen; ?>
                <br>
                <?php
                  if ($txtImagen !="") {
                  ?>
                  
                  <img class="img-thumbnail rounded" src="../img/perfil/<?php echo $txtImagen ?>"width="100" alt="">

                  <?php }?>
                  
                <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Imagen" accept="image/*">
              </div>
      
              <div class="form-group">
                <label for="txtNombre" class="form-label">Nombre:</label>
                <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre">
              </div>

              <div class="form-group">
                <label for="txtNombre" class="form-label">Apellido:</label>
                <input type="text" required class="form-control" value="<?php echo $txtApellido; ?>" name="txtApellido" id="txtApellido" placeholder="Nombre">
              </div>

              <div class="form-group">
                <label for="txtNombre" class="form-label">Telefono:</label>
                <input type="tel" required class="form-control" value="<?php echo $txtTelefono; ?>" name="txtTelefono" id="txtTelefono" placeholder="Telefono">
              </div>

              <br>
              <div class="btn-group" role="group" aria-label="">
                  <button type="submit" name="accion" value="Modificar" class="btn btn-primary userinfo" data-imagen="<?php echo $producto['Prod_Id']; ?>">Modificar</button>
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