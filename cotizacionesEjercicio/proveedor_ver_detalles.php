<?php
$id_proveedor = $_GET['id_proveedor'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--código que incluye Bootstrap-->
        <?php
        include'inc/incluye_bootstrap.php';
        include 'inc/conexion.php';
        ?>
        <!--termina código que incluye Bootstrap-->

        <!-- PARA DATATABLE -->
        <link href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    </head>
    <body>
        <!--código que incluye el menú responsivo-->
        <?php
        include'inc/incluye_menu.php';
        $sel = $con->prepare("SELECT *FROM proveedor WHERE proveedor_id=?");
        $sel->bind_param('i', $id_proveedor);
        $sel->execute();
        $res = $sel->get_result();
        while ($f = $res->fetch_assoc()) {
            ?>
            <!--termina código que incluye el menú responsivo-->
            <div class="container">
                <div class="jumbotron">
                    <h2>Detalles del proveedor</h2>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <th>Campo</th>
                            <th>Valor</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Id del Proveedor</td>
                                    <td><?php echo $f['proveedor_id'] ?></td>
                                </tr>
                                <tr>
                                    <td>Nombre</td>
                                    <td><?php echo $f['proveedor_nombre'] ?></td>
                                </tr>
                                <tr>
                                    <td>Direcci&oacute;n</td>
                                    <td><?php echo $f['proveedor_direccion'] ?></td>
                                </tr>
                                <tr>
                                    <td>Tel&eacute;fono Proveedor</td>
                                    <td><?php echo $f['proveedor_telefono'] ?></td>
                                </tr>
                                <tr>
                                    <td>Tel&eacute;fono 2</td>
                                    <td><?php echo $f['proveedor_telefono2'] ?></td>
                                </tr>
                                <tr>
                                    <td>Correo-e</td>
                                    <td><?php echo $f['proveedor_correo_e'] ?></td>
                                </tr>
                                <?php
                            }
                            $sel->close();
                            $con->close();
                            ?>
                        </tbody>
                    </table>
                </div> 
                <a href="proveedor_listar.php">REGRESAR</a>
            </div>
        </div>

    </body>
</html>