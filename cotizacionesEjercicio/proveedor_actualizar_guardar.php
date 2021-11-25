<?php
include 'inc/conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_del_proveedor_post = $_POST['id_proveedor'];
    $nombre_del_proveedor_post = strtoupper($_POST['nombre_del_proveedor']);
    $direccion_del_proveedor_post = strtoupper($_POST['direccion_del_proveedor']);
    $telefono_1_post = strtoupper($_POST['telefono_1']);
    $telefono_2_post = strtoupper($_POST['telefono_2']);
    $correo_proveedor_post = strtoupper($_POST['correo_proveedor']);
    
    $ins=$con->prepare("UPDATE proveedor SET proveedor_nombre=?,proveedor_direccion=?,proveedor_telefono=?,proveedor_telefono2=?,proveedor_correo_e=? WHERE proveedor_id=?");
    $ins->bind_param("sssssi",$nombre_del_proveedor_post,$direccion_del_proveedor_post,$telefono_1_post,$telefono_2_post,$correo_proveedor_post,$id_del_proveedor_post);
    if($ins->execute()){
        header("Location: alerta.php?tipo=exito&operacion=Proveedor Actualizado&destino=proveedor_listar.php");
    }
    else{
        header("Location: alerta.php?tipo=fracaso&operacion=Proveedor No Actualizado (Proveedor repetido?)&destino=proveedor_listar.php");
    }
    $ins->close();
    $con->close();

}