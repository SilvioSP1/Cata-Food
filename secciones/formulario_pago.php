<?php


require ('../extensions/vendor/autoload.php'); 

MercadoPago\SDK::setAccessToken('APP_USR-5461755461441479-110915-43fbd085c24709d01764eb3373337efb-340183645'); 

$preference = new MercadoPago\Preference(); 

$item = new MercadoPago\Item(); 

$item->id = '0001'; 

$item->title = 'Producto Gorra'; 

$item->quantity = '1'; 

$item->unit_price = 10.00; 

$item->currency_id = "ARS"; 

$preference->items = array($item);

$preference->back_urls = array(

  "success" => "http://localhost/Cata-Food/admin/secciones/captura.php",
  "fail" => "http://localhost/Cata-Food/admin/secciones/fallo.php"

);

$preference->auto_return = "approved"; 

$preference->binary_mode = true; 

$preference->save();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/estilos.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
    crossorigin="anonymous"></script>
    <!-- MercadoPago SDK -->
    <script src="https://sdk.mercadopago.com/js/v2"></script>
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

                                    <div class="inputbox mt-3 mr-2"> <input type="text" name="name" class="form-control"
                                            required="required"> <span>Nombre</span> </div>


                                </div>


                                <div class="col-md-6">

                                    <div class="inputbox mt-3 mr-2"> <input type="text" name="name" class="form-control"
                                            required="required"> <span>Apellido</span> </div>


                                </div>




                            </div>


                            <div class="row mt-2">

                                <div class="col-md-6">

                                    <div class="inputbox mt-3 mr-2"> <input type="text" name="name" class="form-control"
                                            required="required"> <span>Telefono</span> </div>


                                </div>


                                <div class="col-md-6">

                                    <div class="inputbox mt-3 mr-2"> <input type="text" name="name" class="form-control"
                                            required="required"> <span>Provincia</span> </div>


                                </div>




                            </div>

                            <div class="row mt-2">

                                <div class="col-md-6">

                                    <div class="inputbox mt-3 mr-2"> <input type="text" name="name" class="form-control"
                                            required="required"> <span>Ciudad</span> </div>


                                </div>


                                <div class="col-md-6">

                                    <div class="inputbox mt-3 mr-2"> <input type="text" name="name" class="form-control"
                                            required="required"> <span>Código Postal</span> </div>


                                </div>




                            </div>

                        </div>

                    </div>


                    <div class="mt-4 mb-4 d-flex justify-content-between">


                        <a href="../../Cata-Food/secciones/carrito_vista.php" class="text-decoration-none"><span class="text-dark">Paso anterior</span></a>
                        <div class="checkout-boton"></div>


                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card card-blue p-3 text-dark mb-3">

                        <span>Total:</span>
                        <div class="d-flex flex-row align-items-end mb-3">
                            <h1 class="mb-0 yellow">$549</h1> <span>.99</span>
                        </div>

                        <span>Enjoy all the features and perk after you complete the payment</span>

                        <div class="hightlight">

                            <span>100% Guaranteed support and update for the next 5 years.</span>


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

    </section>


</body>

</html>