<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['id_usuario'])) {
        $id_usuario = $_SESSION['id_usuario'];
        
        Base_Operaciones::borrarTodoCarrito($id_usuario);
        echo 'success';
    } else {
        echo 'error: usuario no autenticado';
    }
} else {
    echo 'error: método de solicitud no válido';
}
?>