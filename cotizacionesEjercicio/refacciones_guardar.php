<?php
include 'inc/conexion.php';
$refaccion_id = "";
$marca_id_post = $_POST['marca_id'];
$nombre_refaccion_post = strtoupper($_POST['nombre_de_refaccion']);
$descripcion_refaccion_post = strtoupper($_POST['descripcion_de_refaccion']);
$refaccion_imagen = "imagenes_refacciones/default.jpg";

$sel = $con->prepare("SELECT refaccion_id,marca_id,refaccion_nombre FROM refaccion where marca_id=? AND refaccion_nombre=?");
$sel->bind_param('is', $marca_id_post, $nombre_refaccion_post);
$sel->execute();
$res = $sel->get_result();
$row = mysqli_num_rows($res);

if ($row != 0) {
    echo "YA EXISTE LA REFACCI&Oacute;N " . $nombre_refaccion_post . " PARA LA MARCA SELECCIONADA";
    echo "¿Deseas agregarle un nuevo precio de proveedor?";
    echo "<a href=\"refacciones_proveedores.php?refaccion_id=" . $refaccion_id . "&refaccion_nombre=" . $nombre_refaccion_post . "\" class=\"btn btn-primary\" role=\"button\"> AGREGAR </a>";
    echo "<a href=\"refacciones_seleccionar_marca.php\" class=\"btn btn-default\" role=\"button\"> CANCELAR </a>";
} else {
    $ins = $con->prepare("INSERT INTO refaccion VALUES(?,?,?,?,?)");
    $ins->bind_param("iisss", $id, $marca_id_post, $nombre_refaccion_post, $descripcion_refaccion_post, $refaccion_imagen);
    if ($ins->execute()) {
        //SUBIR LA IMAGEN
        $ultimo_id = "noWhile";
        $extension = '';
        $ruta = 'imagenes_refacciones';
        $archivo = $_FILES['foto']['tmp_name']; //foto es el name del input en el formulario
        $nombrearchivo = $_FILES['foto']['name'];
        $info = pathinfo($nombrearchivo);
        if ($archivo != '') {
            $extension = $info['extension'];
            if ($extension == "png" || $extension == "PNG" || $extension == "JPG" || $extension == "jpg") {
                //CONSULTAMOS EL ID DEL ULTIMO REGISTRO SUBIDO
                $sel = $con->prepare("SELECT MAX(refaccion_id)as ultima_refaccion FROM refaccion;");
                $sel->execute();
                $res = $sel->get_result();
                while ($f = $res->fetch_assoc())
                    $ultimo_id = $f['ultima_refaccion'];

                //FIN //CONSULTAMOS EL ID DEL ULTIMO REGISTRO SUBIDO
                //SUBIMOS LA IMAGEN CAMBIANDO SU NOMBRE POR EL DEL ULTIMO ID
                move_uploaded_file($archivo, 'imagenes_refacciones/' . $ultimo_id . '.' . $extension);
                $ruta = $ruta . "/" . $ultimo_id . '.' . $extension;
                //FIN SUBIMOS LA IMAGEN CAMBIANDO SU NOMBRE POR EL DEL ULTIMO ID
                //ACTUALIZAMOS EL CAMPO QUE CONTIENE EL NOMBRE DE LA IMAGEN EN LA BD
                $sel = $con->prepare("UPDATE refaccion SET refaccion_imagen='" . $ruta . "' WHERE refaccion_id=?;");
                $sel->bind_param('i', $ultimo_id);
                $sel->execute();
                //FIN ACTUALIZAMOS EL CAMPO QUE CONTIENE EL NOMBRE DE LA IMAGEN EN LA BD
                header("Location: alerta.php?tipo=exito&operacion=Refaccion guardada, imagen almacenada&destino=refacciones_seleccionar_marca.php?");
            } else {
                header("Location: alerta.php?tipo=fracaso&operacion=Formato de imagen no valido, utiliza jpg o png &destino=refacciones_seleccionar_marca.php");
            }
        } else {

            header("Location: alerta.php?tipo=exito&operacion=Refaccion guardada, no se selecciono imagen&destino=refacciones_seleccionar_marca.php?");
        }
    } else {
        header("Location: alerta.php?tipo=fracaso&operacion=Refaccion No Guardada&destino=refacciones_seleccionar_marca.php");
    }
    $ins->close();
    $con->close();
}
?>
