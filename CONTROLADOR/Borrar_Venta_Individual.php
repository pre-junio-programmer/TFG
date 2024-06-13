<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_producto'], $_POST['cantidad'])) {
        
        $id_usuario = $_SESSION['id_usuario'];
        $id_producto = $_POST['id_producto'];
        $cantidad_venta = intval($_POST['cantidad']);
        
        //SELECCIONAMOS LA CANTIDAD EN PRODUCTOS PARA CUANDO SE BORRE RESTARSELA
        $cantidad_total_p = Base_Operaciones::seleccionarValor($id_producto, 'cantidad_p', 'id_producto', 'producto');
        $cantidad_final = $cantidad_total_p - $cantidad_venta;
        
        //BORRAMOS LA VENTA DONDE EL ID DE USUARIO ES IGUAL AL DEL CLIENTE Y EL ID PRODUCTO ES IGUAL AL DE LA FILA SELECCIONADA
        Base_Operaciones::borrarVentaCompra($id_usuario, $id_producto, 'id_usuario', 'id_producto', 'relacion_venta');

        //SI HA BORRADO TODO EL STOCK SE QUITA EL PRODUCTO DE LA BASE Y SU IMAGEN, SI NO SOLAMENTE LE RESTA LA CANTIDAD QUE SE VENDÍA
        if ($cantidad_final > 0) {
            Base_Operaciones::updateCampo($id_producto, $cantidad_final, 'id_producto', 'cantidad_p', 'producto');
        } else {
            Base_Operaciones::borrarElemento($id_producto, 'id_producto', 'producto');
            
            $ruta = "../img/productos/";
            $rutaArchivos = glob($ruta . $id_producto . '.*');
            foreach ($rutaArchivos as $rutaArchivo) {
                if (file_exists($rutaArchivo)) {
                    unlink($rutaArchivo);
                }
            }
        }


        echo 'success';
    } else {
        echo 'error: datos incompletos';
    }
} else {
    echo 'error: método de solicitud no válido';
}
?>