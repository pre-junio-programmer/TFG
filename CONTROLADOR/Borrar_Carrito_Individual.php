<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_producto'])) {
        $nombre_usuario = $_SESSION['nombreDeSesion'];
        
        $id_usuario = $_SESSION['id_usuario'];
        $id_producto = $_POST['id_producto'];
       
        Base_Operaciones::borrarVentaCompra($id_usuario, $id_producto, 'id_usuario', 'id_producto', 'compra_realizada');        

        echo 'success';
    } else {
        echo 'error: datos incompletos';
    }
}else {
    echo 'error: método de solicitud no válido';
}
?>