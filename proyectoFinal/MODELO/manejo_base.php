<?php
class Operaciones_Base {
    
    public static function conexion() {
        try {
            $conexion = new PDO('mysql:host=localhost; dbname=pf_adhajr', 'root', '');
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->exec("SET CHARACTER SET UTF8");
        } catch (Exception $e) {
            echo "Linea de error: " . $e->getLine();
            die("Erro" . $e->getMessage());
        }
        return $conexion;
    }

 
    //LO USAMOS PARA AVERIGUAR EL ULTIMO CAMPO EN LA TABLA, SOLEMOS USAR EL DATO PARA INCREMENTAR EN 1 EL ID
    public static function obtenerUltimoCampo($campo,$tabla) {
        $conexion = Operaciones_Base::conexion();
        
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
        $conexion = Operaciones_Base::conexion();

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
        $conexion = Operaciones_Base::conexion();
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

    public static function insertarUsuario($nombreUsu, $correoUsu, $contraUsu,$direccionUsu,$saldo) {
    
        //COMPROBAMOS QUE EL NOMBRE INTRODUCIDO NO ESTÉ EN USO
        $nombreExistente = Operaciones_Base::comprobarCampoUnico($nombreUsu,"name","usuario");
        //COMPROBAMOS QUE EL CORREO INTRODUCIDO NO ESTÉ EN USO
        $emailExistente = Operaciones_Base::comprobarCampoUnico($correoUsu,"email","usuario");
        //OBTENEMOS EL ÚLTIMO ID PARA INSERTAR EL SIGUIENTE USUARIO DE MANERA INCREMENTAL
        $idMaximo = Operaciones_Base::obtenerUltimoCampo("id_usuario","usuarios");
        $idNuevo = $idMaximo+1;
        //ALMACENAMOS EN RESULTADO Campo_Vacio SI ALGUNO DE LOS ELEMENTOS DEL FORMULARIO NO ESTÁ RELLENO
        if($nombreUsu=="" || $contraUsu=="" || $correoUsu=="" || $direccionUsu==""){
            $resultado = "Campo_Vacío";
            return $resultado;
        }
        //SI nombreExistente ES TRUE(EXISTE) DEVUELVE Nombre_Existente
        else if($nombreExistente) {
            $resultado = "Nombre_Existente";
            return $resultado;
        //SI emailExistente ES TRUE HACE LO MISMO
        } else if($emailExistente) {
            $resultado = "Email_existente";
            return $resultado;
        } else {
            //SI TODO HA IDO BIEN INSERTA EN USUARIOS TODOS LOS DATOS DEL USUARIO
            $conexion = Operaciones_Base::conexion();
            $sql = "INSERT INTO usuarios (nombre_u, direccion_u, correo_u, contra_u, saldo_u) VALUES (:nombre_u, :direccion_u, :correo_u, :contra_u, :saldo_u)";
            $resultado = $conexion->prepare($sql);
            $resultado->bindValue(":nombre_u", $nombreUsu);
            $resultado->bindValue(":direccion_u", $direccionUsu);
            $resultado->bindValue(":correo_u", $correoUsu);
            $resultado->bindValue(":contra_u", $contraUsu);
            $resultado->bindValue(":saldo_u", $saldo);
            $resultado->execute();
            $resultado = "Todo_Correcto";
            return $resultado;
        }
    }
    


}