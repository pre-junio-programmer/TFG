<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

//RECOGEMOS LOS DATOS DE LA TARJETA DEL FORMULARIO Y LOS INSERTAMOS EN LA BASE DE DATOS
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numeroT = $_POST['numero'];
    $tipoT = $_POST['tipoTarjeta'];
    $nombreT = $_POST['nombre'];
    $fechaCadT=$_POST['fecha'];
    $csvT = $_POST['cvv'];
    $nombreUsu=$_SESSION['nombreDeSesion'];

    //TRANSFORMAMOS DE TEXTO A NUMÉRICO PARA MANEJARLO MEJOR POSTERIORMENTE
    switch ($tipoT) {
        case 'Visa':
            $tipoTarjeta= "1";
            break;
        case 'MasterCard':
            $tipoTarjeta = "2";
            break;
        case 'Discover':
            $tipoTarjeta = "3";
            break;
        case 'American Express':
            $tipoTarjeta = "4";
            break;
        default:
            $tipoTarjeta= "1";
            break;
    }
    
    $respuesta = Base_Operaciones::insertarTarjeta($numeroT, $tipoTarjeta, $nombreT, $fechaCadT,$csvT,$nombreUsu);

    //SI YA HAY UN NUMERO DE TARJETA IGUAL(RESPUESTA A) DEVOLVEMOS AL FORMULARIO CON ERROR
    if ($respuesta == "A") {
        header("Location: ../VISTA/InformacionTarjeta.html?error=1");
        exit();
    } else {
        header("Location: ../VISTA/PaginaPrincipal.html");
        exit();
    }
}
?>