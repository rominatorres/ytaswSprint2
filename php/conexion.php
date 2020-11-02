<?php 
    class Conexion{
        public static function Conectar(){
            define('servidor', 'bfassz2oczlfulvixj8l-mysql.services.clever-cloud.com');
            define('nombre_bd','bfassz2oczlfulvixj8l');
            define('usuario','usbnwxo7p3hke6y8');
            define('password','QWhSIgTTcYfpswxIhp0m');
            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
            try{
                $conexion = new PDO("mysql:host=".servidor."; dbname=".nombre_bd, usuario, password, $opciones);
                
                return $conexion;
            }
            catch(Exception $e){
                die("El error de Conexión es: ". $e->getMessage());
            }
        }
    }

?>