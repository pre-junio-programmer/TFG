<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    $valor_nombre = $_SESSION['nombreDeSesion'];
    $tarjeta_elegida = $_POST['radioTarjeta'];
    $cantidad_manejo = floatval($_POST['cantidadIntroducida']);

    $id_usuario = Base_Operaciones::seleccionarValor($valor_nombre, 'id_usuario', 'nombre_u', 'usuario');
    $saldo_usuario = Base_Operaciones::seleccionarValor($valor_nombre, 'saldo_u', 'nombre_u', 'usuario');
    $saldo_tarjeta = Base_Operaciones::seleccionarValor($tarjeta_elegida, 'saldo_tarjeta', 'num_tarjeta', 'metodo_pago');

    $cantidad_final = $saldo_tarjeta - $cantidad_manejo;
    $saldo_usuario_final = $saldo_usuario + $cantidad_manejo;

    if ($cantidad_final > 0) {
        Base_Operaciones::updateCampo($tarjeta_elegida, $cantidad_final, 'num_tarjeta', 'saldo_tarjeta', 'metodo_pago');
        Base_Operaciones::updateCampo($id_usuario, $saldo_usuario_final, 'id_usuario', 'saldo_u', 'usuario');
        header("Location: ../VISTA/PaginaPrincipal.html");
        exit();
    } else {
        header("Location: ../VISTA/AniadirFondos.html?error=1");
        exit();
    }
}
?>