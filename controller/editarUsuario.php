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
    $usuarios = "SELECT * FROM usuarios WHERE idusuario = '$ID'";
    $resultadousuarios = $conexion->query($usuarios);
    $filas = $resultadousuarios->fetch_assoc();

    $empleados = "SELECT * FROM personal WHERE idnombre = '$ID'";
    $resultadoempleado = $conexion->query($empleados);
    $rows = $resultadoempleado->fetch_assoc();

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
</style>

<body>

<div class="main-content">
    <div class="section__content">
        <div class="section__content--p30">
            <div class="container pt-5 pb-5">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card text-light bg-dark">
                            <div class="card-header">Administrador - Editar usuarios</div>
                            <div class="card-body">
                                <div class="card-title">
                                    <h2 class="text-light">Actualizar información</h2>
                                    <p>* Verifique todos los campos antes de editar</p>
                                </div>
                                <hr>
                                    <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST">
                                        <div class="form-row">
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 pb-2">
                                                <label for="">Usuario</label>
                                                <input name="usuario" type="text" class="form-control" value="<?php echo $filas['usuario']; ?>">
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 pb-2">
                                                <label for="">Nombre</label>
                                                <input name="nombre" type="text" class="form-control" value="<?php echo $rows['nombre']; ?>">
                                            </div>                                        
                                        </div>

                                        <div class="form-row">
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 pb-2">
                                                <label for="" class="control-label mb-1">Tipo de Usuario</label>
                                                <select name="tipouser" class="form-control">					
                                                    <option value="1">Usuario</option>						           
                                                    <option value="2">Administrador</option>
                                                    <option value="3">Usuario Restringido</option>        
                                                </select>
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 pb-2">
                                                <label for="" class="control-label mb-1">Contraseña</label>
                                                <input id="password" name="password" type="password" class="form-control" value="<?php echo $filas['password']; ?>">
                                                <!-- <button class="btn btn-primary" type="button" onclick="mostrarContrasena()"><i class="fas fa-eye"></i> Ver contraseña</button> -->
                                            </div>
                                        </div>                                                                             
                                                                                                    

                                        <div class="form-row pb-2">
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 pb-2">
                                                <label for="">Correo</label>
                                                <input name="correo" type="email" class="form-control" value="<?php echo $rows['correo']; ?>">  
                                            </div>                                      
                                        </div>

                                        <input type="hidden" name="ID" value="<?php echo $ID; ?>">                
                                                                         
                                        <!-- <input type="submit" value="Editar registro" name="editar" class="btn btn-lg btn-warning btn-block"> -->

                                        <div class="form-row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 pb-2">
                                                <button type="submit" class="btn btn-lg btn-warning btn-block" name="editar"><i class="fas fa-edit"></i> Editar usuario</button>
                                            </div>

                                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                                <a href="../usuarios" class="btn btn-lg btn-danger btn-block" name="cancelar"><i class="fas fa-times"></i> Cancelar</a>
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
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    $correo = $_POST['correo'];
    $tipouser = $_POST['tipouser'];

    $id = $_POST['ID'];

    $modificarEmpleado = "UPDATE personal SET nombre = '$nombre', correo = '$correo' WHERE idnombre = $id";
    $modificarUsuario = "UPDATE usuarios SET usuario = '$usuario', password = '$password', idtipousuario = '$tipouser' WHERE idusuario = $id";
    
    $modificacionEmpleado = $conexion->query($modificarEmpleado);
    $modificacionUsuario = $conexion->query($modificarUsuario);

    if($modificarUsuario > 0 and $modificacionUsuario > 0){
        echo "<script>window.location = '../usuarios';</script>";
    }else{
        echo "<script>window.location = '../usuarios';</script>";
    }
}    

?>

<script>
function mostrarContrasena(){
    var tipo = document.getElementById("password");
    if(tipo.type == "password"){
        tipo.type = "text";
    }else{
        tipo.type = "password";
    }
}
</script>

<?php include("../layout/footer.php"); ?>

        