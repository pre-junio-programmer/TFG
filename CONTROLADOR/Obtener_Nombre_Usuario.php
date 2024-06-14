<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

//OBTIENE EL NOMBRE PARA MOSTRARLO EN EL MENU DE USUARIO
if(isset($_SESSION['nombreDeSesion'])) {
    echo $_SESSION['nombreDeSesion'];
} else {
    echo "Nombre de usuario";
}
?>