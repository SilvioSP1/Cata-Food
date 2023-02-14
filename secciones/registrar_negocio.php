<?php include("../template/alert.php"); ?>
<?php 
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');

include("../admin/config/db.php");
$sentenciaSQL = $conexion->prepare("SELECT * FROM tipo_local");
$sentenciaSQL->execute();
$localesTipos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    if ($_POST) 
    {

      include("../admin/config/db.php");

      $txtNombre = ($_POST['txtNombre']);
      $txtGenero = ($_POST['txtGenero']);
      $txtCantLoca = ($_POST['txtCantLoca']);
      $txtNombreDue = ($_POST['txtNombreDue']);
      $txtEmail = ($_POST['txtEmail']);
      $txtApellidoDue = ($_POST['txtApellidoDue']);
      $txtTelefono = ($_POST['txtTelefono']);
      $txtUbicacion = ($_POST['txtUbicacion']);
      $txtUbicacionRef = ($_POST['txtUbicacionRef']);
      $txtContrasena = ($_POST['txtContrasena']);
      $txtContrasenaRep = ($_POST['txtContrasenaRep']);
      $txtRolId = 2;
      $txtImagen = '1669751061_profile2.png';
      $txtNombreCompleto = $txtApellidoDue.' '.$txtNombreDue;
      
      $prueba = $conexion->prepare("SELECT COUNT(Local_Nombre) AS cantidad FROM local WHERE Local_Nombre=?");
      $prueba->execute([$txtNombre]);
      $prueba = $prueba->fetch(PDO::FETCH_ASSOC);

      $prueba2 = $conexion->prepare("SELECT COUNT(Local_Email) AS cantidad FROM local WHERE Local_Email=?");
      $prueba2->execute([$txtEmail]);
      $prueba2 = $prueba2->fetch(PDO::FETCH_ASSOC);

      if(($prueba['cantidad'] > 0) && ($prueba2['cantidad'] > 0)) {
         echo '<script>
         Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "¡Vaya!, este nombre de local o email ya tiene una cuenta 💔",
          });
         </script>';
      }else{

        if ($txtContrasena !== $txtContrasenaRep) {
          echo '<script>
         Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "¡Vaya!, Las contraseñas no coinciden 💔",
          });
         </script>';
        }

        if ((strlen($txtContrasena) < 8) && (strlen($txtContrasenaRep) < 8)) {
          echo '<script>
         Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "¡Vaya!, Las contraseñas son demasiado cortas, minimo 8 caracteres 💔",
          });
         </script>';
        }
        else{

          $sentenciaSQL = $conexion->prepare("INSERT INTO local (Local_Nombre,Local_Imagen,Local_Status,Local_Telefono,Local_Ubicacion,Local_Dueno,Local_Tipo,Local_UbiRefe,Local_Contrasena,Local_Email,Local_RolId) VALUES (:Local_Nombre,:Local_Imagen,2,:Local_Telefono,:Local_Ubicacion,:Local_Dueno,:Local_Tipo,:Local_UbiRefe,:Local_Contrasena,:Local_Email,:Local_RolId);");
          $sentenciaSQL->bindParam(':Local_Nombre',$txtNombre);
          $sentenciaSQL->bindParam(':Local_Imagen',$txtImagen);
          $sentenciaSQL->bindParam(':Local_Telefono',$txtTelefono);
          $sentenciaSQL->bindParam(':Local_Ubicacion',$txtUbicacion);
          $sentenciaSQL->bindParam(':Local_Dueno',$txtNombreCompleto);
          $sentenciaSQL->bindParam(':Local_Tipo',$txtGenero);
          $sentenciaSQL->bindParam(':Local_UbiRefe',$txtUbicacionRef);
          $sentenciaSQL->bindParam(':Local_Contrasena',$txtContrasena);
          $sentenciaSQL->bindParam(':Local_Email',$txtEmail);
          $sentenciaSQL->bindParam(':Local_RolId',$txtRolId);
          $sentenciaSQL->execute();
  
          $sentenciaSQL = $conexion->prepare("SELECT * FROM local WHERE Local_Email=:Local_Email AND Local_Contrasena=:Local_Contrasena");
          $sentenciaSQL->bindParam(':Local_Email',$txtEmail,PDO::PARAM_STR);
          $sentenciaSQL->bindParam(':Local_Contrasena',$txtContrasena,PDO::PARAM_STR);
          $sentenciaSQL->execute();
          $locales = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);
  
          session_start();
          $_SESSION['usuario'] = $locales;
          $_SESSION['nombreUsuario']=$locales['Local_Nombre'];
          $_SESSION['nombre']=$locales['Local_Dueno'];
          $_SESSION['email']=$locales['Local_Email'];
          $_SESSION['ubicacion']=$locales['Local_Ubicacion'];
          $_SESSION['ubicacionRef']=$locales['Local_UbicacionRefe'];
          $_SESSION['tipo']=$locales['Local_Tipo'];
          $_SESSION['contraseña']=$locales['Local_Contrasena'];
          $_SESSION['telefono']=$locales['Local_Telefono'];
          $_SESSION['idUsuario']=$locales['Local_Id'];
          $_SESSION['idLocal']=$locales['Local_Id'];
          $_SESSION['imagen']= $locales['Local_Imagen'];
          $_SESSION['idRol']= $locales['Local_RolId'];
          $_SESSION['status']= $locales['Local_Status'];
          header("Location:local.php");
        }

      }


    } 
