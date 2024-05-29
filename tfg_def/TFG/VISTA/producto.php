<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];
    $producto = Base_Operaciones::obtenerProductoPorId($id_producto);

    if ($producto) {

        $nombre = $producto['nombre_p'];

        $descripcion = $producto['descripcion_p'];

        $precio = $producto['precio_p'];

        $stock = $producto['cantidad_p'];
    } else {
        echo "Producto no encontrado.";
        exit;
    }
} else {
    echo "ID de producto no especificado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto</title>
</head>
<body>
    <div class="container">
        <h1><?php echo $nombre; ?></h1>
        <h2><?php echo $descripcion; ?></h2>
        <h3> Precio: <?php echo $precio; ?></h3>
        <h4><?php echo $stock; ?> disponibles </h4>
    </div>
</body>
</html>
