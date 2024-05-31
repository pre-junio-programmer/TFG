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

        // Buscar la imagen del producto
        $formatos = ['jpeg', 'png', 'jpg'];
        $ruta = '';

        foreach ($formatos as $formato) {
            $src = "../img/{$id_producto}.{$formato}";
            if (file_exists($src)) {
                $ruta = $src;
                break;
            }
        }
    } else {
        echo "Producto no encontrado.";
        exit;
    }
} else {
    echo "ID de producto no especificado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_comentario = $_POST['id_comentario'];
    Base_Operaciones::eliminarComentario($id_comentario);
    header("Location: producto.php?id=" . $id_producto);
    exit();
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
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="card-title"><?php echo htmlspecialchars($nombre); ?></h1>
                        <p class="card-text"><?php echo htmlspecialchars($descripcion); ?></p>
                        <h3 class="card-subtitle mb-2 text-muted">Precio: <?php echo htmlspecialchars($precio); ?> €</h3>
                        <h4 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($stock); ?> disponibles</h4>
                        <a href="#" class="btn btn-primary">Comprar</a>
                    </div>
                    <div class="col-md-4">
                        <?php if ($ruta): ?>
                            <img src="<?php echo htmlspecialchars($ruta); ?>" class="card-img-top img-fluid" alt="Imagen del producto">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <h2><?php if ($comentarios): ?></h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Valoración</th>
                            <th>Comentario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($comentarios as $comentario): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($comentario['nombre_usuario']); ?></td>
                                <td><?php echo htmlspecialchars($comentario['valoracion_c']); ?></td>
                                <td><?php echo htmlspecialchars($comentario['comentario_c']); ?></td>
                                <?php if (isset($_SESSION['nombreDeSesion']) && $_SESSION['nombreDeSesion'] === $comentario['nombre_usuario']): ?>
                                    <td>
                                        <form method="post" action="">
                                            <input type="hidden" name="id_comentario" value="<?php echo htmlspecialchars($comentario['id_comentario']); ?>">
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                <?php else: ?>
                                    <td></td>
                                <?php endif; ?>
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
