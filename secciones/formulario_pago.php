<?php

require ('../extensions/vendor/autoload.php'); 
session_start();
error_reporting(0);

MercadoPago\SDK::setAccessToken('APP_USR-5461755461441479-110915-43fbd085c24709d01764eb3373337efb-340183645'); 

$preference = new MercadoPago\Preference(); 

// Hay que crear mas items para poder guardar la infromacion de cada producto y que se muestre a la hora de comprar

foreach ($_SESSION['carritoCompra'] as $indice => $producto) {

    $item = new MercadoPago\Item(); 

    /* $item->id = "00001";  */
    
    $item->title = $producto['nombre']; 

    $item->quantity = $producto['cantidad']; 

    $item->unit_price = 2; 

    $item->currency_id = "ARS"; 

    $productos[] = $item;
}

/* $item->id = "00001"; 
    
$item->title = "Productos"; 

$item->quantity = 1; 

$item->unit_price = 2; 

$item->currency_id = "ARS";  */

$preference->items = $productos;

$preference->back_urls = array(

  "success" => "https://catafood.shop/Cata-Food/secciones/captura.php",
  "fail" => "https://catafood.shop/Cata-Food/admin/secciones/fallo.php"

);

$preference->auto_return = "approved"; 

$preference->binary_mode = true; 

$preference->save();

$_SESSION['condicion'] = 1;

/* if ($_POST) {
    $productoArr = array( 
        'id'=>$Prod_Id,
        'imagen'=>$Prod_Imagen,
        'nombre'=>$Prod_Nombre,
        'precio'=>$Prod_Precio,
        'cantidad'=>$cantidad,
        'descripcion'=>$Prod_Descripcion,
        'local'=>$Local_Nombre
    );
    $_SESSION['info'];
} */


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Cata-Food/css/estilos.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
    crossorigin="anonymous"></script>
    <!-- MercadoPago SDK -->
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <link rel="icon" href="../../Cata-Food/img/index/logo_redondo.png">
    <title>Checkout</title>
</head>

