<?php
include("../model/conexion.php");

    $conexion = conexion();

    session_start();

    if(!isset($_SESSION['idusuario'])){
        header("Location: ../login");
    }

    if($_SESSION['tipousuario'] == 2){
        $ID = $_GET['id'];
        $eliminarusuario = "DELETE FROM usuarios WHERE idusuario = '$ID'";
        $resultado = $conexion->query($eliminarusuario);   
        
        $eliminarempleado = "DELETE FROM personal WHERE idnombre = '$ID'";
        $resultadoeliminarempleado = $conexion->query($eliminarempleado);

        header('Location: ../usuarios');

        $conexion->close();
    } else {
        echo "<script> window.location = '../index';</script>";
    }         

?>
