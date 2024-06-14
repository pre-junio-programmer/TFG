<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

$valor_nombre = $_SESSION['nombreDeSesion'];
$id_usuario = $_SESSION['id_usuario'];
$usuario_datos = Base_Operaciones::extraerDatos($id_usuario, 'id_usuario', 'usuario');

//CARGA EN CADA UNA DE LAS TEXTBOX DE MODIFICAR_USUARIO LOS DATOS PARA VERLOS EN VIVO
if (is_array($usuario_datos) && count($usuario_datos) > 0) {
    $primer_usuario = $usuario_datos[0];

    $nombre_usuario = $primer_usuario['nombre_u'];
    $direccion_usuario = $primer_usuario['direccion_u'];
    $email_usuario = $primer_usuario['correo_u'];


    $data = $nombre_usuario . '|' . $direccion_usuario . '|' . $email_usuario ;
    echo $data;
} else {
    echo "No se encontraron datos del usuario.";
}
?>