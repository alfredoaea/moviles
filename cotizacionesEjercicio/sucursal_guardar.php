<?php
include 'inc/conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_del_proveedor_post = strtoupper($_POST['proveedor_id']);
    $nombre_sucursal = strtoupper($_POST['nombre_sucursal']);
    $direccion_sucursal = strtoupper($_POST['direccion_sucursal']);
    $telefono_1 = strtoupper($_POST['telefono_1']);
    $telefono_2 = strtoupper($_POST['telefono_2']);
    $correo_sucursal = strtoupper($_POST['correo_sucursal']);
    $ins=$con->prepare("INSERT INTO sucursal_prov VALUES(?,?,?,?,?,?,?)");
    $ins->bind_param("iisssss",$id,$id_del_proveedor_post,$nombre_sucursal,$direccion_sucursal,$telefono_1,$telefono_2,$correo_sucursal);
    if($ins->execute()){
        header("Location: alerta.php?tipo=exito&operacion=Sucursal Guardada&destino=sucursal_registrar.php");
    }
    else{
        header("Location: alerta.php?tipo=fracaso&operacion=Sucursal No Guardada&destino=sucursal_registrar.php");
    }
    $ins->close();
    $con->close();
}
