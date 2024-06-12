<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

$nombre_usuario = $_SESSION['nombreDeSesion'];
$id_usuario = $_SESSION['id_usuario'];
$saldo = floatval($_SESSION['saldo_u']);
$coste_total = $_POST['total'];
$coste_total = floatval($coste_total);

$saldo_final = $saldo - $coste_total;

if ($saldo_final >= 0) {
    $_SESSION['saldo_u'] = number_format($saldo_final, 2, '.', '');
    Base_Operaciones::updateCampo($id_usuario, $saldo_final, 'id_usuario', 'saldo_u', 'usuario');
    $idsProductos = Base_Operaciones::seleccionarValores($id_usuario,'id_producto','id_usuario','compra_realizada');

    foreach ($idsProductos as $id_producto) {
        $resultadoCompra = Base_Operaciones::seleccionarVentaCompra('cantidad_c', $id_usuario, $id_producto, 'id_usuario', 'id_producto', 'compra_realizada');
        $sumaCompra = array_sum($resultadoCompra);
    
        $cantidadesProductos = Base_Operaciones::seleccionarValor($id_producto, 'cantidad_p', 'id_producto', 'producto');
    
        $cantidad_final = $cantidadesProductos - $sumaCompra;
        $cantidad_final = intval($cantidad_final);

        if ($cantidad_final>0){
            Base_Operaciones::updateCampo($id_producto, $cantidad_final, 'id_producto', 'cantidad_p', 'producto');
            Base_Operaciones::borrarVentaCompra($id_usuario, $id_producto, 'id_usuario', 'id_producto', 'compra_realizada');
        }else{
            
            Base_Operaciones::borrarVentaCompra($id_usuario, $id_producto, 'id_usuario', 'id_producto', 'compra_realizada');
            Base_Operaciones::borrarElemento($id_producto, 'id_producto', 'producto');

        }
    
    }
    echo 'success';
} else {
    echo 'error';
}
exit();
?>