<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

$valor_nombre = $_SESSION['nombreDeSesion'];
$id_usuario = $_SESSION['id_usuario'];
$tarjetas = Base_Operaciones::extraerDatos($id_usuario, 'id_usuario', 'metodo_pago');

$html = '';

foreach ($tarjetas as $tarjeta) {
    $html .= '<div class="tarjeta">';
    $html .= '<div class="card">';
    $html .= '<div class="card-body d-flex justify-content-between align-items-center">'; // Contenedor flexible con justificación entre elementos
    $html .= '<div class="d-flex align-items-center">'; // Contenedor flexible para imagen y label
    switch ($tarjeta['Tipo']) {
        case '1':
            $html .= '<img src="../img/tarjetas/Visa.png" class="imagenTarjeta img-fluid">';
            break;
        case '2':
            $html .= '<img src="../img/tarjetas/MasterCard.png" class="imagenTarjeta img-fluid">';
            break;
        case '3':
            $html .= '<img src="../img/tarjetas/Discover.png" class="imagenTarjeta img-fluid">';
            break;
        case '4':
            $html .= '<img src="../img/tarjetas/American_Express.png" class="imagenTarjeta img-fluid">';
            break;
        default:
            $html .= '<img src="../img/tarjetas/Visa.png" class="imagenTarjeta img-fluid">';
            break;
    }
    $html .= '<label class="m-4" style="color:black;">' . $tarjeta['num_tarjeta'] . ' - ' . $tarjeta['nombre_u_tarjeta'] . ' - ' . $tarjeta['fecha_cad'] . '</label>';
    $html .= '</div>'; // Cerrar contenedor flexible de imagen y label
    $html .= '<input type="radio" name="radioTarjeta" class="m-3" value="' . $tarjeta['num_tarjeta'] . '" style="height: 30px; width: 30px;">';
    $html .= '</div>'; // Cerrar card-body flexible
    $html .= '</div>';
    $html .= '</div>';
}

echo $html;
?>
