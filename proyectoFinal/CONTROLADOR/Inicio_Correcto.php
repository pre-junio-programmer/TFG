<?php
session_start();
require_once "../modelo/manejo_base.php";

//SI HA DEVUELTO TRUE
if (Operaciones_Base::inicioExitoso($_POST['nombre'], $_POST['contraseña'])) {
    //DIRIGE A LA PAGINA PRINCIPAL header("Location: ../vista/Pag_Principal.php");
} else {
    //SI ES FALSE, YA SEA POR NOMBRE O CONTRASEÑA INCORRECTOS DA ERROR Y REDIRIGE A LA MISMA PAGINA DE INICIO
    //EL ERROR HARÁ DISPLAY EN UNA LABEL EN LA VISTA(SE PUEDE ESPECIFICAR POR NOMBRE O POR CONTRASEÑA)
    header("Location:../VISTA/Inicio_Sesion_F.php?error=El nombre o la contraseña son incorrectos"); 
}