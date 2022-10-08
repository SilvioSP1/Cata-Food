<?php

$mensaje="";

if ([$_SESSION['usuario'] != "Sin Loguearse"]) 
{
    if (isset($_POST["btnAccion"])) {
        switch ($_POST["btnAccion"]) {
            case 'Agregar':
                if (is_numeric(openssl_decrypt($_POST["Prod_Id"],cod,key))) {
                    $id = openssl_decrypt($_POST["Prod_Id"],cod,key);
                    $mensaje.= "Ok id correcto".$id;
                }
                else{
                    $mensaje.= "id incorrecto".$id;
                }
    
                if (is_string(openssl_decrypt($_POST['nombre'],cod,key))) {
                    $nombre = openssl_decrypt($_POST['nombre'],cod,key);
                    $mensaje.= "ok precio".$nombre;
                }else{
                    $mensaje.= "algo pasa con el nombre";
                }
    
                if (is_file(openssl_decrypt($_POST['imagen'],cod,key))) {
                    $imagen = openssl_decrypt($_POST['imagen'],cod,key);
                }else{
                    $mensaje.= "algo pasa con el imagen";
                }
    
                if (is_numeric(openssl_decrypt($_POST['precio'],cod,key))) {
                    $precio = openssl_decrypt($_POST['precio'],cod,key);
                    $mensaje.= "ok precio".$precio;
                }else{
                    $mensaje.= "algo pasa con el precio";
                }
    
                if (is_numeric(openssl_decrypt($_POST['cantidad'],cod,key))) {
                    $cantidad = $_POST['conta'];
                    $mensaje.= "ok precio".$cantidad;
                }else{
                    $mensaje.= "algo pasa con el cantidad";
                }
    
                if (is_string(openssl_decrypt($_POST['descripcion'],cod,key))) {
                    $descripcion = openssl_decrypt($_POST['descripcion'],cod,key);
                    $mensaje.= "ok precio".$descripcion;
                }else{
                    $mensaje.= "algo pasa con el descripcion";
                }
    
                if (!isset($_SESSION['carrito'])) {
                    $productoArr = array( 
                        'id'=>$id,
                        'nombre'=>$nombre,
                        'precio'=>$precio,
                        'cantidad'=>$cantidad,
                        'descripcion'=>$descripcion
                    );
                    $_SESSION['carrito'][0] = $productoArr;
                    $mensaje= "Producto agreagdo";
                }
                else{
                    $idProductos = array_column($_SESSION['carrito'],"id");
                    if (in_array($id,$idProductos)) {
                        $mensaje= "Ya esta agreagdo este producto";
                    }
                    else{
                        $numeroProductos = count($_SESSION['carrito']);
                        $productoArr = array( 
                            'id'=>$id,
                            'nombre'=>$nombre,
                            'precio'=>$precio,
                            'cantidad'=>$cantidad,
                            'descripcion'=>$descripcion
                        );
                        $_SESSION['carrito'][$numeroProductos] = $productoArr;
                        $mensaje= "Producto agreagdo";
                    }
                }
                /* $mensaje= print_r($_SESSION,true); */
                
                break;
            
            case 'Eliminar':
                if (is_numeric(openssl_decrypt($_POST["id"],cod,key))) {
                    $id = openssl_decrypt($_POST["id"],cod,key);

                    foreach ($_SESSION['carrito'] as $indice => $productoArr) {
                        if ($productoArr['id'] == $id) {
                            unset($_SESSION['carrito'][$indice]);
                            /* echo "<script>alert('Elemento borrado');</script>"; */
                        }
                    }
                }
                break;

            default:
                # code...
                break;
        }
    }
}
else{
    echo "<script>alert(No ha iniciado sesion);</script>";
    $mensaje= "Inicie sesion para poder efectuar una compra";
}


?>

<?php include("../template/header.php"); ?>


<section class="h-100 sectionCarrito" >
  <div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-10">

        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="fw-normal mb-0 text-black">Carrito de compras</h3>
        </div>

        <div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-2 col-lg-2 col-xl-2">
                <img
                  src="../../Cata-Food/img/carrito/cheeseburger.png"
                  class="img-fluid rounded-3" alt="Cotton T-shirt">
              </div>
              <div class="col-md-3 col-lg-3 col-xl-3">
                <p class="lead fw-normal mb-2">Cheese Burger</p>
                <p><span class="text-muted">Lugar: </span>Mostaza</p>
              </div>
              <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                <button class="btn btn-link px-2"
                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                  <i class="fas fa-minus iconoMenos"></i>
                </button>

                <input id="form1" min="0" name="quantity" value="2" type="number"
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
                <a href="#!" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-2 col-lg-2 col-xl-2">
                <img
                  src="../../Cata-Food/img/carrito/betosAmericano.png"
                  class="img-fluid rounded-3" alt="Cotton T-shirt">
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

                <input id="form1" min="0" name="quantity" value="2" type="number"
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
                <a href="#!" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
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
                  class="img-fluid rounded-3" alt="Cotton T-shirt">
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

                <input id="form1" min="0" name="quantity" value="2" type="number"
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
                <a href="#!" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
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
                  class="img-fluid rounded-3" alt="Cotton T-shirt">
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

                <input id="form1" min="0" name="quantity" value="2" type="number"
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
                <a href="#!" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="container-flex">


            <div class="contenedorCarrito">

                <button class="btn btn-warning botonCarrito1">Seguir comprando</button>
                <button class="btn btn-warning botonCarrito2">Finalizar Compra</button>
                <button class="btn btn-warning botonCarrito3">Total: $2000</button>

            </div>


        </div>

        

        


      </div>
    </div>
  </div>
</section>





<?php include("../template/footer.php"); ?>

