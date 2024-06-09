<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

$valor_nombre = $_SESSION['nombreDeSesion'];

$respuesta = $_SESSION['saldo_u'];

if($respuesta != null){
    echo $respuesta;
} else {
    echo '0';
}
?>