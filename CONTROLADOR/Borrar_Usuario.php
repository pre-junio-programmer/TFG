<?php
require_once "../MODELO/Manejo_Base.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['id_usuario'])) {
        $id_usuario = $_SESSION['id_usuario'];
        Base_Operaciones::borrarUsuTotal($id_usuario);
        session_destroy();
        echo "Usuario borrado con éxito";
    }
} 
?>