<?php include 'layout/header.php'; ?>

<?php
if(!empty($_POST)){
        
    $reporte = mysqli_real_escape_string($conexion, $_POST["reporte"]);
    // fechas

    date_default_timezone_set('America/Mexico_City');
    $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


    $fecha = $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') . " a las ".date("h:i a");

    $sqlreporte = "INSERT INTO reportes(reporte, nombre, fecha) VALUES('$reporte','$nombre', '$fecha')";

    $resultadoreporte = $conexion->query($sqlreporte);            

    if($resultadoreporte > 0){
        echo "<script>  window.location = 'reportes';</script>";
    }else {
        echo "<script> alert('Error al registar'); window.location = 'reportes';</script>";
    }
}

/* $verReportes = "SELECT * FROM reportes";
$resultadoVerReportes = $conexion->query($verReportes); */



$verReportes = "SELECT * FROM reportes ORDER BY idreporte DESC";
$resultadoVerReportes = $conexion->query($verReportes);



?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card bg-dark text-light">                        
                        <div class="card-body card-block">
                            <h2 class="text-light pb-4">Envio de Reportes <a href="soporte" title="Ayuda sobre el envio de reportes"><!-- <i class="fas fa-question-circle" style="color: #2C916D;"></i> --></a></h2>
                            <form action="" method="post" class="form-horizontal">
                                <div class="row form-group">                                    
                                    <div class="col-12 col-md-12">
                                    <label for="">Reporte :</label>                                    
                                        <textarea name="reporte" rows="9" placeholder="Ingresa tu reporte" class="form-control" style="resize: none;" required></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 pb-2">
                                        <button type="submit" class="btn btn-lg btn-block" style="background: #3F9A7A; color: white;"><i class="fas fa-paper-plane"></i> Enviar Reporte</button>                                        
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 pb-2">
                                        <a href="index" class="btn btn-danger btn-lg btn-block"><i class="fas fa-times"></i> Cancelar</a>
                                    </div>                                    
                                </div>                        
                            </form>                                                                                
                    </div>                    
                </div>
            </div>
        </div>



        <div class="container bg-dark">
            <h2 class="text-light pb-4 pt-3">Últimos reportes</h2>
            <div class="row">
              <?php
                    if($_SESSION['tipousuario'] == 2){
                        while($regreporte = $resultadoVerReportes->fetch_array(MYSQLI_BOTH)){
                            echo "<div class='col-sm-12 col-md-6 col-lg-6 col-xl-6'>
                                    <div class='card'>
                                        <div class='card-header'>
                                            <p>Enviado el ".$regreporte['fecha']."</p>
                                        </div>
                                        <div class='card-body'>                                                             
                                            <h3 class='pb-2'>".$regreporte['nombre']."</h3>
                                            <p>".nl2br($regreporte['reporte'])."</p>                                 
                                        </div>
                                        <div class='card-footer row'>
                                            <div class='col-sm-12 col-md-6 col-lg-6 col-xl-6'>
                                                <a href='controller/editarReporte.php?id=".$regreporte["idreporte"]."' class='btn btn-warning btn-block'> <i class='fas fa-pen'></i> Editar </a>
                                            </div>

                                            <div class='col-sm-12 col-md-6 col-lg-6 col-xl-6'>
                                                <a href='controller/eliminarReporte.php?id=".$regreporte["idreporte"]."' class='btn btn-danger btn-block'> <i class='fas fa-trash'></i> Eliminar </a>                                
                                            </div>
                                                
                                        </div>
                                    </div>
                                </div>";
                        }
                    } else if ($_SESSION['tipousuario'] == 1 || $_SESSION['tipousuario'] == 3) {
                        while($regreporte = $resultadoVerReportes->fetch_array(MYSQLI_BOTH)){
                            echo "<div class='col-sm-12 col-md-6 col-lg-6 col-xl-6'>
                                    <div class='card'>
                                        <div class='card-header'>
                                            <p>Enviado el ".$regreporte['fecha']."</p>
                                        </div>
                                        <div class='card-body'>                                                             
                                            <h3 class='pb-2'>".$regreporte['nombre']."</h3>
                                            <p>".nl2br($regreporte['reporte'])."</p>                                 
                                        </div> 
                                    </div>                                    
                                </div>";
                        }
                    } ?>
                </div>               

            </div>
        </div>

    </div>
</div>

<?php include 'layout/footer.php'; ?>

