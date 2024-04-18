<?php
include_once "/app/MODELO/conexion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Inicio de Sesion</title>
</head>
<body>
    <h2>Inicio de Sesion</h2>
    //<form action="../CONTROLADOR/Registro_Correcto.php" method="post">
        
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre"><br><br>
        
        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña"><br><br>
        
        <input type="submit" value="Iniciar Sesion">
    </form>
</body>
</html>