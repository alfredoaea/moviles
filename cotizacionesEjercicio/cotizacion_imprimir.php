<?php
session_start();
$nombre_cliente;
if (!isset($_SESSION['nombre_cliente']) && !isset($_SESSION['descripcion_coche']) && !isset($_SESSION['fecha_actual'])) {
    header('Location: cotizacion_inicia.php');
    //echo 'No se ha iniciado sesion';
} else {
    include 'inc/conexion.php';
    $sel = $con->prepare("SELECT cotizacion_detalle_temporal.cotizacion_detalle_temporal_id, refaccion.refaccion_nombre, (precio)+(cotizacion_detalle_incremento_temporal) AS costo_pieza, cotizacion_detalle_temporal.cotizacion_detalle_numero_piezas_temporal, cotizacion_detalle_temporal.cotizacion_detalle_mano_obra, (((precio)+(cotizacion_detalle_incremento_temporal))*(cotizacion_detalle_numero_piezas_temporal))+(cotizacion_detalle_mano_obra) AS costo_parcial
FROM (refaccion INNER JOIN refaccion_proveedor ON refaccion.refaccion_id = refaccion_proveedor.id_refaccion) INNER JOIN cotizacion_detalle_temporal ON refaccion_proveedor.refaccion_proveedor_id = cotizacion_detalle_temporal.refaccion_proveedor_id_temporal;
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
        <meta charset="UTF-8">
        <title>Imprimir cotizaci&oacute;n</title>

        <!-- CSS de Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="css/formularios.css">
        <!-- CSS de Bootstrap -->
    </head>
    <body>
        <div><img src="img/header.jpg" alt=""/> </div>
        <br><br>
        <div class="h2">

            <center><b><label>Cotizaci&oacute;n</label></b></center>
        </div>
        <br>
        <div class="h4">
            <table>
                <tr>
                    <td>Fecha de realizaci&oacute;n:</td><td><u> <?php echo $_SESSION['fecha_actual'] ?> </u></td>
                </tr>
                <tr>
                    <td>Nombre del cliente: </td><td><u><?php echo $_SESSION['nombre_cliente'] ?></u></td>
                </tr>
                <tr>
                    <td>Descripci&oacute;n del coche: </td><td><u><?php echo $_SESSION['descripcion_coche'] ?> </u></td>
                </tr>
            </table>
        </div>

        <br>

        <div class="table-responsive">
            <table class="table table-hover" border="1" cellpadding="10">
                <thead>
                    <tr>
                        <th> No. </th>
                        <th>Refacci&oacute;n</th>
                        <th>Precio</th>
                        <th>No. de piezas</th>
                        <th>Mano de obra</th>
                        <th>Costo parcial</th>
                    </tr>
                </thead>
                <tbody>
                            <?php while ($f = $res->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $f['cotizacion_detalle_temporal_id'] ?></td>
                                    <td><?php echo $f['refaccion_nombre'] ?></td>
                                    <td><?php echo $f['costo_pieza'] ?></td>
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
        <br>
        <div class="h1">
            <b>Total = $
                <?php
                // echo money_format('%=*(#10.2n', $total) . "\n";
                echo number_format($total, 2);
                ?>
            </b>
        </div>
        <br><br>
        <div class="h5">
            <p>
                La presente cotizaci&oacute;n no representa en forma alguna, reserva de inventario<br>
                Precios sujetos a cambios por el proveedor<br>
            </p>
        </div>
        <br><br>
        <div class="h5">
            <p><i>
                    Direcci&oacute;n: Calle 5 de febrero No.300 <br>
                    Teléfono: 22222222<br>
                    mecanico@gmail.com<br>
                </i></p>
        </div>
    </body>
</html>