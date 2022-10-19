<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
    crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>

    <div class="container">
        <br />
        <h3 align="center">Productos</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="panel-body">

                    <?php

            include("../admin/config/dbcon.php");
            $query = "select * from producto";
            $result = mysqli_query($conn,$query);

        ?>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="60">Foto</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>View</th>

                                </tr>
                            </thead>

                            <?php while($row = mysqli_fetch_array($result)){ ?>
                            <tr>
                                <td><img src="images/<?php echo $row['Prod_Imagen']; ?>" height="50" width="50" /></td>
                                <td><?php echo $row['Prod_Nombre']; ?></td>
                                <td><?php echo $row['Prod_Descripcion']; ?></td>
                                <td><?php echo $row['Prod_Precio']; ?></td>
                                <td><button data-id='<?php echo $row['Prod_Id']; ?>'
                                        class="userinfo btn btn-primary btn-md">Info</button></td>
                            </tr>
                            <?php } ?>

                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
    
    <div>

        <script type='text/javascript'>
            $(document).ready(function () {
                $('.userinfo').click(function () {
                    var userid = $(this).data('id');
                    $.ajax({
                        url: '../admin/config/ajaxfile.php',
                        type: 'post',
                        data: {
                            userid: userid
                        },
                        success: function (response) {
                            $('.modal-body').html(response);
                            $('#empModal').modal('show');
                        }
                    });

                });
            });
        </script>

    </div>
    



    <div class="backgroundModal">

        <div class="modal fade" tabindex="-1" role="dialog" id="empModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Save changes</button>
                        <a href="./carrito_vista.php"><button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Agregar al carrito</button></a>
                    </div>
                </div>
            </div>
        </div>

    </div>


</body>

</html>