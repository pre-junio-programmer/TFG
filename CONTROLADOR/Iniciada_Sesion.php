<?php
session_start();
if(!isset($_SESSION['nombreDeSesion'])) {
    echo "ERROR";
    exit();
}
echo "OK";
?>