<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $categoria = $_POST['categoria'];
    $productos = Base_Operaciones::mostrarProductos($categoria);
    

    foreach ($productos as $producto) {
        echo '<div class="producto">';
        echo '<div class="orden" style="width: 18rem;">';
        echo '<div class="textos">';
        echo '<h5 class="estilo-hugo">' . $producto['nombre_p'] . '</h5>';
        echo '<p class="descripcion">' . $producto['descripcion_p'] . '</p>';
        echo '<button class="aBoton">Comprar</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}
?>