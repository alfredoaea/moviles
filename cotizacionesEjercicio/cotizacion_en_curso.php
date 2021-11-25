<?php
session_start();
$nombre_cliente;
if (!isset($_SESSION['nombre_cliente']) && !isset($_SESSION['descripcion_coche']) && !isset($_SESSION['fecha_actual'])) {
    header('Location: cotizacion_inicia.php');
    //echo 'No se ha iniciado sesion';
} else {
    include'inc/incluye_bootstrap.php';
    include 'inc/conexion.php';
    include 'inc/incluye_datatable_head.php';
    $sel = $con->prepare("SELECT refaccion.refaccion_nombre, proveedor.proveedor_nombre, refaccion_proveedor.precio, cotizacion_detalle_temporal.cotizacion_detalle_incremento_temporal, cotizacion_detalle_temporal.cotizacion_detalle_numero_piezas_temporal, cotizacion_detalle_temporal.cotizacion_detalle_mano_obra, (((precio)+(cotizacion_detalle_incremento_temporal))*(cotizacion_detalle_numero_piezas_temporal))+(cotizacion_detalle_mano_obra) AS costo_parcial
      FROM (refaccion INNER JOIN (proveedor INNER JOIN refaccion_proveedor ON proveedor.proveedor_id = refaccion_proveedor.id_proveedor) ON refaccion.refaccion_id = refaccion_proveedor.id_refaccion) INNER JOIN cotizacion_detalle_temporal ON refaccion_proveedor.refaccion_proveedor_id = cotizacion_detalle_temporal.refaccion_proveedor_id_temporal;
      ");
    $sel->execute();
    $res = $sel->get_result();
    $row = mysqli_num_rows($res);
}
$total = 0;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--código que incluye Bootstrap-->
        <?php include'inc/incluye_bootstrap.php' ?>
        <!--termina código que incluye Bootstrap-->

        <!-- PARA DATATABLE -->
        <link href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    </head>
    <body>
        <!--código que incluye el menú responsivo-->
        <?php include'inc/incluye_menu.php' ?>
        <!--termina código que incluye el menú responsivo-->
        <div class="container">
            <div class="jumbotron">
                <div class="h3">
                    La cotizaci&oacute;n en curso contiene la siguiente informaci&oacute;n:<br>
                    <label>Nombre del cliente: <?php echo $_SESSION['nombre_cliente'] ?></label><br>
                    <label>Descripci&oacute;n del coche: <?php echo $_SESSION['descripcion_coche'] ?></label>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th> Refaccion </th>
                                <th>Proveedor</th>
                                <th>Precio</th>
                                <th>Incremento</th>
                                <th>No. de piezas</th>
                                <th>Costo mano de obra</th>
                                <th>Costo parcial</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($f = $res->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $f['refaccion_nombre'] ?></td>
                                    <td><?php echo $f['proveedor_nombre'] ?></td>
                                    <td><?php echo $f['precio'] ?></td>
                                    <td><?php echo $f['cotizacion_detalle_incremento_temporal'] ?></td>
                                    <td><?php echo $f['cotizacion_detalle_numero_piezas_temporal'] ?></td>
                                    <td><?php echo $f['cotizacion_detalle_mano_obra'] ?></td>
                                    <td><?php echo $f['costo_parcial'] ?></td>
                                </tr>
                                <?php
                                $total = $total + $f['costo_parcial'];
                            }
                            $sel->close();
                            $con->close();
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="h1">
                    Total a cobrar = $
                    <?php
                    echo number_format($total, 2);
                    ?>
                </div>
                <div class="h2">
                    <p> <a href="cotizacion_seleccionar_refaccion_marca.php" class="btn btn-primary" role="button">A&ntilde;adir m&aacute;s refacciones</a></p>
                    <p> <a href="cotizacion_imprimir.php" target="_blank" class="btn btn-info" role="button">Imprimir esta cotizaci&oacute;n</a></p>
                    <p> <a href="cotizacion_guardar.php" class="btn btn-success" role="button">Guardar esta cotizaci&oacute;n</a></p>
                    <p> <a href="cotizacion_eliminar.php" class="btn btn-danger" role="button">Eliminar esta cotizaci&oacute;n</a></p>

                </div>
            </div>
        </div>

    </body>
</html>