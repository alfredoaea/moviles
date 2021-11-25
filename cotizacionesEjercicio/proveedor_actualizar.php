<?php
$id_proveedor_actualizar = $_GET['id_proveedor'];
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
                <?php
                $sel = $con->prepare("SELECT *from proveedor WHERE proveedor_id=?");
                $sel->bind_param('i', $id_proveedor_actualizar);
                $sel->execute();
                $res = $sel->get_result();
                while ($f = $res->fetch_assoc()) {
                    ?>
                    <h1>Actualizar datos de un Proveedor</h1>
                    <form role="form" id="login-form" 
                          method="post" class="form-signin" 
                          action="proveedor_actualizar_guardar.php">
                        <div class="h2">
                            Datos del proveedor
                        </div>
                        <div class="form-group">
                            <label for="id_del_proveedor">Id del Proveedor (requerido)</label>
                            <input type="text" class="form-control" id="id_proveedor" name="id_proveedor"
                                   value="<?php echo $f['proveedor_id'] ?>" style="text-transform:uppercase;" readonly="">
                        </div>

                        <div class="form-group">
                            <label for="nombre_del_proveedor">Nombre del Proveedor (requerido)</label>
                            <input type="text" class="form-control" id="nombre_del_proveedor" name="nombre_del_proveedor"
                                   value="<?php echo $f['proveedor_nombre'] ?>" style="text-transform:uppercase;" required>
                        </div>
                        <div class="form-group">
                            <label>Direcci&oacute;n (Matr&iacute;z)</label>
                            <input type="text" class="form-control" id="direccion_del_proveedor" name="direccion_del_proveedor"
                                   value="<?php echo $f['proveedor_direccion'] ?>" style="text-transform:uppercase;">
                        </div>

                        <div class="form-group">
                            <label>Tel&eacute;fono 1</label>
                            <input type="tel" class="form-control" id="telefono_1" name="telefono_1"
                                   value="<?php echo $f['proveedor_telefono'] ?>" style="text-transform:uppercase;">
                        </div>

                        <label>Tel&eacute;fono 2</label>
                        <input type="tel" class="form-control" id="telefono_2" name="telefono_2"
                               value="<?php echo $f['proveedor_telefono2'] ?>" style="text-transform:uppercase;">
                        <br>
                        <div class="form-group">
                            <label for="correo_proveedor">Correo electr&oacute;nico</label>

                            <input type="email" class="form-control" id="correo_proveedor" name="correo_proveedor"
                                   value="<?php echo $f['proveedor_correo_e'] ?>" style="text-transform:uppercase;">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Actualizar Datos</button>
                        
                        <input type="button" value=" Cancelar " name="Cancelar" class="btn btn-danger" OnClick="location.href='proveedor_listar' ">
                    </form>
                    <?php
                }
                $sel->close();
                $con->close();
                ?>
            </div>
        </div>

    </body>
</html>

