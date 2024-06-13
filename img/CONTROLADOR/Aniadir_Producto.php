<?php
session_start();
require_once "../MODELO/Manejo_Base.php";


$id_producto = $_GET['id'];
$cantidad = intval($_GET['cantidad']);
$id_usuario = $_SESSION['id_usuario'];

//OBTENEMOS LOS DATOS DEL PRODUCTO A AÑADIR
$producto = Base_Operaciones::extraerDatos($id_producto, 'id_producto', 'producto');


//SI NO EXISTE SE MUESTRA ESE ERROR
if (!isset($producto[0])) {
    echo json_encode(['status' => 'error', 'message' => 'Producto no encontrado']);
    exit;
}


$producto = $producto[0];
$stock_disponible = intval($producto['cantidad_p']);

//OBTENEMOS LA CANTIDAD DE ESE PRODUCTO EN EL CARRITO DEL USUARIO
$compras = Base_Operaciones::extraerDatos($id_usuario, 'id_usuario', 'compra_realizada');
$cantidad_en_carrito = 0;
foreach ($compras as $compra) {
    if ($compra['id_producto'] == $id_producto) {
        $cantidad_en_carrito = intval($compra['cantidad_c']);
        break;
    }
}

//SI LA CANTIDAD EXCEDE EL NUMERO DE PRODUCTOS EN STOCK SE MANDA ESE ERROR
if ($cantidad + $cantidad_en_carrito > $stock_disponible) {
    echo json_encode(['status' => 'error', 'message' => 'No hay suficiente stock disponible']);
} else {

$fecha = date("Y-m-d");
$cantidad = $_GET['cantidad'];
$idUsuario = $_SESSION['id_usuario'];
$idProducto = $_GET['id'];

//SI TODO VA CORRECTO INSERTAMOS LA COMPRA EN EL CARRITO
Base_Operaciones::insertarCompra($fecha, $cantidad, $idUsuario, $idProducto);

echo json_encode(['status' => 'success', 'message' => 'Producto añadido al carrito']);
}

?>