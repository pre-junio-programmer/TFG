<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

$valor_nombre = $_SESSION['nombreDeSesion'];

$respuesta = number_format($_SESSION['saldo_u'], 2, '.', '');

if($respuesta != null){
    echo $respuesta;
} else {
    echo '0';
}
?>