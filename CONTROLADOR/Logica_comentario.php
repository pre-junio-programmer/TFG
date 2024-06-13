<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

if (isset($_GET['id']) || isset($_POST['id_producto'])) {
    $id_producto = isset($_GET['id']) ? $_GET['id'] : $_POST['id_producto'];
    
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
            $src = "../img/productos/{$id_producto}.{$formato}";
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


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id_producto = isset($_POST['id_producto']) ? $_POST['id_producto'] : $_GET['id'];

    if(isset($_POST['comentario']) && isset($_POST['Valoracion'])) {
        $texto = $_POST['comentario'];
        $valoracion = $_POST['Valoracion'];

        try {
            $id_usuario = $_SESSION['id_usuario'];
            Base_Operaciones::agregarComentario($id_usuario, $id_producto, $valoracion, $texto);

            header("Location: ../VISTA/producto.php?id=" . $id_producto);
            exit();
        } catch (Exception $e) {
            echo "Error al agregar el comentario: " . $e->getMessage();
        }
    } elseif (isset($_POST['orden']) && !empty($_POST['orden'])) {
        $orden = $_POST['orden'];
        if ($orden == 'mas-valorados') {
            $comentarios = Base_Operaciones::obtenerComentariosPorProductoOrdenados($id_producto, 'desc');
        } elseif ($orden == 'menos-valorados') {
            $comentarios = Base_Operaciones::obtenerComentariosPorProductoOrdenados($id_producto, 'asc');
        } elseif ($orden == 'orden-normal') {
            $comentarios = Base_Operaciones::obtenerComentariosPorProducto($id_producto);
        }
    } elseif (isset($_POST['id_comentario']) && !empty($_POST['id_comentario'])) {
        $id_comentario = $_POST['id_comentario'];
        Base_Operaciones::eliminarComentario($id_comentario);
        header("Location: ../VISTA/producto.php?id=" . $id_producto);
        exit();
    } else {
        echo "Alguno de los campos del formulario está vacío.";
    }
}
?>
