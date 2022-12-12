<?php
    session_start();
 
    include("../config/db.php");
    include("../config/config.php");
    //creamos cada unos de los scripts, nos devuelve lo datos con el metodo get


    $payment = $_GET['payment_id']; //id de la transacción, es un dato muy importante, es el que identifica el pago que se realizo
    $status = $_GET['status']; //estado de la transaccion
    $payment_type = $_GET['payment_type']; //nos dice el tipo de metodo de pago: tarjeta, efectivo, tarjeta, etc.
    $order_id = $_GET['merchant_order_id']; //orden de la compra
    $date = $_GET['money_release_date'];
    $money = $_GET['transaction_amount'];

 
    echo $payment.'<br>';
    echo $status.'<br>';
    echo $payment_type.'<br>';
    echo $order_id.'<br>'; 
    echo $date.'<br>'; 
    echo $money.'<br>'; 

    /*$sentenciaSQL = $conexion->prepare("INSERT INTO pago (Pago_IdTransaccion, Pago_UsuId, Pago_FormaPago, Pago_Fecha, Pago_Total) VALUES (:Pago_IdTransaccion, :Pago_UsuId, :Pago_FormaPago, :Pago_Fecha, :Pago_Total);");
    $sentenciaSQL->bindParam(':Pago_IdTransaccion',$payment);
    $sentenciaSQL->bindParam(':Pago_UsuId',$_SESSION['idUsuario']);
    $sentenciaSQL->bindParam(':Pago_FormaPago',$payment_type);
    $sentenciaSQL->bindParam(':Pago_Fecha',$date);
    $sentenciaSQL->bindParam(':Pago_Total',$money);
    $sentenciaSQL->execute();*/

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


   <div class="flexGracias">
       <div class="backgroundGracias">
           <div class="containerGracias">
               <img src="../../img/carrito/gifBurger.gif" alt="">
               <h1>Gracias por tu compra en Betos!</h1>
               <p>Tu código de referencia es: <?php echo $payment;?></p>
               <p>Este código te servira para presentarlo en el local o al delivery para poder verificar la compra.</p>
               <a href="../../index.php"><button class="botonInicio">Volver al inicio</button></a>
           </div>
       </div>
   </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
    crossorigin="anonymous"></script>
</body>
</html>