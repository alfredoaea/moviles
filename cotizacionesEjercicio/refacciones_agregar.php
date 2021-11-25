<!– PARA EJEMPLO DASC — >

<?php
$id_marca_seleccionada = $_GET['marca_id'];
$nombre_marca_seleccionada = $_GET['marca_nombre'];
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
                <form enctype="multipart/form-data" role="form" id="login-form" method="post" class="form-signin" action="refacciones_guardar.php">
                    <div class="h2">
                        Detalles de la refacci&oacute;n
                    </div>

                    <div class="form-group">
                        <label>ID de la marca seleccionada (<?php echo $nombre_marca_seleccionada ?>)</label>
                        <input type="text" id="marca_id" class="form-control" name="marca_id" value="<?php echo $id_marca_seleccionada ?>" readonly="" 
                               placeholder="<?php echo $nombre_marca_seleccionada ?>">
                    </div>

                    <div class="form-group">
                        <label>Nombre de la refacci&oacute;n (requerido)</label>
                        <input type="text" class="form-control" id="nombre_de_refaccion" name="nombre_de_refaccion"
                               placeholder="Ingresa nombre de la refacci&oacute;n" style="text-transform:uppercase;" required>
                    </div>
                    <div class="form-group">
                        <label>Descripci&oacute;n de la refacci&oacute;n</label>
                        <input type="text" class="form-control" id="descripcion_de_refaccion" name="descripcion_de_refaccion"
                               placeholder="Ingresa descripci&oacute;n de esta refacci&oacute;n" style="text-transform:uppercase;">
                    </div>
                    <div class="form-group">
                        <label class="custom-file">Selecciona una imagen en formato jpg o png</label>
                        <input type="file" id="foto" name="foto" class="custom-file-input">
                        <span class="custom-file-control"></span>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <input type="reset" class="btn btn-default" value="Limpiar">
                </form>
            </div>
        </div>
    </body>
</html>

