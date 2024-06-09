<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

if(isset($_SESSION['nombreDeSesion'])) {
    echo $_SESSION['nombreDeSesion'];
} else {
    echo "Nombre de usuario";
}
?>
