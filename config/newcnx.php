<?php 
// Obtenemos los detalle de archivo global.php el cual contiene las variables de la vase de datos
 require_once("global.php");
 global $conexion;
    class Conexion{	  
        public static function Conectar() {        		
            try{
                $conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
                return $conexion;
            }catch (Exception $e){
                die("El error de Conexión es: ". $e->getMessage());
            }
        }
    }
    ?>
