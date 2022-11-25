<?php
    error_reporting(0);
    //creamos cada unos de los scripts, nos devuelve lo datos con el metodo get


    $payment = $_GET['payment_id']; //id de la transacción, es un dato muy importante, es el que identifica el pago que se realizo
    $status = $_GET['status']; //estado de la transaccion
    $payment_type = $_GET['payment_type']; //nos dice el tipo de metodo de pago: tarjeta, efectivo, tarjeta, etc.
    $order_id = $_GET['merchant_order_id']; //orden de la compra

    echo "<h3>PAGO EXITOSO</h3>";
/* 
    echo $payment.'<br>';
    echo $status.'<br>';
    echo $payment_type.'<br>';
    echo $order_id.'<br>'; */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
    crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../../css/estilos.css?v=<?php echo time(); ?>">
</head>
<body>

<div class="panel invoice-list">
    <div class="list-group animate__animated animate__fadeInLeft">
      <a href="#" class="list-group-item list-group-item-action active">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1">Nombre de cliente</h5>
          <small>3 days ago</small>
        </div>
        <p class="amount mb-0">3.200€.</p>
        <div>Concepto de la factura.</div>
      </a>
      <a href="#" class="list-group-item list-group-item-action">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1">Nombre de cliente</h5>
          <small class="text-muted">3 days ago</small>
        </div>
        <p class="amount mb-1">700€</p>
        <div class="text-muted">Donec id elit non mi porta.</div>
      </a>
      <a href="#" class="list-group-item list-group-item-action">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1">Nombre de cliente</h5>
          <small class="text-muted">3 days ago</small>
        </div>
        <p class="amount mb-1">1200€</p>
        <div class="text-muted">Donec id elit non mi porta.</div>
      </a>
    </div>
</div>

<div class="main">
    <div class="container mt-3">
        <div class="card animate__animated animate__fadeIn">
            <div class="card-header">
                Fecha
                <strong>01/01/2018</strong>
                <span class="float-right"> <strong>Estado:</strong> Pendiente</span>

            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-6 col-md-6">
                        <h6 class="mb-2">From:</h6>
                        <div>
                            <strong>Webz Poland</strong>
                        </div>
                        <div>Madalinskiego 8</div>
                        <div>71-101 Szczecin, Poland</div>
                        <div>Email: info@webz.com.pl</div>
                        <div>Phone: +48 444 666 3333</div>
                    </div>

                    <div class="col-6 col-md-6">
                        <h6 class="mb-2">To:</h6>
                        <div>
                            <strong>Bob Mart</strong>
                        </div>
                        <div>Attn: Daniel Marek</div>
                        <div>43-190 Mikolow, Poland</div>
                        <div>Email: marek@daniel.com</div>
                        <div>Phone: +48 123 456 789</div>
                    </div>

                </div>

                <div class="table-responsive-sm">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th scope="col" width="2%" class="center">#</th>
                                <th scope="col" width="20%">Producto/Servicio</th>
                                <th scope="col" class="d-none d-sm-table-cell" width="50%">Descripción</th>

                                <th scope="col" width="10%" class="text-right">P. Unidad</th>
                                <th scope="col" width="8%" class="text-right">Num.</th>
                                <th scope="col" width="10%" class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left">1</td>
                                <td class="item_name">Origin License</td>
                                <td class="item_desc d-none d-sm-table-cell">Extended License</td>

                                <td class="text-right">999,00€</td>
                                <td class="text-right">1</td>
                                <td class="text-right">999,00€</td>
                            </tr>
                            <tr>
                                <td class="center">2</td>
                                <td class="item_name">Custom Services</td>
                                <td class="item_desc d-none d-sm-table-cell">Instalation and Customization (cost per hour)</td>

                                <td class="text-right">150,00€</td>
                                <td class="text-right">20</td>
                                <td class="text-right">3.000,00€</td>
                            </tr>
                            <tr>
                                <td class="center">3</td>
                                <td class="item_name">Hosting</td>
                                <td class="item_desc d-none d-sm-table-cell">1 year subcription</td>

                                <td class="text-right">499,00€</td>
                                <td class="text-right">1</td>
                                <td class="text-right">499,00€</td>
                            </tr>
                            <tr>
                                <td class="center">4</td>
                                <td class="item_name">Platinum Support</td>
                                <td class="item_desc d-none d-sm-table-cell">1 year subcription 24/7</td>

                                <td class="text-right">3.999,00€</td>
                                <td class="text-right">1</td>
                                <td class="text-right">3.999,00€</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                    </div>

                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-sm table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="text-right bg-light">8.497,00€</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Discount (20%)</strong>
                                    </td>
                                    <td class="text-right bg-light">1,699,40€</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>VAT (10%)</strong>
                                    </td>
                                    <td class="text-right bg-light">679,76€</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="text-right bg-light">
                                        <strong>7.477,36€</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
    crossorigin="anonymous"></script>
</body>
</html>