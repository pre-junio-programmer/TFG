<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];
    $producto = Base_Operaciones::obtenerProductoPorId($id_producto);
    $comentarios = Base_Operaciones::obtenerComentariosPorProducto($id_producto);

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title"><?php echo htmlspecialchars($nombre); ?></h1>
                <p class="card-text"><?php echo htmlspecialchars($descripcion); ?></p>
                <h3 class="card-subtitle mb-2 text-muted">Precio: <?php echo htmlspecialchars($precio); ?> €</h3>
                <h4 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($stock); ?> disponibles</h4>
                <a href="#" class="btn btn-primary">Comprar</a>
            </div>
        </div>

        <div class="mt-5">
<!--             <h2>Comentarios</h2> -->
            <h2><?php if ($comentarios): ?></h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Valoración</th>
                            <th>Comentario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($comentarios as $comentario): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($comentario['nombre_usuario']); ?></td>
                                <td><?php echo htmlspecialchars($comentario['valoracion_c']); ?></td>
                                <td><?php echo htmlspecialchars($comentario['comentario_c']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No hay comentarios para este producto.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
