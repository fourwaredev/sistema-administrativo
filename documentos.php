<?php include 'layout/header.php'; ?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="text-center pb-4">Descarga los formatos</h2>
                    </div>
                </div>
            </div>

            <?php                                
            
                if($_SESSION['tipousuario'] == 2){

                echo '
                    <div class="card p-4 bg-dark text-light">
                        <h3 class="text-light pb-1">Subir Archivo</h3>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 pb-2">
                                    <label for="">Nombre del archivo :</label>
                                    <input type="text" class="form-control" placeholder="Ingresa el nombre del archivo" name="nombre" required>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 pb-4">
                                    <label for="">Selecionar archivo :</label>
                                    <input type="file" class="form-control-file" name="documento" required name="archivo">
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 pb-4">
                                    <button type="submit" class="btn btn-primary" name="subir">Subir archivo</button>
                                </div>
                            </div>
                        </form>
                    </div>';

            if (isset($_POST['subir'])) {
                $nombre = $_POST['nombre'];

                date_default_timezone_set('America/Mexico_City');
                
                $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                
                $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

                $fechaDocumento = date('d'.'m'.'Y'.'H'.'i'.'s');

                # subir archivos
                $documento = $_FILES['documento']['name'];
                $rutadocumento = $_FILES['documento']['tmp_name'];
                $ruta = "docs/". $fechaDocumento . str_replace(' ', '', $documento);

                if ($documento != "") {
                    if (copy($rutadocumento, $ruta)) {
                        $subirArchivo = "INSERT INTO documentos(nombre, ruta) VALUES('$nombre', '$ruta')";
                        $resultadoArchivo = $conexion->query($subirArchivo);
                    } else {
                    echo '<script>alert("Error al subir archivo")</script>';
                    }
                } 
            }        
        }

        #Mostrar
        $verDocumentos = "SELECT * FROM documentos";
        $resultadoVerDocumentos = $conexion->query($verDocumentos);

        ?>

        <div class="row mt-3">
            <?php 
            if ($_SESSION['tipousuario'] == 2) {
                while ($filasArchivo = $resultadoVerDocumentos->fetch_array(MYSQLI_BOTH)) {            
                    echo "
                    <div class='col-sm-12 col-md-4 col-lg-4 col-xl-4'>
                        <a href='".$filasArchivo['ruta']."' target='_blank'>
                            <div class='overview-item overview-item--c1'>
                                <div class='overview__inner'>
                                    <div class='overview-box clearfix'>                                        
                                        <div class='text'>
                                            <h3 class='text-light'>".$filasArchivo['nombre']."</h3>
                                        </div>                                                       
                                    </div>
                                </div>
                            </div>
                        </a>                        
                        
                        <div class='col-12'>
                            <a href='controller/eliminar_documento.php?id=".$filasArchivo['id']."' class='btn btn-danger' name='eliminar'><i class='fas fa-times'></i> Eliminar: ".$filasArchivo['nombre']."</a>  
                        </div>
                    </div>";
                } 
            } else {
                while ($filasArchivo = $resultadoVerDocumentos->fetch_array(MYSQLI_BOTH)) {            
                    echo "
                    <div class='col-sm-12 col-md-4 col-lg-4 col-xl-4'>
                        <a href='".$filasArchivo['ruta']."' target='_blank'>
                            <div class='overview-item overview-item--c1'>
                                <div class='overview__inner'>
                                    <div class='overview-box clearfix'>                                        
                                        <div class='text'>
                                            <h3 class='text-light'>".$filasArchivo['nombre']."</h3>
                                        </div>                                                       
                                    </div>
                                </div>
                            </div>
                        </a>                                            
                    </div>";
                } 
            }
                       
            ?>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="copyright">
                    <p>Copyright © 2020 La Estrella del Centro SA de CV. Todos los Derechos Reservados.</p>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

</div>

</div>

<?php include 'layout/footer.php';?>