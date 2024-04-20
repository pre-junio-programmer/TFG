<?php

include_once "/app/MODELO/conexion.php";

class Operaciones_Base {

 
    //LO USAMOS PARA AVERIGUAR EL ULTIMO CAMPO EN LA TABLA, SOLEMOS USAR EL DATO PARA INCREMENTAR EN 1 EL ID
    public static function obtenerUltimoCampo($campo,$tabla) {
        
            //SELECCIONA EL ULTIMO CAMPO DE LA TABLA DESEADA
            $sql = "SELECT MAX({$campo}) AS ultimo_id FROM {$tabla}";
            $consulta = $conexion->query($sql);
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            //ALMACENA EL RESULTADO PARA DEVOLVERLO
            $ultimoId = $resultado['ultimo_id'];
            return $ultimoId;
    }

    //COMPROBAMOS QUE EL VALOR INTRODUCIDO EN EL FORMULARIO NO EXISTA EN LA TABLA, PARA CONTROLAR DUPLICADOS
    public static function comprobarCampoUnico($valor,$campo,$tabla) {

        //BUSCA EN LA TABLA DESEADA SI EXISTE EL VALOR QUE INTRODUCIMOS EN EL CAMPO QUE QUEREMOS
        $buscarCampo = "SELECT COUNT(*) as count FROM {$tabla} WHERE {$campo} = :valor";
        $ejecutarCampo = $conexion->prepare($buscarCampo);
        $ejecutarCampo->bindValue(":valor", $valor);
        $ejecutarCampo->execute();
        
        //LO ALMACENA PARA LUEGO COMPROBAR SI ES MAYOR QUE 0 Y DEVUELVE TRUE SI ASÍ ES
        $existeCampo = $ejecutarCampo->fetch(PDO::FETCH_ASSOC);
        return $existeCampo['count'] > 0;
       
    }


    //COMPRUEBA LAS CREDENCIALES DEL USUARIO
    public static function inicioExitoso($nombreIntroducido, $contraIntroducida) {
        //COMPRUEBA QUE EL NOMBRE INTRODUCIDO EXISTA
        $nombreExistente = Operaciones_Base::comprobarCampoUnico($nombreIntroducido,"name","usuario");
        //SI EXISTE(TRUE) SELECCIONA LA CONTRASEÑA DONDE EL NOMBRE ES IGUAL AL DEL FORMULARIO
        if($nombreExistente){
            
            $sql = "SELECT contra FROM usuario WHERE name = :nombreUsu";
            $resultado = $conexion->prepare($sql);
            $resultado->bindValue(":nombreUsu", $nombreIntroducido);
            $resultado->execute();
            //ALMACENA EN CONTRASEÑA EL RESULTADO DE LA CONSULTA
            $contraSena= $resultado->fetch()["password"]; 
            
            //COMPARA LA CONTRASEÑA INTRODUCIDA EN EL FORMULARIO CON LA DE LA BASE
            if($contraIntroducida ==$contraSena){
                //SI ES CORRECTA EMPIEZA LA SESION Y ALMACENA EL NOMBRE EN UNA VARIABLE DE SESION
                session_start();
                $_SESSION['nombreDeSesion'] = $nombreIntroducido;
                
                //DEVUELVE TRUE POR QUE SE HA INICIADO CORRECTAMENTE(PODEMOS CAMBIARLO PARA QUE SALGA UN MENSAJE MAS ESPECIFICO)
                return true;
            } else {   
                return false;
            }
        } else { 
            return false;
        }
    }

    public static function insertarUsuario($nombreUsu, $correoUsu, $contraUsu, $direccionUsu, $saldo) {
        global $db; // Hacer que la variable $db sea accesible dentro de la función
    
        // Verificar si algún campo está vacío
        if(empty($nombreUsu) || empty($correoUsu) || empty($contraUsu) || empty($direccionUsu) || empty($saldo)) {
            return "Campo_Vacío";
        }
    
        // Verificar si el nombre de usuario ya existe
        $query = "SELECT * FROM usuarios WHERE nombre_u = '$nombreUsu'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) > 0) {
            return "Nombre_Existente";
        }
    
        // Verificar si el correo ya existe
        $query = "SELECT * FROM usuarios WHERE correo_u = '$correoUsu'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) > 0) {
            return "Correo_Existente";
        }
    
        // Insertar el nuevo usuario en la base de datos
        $query = "INSERT INTO usuarios (nombre_u, correo_u, contra_u, direccion_u, saldo_u) VALUES ('$nombreUsu', '$correoUsu', '$contraUsu', '$direccionUsu', $saldo)";
        if(mysqli_query($db, $query)) {
            return "Todo_Correcto";
        } else {
            return "Error en la inserción";
        }
    }
    
    


}