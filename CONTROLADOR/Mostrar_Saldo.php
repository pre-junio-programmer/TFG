<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

$valor_nombre = $_SESSION['nombreDeSesion'];
$id_usuario=$_SESSION['id_usuario'];
$respuesta = $_SESSION['saldo_u'];
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

$response = [
    'saldo' => $respuesta != null ? $respuesta : '0',
    'imagen_url' => $imagen_url
];

echo json_encode($response);
?>