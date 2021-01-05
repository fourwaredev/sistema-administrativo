<?php 

include("model/conexion.php");

$conexion = conexion();

session_start();
if(!isset($_SESSION['idusuario'])){
    echo "<script> window.location = 'login';</script>";
}

$idusuario = $_SESSION['idusuario'];

$consultaAcceso = "SELECT u.idusuario, a.nombre, a.correo, u.usuario FROM usuarios AS u INNER JOIN personal AS a ON u.idnombre = a.idnombre WHERE u.idusuario='$idusuario'";

$resultadoAcceso = $conexion->query($consultaAcceso);
$filas = $resultadoAcceso->fetch_assoc();


$nombre = $filas['nombre']; 
$usuario = $filas['usuario'];
$correo = $filas['correo'];

if ($_SESSION['tipousuario'] == 2) {
    $tipousuario = 'Administrador';
} else if($_SESSION['tipousuario'] == 1) {
    $tipousuario = 'Usuario';
} else if($_SESSION['tipousuario'] == 3) {
    $tipousuario = 'Usuario -d';
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Panel de Administración - La Estrella del Centro SA de CV</title>

    <link rel="shortcut icon" href="images/icono.svg">

    <!-- Fontfaces CSS-->
    <!-- <link rel="stylesheet" href="css/font-face.css"> -->

    <!-- Material Design Iconic Font -->
    <!-- <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"> -->

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- Vendor CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animsition/4.0.2/css/animsition.min.css">

    <!-- Animate CSS -->
    <!-- <link rel="stylesheet" href="https://raw.githubusercontent.com/daneden/animate.css/master/animate.css"> -->

    <!-- Hamburgers CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hamburgers/1.1.3/hamburgers.min.css">

    <!-- Slick CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">

    <!-- Perfect Scrollbar -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.css">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>

    <!--  extension responsive  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

    <!-- Google Font Poppins -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">

</head>

<body>
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index">
                            <img src="images/logo.svg" alt="La Estrella del Centro SA de CV">
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li>
                            <a href="index">
                                <i class="fas fa-home"></i>Inicio</a>
                        </li>
                        <li>
                            <a href="proveedores">
                                <i class="fas fa-handshake"></i>Proveedores</a>
                        </li>
                        <li>
                            <a href="reportes">
                                <i class="fas fa-clipboard-list"></i>Reportes</a>
                        </li>
                        <li>
                            <a href="documentos">
                                <i class="fas fa-copy"></i>Formatos</a>
                        </li>

                        <?php
                            if($_SESSION['tipousuario'] == 2) {
                                echo '<li>
                                <a href="usuarios">
                                    <i class="fas fa-users"></i>Usuarios</a>
                            </li> ';
                            } else {
                                echo '<li>
                                <a href="perfil">
                                    <i class="fas fa-user"></i>Perfil</a>
                            </li> ';
                            }
                        
                        ?>
                                                                
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="index">
                    <img src="images/logo.svg" alt="La Estrella del Centro SA de CV">
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">                       
                        <li class="active has-sub">
                            <a href="index">
                                <i class="fas fa-home"></i>Inicio</a>
                        </li>
                        <li>
                            <a href="proveedores">
                                <i class="fas fa-handshake"></i>Proveedores</a>
                        </li>
                        <li>
                            <a href="reportes">
                                <i class="fas fa-clipboard-list"></i>Reportes</a>
                        </li>
                        <li>
                            <a href="documentos">
                                <i class="fas fa-copy"></i>Formatos</a>
                        </li>

                        <?php 
                        
                            if($_SESSION['tipousuario'] == 2){
                                echo '<li>
                                <a href="usuarios">
                                    <i class="fas fa-users"></i>Usuarios</a>
                            </li> ';
                            } else {
                                echo '<li>
                                <a href="perfil">
                                    <i class="fas fa-user"></i>Perfil</a>
                            </li> ';
                            }
                        
                        ?>
                                       
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="header-wrap float-right p-r-20 p-b-1">
                                    <div class="header-button">
                                        <div class="account-wrap">
                                            <div class="account-item clearfix js-item-menu">
                                                <div class="image">
                                                    <img src="images/usuario.svg" alt="Usuario">
                                                </div>
                                                <div class="content">
                                                    <a class="js-acc-btn" href="#"><?php echo $nombre . ' '; ?><i class="fas fa-chevron-down"></i></a>
                                                </div>
                                                <div class="account-dropdown js-dropdown">
                                                    <div class="info clearfix">
                                                        <div class="image">
                                                            <a href="#">
                                                                <img src="images/usuario.svg" alt="Usuario">
                                                            </a>
                                                        </div>
                                                        <div class="content">
                                                            <h5 class="name">
                                                                <a href="#"><?php echo $usuario; ?></a>
                                                            </h5>
                                                            <span class="email"><?php echo $tipousuario; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="account-dropdown__body">
                                                        <div class="account-dropdown__item">
                                                            <a href="perfil">
                                                                <i class="fas fa-user"></i>Mis proveedores</a>
                                                        </div>
                                                        <!-- <div class="account-dropdown__item">
                                                            <a href="#">
                                                                <i class="fas fa-cog"></i>Configuración</a>
                                                        </div> -->
                                                    </div>
                                                    <div class="account-dropdown__footer">
                                                        <a href="secure/cerrar">
                                                            <i class="fas fa-power-off"></i>Cerrar Sesión</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->