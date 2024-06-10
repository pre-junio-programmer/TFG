<?php
session_start();
$id_usuario = $_SESSION['id_usuario'];
Base_Operaciones::borrarUsuTotal($id_usuario);
session_destroy();
?>