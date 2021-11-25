<?php
session_start();
$nombre_cliente;
if (!isset($_SESSION['nombre_cliente']) && !isset($_SESSION['descripcion_coche']) && !isset($_SESSION['fecha_actual'])) {
    header('Location: cotizacion_inicia.php');
    //echo 'No se ha iniciado sesion';
} else {
    $refaccion_proveedor_id = $_GET['refaccion_proveedor_id'];
    include 'inc/conexion.php';

    $sel = $con->prepare("SELECT marca.marca_nombre, refaccion.refaccion_nombre, refaccion.refaccion_descripcion, proveedor.proveedor_nombre, refaccion_proveedor.fecha_solicitud, refaccion_proveedor.precio, refaccion_proveedor.refaccion_proveedor_id
FROM (marca INNER JOIN refaccion ON marca.marca_id = refaccion.marca_id) INNER JOIN (proveedor INNER JOIN refaccion_proveedor ON proveedor.proveedor_id = refaccion_proveedor.id_proveedor) ON refaccion.refaccion_id = refaccion_proveedor.id_refaccion
GROUP BY marca.marca_nombre, refaccion.refaccion_nombre, refaccion.refaccion_descripcion, proveedor.proveedor_nombre, refaccion_proveedor.fecha_solicitud, refaccion_proveedor.precio, refaccion_proveedor.refaccion_proveedor_id
HAVING (((refaccion_proveedor.refaccion_proveedor_id)=" . $refaccion_proveedor_id . "))
ORDER BY refaccion.refaccion_nombre, refaccion_proveedor.fecha_solicitud DESC;");
    $sel->execute();
    $res = $sel->get_result();
    $row = mysqli_num_rows($res);
    while ($f = $res->fetch_assoc()) {
        $marca_nombre = $f["marca_nombre"];
        $refaccion_nombre = $f["refaccion_nombre"];
        $refaccion_descripcion = $f["refaccion_descripcion"];
        $proveedor_nombre = $f["proveedor_nombre"];
        $fecha_solicitud = $f["fecha_solicitud"];
        $precio = $f["precio"];
    }
    $sel->close();
    $con->close();
}
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

    </head>
    <body>
        <!--código que incluye el menú responsivo-->
        <?php include'inc/incluye_menu.php' ?>
        <!--termina código que incluye el menú responsivo-->
        <div class="container">
            <div class="jumbotron">
                <form role="form" id="login-form" method="post" class="form-signin" action="seleccionar_refaccion_detalles_guardar.php">
                    <div class="h2">
                        Detalles para cotizaci&oacute;n
                    </div>

                    <div class="form-group">
                        <label>ID seleccionado (<?php echo $refaccion_proveedor_id ?>)</label>
                        <input type="text" id="refaccion_proveedor_id_seleccionado" class="form-control" name="refaccion_proveedor_id_seleccionado" value="<?php echo $refaccion_proveedor_id ?>" readonly="" 
                               placeholder="<?php echo $refaccion_proveedor_id ?>">
                    </div>

                    <div class="form-group">
                        <label>Nombre de la marca</label>
                        <input type="text" class="form-control" id="marca_nombre" name="marca_nombre" readonly=""
                               placeholder="<?php echo $marca_nombre ?>" style="text-transform:uppercase;">
                    </div>
                    <div class="form-group">
                        <label>Nombre de la refacci&oacute;n</label>
                        <input type="text" class="form-control" id="refaccion_nombre" name="refaccion_nombre" readonly=""
                               placeholder="<?php echo $refaccion_nombre ?>" style="text-transform:uppercase;">
                    </div>
                    <div class="form-group">
                        <label>Descripci&oacute;n de la refacci&oacute;n</label>
                        <input type="text" class="form-control" id="refaccion_descripcion" name="refaccion_descripcion" readonly=""
                               placeholder="<?php echo $refaccion_descripcion ?>" style="text-transform:uppercase;">
                    </div>
                    <div class="form-group">
                        <label>Nombre del proveedor</label>
                        <input type="text" class="form-control" id="proveedor_nombre" name="proveedor_nombre" readonly=""
                               placeholder="<?php echo $proveedor_nombre ?>" style="text-transform:uppercase;">
                    </div>
                    <div class="form-group">
                        <label>Fecha en que se solicit&oacute; el precio</label>
                        <input type="text" class="form-control" id="fecha_solicitud" name="fecha_solicitud" readonly=""
                               placeholder="<?php echo $fecha_solicitud ?>">
                    </div>
                    <div class="form-group">
                        <label>Precio de la refacci&oacute;n</label>
                        <input type="text" class="form-control" id="precio" name="precio" readonly=""
                               placeholder="$ <?php echo $precio ?>">
                    </div>
                    <div class="form-group">
                        <label>Incremento al precio individual $ (requerido)</label>
                        <input type="number" class="form-control" id="incremento_precio" name="incremento_precio" step="0.01"
                               placeholder="Incremento al precio" required>
                    </div>
                    <div class="form-group">
                        <label>N&uacute;mero de piezas $ (requerido)</label>
                        <input type="number" class="form-control" id="numero_piezas" name="numero_piezas" step="1"
                               placeholder="N&uacute;mero de piezas" required>
                    </div>
                    <div class="form-group">
                        <label>Costo por mano de obra $ (requerido)</label>
                        <input type="number" class="form-control" id="mano_obra" name="mano_obra" step="0.01"
                               placeholder="Costo por mano de obra" required>
                    </div>
                    <br>

                    <button type="submit" class="btn btn-primary">Agregar a cotizaci&oacute;n actual</button>
                    <input type="reset" class="btn btn-default" value="Limpiar">
                </form>

            </div>
        </div>

    </body>
</html>