<?php
include("../model/conexion.php");

    $conexion = conexion();

    session_start();

    if(!isset($_SESSION['idusuario'])){
        header("Location: ../login");
    }

    if($_SESSION['tipousuario'] == 2){       

        $ID = $_GET['id'];
        $eliminarproveedor = "DELETE FROM proveedores WHERE idproveedor = '$ID'";
        $resultado = $conexion->query($eliminarproveedor);
        
        echo "<script> window.location = '../proveedores'; </script>";

        $conexion->close();
    } else if($_SESSION['tipousuario'] == 1 || $_SESSION['tipousuario'] == 3){
        echo "<script> window.location = '../proveedores'; </script>";
    }

           

?>


