<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['email'];
    $contra = $_POST['password'];

    $directorio_img = "../img/usuario/";

    //INTENTA INSERTAR EL USUARIO EN LA BASE
    $respuesta = Base_Operaciones::insertarUsuario($nombre, $direccion, $correo, $contra);

    //SI EXISTE EL NOMBRE TE MANDA ESTE ERROR
    if ($respuesta == "A") {
        header("Location: ../VISTA/Registro.html?error=1");
        exit();
    //SI EXISTE EL CORREO TE MANDA ESTE ERROR
    } else if ($respuesta == "B") {
        header("Location: ../VISTA/Registro.html?error=2");
        exit();
    //SI TODO ES EXITOSO INSERTA LA IMAGEN EN LA CARPETA SI NO HAY IMAGEN NO INSERTA NADA
    } else {
        $idUsuario = $_SESSION['id_usuario'];

        if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES["foto"]["tmp_name"];
            $fileExtension = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));
            $nuevoNombreArchivo = $idUsuario . "." . $fileExtension;
            $imagen = $directorio_img . $nuevoNombreArchivo;

            if (move_uploaded_file($fileTmpPath, $imagen)) {
                header("Location: ../VISTA/PaginaPrincipal.html");
                exit();
            } else {
                header("Location: ../VISTA/Registro.html?error=3");
                exit();
            }
        } else {
            header("Location: ../VISTA/PaginaPrincipal.html");
            exit();
        }
    }
}
?>