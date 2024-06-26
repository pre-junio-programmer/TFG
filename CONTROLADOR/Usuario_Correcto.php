<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $contra = $_POST['contra'];
    //COMPRUEBA QUE EL INICIO DE SESION SE HA REALIZADO DE MANERA CORRECTA
    if (Base_Operaciones::inicioExitoso($usuario, $contra)) {
        header("Location: ../VISTA/PaginaPrincipal.html");
        exit();
    } else {
        header("Location: ../VISTA/InicioSesion.html?error=1");
        exit();
    }
} else {
    header("Location: ../VISTA/InicioSesion.html?error=1");
    exit();
}
?>