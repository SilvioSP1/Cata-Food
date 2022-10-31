<?php
if(isset($_POST["paises"])){$paises=$_POST["paises"];}
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


</head>


<body class="boiler">

  <main>

    <div id="app">

      <!-- CONTEINER -->

      <section class="containerIR3">


            <div class="containerForm3">
                

                <div class="mover">
                    <div class="containerLetras">
                        <img src="../img/registro-local/shops.png" alt="" class="imagenUsuario">
                        <h2>Registrar Local</h2>
                        
                    </div>
                    
    
                    <form class="formulario">
                        <input type="text" placeholder="  Nombre Local" required>
                        <span class="input-border"></span>
                        <div>
                            <label for="" style="color:black ;">Tipo</label>
                            <select name="genero" class="genero" onchange="this.form.submit()">

                                <option selected disabled>-- Select one --</option>
    
                                <option>Food Track</option>
    
                                <option>Restaurante</option>
                          
                                <option>Cafeteria</option>
                          
                              </select>
                        </div>
                        <span class="input-border"></span>
                        <input type="number" placeholder="  Cantidad de locales " required>
                        <span class="input-border"></span>
                        <input type="text" placeholder="  Nombre " required>
                        <span class="input-border"></span>
                        <input type="text" placeholder="  Apellido " required>
                        <span class="input-border"></span>
                        <input type="tel" placeholder="  Telefono " required>
                        <span class="input-border"></span>
                        <input type="email" placeholder="  Email " required>
                        <span class="input-border"></span>

                        <input id="place_input" type="text" placeholder="  Ubicacion  ">
                        <span class="input-border"></span>
                        <div id="map"></div>

                        <input type="text" placeholder=" Referencia de ubicacion " required>
                        <div>
                            <button >
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
  <script src="/js/map.js"></script>

  <!-- Cargar la API de maps javascript -->
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB55y13evt4FRyWHg_8Wn71KVYdj9aQHPo&libraries=places&callback=initMap"></script>

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