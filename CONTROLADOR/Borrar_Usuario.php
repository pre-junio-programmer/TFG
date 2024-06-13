<?php
require_once "../MODELO/Manejo_Base.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['id_usuario'])) {

        //LLAMA AL USERKILLER EN MANEJO BASE Y BORRA TODAS LAS TRAZAS DEL USUARIO
        $id_usuario = $_SESSION['id_usuario'];
        Base_Operaciones::borrarUsuTotal($id_usuario);

        //BORRA LA IMAGEN CON NOMBRE IGUAL AL ID DEL USUARIO A BORRAR
        $ruta = "../img/usuario/";
        $rutaArchivos = glob($ruta . $id_usuario . '.*');
        foreach ($rutaArchivos as $rutaArchivo) {
            if (file_exists($rutaArchivo)) {
                unlink($rutaArchivo);
            }
        }
        session_destroy();
        echo "Usuario borrado con éxito";
    }
} 
?>