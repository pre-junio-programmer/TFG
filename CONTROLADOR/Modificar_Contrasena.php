<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

//MODIFICA EL CAMPO CONTRASEÑA DONDE EL ID DEL USER ES IGUAL AL DEL CLIENTE
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_SESSION['nombreDeSesion'];
    $contrasena = $_POST['contra'];

    $id_usuario = $_SESSION['id_usuario'];
    Base_Operaciones::updateCampo($id_usuario,$contrasena,'id_usuario','contra_u','usuario');
    header("Location: ../VISTA/ModificacionesUsuario.html");
}
?>