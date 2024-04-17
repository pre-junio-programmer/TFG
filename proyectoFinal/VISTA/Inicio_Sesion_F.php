<?php
session_start();

// Verificar si hay un mensaje de error o éxito en la URL
if (isset($_GET['error'])) {
    $mensaje = $_GET['error'];
} else {
    $mensaje = ""; // Si no hay mensaje, establecer como cadena vacía
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <!-- Aquí puedes mostrar el mensaje de éxito o error -->
    <?php if ($mensaje != ""): ?>
        <?php if ($mensaje == "Usuario creado con éxito"): ?>
            <p>Usuario Ingresado</p>
        <?php else: ?>
            <p>Error: <?php echo $mensaje; ?></p>
        <?php endif; ?>
    <?php endif; ?>
    <!-- Resto del contenido de tu página -->
</body>
</html>