<body>


    <section>

        <div class="container mt-5 px-5">

            <div class="mb-4">

                <h2>Confirma tu orden y paga</h2>

            </div>

            <div class="row">

                <div class="col-md-8">


                    <div class="card p-3">

                        <div class="mt-4 mb-4">

                            <h6 class="text-uppercase">Datos Personales</h6>


                            <div class="row mt-3">

                                <div class="col-md-6">

                                    <div class="inputbox mt-3 mr-2"> <input type="text" name="name" id="nombre" class="form-control"
                                            required> <span>Nombre</span> </div>


                                </div>


                                <div class="col-md-6">

                                    <div class="inputbox mt-3 mr-2"> <input type="text" name="name" id="apellido" class="form-control"
                                            required> <span>Apellido</span> </div>


                                </div>




                            </div>


                            <div class="row mt-2">

                                <div class="col-md-6">

                                    <div class="inputbox mt-3 mr-2"> <input type="text" name="name" id="telefono" class="form-control"
                                            required> <span>Telefono</span> </div>


                                </div>


                                <!-- <div class="col-md-6">

                                    <div class="inputbox mt-3 mr-2"> <input type="text" name="name" class="form-control"
                                            required> <span>Provincia</span> </div>


                                </div> -->




                            </div>

                            <!-- <div class="row mt-2">

                                <div class="col-md-6">

                                    <div class="inputbox mt-3 mr-2"> <input type="text" name="name" class="form-control"
                                            required> <span>Ciudad</span> </div>


                                </div>


                                <div class="col-md-6">

                                    <div class="inputbox mt-3 mr-2"> <input type="text" name="name" class="form-control"
                                            required> <span>Código Postal</span> </div>


                                </div>



                            </div> -->

                            <div class="row mt-2">

                                <div class="tabs">

                                    <div class="tab">

                                        <input type="checkbox" id="chck1" class="inputCheckbox">
                                        <label class="tab-label" for="chck1">Envios</label>
                                        <div class="tab-content">

                                            <div class="containerRadios">

                                                <!-- <input type="radio" id="check1" name="input">
                                                <label for="check1" class="envio">Con envio</label>
                                                <input type="radio" value="check2" name="input">
                                                <label for="check2">Sin envio</label> -->

                                                <input type="radio" name="lang" value="hide" id="hide" onclick="showHideDiv(1)" checked>
                                                Con envio
                                                <input type="radio" name="lang" value="show" id="show" onclick="showHideDiv(2)">
                                                Sin envio

                                                <br><br>

                                                <div id="div">

                                                    <div class="centerEnvio">

                                                        <div class="inputbox mt-3 mr-2"> <input type="text" name="name" id="calle" class="form-control"
                                                        required> <span>Calle</span> </div>

                                                        <div class="inputbox mt-3 mr-2"> <input type="text" name="name" id="altura" class="form-control"
                                                        required> <span>Altura</span> </div>

                                                        <div class="inputbox mt-3 mr-2"> <input type="text" name="name" id="piso" class="form-control"
                                                        required> <span>Piso</span> </div>

                                                    </div>

                                                </div>




                                            </div>
                                        
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="mt-4 mb-4 d-flex justify-content-between">


                        <a href="../../Cata-Food/secciones/carrito_vista.php" class="text-decoration-none"><span class="text-dark">Paso anterior</span></a>
                        <div class="checkout-boton" id="divPagar"></div>

                        <script>
                            let nombre = document.getElementById('nombre');
                            let apellido = document.getElementById('apellido');
                            let telefono = document.getElementById('telefono');
                            let calle = document.getElementById('calle');
                            let altura = document.getElementById('altura');
                            let piso = document.getElementById('piso');
                            let boton = document.getElementById('divPagar');
                            let radio = document.querySelector('input[name="lang"]');
                            boton.hidden = true;
                            function validar(){
                            /*creo una variable de tipo booleano que en principio tendrá un valor true(verdadero),
                            y que se convertirá en false(falso) cuando la condición no se cumpla*/
                            var todo_correcto = true;

                            /*El primer campo a comprobar es el del nombre. Lo traemos por id y verificamos
                            la condición, en este caso, por ejemplo, le decimos que tiene que tener más de dos dígitos
                            para que sea un nombre válido. Si no tiene más de dos dígitos, la variable todo_correcto
                            devolverá false.*/

                            if(document.getElementById('nombre').value.length < 2 ){
                                todo_correcto = false;
                            }else{
                                todo_correcto = true;
                            }
                            if(document.getElementById('apellido').value.length < 2 ){
                                todo_correcto = false;
                            }else{
                                todo_correcto = true;
                            }
                            if(document.getElementById('telefono').value.length < 2 ){
                                todo_correcto = false;
                            }else{
                                todo_correcto = true;
                            }

                            if (document.querySelector('input[name="lang"]:checked')) {
                                if(document.getElementById('calle').value.length < 2 ){
                                todo_correcto = false;
                                }else{
                                    todo_correcto = true;
                                }
                                if(document.getElementById('altura').value.length < 2 ){
                                    todo_correcto = false;
                                }else{
                                    todo_correcto = true;
                                }
                            }else{
                                todo_correcto = true;
                            }

                            /*Por último, y como aviso para el usuario, si no está todo bién, osea, si la variable
                            todo_correcto ha devuelto false al menos una vez, generaremos una alerta advirtiendo
                            al usuario de que algunos datos ingresados no son los que esperamos.*/
                            if(!todo_correcto){
                                boton.hidden = true;
                            }else{
                                boton.hidden = false;
                            }
                            return todo_correcto;
                            }
                            nombre.addEventListener("keyup", validar);
                            apellido.addEventListener("keyup", validar);
                            telefono.addEventListener("keyup", validar);
                            calle.addEventListener("keyup", validar);
                            altura.addEventListener("keyup", validar);
                            telefono.addEventListener("keyup", validar);
                            piso.addEventListener("keyup", validar);
                        </script>


                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card card-blue p-3 text-dark mb-3">

                        <span>Total:</span>
                        <div class="d-flex flex-row align-items-end mb-3">
                            <h1 class="mb-0 priceColor">$<?php echo $_SESSION["total"]; ?></h1>
                        </div>

                        <span>Lista Productos</span>

                        <div class="hightlight">
                            <?php foreach ($_SESSION['carritoCompra'] as $indice => $producto) {?>
                            <ul>
                                <li><span><?php echo $producto['nombre'];?></span></li>
                            </ul>
                            <?php } ?>

                        </div>

                    </div>

                </div>

            </div>


        </div>

        <script>

            const mp = new MercadoPago('APP_USR-8002e71e-7de8-4801-9db3-7fbf448dbf57', { //public key

                locale: 'es-AR' //idioma local

            })

        mp.checkout({
                preference: {

                    id: '<?php  echo $preference->id ?>' //le pasamos el id de referencia, llamamos a la variable preference
                    //una vez que guardamos las preferencias de mercado pago, nos genera un id y ese lo tenemos que pasar aquí

                },

                render: {

                    container: '.checkout-boton', //llamamos al boton para que lo muestre
                    label: 'Pagar', //el texto que va en el boton

                }

            })

        </script>

        <script src="../../Cata-Food/js/showhideRadio.js"></script>

    </section>


</body>

</html>