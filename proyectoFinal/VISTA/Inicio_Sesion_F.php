<?php
include_once "/app/MODELO/conexion.php";

$mensaje = "";

// Verificar si hay un mensaje de éxito en la URL
if (isset($_GET['error']) && $_GET['error'] === "Usuario creado con éxito") {
    $mensaje = "Usuario creado con éxito";
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
        document.getElementById("mostrarContrasena").addEventListener("click", alternarTipoContrasena);
    </script>
</body>
</html>
