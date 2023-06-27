<?php

require ('../extensions/vendor/autoload.php'); //llamamos al autoload para usar mercadopago
date_default_timezone_set('America/Argentina/Buenos_Aires');
session_start();
error_reporting(0);
MercadoPago\SDK::setAccessToken('APP_USR-4458268088218747-062418-22e275f0d30cfef4521a397d137fd49f-340183645'); //usamos el token


foreach ($_SESSION['carritoCompra'] as $indice => $producto) {

    $preference = new MercadoPago\Preference(); //creamos una variable que se llame preference que va a ser un objeto

    $item = new MercadoPago\Item(); //con esta opción cargamos el producto que vamos a cobrar

    $item->title = $producto['nombre']; //titulo de nuestro producto

    $item->quantity = $producto['cantidad']; //cantidad de nuestro producto

    $item->unit_price = $producto['precio']; //precio de nuestro producto

    $item->currency_id = "ARS"; //la moneda


}

$preference->items = array($item); //es igual al array en el que agregamos item

$preference->save(); //guardamos las preferencias

//capturar la información que nos llega

$preference->back_urls = array(

    "success" => "http://catafood.shop/Cata-Food/admin/secciones/captura.php", //esto es donde se va a redireccionar cuando sea correcto el pago
    "fail" => "http://catafood.shop/Cata-Food/admin/secciones/fallo.php", //si sale mal

); //aca ponemos urls para que nos redireccione cuando se haya terminado el pago

$preference->auto_return = "approved"; //para que nos retorne cuando sea aprobado

$preference->binary_mode = true; //nos ayuda a que solo pueda tener trasacciones aprobadas o rechazadas, hay un tercer status que es pendiente

$_SESSION['condicion'] = 1;

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
    <title>Finalizar compra</title>
</head>

<body class="fondoFormulario">

    <section>

       <div class="container mt-5 px-5">

            <div class="mb-4">

                <h2 class="textoPagar">Confirma tu orden y paga</h2>

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

                                <div class="col-md-6">

                                    <div class="inputbox mt-3 mr-2"> <input type="number" name="name" id="telefono"
                                            class="form-control" required> <span>Telefono</span> </div>


                                </div>


                            </div>


                        </div>

                    </div>


                    <div class="mt-4 mb-4 d-flex justify-content-between">


                        <a href="../../Cata-Food/secciones/carrito_vista.php" class="text-decoration-none"><span class="text-white">Paso anterior</span></a>
                        <div class="checkout-boton" id="divPagar"></div>


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

                    <div class="mercadoPago__div">

                        <img src="../img/formulario-pago/mercado-pago.png" alt="" class="mercadoPago">
                        
                    </div>

                </div>

            </div>


        </div>

        <script>

        const mp = new MercadoPago('APP_USR-e9e54e28-c2d9-4483-9593-819ec4230a74',{ //public key

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

        <script src="../../Cata-Food/js/showhideRadio.js?v=<?php echo time(); ?>"></script>
        <script src="../../Cata-Food/js/radioInputs.js?v=<?php echo time(); ?>"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js?v=<?php echo time(); ?>"></script>

    </section>


</body>

</html>