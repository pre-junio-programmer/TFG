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
    <form action="../CONTROLADOR/Registro_Correcto.php" method="post">
        
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre"><br><br>
        
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion"><br><br>
        
        <label for="correo">Correo electrónico:</label>
        <input type="text" id="correo" name="correo"><br><br>
        
        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña"><br><br>
        
        <label for="saldo">Saldo:</label>
        <input type="number" id="saldo" name="saldo"><br><br>
        
        <input type="submit" value="Registrar Usuario">
    </form>
</body>
</html>