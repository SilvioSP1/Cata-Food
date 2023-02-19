<?php include("../template/header.php"); ?>
<?php include("../admin/config/db.php"); ?>
<?php include("../admin/config/config.php"); ?>
<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

$txtID=(isset($_POST['txtID'])) ? $_POST['txtID'] : $_SESSION['idLocal'];
$txtNombre=(isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : $_SESSION['nombreUsuario'];
$txtImagen=(isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : $_SESSION['imagen'];
$txtTelefono=(isset($_POST['txtTelefono'])) ? $_POST['txtTelefono'] : $_SESSION['telefono'];
$txtUbicacion=(isset($_POST['txtUbicacion'])) ? $_POST['txtUbicacion'] : $_SESSION['ubicacion'];
$txtDueño=(isset($_POST['txtDueño'])) ? $_POST['txtDueño'] : $_SESSION['nombre'];
$txtTipo=(isset($_POST['txtTipo'])) ? $_POST['txtTipo'] : $_SESSION['tipo'];
$txtUbiRef=(isset($_POST['txtUbiRef'])) ? $_POST['txtUbiRef'] : $_SESSION['ubicacionRef'];
$txtApertura=(isset($_POST['txtApertura'])) ? $_POST['txtApertura'] : "";
$txtCierre=(isset($_POST['txtCierre'])) ? $_POST['txtCierre'] : "";
$accion=(isset($_POST['accion'])) ? $_POST['accion'] : "";

$sentenciaSQL = $conexion->prepare("SELECT * FROM tipo_local");
$sentenciaSQL->execute();
$localesTipos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL = $conexion->prepare("SELECT * FROM producto
JOIN local ON Local_Id = :Local_Id
WHERE Prod_LocalId = :Local_Id
ORDER BY Prod_Nombre ASC");
$sentenciaSQL->bindParam(':Local_Id',$txtID);
$sentenciaSQL->execute();
$listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

switch($accion){

  case "Modificar":

    $sentenciaSQL = $conexion->prepare("UPDATE local SET Local_Nombre = :Local_Nombre, Local_Telefono= :Local_Telefono, Local_Ubicacion = :Local_Ubicacion, Local_Dueno = :Local_Dueno, Local_Tipo = :Local_Tipo, Local_UbiRefe = :Local_UbiRefe WHERE Local_Id = :Local_Id");
      $sentenciaSQL->bindParam(':Local_Nombre',$txtNombre);
      $sentenciaSQL->bindParam(':Local_UbiRefe',$txtUbiRef);
      $sentenciaSQL->bindParam(':Local_Telefono',$txtTelefono);
      $sentenciaSQL->bindParam(':Local_Ubicacion',$txtUbicacion);
      $sentenciaSQL->bindParam(':Local_Dueno',$txtDueño);
      $sentenciaSQL->bindParam(':Local_Tipo',$txtTipo);
      $sentenciaSQL->bindParam(':Local_Id',$txtID);
      $sentenciaSQL->execute();

      if ($txtImagen!="") {
        $fecha= new DateTime();
        $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg"; 

        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
        move_uploaded_file($tmpImagen,"../img/restaurantes/locales/".$nombreArchivo);

        $sentenciaSQL = $conexion->prepare("SELECT Local_Imagen FROM local WHERE Local_Id=:Local_Id");
        $sentenciaSQL->bindParam(':Local_Id',$txtID);
        $sentenciaSQL->execute();
        $local = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if (isset($local["Local_Imagen"]) && ($local)["Local_Imagen"]!="imagen.jpg") {
            if (file_exists("../img/restaurantes/locales/".$local["Local_Imagen"])) {
                unlink("../img/restaurantes/locales/".$local["Local_Imagen"]);
            }
        }

        $sentenciaSQL = $conexion->prepare("UPDATE local SET Local_Imagen=:Local_Imagen WHERE Local_Id=:Local_Id");
        $sentenciaSQL->bindParam(':Local_Imagen',$nombreArchivo);
        $sentenciaSQL->bindParam(':Local_Id',$txtID);
        $sentenciaSQL->execute();
        $_SESSION['imagen'] = $nombreArchivo;
      }
      $_SESSION['nombreUsuario'] = $txtNombre;
      $_SESSION['idLocal'] = $txtID;
      $_SESSION['telefono'] = $txtTelefono;
      $_SESSION['ubicacion'] =  $txtUbicacion;
      $_SESSION['ubicacionRef'] = $txtUbiRef;
      $_SESSION['nombre'] = $txtDueño;
      $_SESSION['tipo'] = $txtTipo;

    header("Location:local.php");
    /* echo "Presionado boton Modificar"; */
    break;
  case "Abrir":
    $abierto = date("Y-m-d",time());
    $time = date("Y-m-d",time());
    $time = strtotime($time);
    switch (date('w', $time)){
      case 0: $fech= "Domingo"; break;
      case 1: $fech= "Lunes"; break;
      case 2: $fech= "Martes"; break;
      case 3: $fech= "Miercoles"; break;
      case 4: $fech= "Jueves"; break;
      case 5: $fech= "Viernes"; break;
      case 6: $fech= "Sabado"; break;
    } 
    $txtApertura = date("H:i:s",strtotime($txtApertura));
    $txtCierre = date("H:i:s",strtotime($txtCierre));
    $sentenciaSQL = $conexion->prepare("INSERT INTO horario (Horario_Fecha,Horario_Dia,Horario_Apertura,Horario_Cierre,Horario_LocalId) VALUES (:Horario_Fecha,:Horario_Dia,:Horario_Apertura,:Horario_Cierre,:Horario_LocalId)");
      $sentenciaSQL->bindParam(':Horario_Fecha',$abierto);
      $sentenciaSQL->bindParam(':Horario_Dia',$fech);
      $sentenciaSQL->bindParam(':Horario_Apertura',$txtApertura);
      $sentenciaSQL->bindParam(':Horario_Cierre',$txtCierre);
      $sentenciaSQL->bindParam(':Horario_LocalId',$txtID);
      $sentenciaSQL->execute();
      $idHorario = $conexion->lastInsertId();

    foreach ($listaProductos as $listastock) {
      $stock=(isset($_POST[$listastock['Prod_Id']])) ? $_POST[$listastock['Prod_Id']] : "";
      echo $stock;
      $sentenciaSQL = $conexion->prepare("INSERT INTO stock_producto (Stock_ProdId,Stock_LocalId,Stock_Cantidad,Stock_HorarioId) VALUES (:Stock_ProdId,:Stock_LocalId,:Stock_Cantidad,:Stock_HorarioId)");
      $sentenciaSQL->bindParam(':Stock_ProdId',$listastock['Prod_Id']);
      $sentenciaSQL->bindParam(':Stock_LocalId',$txtID);
      $sentenciaSQL->bindParam(':Stock_Cantidad',$stock);
      $sentenciaSQL->bindParam(':Stock_HorarioId',$idHorario);
      $sentenciaSQL->execute();
    }
      header("Location:local.php");
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
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechaActual = date("Y-m-d",time());

$sentenciaSQL = $conexion->prepare("SELECT * FROM horario WHERE Horario_LocalId = :Horario_LocalId AND Horario_Fecha = :Horario_Fecha");
$sentenciaSQL->bindParam(':Horario_LocalId',$txtID);
$sentenciaSQL->bindParam(':Horario_Fecha',$fechaActual);
$sentenciaSQL->execute();
$localAbierto = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);


?>

<section class="backgroundProfile">
  <div class="container py-5">
    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4 textoLocal">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item" aria-current="page">Perfil Local</li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4">
      <div class="card mb-4">
          <div class="card-body text-center">
            <div class="contanedorImagen">

            <i class="bi bi-pencil-fill imagen-editar" data-bs-toggle="modal" data-bs-target="#exampleModal1" alt=""></i>
              <img src="../img/restaurantes/locales/<?php echo $_SESSION['imagen'] ?>" alt="avatar" style="width: 150px;" class="profilePicture">

            </div>
            <h5 class="my-3"><?php echo $_SESSION['nombreUsuario'];?></h5>
            <p class="mb-1">Vendedor / Local</p>
            <div class="d-flex justify-content-center mb-2">
              <button type="button" class="btn btn-outline-primary ms-1 botonModal" data-bs-toggle="modal" data-bs-target="#exampleModal1">Modificar</button>
              <form action="restaurante.php" method="post">
                <!-- <input type="hidden" name="Local_Id" id="Local_Id" value="<?php echo openssl_encrypt($txtID,cod,key); ?>"> -->
                <input type="hidden" name="Local_Id" id="Local_Id" value="<?php echo openssl_encrypt($_SESSION['idLocal'],cod,key); ?>">
                <button class="btn btn-outline-primary ms-1 botonModal" name="btnAccion" type="submit">Ver Productos</button>
              </form>
              <?php if ($localAbierto['Horario_Fecha'] == date("Y-m-d",time()) && $localAbierto['Horario_Cierre'] > date("(H:i:s)", time()) || $_SESSION['status'] == 2) { ?>
              <button disabled class="btn btn-outline-primary ms-1 botonModal" name="btnAccion" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2">Abrir Local</button>
              <?php }else{ ?>
                <button class="btn btn-outline-primary ms-1 botonModal" name="btnAccion" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2">Abrir Local</button>
              <?php } ?>
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
                <p class="mb-0"><?php echo $_SESSION['nombreUsuario'];?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Dueño</p>
              </div>
              <div class="col-sm-9">
                <p class="mb-0"><?php echo $_SESSION['nombre'];?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="mb-0"><?php echo $_SESSION['email'];?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Telefono</p>
              </div>
              <div class="col-sm-9">
                <p class="mb-0"><?php echo $_SESSION['telefono'];?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Dirección</p>
              </div>
              <div class="col-sm-9">
                <p class="mb-0"><?php echo $_SESSION['ubicacion'];?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="font-italic me-1">Ventas</span>
                </p>
                <?php 
                $totalVentas = 0;
                $cantidadVentas = 0;
                $totalVentasMes = 0;
                $cantidadVentasMes = 0;
                $time = date("m",time());
                /* $mesActual = date("m",$time); */
                  foreach ($listaProductos as $ventas) {
                    $sentenciaSQL = $conexion->prepare("SELECT * FROM venta_detalle WHERE VD_ProdId = :VD_ProdId");
                    $sentenciaSQL->bindParam(':VD_ProdId',$ventas['Prod_Id']);
                    $sentenciaSQL->execute();
                    $listaVentas = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($listaVentas as $total) {
                      $sentenciaSQL = $conexion->prepare("SELECT * FROM venta WHERE Venta_Id = :Venta_Id");
                      $sentenciaSQL->bindParam(':Venta_Id',$total['VD_VentaId']);
                      $sentenciaSQL->execute();
                      $ventaInfo = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

                      $ventaMes = $ventaInfo['Venta_Fecha'];
                      echo $ventaMes;
                      list(, $mes,) = explode('-', $ventaMes);
                      echo $ventaMes;
                      if ($ventaMes == $mesActual) {
                        $totalVentasMes = $totalVentasMes + ($total['VD_Cantidad'] * $total['VD_PrecioUnitario']);
                        $cantidadVentasMes++;
                      }

                      $totalVentas = $totalVentas + ($total['VD_Cantidad'] * $total['VD_PrecioUnitario']);
                      $cantidadVentas++;
                    }
                  } 
                ?>
                <p class="mb-1" style="font-size: .77rem;">Total de ventas: <?php echo $totalVentas; ?></p>
                <p class="mb-1" style="font-size: .77rem;">Cantidad de ventas: <?php echo $cantidadVentas; ?></p>
                <p class="mb-1" style="font-size: .77rem;">Total de ventas del Mes: <?php echo $totalVentasMes; ?></p>
                <p class="mb-1" style="font-size: .77rem;">Cantidad de ventas del Mes: <?php echo $cantidadVentasMes; ?></p>
                <!-- <div class="progress rounded" style="height: 5px;">
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
                </div> -->
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="font-italic me-1">Productos más vendidos</span>
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
  <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header modalDark">
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
                    
                    <img class="img-thumbnail rounded editarImagen" src="../img/restaurantes/locales/<?php echo $_SESSION['imagen'] ?>"width="100" alt="">

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

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Local</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data" action="">
                <div class="form-group">
                  <label for="txtNombre" class="form-label">Apertura:</label>
                  <input type="text" required class="form-control" value="" name="txtApertura" id="txtApertura" placeholder="Horario: 09:20:30">
                </div>

                <div class="form-group">
                  <label for="txtNombre" class="form-label">Cierre:</label>
                  <input type="text" required class="form-control" value="" name="txtCierre" id="txtCierre" placeholder="Horario: 23:20:30">
                </div>
                  <!-- <input type="text"  required class="form-control" value="<?php echo $txtTipo; ?>" name="txtTipo" id="txtTipo" placeholder="Tipo Local"> -->
                <br>
                <h4>Stock</h4>
                <br>
                <?php foreach ($listaProductos as $lista) { ?>
                  <?php if($lista['Prod_Status'] == 1){?>
                <div class="form-group">
                  <label for="txtNombre" class="form-label"><?php echo $lista['Prod_Nombre'] ?></label>
                  <input type="number" required class="form-control" value="" name="<?php echo $lista['Prod_Id'] ?>" id="<?php echo $lista['Prod_Id'] ?>" placeholder="Stock para hoy">
                </div>
                <?php } ?>
                <?php } ?>
                <br>
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" value="Abrir" class="btn btn-primary">Abrir</button>
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