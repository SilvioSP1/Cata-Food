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