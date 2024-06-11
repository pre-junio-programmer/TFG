<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

$fecha = date("Y-m-d");
$cantidad = $_GET['cantidad'];
$idUsuario = $_SESSION['id_usuario'];
$idProducto = $_GET['id'];

Base_Operaciones::insertarCompra($fecha, $cantidad, $idUsuario, $idProducto);

?>