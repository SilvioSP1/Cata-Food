<?php
include("../admin/config/config.php");
date_default_timezone_set('America/Argentina/Buenos_Aires');
session_start();
error_reporting(0);
$mensaje="";
if (is_numeric(openssl_decrypt($_POST["Prod_Id"],cod,key))) {
  $Prod_Id = openssl_decrypt($_POST["Prod_Id"],cod,key);
}

if (is_numeric(openssl_decrypt($_POST["Local_Id"],cod,key))) {
  $Local_Id = openssl_decrypt($_POST["Local_Id"],cod,key);
}


if ([$_SESSION['usuario'] != "Sin Loguearse"]) 
{
    if (isset($_POST["btnAccion"])) {
        switch ($_POST["btnAccion"]) {
            case 'Agregar':
                if (is_numeric(openssl_decrypt($_POST["Prod_Id"],cod,key))) {
                    $Prod_Id = openssl_decrypt($_POST["Prod_Id"],cod,key);
                    $mensaje.= "Ok id correcto".$Prod_Id;
                }
                else{
                    $mensaje.= "id incorrecto".$Prod_Id;
                }
    
                if (is_string(openssl_decrypt($_POST['Prod_Nombre'],cod,key))) {
                    $Prod_Nombre = openssl_decrypt($_POST['Prod_Nombre'],cod,key);
                    $mensaje.= "ok precio".$Prod_Nombre;
                }else{
                    $mensaje.= "algo pasa con el nombre";
                }
    
                if (is_string(openssl_decrypt($_POST['Prod_Imagen'],cod,key))) {
                    $Prod_Imagen = openssl_decrypt($_POST['Prod_Imagen'],cod,key);
                }else{
                    $mensaje.= "algo pasa con el imagen";
                }
    
                if (is_numeric(openssl_decrypt($_POST['Prod_Precio'],cod,key))) {
                    $Prod_Precio = openssl_decrypt($_POST['Prod_Precio'],cod,key);
                    $mensaje.= "ok precio".$Prod_Precio;
                }else{
                    $mensaje.= "algo pasa con el precio";
                }
    
                if (is_numeric(openssl_decrypt($_POST['cantidad'],cod,key))) {
                    $cantidad = $_POST['conta'];
                    $mensaje.= "ok precio".$cantidad;
                }else{
                    $mensaje.= "algo pasa con el cantidad";
                }
    
                if (is_string(openssl_decrypt($_POST['Prod_Descripcion'],cod,key))) {
                    $Prod_Descripcion = openssl_decrypt($_POST['Prod_Descripcion'],cod,key);
                    $mensaje.= "ok precio".$Prod_Descripcion;
                }else{
                    $mensaje.= "algo pasa con el descripcion";
                }

                if (is_string(openssl_decrypt($_POST['Local_Nombre'],cod,key))) {
                  $Local_Nombre = openssl_decrypt($_POST['Local_Nombre'],cod,key);
                  $mensaje.= "ok local".$Local_Nombre;
                }else{
                    $mensaje.= "algo pasa con el descripcion";
                }
    
                if (!isset($_SESSION['carritoCompra'])) {
                    if ($cantidad <= $_SESSION['stockPro']) {
                        $productoArr = array( 
                            'id'=>$Prod_Id,
                            'imagen'=>$Prod_Imagen,
                            'nombre'=>$Prod_Nombre,
                            'precio'=>$Prod_Precio,
                            'cantidad'=>$cantidad,
                            'descripcion'=>$Prod_Descripcion,
                            'local'=>$Local_Nombre
                        );
                        $_SESSION['carritoCompra'][0] = $productoArr;
                        $mensaje= "Producto agregado";
                    }else{

                        $mensaje= "Producto sin stock suficiente";
                    }
                }
                else{
                    $idProductos = array_column($_SESSION['carritoCompra'],"id");
                    if (in_array($Prod_Id,$idProductos)) {
                        $mensaje= "Ya esta agregado este producto";
                    }
                    else{
                        if ($cantidad <= $_SESSION['stockPro']) {
                            $numeroProductos = count($_SESSION['carritoCompra']);
                            $productoArr = array( 
                                'id'=>$Prod_Id,
                                'imagen'=>$Prod_Imagen,
                                'nombre'=>$Prod_Nombre,
                                'precio'=>$Prod_Precio,
                                'cantidad'=>$cantidad,
                                'descripcion'=>$Prod_Descripcion,
                                'local'=>$Local_Nombre
                            );
                            $_SESSION['carritoCompra'][$numeroProductos] = $productoArr;
                            $mensaje= "Producto agregado";
                        }else{

                            $mensaje= "Producto sin stock suficiente";
                        }
                    }
                }
                /* $mensaje= print_r($_SESSION,true); */
                
                break;
            
            case 'Eliminar':
                if (is_numeric(openssl_decrypt($_POST["id"],cod,key))) {
                    $id = openssl_decrypt($_POST["id"],cod,key);

                    foreach ($_SESSION['carritoCompra'] as $indice => $productoArr) {
                        if ($productoArr['id'] == $id) {
                            unset($_SESSION['carritoCompra'][$indice]);
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

