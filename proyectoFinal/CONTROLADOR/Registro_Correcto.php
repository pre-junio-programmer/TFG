<?php
include_once "../MODELO/manejo_base.php";

$resultado = Operaciones_Base::insertarUsuario($_POST['nombre_u'], $_POST['correo_u'], $_POST['contra_u'], $_POST['direccion_u'], $_POST['saldo_u']);

if ($resultado=="Todo_Correcto") {
    //PODEMOS CAMBIARLO A LA PAG PRINCIPAL EN VEZ DE AL INICIO
    header("Location:../VISTA/Inicio_Sesion.php?error=Usuario creado con éxito.");
}else if($resultado=="Campo_Vacío"){
    header("Location:../VISTA/Registro_F.php?error=Rellena todos los campos por favor.");
}else if($resultado=="Nombre_Existente"){
    header("Location:../VISTA/Registro_F.php?error=El nombre que has introducido ya está en uso");
}else{
    header("Location:../VISTA/Registro_F.php?error=El correo introducido ya está en uso");
}

?>
