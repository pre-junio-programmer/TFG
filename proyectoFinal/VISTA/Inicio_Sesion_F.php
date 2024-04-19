<?php
include_once "/app/MODELO/conexion.php";

// Verificar si hay un mensaje de éxito en la sesión
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    // Eliminar el mensaje de la sesión para que no se muestre más de una vez
    unset($_SESSION['mensaje']);
} else {
    $mensaje = ""; // Si no hay mensaje, establecer como cadena vacía
}
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
    <!-- Mostrar mensaje de éxito si existe -->
    <?php if ($mensaje != ""): ?>
        <p><?php echo $mensaje; ?></p>
    <?php endif; ?>
    <form action="../CONTROLADOR/Inicio_Correcto.php" method="post">
        
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre">
        
        <br><br>
        
        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña"> 
        <!-- Agregamos un elemento de imagen que se puede hacer clic para mostrar la contraseña -->
        <img src="../imagenes/ojo.png" id="mostrarContrasena" width="30px" height="30px" style="cursor: pointer;">
        
        <br><br>
        
        <input type="submit" value="Iniciar Sesion">
    </form>
    
    <script>
        function alternarTipoContrasena() {
            var campoContrasena = document.getElementById("contraseña");
            if (campoContrasena.type === "password") {
                campoContrasena.type = "text";
            } else {
                campoContrasena.type = "password";
            }
        }
        document.getElementById("mostrar_contrasena").onclick(alternarTipoContrasena);
    </script>
</body>
</html>
