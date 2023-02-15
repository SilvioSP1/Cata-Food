<?php include("../template/alert.php"); ?>
<?php 
session_start();
error_reporting(0);
date_default_timezone_set('America/Argentina/Buenos_Aires');
    if ($_POST) 
    {

      include("../admin/config/db.php");

      $txtNombre = ($_POST['txtNombre']);
      $txtApellido = ($_POST['txtApellido']);
      $txtEmail = ($_POST['txtEmail']);
      $txtTelefono = ($_POST['txtTelefono']);
      $txtContrasena = ($_POST['txtContrasena']);
      $txtContrasenaRepe = ($_POST['txtContrasenaRepe']);
      $txtImagen = 'user_icon.png';
      
      $prueba = $conexion->prepare("SELECT COUNT(Usu_Email) AS cantidad FROM usuario WHERE Usu_Email=?");
      $prueba->execute([$txtEmail]);
      $prueba = $prueba->fetch(PDO::FETCH_ASSOC);

      if($prueba['cantidad'] > 0) {
         echo '<script>
         Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "¡Vaya!, este mail ya tiene una cuenta 💔",
          });
         </script>';
      }else{

        if ($txtContrasena !== $txtContrasenaRepe) {
          echo '<script>
         Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "¡Vaya!, Las contraseñas no coinciden 💔",
          });
         </script>';
        }

        if ((strlen($txtContrasena) < 8) && (strlen($txtContrasenaRepe) < 8)) {
          echo '<script>
         Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "¡Vaya!, Las contraseñas son demasiado cortas, minimo 8 caracteres 💔",
          });
         </script>';
        }
        else{

          $sentenciaSQL = $conexion->prepare("INSERT INTO usuario (Usu_Nombre,Usu_Apellido,Usu_Contrasena,Usu_Email,Usu_Telefono,Usu_RolId,Usu_Status,Usu_Imagen) VALUES (:Usu_Nombre,:Usu_Apellido,:Usu_Contrasena,:Usu_Email,:Usu_Telefono,1,1,:Usu_Imagen);");
          $sentenciaSQL->bindParam(':Usu_Nombre',$txtNombre);
          $sentenciaSQL->bindParam(':Usu_Apellido',$txtApellido);
          $sentenciaSQL->bindParam(':Usu_Email',$txtEmail);
          $sentenciaSQL->bindParam(':Usu_Telefono',$txtTelefono);
          $sentenciaSQL->bindParam(':Usu_Contrasena',$txtContrasena);
          $sentenciaSQL->bindParam(':Usu_Imagen',$txtImagen);
          $sentenciaSQL->execute();
  
          $sentenciaSQL = $conexion->prepare("SELECT * FROM usuario WHERE Usu_Email=:Usu_Email AND Usu_Contrasena=:Usu_Contrasena");
          $sentenciaSQL->bindParam(':Usu_Email',$txtEmail,PDO::PARAM_STR);
          $sentenciaSQL->bindParam(':Usu_Contrasena',$txtContrasena,PDO::PARAM_STR);
          $sentenciaSQL->execute();
          $usuarios = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);
  
          if ($usuarios['Usu_RolId'] == 1) 
        {
          session_start();
          $_SESSION['usuario'] = $usuarios;
          $_SESSION['nombreUsuario']=$usuarios['Usu_Nombre']." ".$usuarios['Usu_Apellido'];
          $_SESSION['nombre']=$usuarios['Usu_Nombre'];
          $_SESSION['apellido']=$usuarios['Usu_Apellido'];
          $_SESSION['email']=$usuarios['Usu_Email'];
          $_SESSION['contraseña']=$usuarios['Usu_Contrasena'];
          $_SESSION['telefono']=$usuarios['Usu_Telefono'];
          $_SESSION['idUsuario']=$usuarios['Usu_Id'];
          $_SESSION['idRol']= $usuarios['Usu_RolId'];
          $_SESSION['imagen']= $usuarios['Usu_Imagen'];
          header("Location:../index.php");
        }
        if ($usuarios['Usu_RolId'] == 2) 
        {
          session_start();
          $_SESSION['usuario'] = $usuarios;
          $_SESSION['nombreUsuario']=$usuarios['Usu_Nombre']." ".$usuarios['Usu_Apellido'];
          $_SESSION['nombre']=$usuarios['Usu_Nombre'];
          $_SESSION['apellido']=$usuarios['Usu_Apellido'];
          $_SESSION['email']=$usuarios['Usu_Email'];
          $_SESSION['contraseña']=$usuarios['Usu_Contrasena'];
          $_SESSION['telefono']=$usuarios['Usu_Telefono'];
          $_SESSION['idUsuario']=$usuarios['Usu_Id'];
          $_SESSION['idRol']= $usuarios['Usu_RolId'];
          $_SESSION['imagen']= $usuarios['Usu_Imagen'];
          header("Location:../index.php");
        }
        if ($usuarios['Usu_RolId'] == 3) 
        {
          session_start();
          $_SESSION['usuario'] = $usuarios;
          $_SESSION['nombreUsuario']=$usuarios['Usu_Nombre']." ".$usuarios['Usu_Apellido'];
          $_SESSION['nombre']=$usuarios['Usu_Nombre'];
          $_SESSION['apellido']=$usuarios['Usu_Apellido'];
          $_SESSION['email']=$usuarios['Usu_Email'];
          $_SESSION['contraseña']=$usuarios['Usu_Contrasena'];
          $_SESSION['telefono']=$usuarios['Usu_Telefono'];
          $_SESSION['idUsuario']=$usuarios['Usu_Id'];
          $_SESSION['idRol']= $usuarios['Usu_RolId'];
          $_SESSION['imagen']= $usuarios['Usu_Imagen'];
          header("Location:../admin/index.php");
        }
        }
        

      }


    } 
