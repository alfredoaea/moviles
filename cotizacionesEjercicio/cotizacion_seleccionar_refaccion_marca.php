<?php
include 'inc/conexion.php';
session_start();
$nombre_cliente;
if (!isset($_SESSION['nombre_cliente']) && !isset($_SESSION['descripcion_coche']) && !isset($_SESSION['fecha_actual'])) {
    header('Location: cotizacion_inicia.php');
    //echo 'No se ha iniciado sesion';
} else {
    
}
?>
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
        <link href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

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
                //Consulta sin parámetros
                $sel = $con->prepare("SELECT *from marca");
                $sel->execute();
                $res = $sel->get_result();
                $row = mysqli_num_rows($res);
                ?>
                Elementos devueltos por la consulta: <?php echo $row ?>
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <th>Id</th>
                    <th>Marca</th>
                    <th>Clic para seleccionar</th>
                    </thead>
                    <tfoot>
                    <th>Id</th>
                    <th>Marca</th>
                    <th>Clic para seleccionar</th>
                    </tfoot>
                    <tbody>
                        <?php while ($f = $res->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $f['marca_id'] ?></td>
                                <td><?php echo $f['marca_nombre'] ?></td>
                                <td><a href="cotizacion_seleccionar_refaccion.php?marca_id=<?php echo $f['marca_id'] ?>&marca_nombre=<?php echo $f['marca_nombre'] ?>">Seleccionar <span class="glyphicon glyphicon-hand-left"></span> </td>
                            </tr>
                            <?php
                        }
                        $sel->close();
                        $con->close();
                        ?>
                    <tbody>
                </table>

            </div>
        </div>
        <?php
        include 'inc/incluye_datatable_pie.php';
        ?>
    </body>
</html>
