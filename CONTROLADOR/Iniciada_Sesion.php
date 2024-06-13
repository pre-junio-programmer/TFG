<?php
//INICIA LA SESSION DEL USUARIO
session_start();
if(!isset($_SESSION['nombreDeSesion'])) {
    echo "ERROR";
    exit();
}
echo "OK";
?>