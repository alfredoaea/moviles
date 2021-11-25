<?php

$nombre_del_cliente_post = strtoupper($_POST['nombre_del_cliente']);
$descripcion_coche_post = strtoupper($_POST['descripcion_coche']);
$fecha_actual_post = $_POST['fecha_actual'];

/*echo $nombre_del_cliente_post;
echo $descripcion_coche_post;
echo $fecha_actual_post;*/

session_start();
$_SESSION['nombre_cliente']  = $nombre_del_cliente_post;
$_SESSION['descripcion_coche'] =$descripcion_coche_post;
$_SESSION['fecha_actual']=$fecha_actual_post;

header('Location: cotizacion_en_curso.php');