<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_SESSION['nombreDeSesion'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['email'];
    
    $id_usuario = $_SESSION['id_usuario'];
    $respuesta = Base_Operaciones::updateUser($id_usuario,$nombre,$direccion,$correo);

    if ($respuesta == "A") {
        header("Location: ../VISTA/CambiarInformacionUsuario.html?error=1");
        exit();
    } else if ($respuesta == "B") {
        header("Location: ../VISTA/CambiarInformacionUsuario.html?error=2");
        exit();
    } else {
        header("Location: ../VISTA/PaginaPrincipal.html");
        exit();
    }
}
?>