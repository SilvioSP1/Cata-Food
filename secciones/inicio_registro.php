<?php include("../template/alert.php"); ?>
<?php
session_start();
error_reporting(0);
    if ($_POST) 
    {

      include("../admin/config/db.php");

      $txtEmail = ($_POST['txtEmail']);
      $txtContrasena = ($_POST['txtContrasena']);
      
      $sentenciaSQL = $conexion->prepare("SELECT * FROM usuario WHERE Usu_Email=:Usu_Email AND Usu_Contrasena=:Usu_Contrasena");
      $sentenciaSQL->bindParam(':Usu_Email',$txtEmail,PDO::PARAM_STR);
      $sentenciaSQL->bindParam(':Usu_Contrasena',$txtContrasena,PDO::PARAM_STR);
      $sentenciaSQL->execute();
      $usuarios = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);



      $ip = $_SERVER['REMOTE_ADDR'];

      $captcha = $_POST['g-recaptcha-response'];

      $secretkey = "6LcDv0UkAAAAAGDseH3tzcFkaFITjVFJ60duerFg";

      $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha&remoteip=$ip");

      $atributos = json_decode($response, TRUE); 


      if ($usuarios['Usu_Email'] == $txtEmail && $usuarios['Usu_Contrasena'] == $txtContrasena && $atributos['success'] && $usuarios['Usu_Nombre'] != 3) {
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
      else if(!$atributos['success']){

        echo '<script>
        Swal.fire({
         icon: "error",
         title: "Error",
         text: "No se verifico el captcha",
         });
        </script>';

      }
      else 
      {
        
        echo '<script>
        Swal.fire({
         icon: "error",
         title: "Oops...",
         text: "¡El usuario o la contraseña son incorrectos!",
         });
        </script>';
        
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

      <section class="containerIR1">

            <div class="containerForm1">
                

                <div class="mover">
                    <div class="containerLetras">
                        <img src="../img/login-registro/login.png" alt="" class="imagenUsuario">
                        <h2>Iniciar Sesion</h2>
                        
                    </div>
                    
    
                    <form method="POST" class="formulario">
                        <input type="email" placeholder="  Email " required name="txtEmail" id="txtEmail">
                        <span class="input-border"></span>
                        <input type="password" placeholder=" Contraseña " required name="txtContrasena" id="txtContrasena" class="password">
                        <div id="toggle" onclick="showHide();"></div>

                        <div class="recaptchaFlex">
                            <div class="g-recaptcha" data-sitekey="6LcDv0UkAAAAAEiaqFBQJ7_tHdiaCtpLN2whk7T9"></div>
                        </div>

                        <div class="contentForm">
                        <span class="textoRegister">¿No tienes cuenta aún? <a href="registro_inicio.php">Registrarse</a></span>
                        
                        <div class="contenidoModificar">
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

  <script src="../js/show_hide.js"></script>
  <script src="../js/boiler.js"></script>
  <script src="../js/loader.js"></script>
  

  <!-- JavaScript Bundle with Popper -->
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
  </script>

  <!-- Font awesome -->
  <script src="https://kit.fontawesome.com/0dcf698896.js" crossorigin="anonymous"></script>

  <!-- Anime.js -->
  <script src="../node_modules/animejs/lib/anime.min.js"></script>
  
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

  <script src="../../Cata-Food/js/darkMode.js?v=<?php echo time(); ?>"></script>


</body>

</html>