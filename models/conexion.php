<?php 
class conexion{
    public function get_conexion(){
        include ("datos.php");
        $conexion =new PDO("mysql:host=$host;dbname=$db;",$user, $pass);
        $conexion->query("SET NAMES 'utf8mb4';");
        $conexion->query("SET lc_time_names = 'es_ES';");
        return $conexion;
    }
}
?>