?>

  <div class="flexDark">

    <div class="colorMode__dark">
      <i class="bi bi-moon-fill moon"></i>
      <i class="bi bi-sun sun"></i>
    </div>

  </div>

    <div id="app">

      <!-- CONTEINER -->

      <section class="containerIR2">


            <div class="containerForm2">
                

                <div class="mover">
                    <div class="containerLetras">
                        <img src="../img/login-registro/login.png" alt="" class="imagenUsuario">
                        <h2>Registrar Usuario</h2>
                        
                    </div>
                    
                    <?php if(isset($mensaje)){ ?>
                        <div class="alert alert-danger" role="alert">
                          <strong><?php echo $mensaje; ?></strong>
                        </div>
                      <?php } ?>
    
                    <form method="POST" class="formulario">
                        <input type="text" placeholder="  Nombre " required name="txtNombre" id="txtNombre">
                        <span class="input-border"></span>
                        <input type="text" placeholder="  Apellido " required name="txtApellido" id="txtApellido">
                        <span class="input-border"></span>
                        <input type="email" placeholder="  Email " required name="txtEmail" id="txtEmail">
                        <span class="input-border"></span>
                        <input type="tel" placeholder="  Telefono " required name="txtTelefono" id="txtTelefono">
                        <span class="input-border"></span>
                        <input type="password" placeholder=" Contraseña " required name="txtContrasena" id="txtContrasena">
                        <span class="input-border"></span>
                        <p id="message">La contraseña es <span id="strenght"></span> </p>
                        <input type="password" placeholder=" Repetir contraseña " required name="txtContrasenaRepe" id="txtContrasenaRepe">
                        <p class="contraseniaMatching"></p>
                        <span class="textoRegister">¿Ya tienes cuenta? <a href="inicio_registro.php">Iniciar Sesion</a></span>
                        <div>
                            <button type="submit">
                              <span>Ingresar</span>
                            </button>
                            <a href="../index.php" class="boton">
                              <span>Volver</span>
                            </a>
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
  <script src="../js/password.js"></script>
  <script src="../js/password_validate.js?v=<?php echo time() ?>"></script>
  <script src="../js/validateUser.js"></script>

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