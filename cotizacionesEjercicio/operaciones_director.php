<?php
session_start();
if (!isset($_SESSION['usuario_tipo']) && !isset($_SESSION['usuario_nombre'])) {
header('Location: login.php');
}
else {
if($_SESSION['usuario_tipo']=="director"){
echo "PUEDES VER LAS TAREAS DE ADMINISTRADOR";
$minombre=$_SESSION['usuario_nombre'];
echo "BIENVENIDO".$minombre;
?>
<a href="cerrar.php"></a> 
<?php
}
else{
header('Location: operaciones_empleado.php');
}
}
