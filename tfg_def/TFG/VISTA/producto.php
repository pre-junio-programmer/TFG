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
    if (isset($_POST['orden']) && !empty($_POST['orden'])) {
        $orden = $_POST['orden'];
        if ($orden === 'mas-valorados') {

            $comentarios = Base_Operaciones::obtenerComentariosPorProductoOrdenados($id_producto, 'desc');

        } elseif ($orden === 'menos-valorados') {

            $comentarios = Base_Operaciones::obtenerComentariosPorProductoOrdenados($id_producto, 'asc');

        } else if($orden === 'orden-normal') {

            $comentarios = Base_Operaciones::obtenerComentariosPorProducto($id_producto);

        }

    } elseif (isset($_POST['id_comentario']) && !empty($_POST['id_comentario'])) {

        $id_comentario = $_POST['id_comentario'];
        Base_Operaciones::eliminarComentario($id_comentario);
        header("Location: producto.php?id=" . $id_producto);
        exit();
    }
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="producto.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="card" id="eliminar">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="card-title"><?php echo htmlspecialchars($nombre); ?></h1>
                        <p class="card-text"><?php echo htmlspecialchars($descripcion); ?></p>
                        <h3 class="card-subtitle mb-2 text-muted">Precio: <?php echo htmlspecialchars($precio); ?> €</h3>
                        <h4 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($stock); ?> disponibles</h4>
                        <a href="#" class="btn btn-primary">Añadir al carrito</a>
                        <br>
                        <br>
                        <form id="ordenForm" method="post" action="">
                            <select id="orden" name="orden" class="form-control" onchange="cambiarOrden()">
                                <option value="">Elegir orden</option>
                                <option value="orden-normal">Predeterminado</option>
                                <option value="mas-valorados">Más valorados</option>
                                <option value="menos-valorados">Menos valorados</option>
                            </select>
                        </form>
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
            <div id="comentarios">
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
                <a href="NuevoComentario.html?producto=<?php echo urlencode($nombre); ?>&id=<?php echo urlencode($id_producto); ?>" class="btn btn-primary">+ Añadir Comentario</a>
                <br>
                <br>
                <a href="PaginaPrincipal.html" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </div>
</body>
</html>
