<?php
include_once "../CONTROLADOR/Logica_comentario.php"
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./Producto.css">
    <script src="producto.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="card" id="eliminar">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="card-title titulo"><?php echo htmlspecialchars($nombre); ?></h1>
                        <p class="card-text descripcion"><?php echo htmlspecialchars($descripcion); ?></p>
                        <h3 class="card-subtitle mb-4 mt-2">Precio: <?php echo htmlspecialchars($precio); ?> €</h3>
                        <h4 class="card-subtitle mb-4" id="stock"><?php echo htmlspecialchars($stock); ?> disponibles</h4>
                        <input type="number" id="Cantidad" name="Cantidad" class="form-control" placeholder="Introduzca cantidad a comprar">
                        <label id="errorCantidad" class="mensajesError"></label>
                        <br>
                        <input type="submit" value="Añadir al carrito" class="btn btn-primary" id="Anadir">
                        <br>
                        <br>
                        <form id="ordenForm" method="post" action="../CONTROLADOR/Logica_comentario.php?id=<?php echo urlencode($id_producto); ?>">
                        <input type="hidden" name="id_producto" value="<?php echo htmlspecialchars($_GET['id']); ?>">
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
                                            <form method="post" action="../CONTROLADOR/Logica_comentario.php?id=<?php echo urlencode($id_producto); ?>">
                                                <input type="hidden" name="id_producto" value="<?php echo htmlspecialchars($_GET['id']); ?>">
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
                <a href="#" class="btn btn-primary" id="mostrarFormulario">+ Añadir Comentario</a>
                <br><br>
                <div class="card-body" id="Creacion" style="display: none;">
                <form action="../CONTROLADOR/Logica_comentario.php?id=<?php echo urlencode($id_producto); ?>" method="post" id="formulario">
                        <input type="hidden" name="id_producto" value="<?php echo htmlspecialchars($_GET['id']); ?>">
                        <div class="m-3">
                            <textarea id="comentario" name="comentario" class="form-control" placeholder="Texto"></textarea>
                            <label id="errorComentario" class="mensajesError"></label>
                            <br>
                        </div>
                        <div class="m-3">
                            <input type="number" id="Valoracion" name="Valoracion" class="form-control" placeholder="Valoracion (1-5)">
                            <label id="errorValoracion" class="mensajesError"></label>
                            <br>
                        </div>
                        <div class="m-3">
                            <input type="submit" value="Crear" class="btn btn-primary" id="Enviar">
                        </div>
                        </form>
                </div>
                <a href="PaginaPrincipal.html" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </div>
</body>
</html>


