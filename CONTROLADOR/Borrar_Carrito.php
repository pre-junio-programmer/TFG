<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['id_usuario'])) {
        $id_usuario = $_SESSION['id_usuario'];
        //BORRAMOS TODAS LAS FILAS DONDE EL USUARIO SEA IGUAL AL DEL CLIENTE
        Base_Operaciones::borrarElemento($id_usuario, 'id_usuario', 'compra_realizada');
        echo 'success';
    } else {
        echo 'error: usuario no autenticado';
    }
} else {
    echo 'error: método de solicitud no válido';
}
?>
