<?php include("../template/alert.php"); ?>
<?php
session_start();
error_reporting(0);
    if ($_POST) 
    {

      include("../admin/config/db.php");

      $txtEmail = ($_POST['txtEmail']);
      $txtContrasena = ($_POST['txtContrasena']);
      
      $sentenciaSQL = $conexion->prepare("SELECT * FROM local WHERE Local_Email=:Local_Email AND Local_Contrasena=:Local_Contrasena");
      $sentenciaSQL->bindParam(':Local_Email',$txtEmail,PDO::PARAM_STR);
      $sentenciaSQL->bindParam(':Local_Contrasena',$txtContrasena,PDO::PARAM_STR);
      $sentenciaSQL->execute();
      $locales = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

      $ip = $_SERVER['REMOTE_ADDR'];

      $captcha = $_POST['g-recaptcha-response'];

      $secretkey = "6Lf0yf0iAAAAAOcuDfvUE2GGl98HDOqu9zqKyPIT";

      $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha&remoteip=$ip");

      $atributos = json_decode($response, TRUE); 


      if ($locales['Local_Email'] == $txtEmail && $locales['Local_Contrasena'] == $txtContrasena && $atributos['success']) {
          session_start();
          $_SESSION['usuario'] = $locales;
          $_SESSION['nombreUsuario']=$locales['Local_Nombre'];
          $_SESSION['nombre']=$locales['Local_Dueno'];
          $_SESSION['email']=$locales['Local_Email'];
          $_SESSION['ubicacion']=$locales['Local_Ubicacion'];
          $_SESSION['ubicacionRef']=$locales['Local_UbiRefe'];
          $_SESSION['tipo']=$locales['Local_Tipo'];
          $_SESSION['contraseña']=$locales['Local_Contrasena'];
          $_SESSION['telefono']=$locales['Local_Telefono'];
          $_SESSION['idUsuario']=$locales['Local_Id'];
          $_SESSION['imagen']= $locales['Local_Imagen'];
          $_SESSION['idRol']= 2;
          header("Location:./local.php");
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


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cata Food</title>
  <!-- CSS only Bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

  <!-- CSS -->
  <link rel="stylesheet" href="../css/estilos.css">

  <!-- animation css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <link rel="icon" href="../img/index/logo_redondo.png">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


</head>


<body class="boiler">

  <main>

    <div id="app">

      <!-- CONTEINER -->

      <section class="containerIR1">

            <div class="containerForm1">
                

                <div class="mover">
                    <div class="containerLetras">
                        <img src="../img/registro-local/shops.png" alt="" class="imagenUsuario">
                        <h2>Iniciar Sesion</h2>
                        
                    </div>
                    
    
                    <form method="POST" class="formulario">
                        <input type="email" placeholder="  Email " required name="txtEmail" id="txtEmail">
                        <span class="input-border"></span>
                        <input type="password" placeholder=" Contraseña " required name="txtContrasena" id="txtContrasena">
                        <div id="toggle" onclick="showHide();"></div>

                        <div class="recaptchaFlex">
                            <div class="g-recaptcha" data-sitekey="6Lf0yf0iAAAAAHpCvY2k0oEIlLpjGCQpqF4qMKhT"></div>
                        </div>

                        <div class="contentForm">
                          <span class="textoRegister">¿No tienes cuenta aún? <a href="registrar_negocio.php">Registrarse</a></span>
                          
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
  


</body>

</html>