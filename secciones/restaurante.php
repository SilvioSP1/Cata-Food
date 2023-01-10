<?php include("../template/header.php"); ?>
<?php 
include("../admin/config/db.php");
include("carrito.php");

if (!empty($_POST["Local_Id"])) {
    
    if (is_numeric(openssl_decrypt($_POST["Local_Id"],cod,key))) {
        $Local_Id = openssl_decrypt($_POST["Local_Id"],cod,key);
        $_SESSION['local'] = openssl_decrypt($_POST["Local_Id"],cod,key);
    }
    $Local_Id = $_SESSION['local'];
}else{
    $Local_Id = $_SESSION['local'];
}

$sentenciaSQL = $conexion->prepare("SELECT Prod_Id,Prod_Nombre,Prod_Descripcion,Prod_Imagen,Prod_Precio,Prod_ABC,Prod_Status,Prod_LocalId,Prod_Tipo,Local_Nombre,TP_Tipo,TP_Imagen FROM producto
JOIN local ON Local_Id = :Local_Id
JOIN tipo_producto ON TP_Tipo = Prod_Tipo
WHERE Prod_LocalId = :Local_Id
ORDER BY Prod_Nombre ASC");
$sentenciaSQL->bindParam(':Local_Id',$Local_Id);
$sentenciaSQL->execute();
$listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL = $conexion->prepare("SELECT * from producto
JOIN local on Prod_LocalId = :Local_Id
JOIN tipo_producto on TP_Tipo = Prod_Tipo
GROUP by Prod_Tipo");
$sentenciaSQL->bindParam(':Local_Id',$Local_Id);
$sentenciaSQL->execute();
$listaTipoProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL = $conexion->prepare("SELECT * FROM local WHERE Local_Id=:Local_Id");
$sentenciaSQL->bindParam(':Local_Id',$Local_Id);
$sentenciaSQL->execute();
$localDelProducto = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_POST["TP_Tipo"])) {
    $sentenciaSQL = $conexion->prepare("SELECT * from producto
    JOIN local on Prod_LocalId = :Local_Id WHERE Prod_Tipo = :Prod_Tipo GROUP BY Prod_Nombre");
    $sentenciaSQL->bindParam(':Local_Id',$Local_Id);
    $sentenciaSQL->bindParam(':Prod_Tipo',$_POST['TP_Tipo']);
    $sentenciaSQL->execute();
    $listaProductosPorTipo = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM tipo_producto");
$sentenciaSQL->execute();
$tipoProducto = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$txtID=(isset($_POST['txtID'])) ? $_POST['txtID'] : null;
$txtNombre=(isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtImagen=(isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : null;
$txtDescripcion=(isset($_POST['txtDescripcion'])) ? $_POST['txtDescripcion'] : "";
$txtPrecio=(isset($_POST['txtPrecio'])) ? $_POST['txtPrecio'] : null;
$txtTipo=(isset($_POST['txtTipo'])) ? $_POST['txtTipo'] : null;
$accion=(isset($_POST['accion2'])) ? $_POST['accion2'] : "";


switch ($accion) {
    case "Agregar":
        $txtABC = 'C';
        $txtLocalId = $Local_Id;
        $txtStatus = 1;
        $sentenciaSQL = $conexion->prepare("INSERT INTO producto (Prod_Nombre , Prod_Descripcion , Prod_Imagen , Prod_Precio , Prod_ABC , Prod_Status , Prod_LocalId , Prod_Tipo) VALUES (:Prod_Nombre,:Prod_Descripcion,:Prod_Imagen,:Prod_Precio,:Prod_ABC,:Prod_Status,:Prod_LocalId,:Prod_Tipo);");
          $sentenciaSQL->bindParam(':Prod_Nombre',$txtNombre);
          $sentenciaSQL->bindParam(':Prod_Descripcion',$txtDescripcion);
          
          $fecha= new DateTime();
          $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg"; 
          
          $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
          if ($tmpImagen!="") {
              move_uploaded_file($tmpImagen,"../../img/restaurantes/productos/".$nombreArchivo);
          }
            
          $sentenciaSQL->bindParam(':Prod_Imagen',$nombreArchivo);
          $sentenciaSQL->bindParam(':Prod_Precio',$txtPrecio);
          $sentenciaSQL->bindParam(':Prod_ABC',$txtABC);
          $sentenciaSQL->bindParam(':Prod_Status',$txtStatus);
          $sentenciaSQL->bindParam(':Prod_LocalId',$txtLocalId);
          $sentenciaSQL->bindParam(':Prod_Tipo',$txtTipo);
          $sentenciaSQL->execute();
        header("Location:restaurante.php");
        break;
    case "Modificar":
        $txtStatus = 2;
        $sentenciaSQL = $conexion->prepare("UPDATE producto SET Prod_Nombre = :Prod_Nombre,Prod_Descripcion = :Prod_Descripcion, Prod_Precio= :Prod_Precio, Prod_Status = :Prod_Status, Prod_Tipo = :Prod_Tipo WHERE Prod_Id = :Prod_Id");
          $sentenciaSQL->bindParam(':Prod_Nombre',$txtNombre);
          $sentenciaSQL->bindParam(':Prod_Descripcion',$txtDescripcion);
          $sentenciaSQL->bindParam(':Prod_Precio',$txtPrecio);
          $sentenciaSQL->bindParam(':Prod_Status',$txtStatus);
          $sentenciaSQL->bindParam(':Prod_Tipo',$txtTipo);
          $sentenciaSQL->bindParam(':Prod_Id',$txtID);
          $sentenciaSQL->execute();

          if ($txtImagen!="") {
            $fecha= new DateTime();
            $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg"; 

            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
            move_uploaded_file($tmpImagen,"../../img/restaurantes/productos/".$nombreArchivo);

            $sentenciaSQL = $conexion->prepare("SELECT Prod_Imagen FROM producto WHERE Prod_Id=:Prod_Id");
            $sentenciaSQL->bindParam(':Prod_Id',$txtID);
            $sentenciaSQL->execute();
            $producto = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
    
            if (isset($producto["Prod_Imagen"]) && ($producto)["Prod_Imagen"]!="imagen.jpg") {
                if (file_exists("../../img/restaurantes/productos/".$producto["Prod_Imagen"])) {
                    unlink("../../img/restaurantes/productos/".$producto["Prod_Imagen"]);
                }
            }

            $sentenciaSQL = $conexion->prepare("UPDATE producto SET Prod_Imagen=:Prod_Imagen WHERE Prod_Id=:Prod_Id");
            $sentenciaSQL->bindParam(':Prod_Imagen',$nombreArchivo);
            $sentenciaSQL->bindParam(':Prod_Id',$txtID);
            $sentenciaSQL->execute();
        }
        header("Location:restaurante.php");
        $txtID="";
        $txtNombre="";
        $txtDescripcion="";
        $txtImagen="";
        $txtPrecio="";
        $txtABC="";
        $txtStatus="";
        $txtLocalId="";
        $txtTipo="";
        /* echo "Presionado boton Modificar"; */
        break;
    case "Cancelar":
        header("Location:restaurante.php");
        $txtID="";
        $txtNombre="";
        $txtDescripcion="";
        $txtImagen="";
        $txtPrecio="";
        $txtABC="";
        $txtStatus="";
        $txtLocalId="";
        $txtTipo="";
        break;
    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM producto WHERE Prod_Id = :Prod_Id");
        $sentenciaSQL->bindParam(':Prod_Id',$txtID);
        $sentenciaSQL->execute();
        $producto = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtNombre=$producto['Prod_Nombre'];
        $txtDescripcion=$producto['Prod_Descripcion'];
        $txtImagen=$producto['Prod_Imagen'];
        $txtPrecio=$producto['Prod_Precio'];
        $txtABC=$producto['Prod_ABC'];
        $txtStatus=$producto['Prod_Status'];
        $txtLocalId=$producto['Prod_LocalId'];
        $txtTipo=$producto['Prod_Tipo'];
        /* echo "Presionado boton Seleccionar"; */
        break;
    case "Desabilitar":
        $sentenciaSQL = $conexion->prepare("UPDATE producto SET Prod_Status = 2 WHERE Prod_Id = :Prod_Id");
        $sentenciaSQL->bindParam(':Prod_Id',$txtID);
        $sentenciaSQL->execute();
        /* echo "Presionado boton Borrar"; */
        header("Location:productos.php");
        break;

    case "Habilitar":
        $sentenciaSQL = $conexion->prepare("UPDATE local SET Prod_Status = 1 WHERE Prod_Id = :Prod_Id");
        $sentenciaSQL->bindParam(':Prod_Id',$txtID);
        $sentenciaSQL->execute();
        /* echo "Presionado boton Borrar"; */
        header("Location:productos.php");
        break;
    
    default:
        # code...
        break;
}


?>
<?php if ($mensaje !="") {?>
<?php if ($mensaje == "Producto agregado") {?>
<script>
    Swal.fire({
        icon: "success",
        title: "Se agrego correctamente",
        text: "<?php echo $mensaje?>",
    });
    //echo $mensaje; //
</script>
<?php }else{?>
<script>
    Swal.fire({
        icon: "error",
        title: "No se agrego correctamente",
        text: "<?php echo $mensaje?>",
    });
</script>
<?php } ?>
<?php } ?>

<div class="conteiner_restaurantes">

    <div class="container-fluid">
        <div class="row justify-content-center g-2 containerColum">
            <div class="col-12 columnas">
                <?php foreach($localDelProducto as $local) { ?>
                <div class="conteimerLocal">
                    <div class="conteinerLocalImagen">
                        <img class="imagenRestaurante"
                            src="../img/restaurantes/locales/<?php echo $local['Local_Imagen']; ?>" alt="">
                    </div>
                    <div class="continerTextoBusca">
                        <div class="contenedorTexto">
                            <div>
                                <?php $localNombre = $local['Local_Nombre'];?>
                                <p class="nombreRestaurante"><strong><?php echo $local['Local_Nombre']; ?></strong></p>
                                <?php $_SESSION['localNombre'] = $local['Local_Nombre'] ?>
                                <p class="ubiRestaurante"><?php echo $local['Local_Ubicacion']; ?></p>
                            </div>
                        </div>
                        <div class="contenedorBuscadorRes">
                            <form class="d-flex containerMedias">
                                <input class="form-control me-1 buscador" type="search" placeholder="🔍︎ Buscar "
                                    aria-label="Search">
                                <button class="btn btn-outline-dark botonBusc text-white" type="submit">Buscar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="row justify-content-center g-2 containerColum">
            <div class="col-3 columnas">
                <div class="contenedorResTipo">
                    <div class="tiposRes">
                        <div aria-label="" class="tipo">
                            <form class="tipo" action="restaurante.php" method="POST">
                                <input type="hidden" name="TP_Tipo" id="TP_Tipo" value="">
                                <button name="btnAccion" type="submit" class="buttonTipo">
                                    <div class="circulo">
                                        <img src="../img/restaurantes/categorias/" aria-hidden="true" class="">
                                    </div>
                                    <div aria-hidden="true" class="sc-tl2hnw-0 hNbawF">Todos</div>
                                </button>
                            </form>
                        </div>
                        <?php foreach($listaTipoProductos as $tipoProductos) { ?>
                        <!-- <div aria-label="" class="tipo">
                                            <div class="circulo">
                                                <img src="../img/restaurantes/categorias/<?php echo $tipoProductos['TP_Imagen']; ?>"
                                                    aria-hidden="true" class="">
                                            </div>
                                            <div aria-hidden="true" class="sc-tl2hnw-0 hNbawF"><?php echo $tipoProductos['TP_Tipo']; ?></div>
                                        </div> -->

                        <div aria-label="" class="tipo">
                            <form class="tipo" action="restaurante.php" method="POST">
                                <input type="hidden" name="TP_Tipo" id="TP_Tipo"
                                    value="<?php echo $tipoProductos['TP_Tipo']; ?>">
                                <button name="btnAccion" type="submit" class="buttonTipo">
                                    <div class="circulo">
                                        <img src="../img/restaurantes/categorias/<?php echo $tipoProductos['TP_Imagen']; ?>"
                                            aria-hidden="true" class="">
                                    </div>
                                    <div aria-hidden="true" class="sc-tl2hnw-0 hNbawF">
                                        <?php echo $tipoProductos['TP_Tipo']; ?></div>
                                </button>
                            </form>
                        </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
            <div class="col-9 columnas">
                <div class="conteinerProductos">
                    <?php if(!empty($listaProductosPorTipo)){ ?>
                    <?php foreach($listaProductosPorTipo as $producto) { ?>
                    <?php if ($producto['Prod_Status'] == 1) { ?>
                    <form class="container__CardProd" action="" method="POST" id="">
                        <button class="userinfo conteinerCardResta producto botonModal" type="button"
                            data-id="<?php echo $producto['Prod_Id']; ?>" onClick="reply_click(this.id)"
                            data-value="<?php echo $_SESSION['localNombre']?>">
                            <img class="imagenRestaurante"
                                src="../img/restaurantes/productos/<?php echo $producto['Prod_Imagen']; ?>" alt="">
                            <div class="contenedorTexto">
                                <p class="nombreRestaurante nombreProducto">
                                    <strong><?php echo $producto['Prod_Nombre']; ?></strong></p>
                                <p class="ubiRestaurante ingredientes"><?php echo $producto['Prod_Descripcion']; ?></p>
                                <h6>$<?php echo $producto['Prod_Precio']; ?></h6>
                            </div>
                        </button>
                    </form>
                    <?php } ?>
                    <?php } ?>
                    <?php }else { ?>
                    <?php foreach($listaProductos as $producto) { ?>
                    <?php if ($producto['Prod_Status'] == 1) { ?>
                    <form class="container__CardProd" action="" method="POST" id="">
                        <button class="userinfo conteinerCardResta producto botonModal" type="button"
                            data-id="<?php echo $producto['Prod_Id']; ?>" onClick="reply_click(this.id)"
                            data-value="<?php echo $_SESSION['localNombre']?>">
                            <img class="imagenRestaurante"
                                src="../img/restaurantes/productos/<?php echo $producto['Prod_Imagen']; ?>" alt="">
                            <div class="contenedorTexto">
                                <p class="nombreRestaurante nombreProducto">
                                    <strong><?php echo $producto['Prod_Nombre']; ?></strong></p>
                                <p class="ubiRestaurante ingredientes"><?php echo $producto['Prod_Descripcion']; ?></p>
                                <h6>$<?php echo $producto['Prod_Precio']; ?></h6>
                            </div>
                        </button>
                    </form>
                    <?php } ?>
                    <?php } ?>
                    <?php } ?>
                    <?php if ($_SESSION['idRol'] == 2 || $_SESSION['idRol' == 3]) { ?>
                    <div class="container__CardProd" action="" method="POST" id="">
                        <button class="conteinerCardResta producto centra" type="button" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            <img class="imagenRestaurante" src="../img/index/IconoDeMas.png" alt="">
                            <!-- <button class="dis" name="accion" type="button" value="Seleccionar" data-bs-toggle="modal" data-bs-target="#exampleModal">Modificar</button> -->
                            <!-- <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> -->
                        </button>
                    </div>
                    <?php } ?>
                </div>
                <input type="hidden" name="id" id="id" value="">
            </div>
        </div>
    </div>

</div>
<div>
    <script type='text/javascript'>
        $(document).ready(function () {
            $('.userinfo').click(function () {
                var userid = $(this).data('id');
                var localNomb = $(this).data('value');
                $.ajax({
                    url: '../admin/config/ajaxfile.php',
                    type: 'post',
                    data: {
                        userid: userid,
                        localNomb: localNomb
                    },
                    success: function (response) {
                        $('.modalVer').html(response);
                        $('#empModal').modal('show');
                    }
                });

            });
        });
    </script>

</div>


<div class="backgroundModal">

    <div class="modal fade" tabindex="-1" role="dialog" id="empModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Producto</h5>
                </div>
                <div class="modal-body modalVer">
                </div>

            </div>
        </div>
    </div>

</div>
<?php if ($_SESSION['idRol'] == 2) { ?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Producto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="">

                    <div class="form-group">
                        <label for="txtNombre" class="form-label">Imagen:</label>
                        <?php echo $txtImagen; ?>
                        <br>
                        <!-- <?php
                                        if ($txtImagen !="") {?>
                                        
                                        <img class="img-thumbnail rounded" src="../img/restaurantes/productos/<?php echo $txtImagen;?>"width="100" alt="">

                                    <?php }?> -->
                        <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Imagen">
                    </div>

                    <div class="form-group">
                        <label for="txtNombre" class="form-label">Nombre:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>"
                            name="txtNombre" id="txtNombre" placeholder="Nombre">
                    </div>

                    <div class="form-group">
                        <label for="txtNombre" class="form-label">Descripciom:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtDescripcion; ?>"
                            name="txtDescripcion" id="txtDescripcion" placeholder="Descripcion">
                    </div>

                    <div class="form-group">
                        <label for="txtNombre" class="form-label">Precio:</label>
                        <input type="number" step="any" required class="form-control" value="<?php echo $txtPrecio; ?>"
                            name="txtPrecio" id="txtPrecio" placeholder="Precio">
                    </div>

                    <div class="form-group">
                        <label for="txtNombre" class="form-label">Tipo:</label>
                        <div>
                            <select name="txtTipo" class="txtTipo" id="txtTipo">

                                <?php if(empty($txtTip)) {?>
                                <option selected disabled>Seleccione uno</option>
                                <?php }else { ?>
                                <option selected><?php echo $txtTipo; ?></option>
                                <?php } ?>

                                <?php foreach($tipoProducto as $tipo){ ?>
                                <option><?php echo $tipo["TP_Tipo"] ?></option>

                                <?php } ?>

                            </select>
                        </div>
                        <!-- <input type="text"  required class="form-control" value="<?php echo $txtTipo; ?>" name="txtTipo" id="txtTipo" placeholder="Tipo Local"> -->
                    </div>

                    <br>
                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="accion2" value="Agregar" class="btn btn-success">Agregar</button>
                        <!-- <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Modificar" class="btn btn-warning">Modificar</button> -->
                        <button type="submit" name="accion2" value="Cancelar" class="btn btn-danger">Cancelar</button>
                    </div>

                </form>
            </div>
            <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div> -->
        </div>
    </div>


    <?php } ?>

    <div class="row contenedorComentarios">
        <div class="col-md-6">

        <div class="containerRating__flex">

        <div class="containerRating">
                    <div class="postRating">
                        <div class="text">Gracias por valorar!</div>
                        <div class="edit">EDITAR</div>
                    </div>
                    <div class="star-widget">
                        <input type="radio" name="rate" id="rate-5" class="inputRating">
                        <label for="rate-5" class="fas fa-star labelRating"></label>
                        <input type="radio" name="rate" id="rate-4" class="inputRating">
                        <label for="rate-4" class="fas fa-star labelRating"></label>
                        <input type="radio" name="rate" id="rate-3" class="inputRating">
                        <label for="rate-3" class="fas fa-star labelRating"></label>
                        <input type="radio" name="rate" id="rate-2" class="inputRating">
                        <label for="rate-2" class="fas fa-star labelRating"></label>
                        <input type="radio" name="rate" id="rate-1" class="inputRating">
                        <label for="rate-1" class="fas fa-star labelRating"></label>
                        <form action="#" class="formRating">
                            <header class="headerRating"></header>
                            <div class="textarea">
                                <textarea cols="30" placeholder="Describe your experience.."></textarea>
                            </div>
                            <div class="btnRating">
                                <button type="submit" class="btnSubmit">Post</button>
                            </div>
                        </form>
                    </div>
                </div>

        </div>

            <div class="panel-body">

                <!--Inicio elementos contenedor-->

                <div class="comment-form-container">
                    <form id="frm-comment">
                        <div class="input-row">
                            <input type="hidden" name="comentario_id" id="commentId" placeholder="Name" /> <input
                                class="input-field" type="text" name="name" id="name" placeholder="Nombres" />
                        </div>
                        <div class="input-row">
                            <textarea class="input-field textComment" type="text" name="comment" id="comment"
                                placeholder="Agregar comentario">  </textarea>
                        </div>
                        <div>
                            <input type="button" class="btn-submit" id="submitButton" value="Publicar Ahora" />
                            <div id="comment-message">Comentario ha sido agregado exitosamente!</div>
                        </div>
                        <div style="clear:both"></div>
                    </form>
                </div>

                <div id="output"></div>
                <script>
                    var totalLikes = 0;
                    var totalUnlikes = 0;

                    function postReply(commentId) {
                        $('#commentId').val(commentId);
                        $("#name").focus();
                    }

                    $("#submitButton").click(function () {
                        $("#comment-message").css('display', 'none');
                        var str = $("#frm-comment").serialize();

                        $.ajax({
                            url: "AgregarComentario.php",
                            data: str,
                            type: 'post',
                            success: function (response) {
                                var result = eval('(' + response + ')');
                                if (response) {
                                    $("#comment-message").css('display', 'inline-block');
                                    $("#name").val("");
                                    $("#comment").val("");
                                    $("#commentId").val("");
                                    listComment();
                                } else {
                                    alert("Failed to add comments !");
                                    return false;
                                }
                            }
                        });
                    });

                    $(document).ready(function () {
                        listComment();
                    });

                    function listComment() {
                        $.post("../../admin/comments/ListaDeComentarios.php",
                            function (data) {
                                var data = JSON.parse(data);

                                var comments = "";
                                var replies = "";
                                var item = "";
                                var parent = -1;
                                var results = new Array();

                                var list = $("<ul class='outer-comment'>");
                                var item = $("<li>").html(comments);

                                for (var i = 0;
                                    (i < data.length); i++) {
                                    var commentId = data[i]['comentario_id'];
                                    parent = data[i]['parent_comentario_id'];

                                    var obj = getLikesUnlikes(commentId);

                                    if (parent == "0") {
                                        if (data[i]['like_unlike'] >= 1) {
                                            like_icon =
                                                "<img src='../../Cata-Food/img/comentarios/MeGusta.png'  id='unlike_" +
                                                data[i]['comentario_id'] +
                                                "' class='like-unlike'  onClick='likeOrDislike(" + data[i][
                                                    'comentario_id'
                                                ] + ",-1)' />";
                                            like_icon +=
                                                "<img style='display:none;' src='../../Cata-Food/img/comentarios/NoMeGusta.png' id='like_" +
                                                data[i]['comentario_id'] +
                                                "' class='like-unlike' onClick='likeOrDislike(" + data[i][
                                                    'comentario_id'
                                                ] + ",1)' />";
                                        } else {
                                            like_icon =
                                                "<img style='display:none;' src='../../Cata-Food/img/comentarios/MeGusta.png'  id='unlike_" +
                                                data[i]['comentario_id'] +
                                                "' class='like-unlike'  onClick='likeOrDislike(" + data[i][
                                                    'comentario_id'
                                                ] + ",-1)' />";
                                            like_icon +=
                                                "<img src='../../Cata-Food/img/comentarios/NoMeGusta.png' id='like_" +
                                                data[i]['comentario_id'] +
                                                "' class='like-unlike' onClick='likeOrDislike(" + data[i][
                                                    'comentario_id'
                                                ] + ",1)' />";

                                        }

                                        comments = "\
                                        <div class='comment-row'>\
                                            <div class='comment-info'>\
                                                <span class='commet-row-label'>De</span>\
                                                <span class='posted-by'>" + data[i]['comment_sender_name'] + "</span>\
                                                <span class='commet-row-label'>a las </span> \
                                                <span class='posted-at'>" + data[i]['date'] + "</span>\
                                            </div>\
                                            <div class='comment-text'>" + data[i]['comment'] + "</div>\
                                            <div>\
                                                <a class='btn-reply' onClick='postReply(" + commentId + ")'>Responder</a>\
                                            </div>\
                                            <div class='post-action'>\ " + like_icon + "&nbsp;\
                                                <span id='likes_" + commentId + "'> " + totalLikes + " Me Gusta </span>\
                                            </div>\
                                        </div>";

                                        var item = $("<li>").html(comments);
                                        list.append(item);
                                        var reply_list = $('<ul>');
                                        item.append(reply_list);
                                        listReplies(commentId, data, reply_list);
                                    }
                                }
                                $("#output").html(list);
                            });
                    }

                    function listReplies(commentId, data, list) {

                        for (var i = 0;
                            (i < data.length); i++) {

                            var obj = getLikesUnlikes(data[i].comentario_id);
                            if (commentId == data[i].parent_comentario_id) {
                                if (data[i]['like_unlike'] >= 1) {
                                    like_icon = "<img src='../../Cata-Food/img/comentarios/MeGusta.png'  id='unlike_" +
                                        data[i]['comentario_id'] + "' class='like-unlike'  onClick='likeOrDislike(" +
                                        data[i]['comentario_id'] + ",-1)' />";
                                    like_icon +=
                                        "<img style='display:none;' src='../../Cata-Food/img/comentarios/NoMeGusta.png' id='like_" +
                                        data[i]['comentario_id'] + "' class='like-unlike' onClick='likeOrDislike(" +
                                        data[i]['comentario_id'] + ",1)' />";

                                } else {
                                    like_icon =
                                        "<img style='display:none;' src='../../Cata-Food/img/comentarios/NoMeGusta.png'  id='unlike_" +
                                        data[i]['comentario_id'] + "' class='like-unlike'  onClick='likeOrDislike(" +
                                        data[i]['comentario_id'] + ",-1)' />";
                                    like_icon += "<img src='../../Cata-Food/img/comentarios/NoMeGusta.png' id='like_" +
                                        data[i]['comentario_id'] + "' class='like-unlike' onClick='likeOrDislike(" +
                                        data[i]['comentario_id'] + ",1)' />";

                                }
                                var comments = "\
                                        <div class='comment-row'>\
                                            <div class='comment-info'>\
                                                <span class='commet-row-label'>De </span>\
                                                <span class='posted-by'>" + data[i]['comment_sender_name'] + "</span>\
                                                <span class='commet-row-label'>a las </span> \
                                                <span class='posted-at'>" + data[i]['date'] + "</span>\
                                            </div>\
                                            <div class='comment-text'>" + data[i]['comment'] + "</div>\
                                            <div>\
                                                <a class='btn-reply' onClick='postReply(" + data[i]['comentario_id'] + ")'>Responder</a>\
                                            </div>\
                                            <div class='post-action'> " + like_icon + "&nbsp;\
                                                <span id='likes_" + data[i]['comentario_id'] + "'> " + totalLikes + " Me Gusta </span>\
                                            </div>\
                                        </div>";

                                var item = $("<li>").html(comments);
                                var reply_list = $('<ul>');
                                list.append(item);
                                item.append(reply_list);
                                listReplies(data[i].comentario_id, data, reply_list);
                            }
                        }
                    }

                    function getLikesUnlikes(commentId) {

                        $.ajax({
                            type: 'POST',
                            async: false,
                            url: 'Envio_MeGusta.php',
                            data: {
                                comentario_id: commentId
                            },
                            success: function (data) {
                                totalLikes = data;
                            }

                        });

                    }


                    function likeOrDislike(comentario_id, like_unlike) {

                        $.ajax({
                            url: 'MeGusta_NoMeGusta.php',
                            async: false,
                            type: 'post',
                            data: {
                                comentario_id: comentario_id,
                                like_unlike: like_unlike
                            },
                            dataType: 'json',
                            success: function (data) {

                                $("#likes_" + comentario_id).text(data + " likes");

                                if (like_unlike == 1) {
                                    $("#like_" + comentario_id).css("display", "none");
                                    $("#unlike_" + comentario_id).show();
                                }

                                if (like_unlike == -1) {
                                    $("#unlike_" + comentario_id).css("display", "none");
                                    $("#like_" + comentario_id).show();
                                }

                            },
                            error: function (data) {
                                alert("error : " + JSON.stringify(data));
                            }
                        });
                    }
                </script>

                <!--Fin elementos contenedor-->
            </div>

            <?php include("../template/footer.php"); ?>