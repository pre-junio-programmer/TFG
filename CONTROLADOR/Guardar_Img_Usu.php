<?php
$directorio_img = "../img/usuario";


if (isset($_FILES["file"])) {
    $imagen = $directorio_img . basename($_FILES["file"]["name"]);
    $subidaOk = 1;
    $extension_img = strtolower(pathinfo($imagen, PATHINFO_EXTENSION)); 

    if ($subidaOk==1){
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $imagen)) {
            echo "El archivo " . basename($_FILES["file"]["name"]) . " ha sido subido.";
        } else {
            echo "Lo siento, hubo un error al subir tu archivo.";
        }
    }
        
} else {
    echo "No se ha recibido ningún archivo.";
}
?>