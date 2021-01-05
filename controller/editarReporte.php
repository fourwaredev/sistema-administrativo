<?php    
    include '../model/conexion.php';

    $conexion = conexion();
    
    session_start();

    if(!isset($_SESSION['idusuario'])){
        header("Location: ../login");
    }

    if($_SESSION['tipousuario'] == 1 || $_SESSION['tipousuario'] == 3){
        header("Location: ../index");
    }

    $ID = $_GET['id'];
    $reportes = "SELECT * FROM reportes WHERE idreporte = '$ID'";
    $resultadoreportes = $conexion->query($reportes);
    $filas = $resultadoreportes->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Title Page-->
    <title>Panel de Administración - La Estrella del Centro SA de CV</title>

    <link rel="shortcut icon" href="../images/icono.svg">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">

</head>

<style>
body {
    background-color: #E5E5E5;
    font-family: "Poppins", sans-serif;
}

textarea {
    resize: none;
}
</style>

<body>

<div class="main-content">
    <div class="section__content">
        <div class="section__content--p30">
            <div class="container pb-3 pt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card text-light bg-dark">
                            <div class="card-header">Administrador - Editar Reportes</div>
                            <div class="card-body">
                                <div class="card-title">
                                    <h2 class="text-center font-weight-bold">Actualizar Reporte</h2>
                                </div>                                
                                    <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST">
                                        <div class="form-group">
                                            <label for="">Nombre</label>
                                            <input name="nombre" type="text" class="form-control" value="<?php echo $filas['nombre']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Reporte</label>
                                            <textarea name="reporte" class="form-control" rows="6"><?php echo $filas['reporte']; ?></textarea>

                                            
                                        </div>                                                                    
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Fecha</label>
                                            <input id="cc-exp" name="fecha" type="text" class="form-control cc-exp" value="<?php echo $filas['fecha']; ?>">
                                        </div>
                                        
                                        <input type="hidden" name="ID" value="<?php echo $ID; ?>">                
                                                                         
                                        <!-- <input type="submit" value="Editar registro" name="editar" class="btn btn-lg btn-warning btn-block"> -->

                                        <div class="row">
                                            <div class='col-sm-12 col-md-6 col-lg-6 col-xl-6'>
                                                <button type="submit" class="btn btn-lg btn-warning btn-block" name="editar"><i class="fas fa-edit"></i> Editar reporte</button>
                                            </div>
                                            
                                            <div class='col-sm-12 col-md-6 col-lg-6 col-xl-6'>
                                                <a href="../reportes" class="btn btn-lg btn-danger btn-block" name="cancelar"><i class="fas fa-times"></i> Cancelar</a>
                                            </div>
                                        </div>
                                    
                                        </div>                                        
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

<?php

if(isset($_POST['editar'])){
    $nombre = $_POST['nombre'];
    $reporte = $_POST['reporte'];
    $fecha = $_POST['fecha'];

    $id = $_POST['ID'];

    $sqlmodificar = "UPDATE reportes SET nombre = '$nombre', reporte = '$reporte', fecha = '$fecha' WHERE idreporte = $id";
    $modificado = $conexion->query($sqlmodificar);

    if($modificado > 0){
        echo "<script> window.location = '../reportes';</script>";
    }else{
        echo "<script> alert('Error al Modificar'); window.location = 'editarReporte.php';</script>";
    }
}    

    include("../layout/footer.php"); 

?>

        