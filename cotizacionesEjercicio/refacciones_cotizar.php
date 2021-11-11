<!– PARA EJEMPLO DASC — >
<?php
$id_refaccion_seleccionada = $_GET['refaccion_id'];
$nombre_refaccion_seleccionada = $_GET['refaccion_nombre'];
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
        <?php
        include'inc/incluye_menu.php';
        include 'inc/conexion.php';
        ?>
        <!--termina código que incluye el menú responsivo-->
        <div class="container">
            <div class="jumbotron">

                <h1>Cotizar una Refaccion</h1>
                <form role="form" id="login-form" 
                      method="post" class="form-signin" 
                      action="refacciones_cotizar_guardar.php">
                    <div class="h2">
                        Datos de la Refacci&oacute;n
                    </div>

                    <div class="form-group">
                        <label>ID de la refaccion seleccionada (<?php echo $nombre_refaccion_seleccionada ?>)</label>
                        <input type="text" id="refaccion_id" class="form-control" name="refaccion_id" value="<?php echo $id_refaccion_seleccionada ?>" readonly="" 
                               placeholder="<?php echo $nombre_refaccion_seleccionada ?>">
                    </div>
                    <div class="form-group">
                        <label for="nombre_proveedor">Selecciona el provedor con el que est&aacute;s cotizando la refacci&oacute;n (requerido)</label>
                        <br>
                        <select class="selectpicker" name="proveedor_id">
                            <?php
                            $sel = $con->prepare("SELECT proveedor_id, proveedor_nombre from PROVEEDOR");
                            $sel->execute();
                            $res = $sel->get_result();
                            ?>
                            <?php while ($f = $res->fetch_assoc()) { ?>
                                <option value="<?php echo $f['proveedor_id'] ?>"><?php echo $f['proveedor_nombre'] ?>
                                </option>
                                <?php
                            }
                            $sel->close();
                            $con->close();
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fecha_solicitud">Fecha de solicitud de precio (requerido)</label>
                        <input type="date" class="form-control" id="fecha_solicitud" name="fecha_solicitud"
                               step="1" value="<?php echo date ("Y-m-d");?>" required>
                    </div>
                    <div class="form-group">
                        <label>Precio</label>
                        <input type="number" class="form-control" id="precio" name="precio"
                               placeholder="Ingresa precio actual" step="0.01" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <input type="reset" class="btn btn-default" value="Limpiar">
                </form>
            </div>
        </div>
    </body>
</html>