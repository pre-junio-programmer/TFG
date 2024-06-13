<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoria = 'NOV';
    //EXTRAE TODOS LOS PRODUCTOS CON CATEGORIA NOV
    $productos = Base_Operaciones::mostrarProductos($categoria);

    $contador = 0;

    //POR CADA PRODUCTO CARGA EN TIEMPO DE EJECUCION SU CARD CON LA IMAGEN, SIGUIENDO 
    // LA MISMA LOGICA QUE AL CARGAR LA IMAGEN DEL USUARIO

    foreach ($productos as $producto) {
        $id_producto = $producto['id_producto'];
        $formatos = ['jpeg', 'png', 'jpg'];
        $ruta = '';

        foreach ($formatos as $formato) {
            $src = "../img/productos/{$id_producto}.{$formato}";
            if (file_exists($src)) {
                $ruta = $src;
                break;
            }
        }
        //CADA 3 PRODUCTOS CREA UNA NUEVA FILA PARA MOSTRARLOS ORDENADOS
        if ($contador % 3 == 0) {
            echo '<div class="row">';
        }

        echo '<div class="col-lg-3 col-sm-12 m-2">';
        echo '<a href="../VISTA/producto.php?id=' . $producto['id_producto'] . '" class="text-decoration-none text-dark">';
        echo '<div class="card border-dark" style="width: 300px; height: 450px">';
        if ($ruta) {
            echo '<img src="' . $ruta . '" class="card-img-top img-fluid" style="width: 370px; height: 280px" alt="Producto ' . $id_producto . '">';
        }
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $producto['nombre_p'] . '</h5>';
        echo '<p class="card-text">' . $producto['descripcion_p'] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</a>';
        echo '</div>';

        $contador++; 

        if ($contador % 3 == 0 || $contador == count($productos)) {
            echo '</div>';
        }
    }
}
?>