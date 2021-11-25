<?php
$error_mensaje = "";
include 'inc/conexion.php';
$mysqli = new mysqli("192.168.56.1", "alfredo", "12345", "tallerbd");
session_start();
if (isset($_SESSION['nombre_cliente']) && isset($_SESSION['descripcion_coche']) && !isset($_SESSION['fecha_actual'])) {
    echo 'La sesion existia, se va adestruir';
}
session_destroy();
if (!$mysqli->query("CALL eliminar_temporal()")) {
    $error_mensaje = "Falló la llamada eliminar temporal: (" . $mysqli->errno . ") " . $mysqli->error;
} else {
    
}
?>
<!DOCTYPE html>


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
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    </head>
    <body>
        <!--código que incluye el menú responsivo-->
        <?php include'inc/incluye_menu.php' ?>
        <!--termina código que incluye el menú responsivo-->
        <div class="container">
            <div class="jumbotron">
                <h3>
                    <?php
                    if (strcmp($error_mensaje, "") == 0) {
                        echo 'Se elimin&oacute; la cotizaci&oacute;n que estaba en curso';
                    } else {
                        echo 'Se gener&oacute un error, avisar al desarrollador error 201'; //lo acabo de inventar
                    }
                    ?>
                </h3>
                <p>
                    <a href="cotizacion_inicia.php" class="btn btn-primary" role="button">ACEPTAR</a>
                </p>
            </div>
        </div>
    </body>
</html>
