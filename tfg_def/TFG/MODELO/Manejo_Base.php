<?php
class Base_Operaciones {
    
    public static function conexion() {
        try {
            $conexion = new PDO('mysql:host=localhost; dbname=tfg', 'root', '');
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->exec("SET CHARACTER SET UTF8");
        } catch (Exception $e) {
            echo "Linea de error: " . $e->getLine();
            die("Erro" . $e->getMessage());
        }
        return $conexion;
    }



    public static function comprobarCampoUnico($valor,$campo) {
        $conexion = Base_Operaciones::conexion();

        $buscarCampo = "SELECT COUNT(*) as count FROM usuario WHERE {$campo} = :valor";
        $ejecutarCampo = $conexion->prepare($buscarCampo);
        $ejecutarCampo->bindValue(":valor", $valor);
        $ejecutarCampo->execute();
    
        $existeCampo = $ejecutarCampo->fetch(PDO::FETCH_ASSOC);
    
        
        return $existeCampo['count'] > 0;
       
    }
    

    public static function obtenerUltimoIdUsuario() {
        $conexion = Base_Operaciones::conexion();
        
            $sql = "SELECT MAX(id) AS ultimo_id FROM users";
            $consulta = $conexion->query($sql);
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            $ultimoId = $resultado['ultimo_id'];
            return $ultimoId;
     
    }
    public static function insertarUsuario($nombreUsu, $correoUsu, $contraUsu, $pintorSelect) {
        $conexion = Base_Operaciones::conexion();
    
    
        $nombreNoExistente = Base_Operaciones::comprobarCampoUnico($nombreUsu,"name");
        $emailNoExistente = Base_Operaciones::comprobarCampoUnico($correoUsu,"email");
        $idMaximo = Base_Operaciones::obtenerUltimoIdUsuario();
        $idNuevo = $idMaximo+1;
        $pintor =  intval($pintorSelect);

        if($nombreUsu=="" || $contraUsu=="" || $correoUsu=="" || $pintorSelect==""){
            $resultado = "B";
            return $resultado;
        }
        else if($nombreNoExistente) {
            $resultado = "A";
            return $resultado;
        } else if($emailNoExistente) {
            $resultado = "D";
            return $resultado;
        } else {
            
            $sql = "INSERT INTO users(id,name,password,email,painter_fk) VALUES (:id,:usuario,:contrasena,:correo,:pintor)";
            $resultado = $conexion->prepare($sql);
    
            $resultado->bindValue(":usuario", $nombreUsu);
            $resultado->bindValue(":contrasena", $contraUsu);
            $resultado->bindValue(":correo", $correoUsu);
            $resultado->bindValue(":pintor", $pintor);
            $resultado->bindValue(":id", $idNuevo);
    
    
            
            $resultado->execute();
    
            $resultado = "C";
            return $resultado;
        }
    }
    public static function inicioExitoso($nombreIntroducido, $contraIntroducida) {
        $conexion = Base_Operaciones::conexion();
        
        $sql = "SELECT * FROM usuario WHERE nombre_u = :nombreUsu AND contra_u = :contraUsu";
        $resultado = $conexion->prepare($sql);
        $resultado->bindValue(":nombreUsu", $nombreIntroducido);
        $resultado->bindValue(":contraUsu", $contraIntroducida);
        $resultado->execute();
        
        if($resultado->rowCount() > 0) {
            session_start();
            $_SESSION['nombreDeSesion'] = $nombreIntroducido;
            return true;
        } else {
            return false; 
        }
    }
    public static function mostrarProductos($categoria) {
        $conexion = Base_Operaciones::conexion();
        
        $sql = "SELECT nombre_p, descripcion_p FROM producto WHERE categoria_p = :categoria";
        $consultaProducto = $conexion->prepare($sql);
        $consultaProducto->bindParam(":categoria", $categoria);
        $consultaProducto->execute();
    
        $productos = $consultaProducto->fetchAll(PDO::FETCH_ASSOC);
        
        return $productos;
    }
    public static function mostrarDatosCuadro($numeroCuadro) {
        $conexion = Base_Operaciones::conexion();

        $buscarCuadro = "SELECT * FROM paintings WHERE id = :numeroCuadro";
        $cuadroObtenido = $conexion->prepare($buscarCuadro);
        $cuadroObtenido->bindParam(":numeroCuadro", $numeroCuadro);
        $cuadroObtenido->execute();
        $devolver = $cuadroObtenido->fetch(PDO::FETCH_ASSOC);

        return $devolver;
    }

