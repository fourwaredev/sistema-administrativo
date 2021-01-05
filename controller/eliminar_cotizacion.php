<?php

include '../model/conexion.php';

$conexion = conexion();

    session_start();

    if(!isset($_SESSION['idusuario'])){
        header("Location: ../login");
    }

        $ID = $_GET['id'];
        $eliminarcotizacion = "DELETE FROM cotizacion WHERE idclave = '$ID'";
        $resultado = $conexion->query($eliminarcotizacion);   
        
        header('Location: ../cotizacion');

        $conexion->close();
    
?>
