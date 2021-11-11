<?php

session_start();
if ($_SESSION['usuario_tipo'] == "empleado") {
    echo "PUEDES VER LAS TAREAS DE UN EMPLEADO";
} else {
    header('Location: login.php');
}