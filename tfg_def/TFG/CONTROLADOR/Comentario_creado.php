<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $texto = $_POST['comentario'];
    $valoracion = $_POST['Valoracion'];
    $id_producto = $_POST['id_producto'];
    $id_usuario = $_SESSION['id_usuario'];

    try {
        $id_comentario = Base_Operaciones::agregarComentario($id_usuario, $id_producto, $valoracion, $texto);

        header("Location: ../VISTA/producto.php?id=" . $id_producto);
        exit();
    } catch (Exception $e) {
        echo "Error al agregar el comentario: " . $e->getMessage();
    }
}
?>
