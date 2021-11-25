<?php
$mysqli = new mysqli("192.168.56.1", "alfredo", "12345", "tallerbd");
$mysqli2 = new mysqli("192.168.56.1", "alfredo", "12345", "tallerbd");
session_start();
$mensaje = "Sin mensajes";
if (!isset($_SESSION['nombre_cliente']) && !isset($_SESSION['descripcion_coche']) && !isset($_SESSION['fecha_actual'])) {
    header('Location: cotizacion_inicia.php');
    //echo 'No se ha iniciado sesion';
} else {
    include 'inc/conexion.php';
    //$db_table_name = "marca";


    if (!$mysqli->query("CALL guardar_co('" . $_SESSION['nombre_cliente'] . "','" . $_SESSION['descripcion_coche'] . "','" . $_SESSION['fecha_actual'] . "')")) {
        echo "Falló la llamada procedimiento principal: (" . $mysqli->errno . ") " . $mysqli->error;
    } else {
        $mensaje = "La cotizacion se guardó correctamente";
        session_destroy();
        if (!$mysqli2->query("CALL eliminar_temporal()")) {
            echo "Falló la llamada eliminar temporal: (" . $mysqli2->errno . ") " . $mysqli2->error;
        } else {
            
        }
    }
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!– PARA EJEMPLO DASC — >
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
                    <?php echo $mensaje ?>"
                </h3>
                <p>
                    <a href="cotizacion_inicia.php" class="btn btn-primary" role="button">ACEPTAR</a>
                </p>

            </div>
        </div>

    </body>
</html>
