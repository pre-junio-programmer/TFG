<?php
include_once "/app/MODELO/conexion.php";

// Obtener los datos del formulario
$id_usuario = $_POST["id_usuario"];
$nombre = $_POST["nombre"];
$direccion = $_POST["direccion"];
$correo = $_POST["correo"];
$contraseña = $_POST["contraseña"];
$saldo = $_POST["saldo"];

// Preparar la consulta SQL para insertar un nuevo usuario
$sql = "INSERT INTO usuarios (id_usuario, nombre_u, direccion_u, correo_u, contra_u, saldo_u) VALUES ('$id_usuario', '$nombre', '$direccion', '$correo', '$contraseña', $saldo)";

// Ejecutar la consulta
if (mysqli_query($db, $sql)) {
    echo "Nuevo registro de usuario creado con éxito";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($db);
}

// Cerrar la conexión
mysqli_close($db);
?>
