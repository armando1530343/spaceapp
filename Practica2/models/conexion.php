<?php

class Conexion{
    public function conectar (){
        $link = new PDO("mysql:host=localhost;dbname=practica2_bd", "root" ,"");
    
    return $link;
    }

}
?>