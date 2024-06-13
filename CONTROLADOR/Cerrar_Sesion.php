<?php
//CIERRA LA SESION
session_start();
session_destroy();
header("Location: ../index.php");
exit();
?>