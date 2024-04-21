<?php
include_once "/app/MODELO/conexion.php";

$mensaje_campos = "";
$mensaje_nombre = "";

// Verificar si hay un mensaje de éxito en la URL
if (isset($_GET['error']) && $_GET['error'] === "Rellena todos los campos por favor") {
    $mensaje_campos = "Rellena todos los campos por favor";

} else if (isset($_GET['error']) && $_GET['error'] === "Nombre_Existente") {
    $mensaje_nombre = "El nombre que has introducido ya está en uso";
}
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

    <?php 
    
    if ($mensaje_campos != ""){

        echo $mensaje_campos;

    } else if($mensaje_nombre != "") {

        echo $mensaje_nombre;
        
    }
    ?>

    <form action="../CONTROLADOR/Registro_Correcto.php" method="post">
        
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre">
        
        <br><br>
        
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion">
        
        <br><br>
        
        <label for="correo">Correo electrónico:</label>
        <input type="text" id="correo" name="correo">
        
        <br><br>
        
        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña">

        <img src="../imagenes/ojo.png" id="mostrar" width="30px" height="30px" style="cursor: pointer;">
        
        <br><br>
        
        <label for="saldo">Saldo:</label>
        <input type="number" id="saldo" name="saldo">
        
        <br><br>
        
        <input type="submit" value="Registrar Usuario">
    </form>

    <script>
        function click_imagen() {
            var campoContrasena = document.getElementById("contraseña");
            if (campoContrasena.type === "password") {
                campoContrasena.type = "text";
            } else {
                campoContrasena.type = "password";
            }
        }
        document.getElementById("mostrar").addEventListener("click", click_imagen);
    </script>
</body>
</html>