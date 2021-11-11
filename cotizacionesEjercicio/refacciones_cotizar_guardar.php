<?php
include 'inc/conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $refaccion_id = strtoupper($_POST['refaccion_id']);
    $proveedor_id = strtoupper($_POST['proveedor_id']);
    $fecha_solicitud = strtoupper($_POST['fecha_solicitud']);
    $precio = strtoupper($_POST['precio']);
    
    $ins=$con->prepare("INSERT INTO refaccion_proveedor VALUES(?,?,?,?,?)");
    $ins->bind_param("iiisd",$id,$refaccion_id,$proveedor_id,$fecha_solicitud,$precio);
    if($ins->execute()){
        header("Location: alerta.php?tipo=exito&operacion=Precio de refaccion Guardada&destino=seleccionar_refaccion.php");
    }
    else{
        header("Location: alerta.php?tipo=fracaso&operacion=Precio de Refaccion No Guardada&destino=seleccionar_refaccion.php");
    }
    $ins->close();
    $con->close();
}
