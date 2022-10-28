<?php include("../template/header.php"); ?>
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

      if ($usuarios['Usu_Email'] == $txtEmail && $usuarios['Usu_Contrasena'] == $txtContrasena) {
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
        else
        {
          session_start();
          $_SESSION['usuario'] = $usuarios;
          $_SESSION['nombreUsuario']=$usuarios['Usu_Nombre'] + " " + $usuarios['Usu_Apellido'];
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
                        <img src="../img/login-registro/login.png" alt="" class="imagenUsuario">
                        <h2>Iniciar Sesion</h2>
                        
                    </div>
                    
    
                    <form method="POST" class="formulario">
                        <input type="email" placeholder="  Email " required name="txtEmail" id="txtEmail">
                        <span class="input-border"></span>
                        <input type="password" placeholder=" Contraseña " required name="txtContrasena" id="txtContrasena">
                        <span class="textoRegister">¿No tienes cuenta aún? <a href="registro_inicio.php">Registrarse</a></span>
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

  <!-- JavaScript Bundle with Popper -->
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
  </script>

  <!-- Font awesome -->
  <script src="https://kit.fontawesome.com/0dcf698896.js" crossorigin="anonymous"></script>

  <!-- Anime.js -->
  <script src="../node_modules/animejs/lib/anime.min.js"></script>
  


</body>

</html>