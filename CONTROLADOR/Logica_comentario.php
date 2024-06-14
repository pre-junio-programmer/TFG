<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

$id_producto = isset($_POST['id_producto']) ? $_POST['id_producto'] : $_GET['id'];

if (isset($_GET['id']) || isset($_POST['id_producto'])) {
    
    //SACA LOS PRODUCTOS CORRESPONDIENTES DE UN ID ESPECIFICO
    $producto = Base_Operaciones::obtenerProductoPorId($id_producto);

    //SACA LOS COMENTARIOS CORRESPONDIENTES DE UN ID ESPECIFICO
    $comentarios = Base_Operaciones::obtenerComentariosPorProducto($id_producto);

    //SI EXISTE UN PRODUCTO SE RELLENA LA PAGINA CON SUS DATOS INCLUYENDO SU FOTO
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

    
    //SI AL HACER CLICK EN EL BOTON AÑADIR COMENTARIO SE HAN RELLENADO EL TEXTO Y SU VALORACION SE INSERTA EL COMENTARIO
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

        //SI SE HA HECHO CLICK EN LA SELECT SE ORDENA LA TABLA COMENTARIOS EN UN ORDEN DETERMINADO
    } elseif (isset($_POST['orden']) && !empty($_POST['orden'])) {
        $orden = $_POST['orden'];

        //SE ORDENA LA TABLA COMENTARIOS EN ORDEN DESCENDENTE
        if ($orden === 'mas-valorados') {
            $comentarios = Base_Operaciones::obtenerComentariosPorProductoOrdenados($id_producto, 'desc');

        //SE ORDENA LA TABLA COMENTARIOS EN ORDEN ASCENDENTE
        } elseif ($orden === 'menos-valorados') {
            $comentarios = Base_Operaciones::obtenerComentariosPorProductoOrdenados($id_producto, 'asc');

        //SE ORDENA LA TABLA COMENTARIOS EN ORDEN DE LA CREACION DE LOS USUARIOS EN LA TABLA USUARIOS
        } elseif ($orden === 'orden-normal') {
            $comentarios = Base_Operaciones::obtenerComentariosPorProducto($id_producto);
        }

        //SI SE HACE CLICK EN EL BOTON ELIMINAR DE UN COMENTARIO SE ELIMINA DE LA BASE DE DATOS
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
