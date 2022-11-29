<?php include("../template/header.php"); 
include("../admin/config/db.php");
include("carrito.php");
?>

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


<section class="h-100 sectionCarrito" >
  <div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-10">

        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="fw-normal mb-0 text-black">Carrito de compras</h3>
        </div>
        
        <?php $total = 0; ?>
        <?php foreach ($_SESSION['carritoCompra'] as $indice => $producto) { ?>
        <div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-2 col-lg-2 col-xl-2">
                <img
                  src="../../Cata-Food/img/carrito/<?php echo $producto['imagen']?>"
                  class="img-fluid rounded-3" alt="">
              </div>
              <div class="col-md-3 col-lg-3 col-xl-3">
                <p class="lead fw-normal mb-2"><?php echo $producto['nombre']?></p>
                <p><span class="text-muted">Lugar: </span><?php echo $producto['local']?></p>
              </div>
              <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                <button class="btn btn-link px-2"
                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                  <i class="fas fa-minus iconoMenos"></i>
                </button>

                <input id="form1" min="0" name="quantity" value="<?php echo $producto['cantidad'] ?>" type="number"
                  class="form-control form-control-sm" />

                <button class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                  <i class="fas fa-plus iconoMas"></i>
                </button>
              </div>
              <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                <h5 class="mb-0">$<?php echo $producto['precio']?></h5>
              </div>
              <div class="col-md-1 col-lg-1 col-xl-1 text-end">
              <form action="" method="post">
                    <td class="text-center">
                        <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['id'],cod,key) ?>;">
                        <button class="text-black icon" type="submit" name ="btnAccion" value="Eliminar"><i class="fas fa-trash fa-lg"></i></button>
                    </td>
                </form>
              </div>
            </div>
          </div>
        </div>
        <?php $total =$total+($producto['precio']*$producto['cantidad']); ?>
        <?php } ?>

        <!-- <div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-2 col-lg-2 col-xl-2">
                <img
                  src="../../Cata-Food/img/carrito/betosAmericano.png"
                  class="img-fluid rounded-3" alt="">
              </div>
              <div class="col-md-3 col-lg-3 col-xl-3">
                <p class="lead fw-normal mb-2">Betos Americano</p>
                <p><span class="text-muted">Lugar: </span>Betos Lomos</p>
              </div>
              <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                <button class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                  <i class="fas fa-minus iconoMenos"></i>
                </button>

                <input id="form1" min="0" name="quantity" value="1" type="number"
                  class="form-control form-control-sm" />

                <button class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                  <i class="fas fa-plus iconoMas"></i>
                </button>
              </div>
              <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                <h5 class="mb-0">$500.00</h5>
              </div>
              <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                <a href="#!" class="text-black"><i class="fas fa-trash fa-lg"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-2 col-lg-2 col-xl-2">
                <img
                  src="../../Cata-Food/img/carrito/medialunas-calentitas.jpg"
                  class="img-fluid rounded-3" alt="">
              </div>
              <div class="col-md-3 col-lg-3 col-xl-3">
                <p class="lead fw-normal mb-2">Medialunas</p>
                <p><span class="text-muted">Lugar: </span>Medialunas Calentitas</p>
              </div>
              <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                <button class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                  <i class="fas fa-minus iconoMenos"></i>
                </button>

                <input id="form1" min="0" name="quantity" value="1" type="number"
                  class="form-control form-control-sm" />

                <button class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                  <i class="fas fa-plus iconoMas"></i>
                </button>
              </div>
              <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                <h5 class="mb-0">$500.00</h5>
              </div>
              <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                <a href="#!" class="text-black"><i class="fas fa-trash fa-lg"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-2 col-lg-2 col-xl-2">
                <img
                  src="../../Cata-Food/img/carrito/alfajoresHavana.png"
                  class="img-fluid rounded-3" alt="">
              </div>
              <div class="col-md-3 col-lg-3 col-xl-3">
                <p class="lead fw-normal mb-2">Alfajores Dulce de Leche</p>
                <p><span class="text-muted">Lugar: </span>Havana</p>
              </div>
              <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                <button class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                  <i class="fas fa-minus iconoMenos"></i>
                </button>

                <input id="form1" min="0" name="quantity" value="1" type="number"
                  class="form-control form-control-sm" />

                <button class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                  <i class="fas fa-plus iconoMas"></i>
                </button>
              </div>
              <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                <h5 class="mb-0">$500.00</h5>
              </div>
              <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                <a href="#!" class="text-black"><i class="fas fa-trash fa-lg"></i></a>
              </div>
            </div>
          </div> -->
        </div>

        <div class="container-flex">


            <div class="contenedorCarrito">

                <div class="checkout-btn"></div>
                <button class="btn btn-warning botonCarrito1">Seguir comprando</button>
                <button class="btn btn-warning botonCarrito3">Total: $<?php echo $total; ?></button>

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

        container: '.checkout-btn', //llamamos al boton para que lo muestre
        label: 'Pagar', //el texto que va en el boton

      }

    })

    </script>

</section>





<?php include("../template/footer.php"); ?>
