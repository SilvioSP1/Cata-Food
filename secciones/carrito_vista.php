<?php include("../template/header.php"); 
include("../admin/config/db.php");
include("../admin/config/config.php");
include("carrito.php");
?>

<section class="h-100 sectionCarrito" >
  <div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-10">

        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="fw-normal mb-0">Carrito de compras</h3>
        </div>
        
        <?php $total = 0; ?>
        <?php foreach ($_SESSION['carritoCompra'] as $indice => $producto) { ?>
        <div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-2 col-lg-2 col-xl-2">
                <img
                  src="../img/restaurantes/productos/<?php echo $producto['imagen'];?>"
                  class="img-fluid rounded-3" alt="">
              </div>
              <div class="col-md-3 col-lg-3 col-xl-3">
                <p class="lead fw-normal mb-2"><?php echo $producto['nombre']?></p>
                <p><span class="text-muted">Lugar: </span><?php echo $producto['local']?></p>
              </div>
              <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                <!-- <button class="btn btn-link px-2"
                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                  <i class="fas fa-minus iconoMenos"></i>
                </button> -->

                <input id="form1" min="0" name="quantity" value="<?php echo $producto['cantidad'] ?>" type="number"
                  class="form-control form-control-sm" />

                <!-- <button class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                  <i class="fas fa-plus iconoMas"></i>
                </button> -->
              </div>
              <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                <h5 class="mb-0">$<?php echo $producto['precio']?></h5>
              </div>
              <div class="col-md-1 col-lg-1 col-xl-1 text-end">
              <form action="" method="post">
                    <td class="text-center">
                        <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['id'],cod,key) ?>">
                        <button class="text-black icon" type="submit" name ="btnAccion" value="Eliminar"><i class="fas fa-trash fa-lg"></i></button>
                    </td>
                </form>
              </div>
            </div>
          </div>
        </div>
        <?php $total= $total+($producto['precio']*$producto['cantidad']);
              $_SESSION['total'] = $total; ?>
        <?php } ?>
        </div>

        <div class="container-flex">


            <div class="contenedorCarrito">

                <a href="./restaurantes.php" class="btn botonCarrito1">Seguir comprando</a>
                <?php if($_SESSION['carritoCompra'] != null){ ?>
                  <a href="../../Cata-Food/secciones/formulario_pago.php"><button class="btn text-bold botonCarrito3">Checkout</button></a>
                  <button class="btn botonCarrito3">Total: $<?php echo $_SESSION["total"]; ?></button>
                <?php }else{ ?>
                  <a href="../../Cata-Food/secciones/formulario_pago.php"><button class="btn text-bold botonCarrito3">Checkout</button></a>
                  <button class="btn botonCarrito3">Total: $0</button>
                <?php } ?>
            </div>


        </div>

      </div>
    </div>
  </div>


</section>


<?php include("../template/footer.php"); ?>
