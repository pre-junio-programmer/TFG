<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

$valor_nombre = $_SESSION['nombreDeSesion'];
$id_usuario = $_SESSION['id_usuario'];
$usuario_datos = Base_Operaciones::extraerDatos($id_usuario, 'id_usuario', 'usuario');

if (is_array($usuario_datos) && count($usuario_datos) > 0) {
    $primer_usuario = $usuario_datos[0];

    $nombre_usuario = $primer_usuario['nombre_u'];
    $direccion_usuario = $primer_usuario['direccion_u'];
    $email_usuario = $primer_usuario['correo_u'];
    $ruta_base = '../img/usuario/';

    $extensiones = ['jpg', 'png', 'jpeg'];

    $imagen_url = '';
    foreach ($extensiones as $extension) {
        $ruta_imagen = $ruta_base . $id_usuario . '.' . $extension;
        if (file_exists($ruta_imagen)) {
            $imagen_url = $ruta_imagen;
            break;
        }
    }

    if ($imagen_url === '') {
        $imagen_url = '../img/usuario.png'; 
    }

    $data = $nombre_usuario . '|' . $direccion_usuario . '|' . $email_usuario . '|'. $imagen_url ;
    echo $data;
} else {
    echo "No se encontraron datos del usuario.";
}
?>