    public static function borrarUsuario($nombreUsuario,$contraUsu) {
        $conexion = Base_Operaciones::conexion();
    
        $borrarTodo = "DELETE FROM users WHERE name = :nombreUsu and password=:contraUsu";
        $borrarDefinitivo = $conexion->prepare($borrarTodo);
        $borrarDefinitivo->bindValue(":nombreUsu", $nombreUsuario);
        $borrarDefinitivo->bindValue(":contraUsu", $contraUsu);

        $borrarDefinitivo->execute();
    }
    public static function obtenerDatos($nombreUsuario) {
        $conexion = Base_Operaciones::conexion();
        $buscarUsuario = "SELECT name,password,email,painter_fk FROM users WHERE name = :nombreUsuario";
        $usuarioObtenido = $conexion->prepare($buscarUsuario);
        $usuarioObtenido->bindParam(":nombreUsuario", $nombreUsuario);
        $usuarioObtenido->execute();
        $arrayUsuario = $usuarioObtenido->fetch(PDO::FETCH_ASSOC);
    
        return $arrayUsuario;
    }
    
    public static function comprobarCampoUnicoModificacion($valor, $campo,$variableSesion) {
        $conexion = Base_Operaciones::conexion();
    
        $buscarCampo = "SELECT COUNT(*) as count FROM users WHERE {$campo} = :valor AND name != :variableSesion";
        $ejecutarCampo = $conexion->prepare($buscarCampo);
        $ejecutarCampo->bindValue(":valor", $valor);
        $ejecutarCampo->bindValue(":variableSesion", $variableSesion);
        $ejecutarCampo->execute();
    
        $existeCampo = $ejecutarCampo->fetch(PDO::FETCH_ASSOC);
    
        return $existeCampo['count'] > 0;
    }

    public static function modificarUsuario($nombreMod, $correoMod, $contraMod, $pintorSelMod, $nombreSesion) {
        $conexion = Base_Operaciones::conexion();

        $nombreNoRepetido = Base_Operaciones::comprobarCampoUnicoModificacion($nombreMod,"name",$nombreSesion);
        $emailNoRepetido = Base_Operaciones::comprobarCampoUnicoModificacion($correoMod,"email",$nombreSesion);
       


        if($nombreMod=="" || $contraMod=="" || $correoMod=="" || $pintorSelMod==""){
            $resultado = "B";
            return $resultado;
        }
        else if($nombreNoRepetido) {
            $resultado = "A";
            return $resultado;
        } else if($emailNoRepetido) {
            $resultado = "D";
            return $resultado;
        } else {
            
            $sql = "UPDATE users SET name = :nombreMod, password = :contraMod, email = :correoMod, painter_fk = :pintorMod WHERE name = :nombreNoBuscar";
            $resultado = $conexion->prepare($sql);
    
            $resultado->bindValue(":nombreMod", $nombreMod);
            $resultado->bindValue(":contraMod", $contraMod);
            $resultado->bindValue(":correoMod", $correoMod);
            $resultado->bindValue(":pintorMod", $pintorSelMod);
            $resultado->bindValue(":nombreNoBuscar", $nombreSesion);
        
            $resultado->execute();
            $_SESSION['nombreDeSesion']=$nombreMod; 
    
            $resultado = "C";
            return $resultado;
        }
    }
}

?>