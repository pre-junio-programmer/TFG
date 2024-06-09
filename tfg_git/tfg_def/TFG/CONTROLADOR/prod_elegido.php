<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $categoria = $_POST['categoria'];
    $productos = Base_Operaciones::mostrarProductos($categoria);

    
    $contador = 0;
    
    foreach ($productos as $producto) {
        if ($contador % 3 == 0) {
            echo '<div class="row">';
        }

        echo '<div class="col-lg-4 col-sm-12 m-2">';
        echo '<div class="card" style="width: 18rem;">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $producto['nombre_p'] . '</h5>';
        echo '<p class="card-text">' . $producto['descripcion_p'] . '</p>';
        echo '<button class="aBoton">Comprar</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        $contador++; 

        if ($contador % 3 == 0 || $contador == count($productos)) {
            echo '</div>';
        }
    }
}
?>