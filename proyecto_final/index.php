<?php
header("Location: src/App.js");
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro de Usuario</title>
</head>
<body>
    <h2>Registro de Usuario</h2>

    <!-- Aquí incluyes tu componente React -->
    <div id="registro-form-container"></div>

    <!-- Incluye el script de React -->
    <script src="ruta/a/tu/App.js"></script>

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
