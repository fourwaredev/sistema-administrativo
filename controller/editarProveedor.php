<?php    
    include '../model/conexion.php';

    $conexion = conexion();
    
    session_start();

    if(!isset($_SESSION['idusuario'])){
        header("Location: ../login");
    }

    if($_SESSION['tipousuario'] == 1 || $_SESSION['tipousuario'] == 3){
        header("Location: proveedores");
    }

    $ID = $_GET['id'];
    $proveedores = "SELECT * FROM proveedores WHERE idproveedor = '$ID'";
    $resultadoproveedor = $conexion->query($proveedores);
    $filas = $resultadoproveedor->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Title Page-->
     <!-- Title Page-->
     <title>Panel de Administración - La Estrella del Centro SA de CV</title>

    <link rel="shortcut icon" href="../images/icono.svg">

    <link rel="shortcut icon" href="../images/icono.svg" type="image/x-icon">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- Main CSS-->
    <link href="../css/theme.css" rel="stylesheet" media="all">

    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">

</head>

<style>
body {
    background-color: #E8EBED;
    font-family: "Poppins", sans-serif;
}
</style>

<body>

<div class="main-content">
    <div class="section__content">
        <div class="section__content--p30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card bg-dark text-light">
                            <div class="card-header text-light">Administrador - Editar Proveedor</div>
                            <div class="card-body">
                                <div class="card-title">
                                    <h2 class="text-center text-light">Editar proveedor</h2>
                                </div>

                                <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 pb-2">
                                            <label for="">Nombre</label>
                                            <input type="text" class="form-control" placeholder="Ingresa el nombre" value="<?php echo $filas['nombre'];?>" name="nombreEditar" required>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 pb-2">
                                            <label for="">Proveedor</label>
                                            <input type="text" class="form-control" placeholder="Ingresa el proveedor" name="proveedorEditar" value="<?php echo $filas['proveedor'];?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 pb-2">
                                            <label for="">Productos</label>
                                            <input type="text" class="form-control" placeholder="Ingresa los productos" value="<?php echo $filas['productos'];?>" name="productoEditar" required>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 pb-2">
                                            <label for="">Fecha</label>
                                            <input type="text" class="form-control" placeholder="Last name" name="fechaEditar" value="<?php echo $filas['fecha']; ?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 pb-3">
                                            <label for="">Estado</label>
                                            <select name="estadoEditar" class="form-control">
                                                <option value="<?php echo $filas['estado']; ?>"><?php echo $filas['estado']; ?></option>
                                                <option value="En revisión">En revisión</option>
                                                <option value="Aprobado">Aprobado</option>
                                                <option value="Cancelado">Cancelado</option>
                                            </select>
                                        </div>                                        
                                    </div>

                                    <input type="hidden" name="ID" value="<?php echo $ID; ?>">

                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                            <button type="submit" class="btn btn-lg btn-warning btn-block" name="editar"><i class="fas fa-edit"></i> Editar</button>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                            <a href="../proveedores" class="btn btn-lg btn-danger btn-block" name="cancelar"><i class="fas fa-times"></i> Cancelar</a>
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
    $nombreEditar = $_POST['nombreEditar'];
    $proveedorEditar = $_POST['proveedorEditar'];
    $productoEditar = $_POST['productoEditar'];
    $fechaEditar = $_POST['fechaEditar'];
    $estadoEditar = $_POST['estadoEditar'];

    $id = $_POST['ID'];

    $sqlmodificar = "UPDATE proveedores SET nombre = '$nombreEditar', proveedor = '$proveedorEditar', productos = '$productoEditar', fecha = '$fechaEditar', estado = '$estadoEditar' WHERE idproveedor = $id";
    $modificado = $conexion->query($sqlmodificar);

    if($modificado > 0){
        echo "<script> window.location = '../proveedores';</script>";
    }else{
        echo "<script> alert('Error al Modificar'); window.location = 'editarproveedor.php';</script>";
    }
}    

    include("../layout/footer.php"); 

?>

        