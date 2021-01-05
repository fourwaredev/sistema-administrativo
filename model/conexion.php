<?php
    function conexion() {
        $conexion = new mysqli("localhost", "root", "", "sistema");
        if ($conexion->connect_errno) {
            echo 'Fallo al conectar' . $conexion->connect_error;
        }        
        $conexion -> set_charset("utf-8");
        return $conexion;
    }


?>