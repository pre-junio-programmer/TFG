<?php
include_once "/app/MODELO/conexion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro de Usuario</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form action="../CONTROLADOR/Insertar_usuario.php" method="post">
        <label for="id_usuario">ID Usuario:</label>
        <input type="text" id="id_usuario" name="id_usuario" required><br><br>
        
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" required><br><br>
        
        <label for="correo">Correo electrónico:</label>
        <input type="email" id="correo" name="correo" required><br><br>
        
        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" required><br><br>
        
        <label for="saldo">Saldo:</label>
        <input type="number" id="saldo" name="saldo" step="0.01" required><br><br>
        
        <input type="submit" value="Registrar Usuario">
    </form>
</body>
</html>
