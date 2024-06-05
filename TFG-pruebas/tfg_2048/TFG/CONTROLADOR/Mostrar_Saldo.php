<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

$valor_nombre = $_SESSION['nombreDeSesion'];
$saldo='saldo_u';
$campo_n='nombre_u';
$usuario_t='usuario';
$respuesta = Base_Operaciones::seleccionarValor($valor_nombre, $saldo, $campo_n, $usuario_t);

if($respuesta != null){
    echo $respuesta;
} else {
    echo '0';
}
?>