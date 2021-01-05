<?php

include '../model/conexion.php';

$conexion = conexion();

    session_start();

    if(!isset($_SESSION['idusuario'])){
        header("Location: ../login");
    } else {        
        $ID = $_GET['id'];
        $eliminarDocumento = "DELETE FROM documentos WHERE id = '$ID'";
        $resultado = $conexion->query($eliminarDocumento);            
        
        header('Location: ../documentos');

        $conexion->close();
    }
    
?>
