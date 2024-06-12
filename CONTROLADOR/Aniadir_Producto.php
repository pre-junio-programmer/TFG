<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

// Obtener parámetros de la solicitud
$id_producto = $_GET['id'];
$cantidad = intval($_GET['cantidad']);
$id_usuario = $_SESSION['id_usuario'];

// Obtener información del producto
$producto = Base_Operaciones::extraerDatos($id_producto, 'id_producto', 'producto');

if (!isset($producto[0])) {
    echo json_encode(['status' => 'error', 'message' => 'Producto no encontrado']);
    exit;
}

$producto = $producto[0];
$stock_disponible = intval($producto['cantidad_p']);

// Obtener cantidad actual del producto en el carrito del usuario
$compras = Base_Operaciones::extraerDatos($id_usuario, 'id_usuario', 'compra_realizada');
$cantidad_en_carrito = 0;
foreach ($compras as $compra) {
    if ($compra['id_producto'] == $id_producto) {
        $cantidad_en_carrito = intval($compra['cantidad_c']);
        break;
    }
}

if ($cantidad + $cantidad_en_carrito > $stock_disponible) {
    echo json_encode(['status' => 'error', 'message' => 'No hay suficiente stock disponible']);
} else {

$fecha = date("Y-m-d");
$cantidad = $_GET['cantidad'];
$idUsuario = $_SESSION['id_usuario'];
$idProducto = $_GET['id'];

Base_Operaciones::insertarCompra($fecha, $cantidad, $idUsuario, $idProducto);

echo json_encode(['status' => 'success', 'message' => 'Producto añadido al carrito']);
}

?>