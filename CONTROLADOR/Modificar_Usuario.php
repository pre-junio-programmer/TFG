<?php
session_start();
require_once "../MODELO/Manejo_Base.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_SESSION['nombreDeSesion'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['email'];
    $directorio_img = "../img/usuario/";
    $id_usuario = $_SESSION['id_usuario'];

    //ACTUALIZA LOS DATOS DEL USUARIO EN LA TABLA(DENTRO DE LA FUNCION COMPRUEBA SI EXISTE EL NOMBRE DE CORREO O EL DE USUARIO)
    $respuesta = Base_Operaciones::updateUser($id_usuario, $nombre, $direccion, $correo);

    //EL USUARIO YA EXISTE
    if ($respuesta == "A") {
        header("Location: ../VISTA/CambiarInformacionUsuario.html?error=1");
        exit();
    //EL CORREO YA EXISTE
    } else if ($respuesta == "B") {
        header("Location: ../VISTA/CambiarInformacionUsuario.html?error=2");
        exit();
    //SE HACE BIEN EL UPDATE Y ADEMAS SE COMPRUEBA SI EXISTIA LA FOTO EN LA CARPETA DE IMG/USUARIO Y SE SUSTITUYE
    } else {
        if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES["foto"]["tmp_name"];
            $fileExtension = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));
            $nuevoNombreArchivo = $id_usuario . "." . $fileExtension;
            $imagen = $directorio_img . $nuevoNombreArchivo;

            $imagenesExistentes = glob($directorio_img . $id_usuario . ".*");
            foreach ($imagenesExistentes as $img) {
                if (file_exists($img)) {
                    unlink($img);
                }
            }

            if (move_uploaded_file($fileTmpPath, $imagen)) {
                header("Location: ../VISTA/CambiarInformacionUsuario.html");
                exit();
            } else {
                header("Location: ../VISTA/CambiarInformacionUsuario.html?error=3");
                exit();
            }
        } else {
            header("Location: ../VISTA/CambiarInformacionUsuario.html");
            exit();
        }
    }
}
?>