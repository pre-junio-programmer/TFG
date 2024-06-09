<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = $_POST['nombreProducto'];
    $descripcion = $_POST['descripcionProducto'];
    $categoria = $_POST['categoríaProducto'];
    $precio = $_POST['precioProducto'];
    $cantidad = $_POST['cantidadProducto'];
    $id_usuario = $_SESSION['id_usuario'];

    Base_Operaciones::insertarVenta($nombre, $descripcion, $categoria, $precio,$cantidad,$id_usuario);
}
?>
