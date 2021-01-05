<?php    
    include '../model/conexion.php';

    $conexion = conexion();
    
    session_start();

    if(!isset($_SESSION['idusuario'])){
        header("Location: ../login");
    }    

    $ID = $_GET['id'];
    $cotizacion = "SELECT * FROM cotizacion WHERE idclave = '$ID'";
    $resultadocotizacion = $conexion->query($cotizacion);
    $filas = $resultadocotizacion->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Title Page-->
    <title>Editar cotización - Panel de Administración</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">

</head>

<body>

    <div class="main-content">
        <div class="section__content">
            <div class="section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header text-light bg-dark">Editar Producto</div>
                                <div class="card-body">
                                    <div class="card-title">
                                        <h2 class="text-center">Actualizar información</h2>
                                    </div>
                                    <hr>

                                    <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST">
                                        <div class="form-group">
                                            <label for="">Producto</label>
                                            <input name="producto" type="text" class="form-control" value="<?php echo $filas['descripcion']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <p id="etiqueta">Cantidad: </p>
                                            <input type="number" class="form-control" placeholder="Ingresa la cantidad" name="cantidad" required step="any" value="<?php echo $filas['cantidad']?>">                               
                                            <select class="form-control" name="unidades">
                                                <option value="unidades"> Unidades</option>
                                                <option value="piezas"> Piezas</option>
                                                <option value="metros"> Metros</option>
                                                <option value="kilogramos"> Kilogramos</option>
                                                <option value="toneladas"> Toneladas</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Precio</label>
                                            <input id="cc-name" name="precio" type="number" class="form-control" value="<?php echo $filas['precio']; ?>">
                                        </div>

                                        <input type="hidden" name="ID" value="<?php echo $ID; ?>">                

                                        <!-- <input type="submit" value="Editar registro" name="editar" class="btn btn-lg btn-warning btn-block"> -->

                                        <button type="submit" class="btn btn-lg btn-warning btn-block" name="editar"><i class="fas fa-edit"></i> Editar registro</button>

                                        <a href="../cotizacion" class="btn btn-lg btn-danger btn-block" name="cancelar"><i class="fas fa-times"></i> Cancelar</a>

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
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $unidades = $_POST['unidades'];
    $precio = $_POST['precio'];

    $importe = ($cantidad * $precio);

    $id = $_POST['ID'];

    $sqlmodificar = "UPDATE cotizacion SET descripcion = '$producto', cantidad = '$cantidad', unidades = '$unidades', precio = $precio, importe = '$importe' WHERE idclave = $id";
    $modificado = $conexion->query($sqlmodificar);

    if($modificado > 0){
        echo "<script>window.location = '../cotizacion';</script>";
    }else{
        echo "<script> alert('Error al Modificar'); window.location = 'editar_cotizacion.php';</script>";
    }
}    

    include("../layout/footer.php"); 

?>

        