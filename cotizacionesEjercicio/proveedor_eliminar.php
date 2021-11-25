<?php
include 'inc/conexion.php';
$id_proveedor_eliminar = $_GET['id_proveedor'];

$ins = $con->prepare("DELETE from proveedor where proveedor_id=?");
$ins->bind_param("i",$id_proveedor_eliminar);
if ($ins->execute()) {
    header("Location: alerta.php?tipo=exito&operacion=Proveedor Eliminado&destino=proveedor_listar.php");
} else {
    header("Location: alerta.php?tipo=fracaso&operacion=Proveedor No Eliminado&destino=proveedor_listar.php");
}
$ins->close();
$con->close();
