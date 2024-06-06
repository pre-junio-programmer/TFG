<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['email'];
    $contra = $_POST['password'];
    
    $respuesta = Base_Operaciones::insertarUsuario($nombre, $direccion, $correo, $contra);

    if ($respuesta == "A") {
        header("Location: ../VISTA/Registro.html?error=1");
        exit();
    } else if ($respuesta == "B") {
        header("Location: ../VISTA/Registro.html?error=2");
        exit();
    } else {
        header("Location: ../VISTA/PaginaPrincipal.html");
        exit();
    }
}
?>