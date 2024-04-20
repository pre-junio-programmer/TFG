<?php
include_once "/app/src/MODELO/conexion.php";

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

        <!-- Aquí incluyes tu componente React -->
        <div id="registro-form-container"></div>

<!-- Incluye el script de React -->
<script src="Registro_F.js"></script>
<!-- Aquí incluye tu script de React que renderiza el componente -->
<script>
    // Renderiza el componente React dentro del contenedor con id "registro-form-container"
    ReactDOM.render(
        <Registro_F />,
        document.getElementById('registro-form-container')
    );
</script>
</body>
</html>