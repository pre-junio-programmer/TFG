<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

$valor_nombre = $_SESSION['nombreDeSesion'];
$id_usuario = Base_Operaciones::seleccionarValor($valor_nombre, 'id_usuario', 'nombre_u', 'usuario');
$tarjetas = Base_Operaciones::extraerDatos($id_usuario, 'id_usuario', 'metodo_pago');

$html = '';

foreach ($tarjetas as $tarjeta) {
    $html .= '<div class="col-lg-3 col-sm-12 m-2">';
    $html .= '<div class="card" style="width: 18rem;">';
    $html .= '<div class="card-body">';
    $html .= '<label style="color:black;">' . $tarjeta['num_tarjeta'] .' - '. $tarjeta['nombre_u_tarjeta'] . ' - ' . $tarjeta['fecha_cad'] . '</label>';
    $html .= '<input type="radio" name="radioTarjeta" value="'. $tarjeta['num_tarjeta'] .'">';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
}

echo $html;
?>