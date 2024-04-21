<?php
// Incluye el archivo de conexión a la base de datos u otras dependencias necesarias
include_once "/app/src/MODELO/conexion.php";

// Variables para mensajes de error
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
    <!-- Incluye la librería de React para manipular el DOM -->
    <script src="https://unpkg.com/react-dom@17/umd/react-dom.production.min.js"></script>
    <!-- Incluye la librería de Axios para hacer peticiones AJAX -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <h2>Registro de Usuario</h2>

    <?php 
    // Muestra mensajes de error si existen
    if ($mensaje_campos != ""){
        echo $mensaje_campos;
    } else if($mensaje_nombre != "") {
        echo $mensaje_nombre;
    }
    ?>

    <!-- Contenedor para el formulario React -->
    <div id="registro-form-container"></div>

    <!-- Incluye el script de React -->
    <script src="../App.js"></script>
    <!-- Script que renderiza el componente React dentro del contenedor -->
    <script>
        // Función para enviar los datos del formulario por AJAX
        const handleSubmit = (event) => {
            event.preventDefault();
            const formData = new FormData(event.target);
            axios.post('../CONTROLADOR/Registro_Correcto.php', formData)
                .then(response => {
                    // Manejar la respuesta del servidor si es necesario
                    console.log(response.data);
                })
                .catch(error => {
                    // Manejar errores si es necesario
                    console.error('Error al enviar los datos:', error);
                });
        };

        // Renderiza el componente React dentro del contenedor con id "registro-form-container"
        ReactDOM.render(
            <Registro_F handleSubmit={handleSubmit} />,
            document.getElementById('registro-form-container')
        );
    </script>
</body>
</html>
