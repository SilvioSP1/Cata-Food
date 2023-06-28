<?php
    session_start();
    error_reporting(0);
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    include("../config/db.php");
    include("../config/config.php");
    //creamos cada unos de los scripts, nos devuelve lo datos con el metodo get
    
    
    $payment = $_GET['payment_id']; //id de la transacción, es un dato muy importante, es el que identifica el pago que se realizo
    $status = $_GET['status']; //estado de la transaccion
    $payment_type = $_GET['payment_type']; //nos dice el tipo de metodo de pago: tarjeta, efectivo, tarjeta, etc.
    $order_id = $_GET['merchant_order_id']; //orden de la compra
    /*$date = $_GET['money_release_date'];
    $money = $_GET['transaction_amount'];*/
    
    /* $response = Http::get("http://api.mercadopago.com/v1/payments/$payment" . "?access_token=APP_USR-5461755461441479-110915-43fbd085c24709d01764eb3373337efb-340183645");
    $response = json_decode($response);

    $date = $response->date_approved; */
    if ($_SESSION['condicion'] == 1) {
        
        if ($status == "approved") {
            $time = date("Y-m-d H:i:s",time());
        }
     
        /* echo $payment.'<br>';
        echo $status.'<br>';
        echo $payment_type.'<br>';
        echo $order_id.'<br>'; 
        echo $_SESSION["total"].'<br>'; 
        echo $time.'<br>';  */
    
        $sentenciaSQL = $conexion->prepare("INSERT INTO pago (Pago_IdTransaccion, Pago_UsuId, Pago_FormaPago, Pago_Fecha, Pago_Total) VALUES (:Pago_IdTransaccion, :Pago_UsuId, :Pago_FormaPago, :Pago_Fecha, :Pago_Total);");
        $sentenciaSQL->bindParam(':Pago_IdTransaccion',$payment);
        $sentenciaSQL->bindParam(':Pago_UsuId',$_SESSION['idUsuario']);
        $sentenciaSQL->bindParam(':Pago_FormaPago',$payment_type);
        $sentenciaSQL->bindParam(':Pago_Fecha',$time);
        $sentenciaSQL->bindParam(':Pago_Total',$_SESSION['total']);
        $sentenciaSQL->execute();
    
        $sentenciaSQL = $conexion->prepare("INSERT INTO venta (Venta_Fecha, Venta_NroFactura, Venta_Neto, Venta_Total, Venta_Status, Venta_UsuId) VALUES (:Venta_Fecha, :Venta_NroFactura, :Venta_Neto, :Venta_Total, :Venta_Status, :Venta_UsuId)");
        $sentenciaSQL->bindParam(':Venta_Fecha',$time);
        $sentenciaSQL->bindParam(':Venta_NroFactura',$payment);
        $sentenciaSQL->bindParam(':Venta_Neto',$_SESSION["total"]);
        $sentenciaSQL->bindParam(':Venta_Total',$_SESSION["total"]);
        $sentenciaSQL->bindParam(':Venta_Status',$status);
        $sentenciaSQL->bindParam(':Venta_UsuId',$_SESSION['idUsuario']);
        $sentenciaSQL->execute();
        $idVenta = $conexion->lastInsertId();
    
        foreach ($_SESSION['carritoCompra'] as $indice => $producto) {
            $sentenciaSQL = $conexion->prepare("INSERT INTO venta_detalle (VD_Cantidad, VD_PrecioUnitario, VD_Costo, VD_VentaId, VD_ProdId) VALUES (:VD_Cantidad, :VD_PrecioUnitario, :VD_Costo, :VD_VentaId, :VD_ProdId)");
            $sentenciaSQL->bindParam(':VD_Cantidad',$producto['cantidad']);
            $sentenciaSQL->bindParam(':VD_PrecioUnitario',$producto['precio']);
            $sentenciaSQL->bindParam(':VD_Costo',$producto['precio']);
            $sentenciaSQL->bindParam(':VD_VentaId',$idVenta);
            $sentenciaSQL->bindParam(':VD_ProdId',$producto['id']);
            $sentenciaSQL->execute();

            $abierto = date("Y-m-d",time());
            $sentenciaSQL = $conexion->prepare("SELECT * FROM horario WHERE Horario_LocalId = :Horario_LocalId AND Horario_Fecha = :Horario_Fecha");
            $sentenciaSQL->bindParam(':Horario_LocalId',$producto['localId']);
            $sentenciaSQL->bindParam(':Horario_Fecha',$abierto);
            $sentenciaSQL->execute();
            $localAbierto = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

            $sentenciaSQL = $conexion->prepare("SELECT * FROM stock_producto WHERE Stock_ProdId = :Stock_ProdId AND Stock_LocalId = :Stock_LocalId AND Stock_HorarioId = :Stock_HorarioId");
            $sentenciaSQL->bindParam(':Stock_ProdId',$producto['id']);
            $sentenciaSQL->bindParam(':Stock_LocalId',$producto['localId']);
            $sentenciaSQL->bindParam(':Stock_HorarioId',$localAbierto['Horario_Id']);
            $sentenciaSQL->execute();
            $stockProducto = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

            $aux = $stockProducto['Stock_Cantidad'] - $producto['cantidad'];
            $sentenciaSQL = $conexion->prepare("UPDATE stock_producto SET Stock_Cantidad = :Stock_Cantidad WHERE Stock_ProdId = :Stock_ProdId AND Stock_HorarioId = :Stock_HorarioId");
            $sentenciaSQL->bindParam(':Stock_ProdId',$producto['id']);
            $sentenciaSQL->bindParam(':Stock_HorarioId',$localAbierto['Horario_Id']);
            $sentenciaSQL->bindParam(':Stock_Cantidad',$aux);
            $sentenciaSQL->execute();
        }
        $_SESSION['condicion'] = 2;
    }

    $_SESSION['carritoCompra'] = null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Finalizada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
    crossorigin="anonymous"></script>
    <link rel="icon" href="../../img/index/logo_redondo.png">

    <link rel="stylesheet" href="../../css/estilos.css?v=<?php echo time(); ?>">
</head>
<body>


   <div class="flexGracias">
       <div class="backgroundGracias">
           <div class="containerGracias">
               <img src="../../img/carrito/gifBurger.gif" alt="" class="imgCaptura">
               <h1>Gracias por tu compra!</h1>
               <p>Tu código de referencia es: <?php echo $order_id;?></p>
               <p>Este código te servira para presentarlo en el local o al delivery para poder verificar la compra.</p>
               <p>Tu total es: <?php echo $_SESSION["total"]; ?></p>
                <a href="https://catafood.shop/Cata-Food/index.php"><button class="botonInicio">Volver al inicio</button></a>
           </div>
       </div>
   </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
    crossorigin="anonymous"></script>
</body>
</html>