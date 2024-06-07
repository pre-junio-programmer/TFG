<?php
$directorio_img = "../img";


if (isset($_FILES["file"])) {
    $imagen = $directorio_img . basename($_FILES["file"]["name"]);
    $subidaOk = 1;
    $extension_img = strtolower(pathinfo($imagen, PATHINFO_EXTENSION));

    

    if ($_FILES["file"]["size"] > 500000) { 
        echo "Lo siento, el archivo es demasiado grande.";
        $subidaOk = 0;
    }

    
    if ($extension_img != "jpg" && $extension_img != "png" && $extension_img != "jpeg") {
        echo "Lo siento, solo se permiten archivos JPG, JPEG o PNG.";
        $subidaOk = 0;
    }

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