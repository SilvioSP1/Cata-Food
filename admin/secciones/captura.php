<?php

    //creamos cada unos de los scripts, nos devuelve lo datos con el metodo get


    $payment = $_GET['payment_id']; //id de la transacción, es un dato muy importante, es el que identifica el pago que se realizo
    $status = $_GET['status']; //estado de la transaccion
    $payment_type = $_GET['payment_type']; //nos dice el tipo de metodo de pago: tarjeta, efectivo, tarjeta, etc.
    $order_id = $_GET['merchant_order_id']; //orden de la compra

    echo "<h3>PAGO EXITOSO</h3>";

    echo $payment.'<br>';
    echo $status.'<br>';
    echo $payment_type.'<br>';
    echo $order_id.'<br>';

?>