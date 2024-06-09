<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_producto'], $_POST['cantidad'])) {
        $nombre_usuario = $_SESSION['nombreDeSesion'];
        
        $id_usuario = $_SESSION['id_usuario'];
        $id_producto = $_POST['id_producto'];
        $cantidad_venta = intval($_POST['cantidad']);

        $cantidad_total_p = Base_Operaciones::seleccionarValor($id_producto, 'cantidad_p', 'id_producto', 'producto');
        $cantidad_final = $cantidad_total_p - $cantidad_venta;

        Base_Operaciones::borrarVentaCompra($id_usuario, $id_producto, 'id_usuario', 'id_producto', 'relacion_venta');

        if ($cantidad_final > 0) {
            Base_Operaciones::updateCampo($id_producto, $cantidad_final, 'id_producto', 'cantidad_p', 'producto');
        } else {
            Base_Operaciones::borrarElemento($id_producto, 'id_producto', 'producto');
        }


        echo 'success';
    } else {
        echo 'error: datos incompletos';
    }
} else {
    echo 'error: método de solicitud no válido';
}
?>