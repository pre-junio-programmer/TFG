
<?php
    require_once "../modelo/Manejo_Base.php";

    $resultado = Operaciones_Base::insertarUsuario($_POST['nombre'], $_POST['correo'], $_POST['contra'], $_POST['direccion']);

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