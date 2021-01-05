<?php
	include 'model/conexion.php';
    
    $conexion = conexion();

	session_start();
	if(isset($_SESSION['idusuario'])){
		header("Location: index");
	}

	if(!empty($_POST)){
		$usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
		$password = mysqli_real_escape_string($conexion, $_POST['password']);
		
		$consultaUsuarios = "SELECT idusuario, idtipousuario FROM usuarios WHERE usuario = '$usuario' AND password = '$password'";

		$resultadoUsuarios = $conexion->query($consultaUsuarios);
        $filas = $resultadoUsuarios->num_rows;
        
		if($filas>0){
			$fila=$resultadoUsuarios->fetch_assoc();
			$_SESSION['idusuario'] = $fila['idusuario'];
			$_SESSION['tipousuario'] = $fila['idtipousuario'];
			header("Location: index");
		}else{
			echo "<script> alert('Usuario o contraseña incorrectos'); window.location = 'login';</script>";
		}
	}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">

    <!-- Title Page-->
    <title>Inicia Sesión - La Estrella del Centro SA de CV</title>

    <link rel="shortcut icon" href="images/icono.svg">  

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    
    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

    <!-- Google Font Poppins -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">

</head>

<body>
    <div class="page-content--bge5">
        <div class="container-fluid">
           <div class="row">
               <div class="col-12">
                    <div class="login-wrap">
                        <div class="login-content">
                            <div class="login-logo">
                                <a href="login">
                                    <img src="images/logo.svg" alt="La Estrella del Centro">
                                </a>
                            </div>
                            <div class="login-form">
                                <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST">
                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <label for="">Nombre de usuario</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                                <input type="text" name="usuario" placeholder="Ingresa tu nombre de usuario" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group pb-3">
                                        <div class="col col-md-12">
                                            <label for="">Contraseña</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fas fa-lock"></i>
                                                </div>
                                                <input type="password" name="password" placeholder="Ingresa tu contraseña" class="form-control">
                                            </div>
                                        </div>
                                    </div>                               
                                    <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</button>                                
                                </form>                            
                            </div>
                        </div>
                    </div>
               </div>
           </div>
        </div>
    </div>

<?php include 'layout/footer.php'; ?>