?>

  <div class="flexDark darkMover">

    <div class="colorMode__dark">
      <i class="bi bi-moon-fill moon"></i>
      <i class="bi bi-sun sun"></i>
    </div>

  </div>

    <div id="app">

      <!-- CONTEINER -->

      <section class="containerIR3">


            <div class="containerForm3">
                

                <div class="mover">
                    <div class="containerLetras">
                        <img src="../img/registro-local/shops.png" alt="" class="imagenUsuario">
                        <h2>Registrar Local</h2>
                        
                    </div>
                    
    
                    <form method="post" class="formulario">
                        <input type="text" placeholder="  Nombre Local" required name="txtNombre" id="txtNombre">
                        <span class="input-border"></span>
                        <div>
                            <label for="" class="tipoClass">Tipo</label>
                            <select class="genero" onchange="" requiered name="txtGenero" id="txtGenero">

                                <option selected disabled>-- Select one --</option>
    
                                <?php foreach($localesTipos as $tipo){ ?>
                                <option><?php echo $tipo["TL_Tipo"] ?></option>
    
                                <?php } ?>
                              </select>
                        </div>
                        <span class="input-border"></span>
                        <input type="number" placeholder="  Cantidad de locales " required name="txtCantLoca" id="txtCantLoca">
                        <span class="input-border"></span>
                        <input type="email" placeholder="  Email " required name="txtEmail" id="txtEmail">
                        <span class="input-border"></span>
                        <input type="text" placeholder="  Nombre " required name="txtNombreDue" id="txtNombreDue">
                        <span class="input-border"></span>
                        <input type="text" placeholder="  Apellido " required name="txtApellidoDue" id="txtApellidoDue">
                        <span class="input-border"></span>
                        <input type="tel" placeholder="  Telefono " required name="txtTelefono" id="txtTelefono">
                        <span class="input-border"></span>
                        <input type="password" placeholder="  Contraseña " required name="txtContrasena" id="txtContrasena">
                        <span class="input-border"></span>
                        <input type="password" placeholder="  Repetir Contraseña " required name="txtContrasenaRep" id="txtContrasenaRep">
                        <span class="input-border"></span>

                        <input id="place_input" type="text" placeholder="  Ubicacion  " name="txtUbicacion" id="txtUbicacion">
                        <span class="input-border"></span>
                        <div id="map"></div>

                        <!-- <div id="map" width="100%" style="height: 280px;"></div> -->   
                        <input hidden type="text" name="input-address-formated" id="input-address-formated"> 
                        <input hidden type="text" name="input-address" id="input-address">
                        <input hidden type="text" name="input-city" id="input-city">
                        <input hidden type="text" name="input-country" id="input-country">
                        <input hidden type="text" name="input-postal-code" id="input-postal-code">
                        <input hidden type="text" name="input-street" id="input-street">
                        <input hidden type="text" name="input-exterior-number" id="input-exterior-number">
                        <input hidden type="text" name="latitude" id="latitude">
                        <input hidden type="text" name="longitude" id="longitude">
                        
                        
                        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB55y13evt4FRyWHg_8Wn71KVYdj9aQHPo&libraries=places&callback=initMap"></script>
                        
                        <input type="text" placeholder=" Referencia de ubicacion " required name="txtUbicacionRef" id="txtUbicacionRef">
                        <span class="textoRegister">¿Ya tienes un local? <a href="inicio_negocio.php">Iniciar Sesion</a></span>
                        <div class="mediaBotones">
                          

                        <div class="mediaBotones">
                            <button type="submit">
                              <span>Ingresar</span>
                            </button>
                            <a href="../index.php" class="boton">
                              <span>Volver</span>
                            </a>
                          </div>

                        </div>
                    </form>
                </div>

                


            </div>
        


      </section>

      <!-- CONTEINER -->

    </div>



  </main>


  <!-- scripts funcionalidad -->

  <script src="../js/boiler.js"></script>
  <script src="../js/loader.js"></script>
  <script src="../js/map.js?v=<?php echo time(); ?>"></script>

  <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->

  <!-- Cargar la API de maps javascript -->
  <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB55y13evt4FRyWHg_8Wn71KVYdj9aQHPo&libraries=places&callback=initMap"></script> -->

  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
  </script>

  <!-- Font awesome -->
  <script src="https://kit.fontawesome.com/0dcf698896.js" crossorigin="anonymous"></script>

  <!-- Anime.js -->
  <script src="../node_modules/animejs/lib/anime.min.js"></script>

  <script src="../../Cata-Food/js/darkMode.js?v=<?php echo time(); ?>"></script>
</body>


</html>