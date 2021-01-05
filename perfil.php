<?php include 'layout/header.php'; ?>

<?php 

if (isset($_POST['guardar'])) {   
   
    $nombre = mysqli_real_escape_string($conexion, $_POST["nombre"]);
    $producto = mysqli_real_escape_string($conexion, $_POST["producto"]);

    $estado = 'En revisión';

    // fechas

    date_default_timezone_set('America/Mexico_City');
    $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

    $fechaArchivo = date('d'.'m'.'Y'.'H'.'i'.'s');

    $fecha = $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') . " a las ".date("h:i:s a");

    

    $verProveedores = "SELECT idproveedor, nombre, proveedor, productos, estado, fecha FROM proveedores WHERE proveedor = '$nombre'";

    $existeProveedor = $conexion->query($verProveedores);
    $filas = $existeProveedor->num_rows;

    

         // subir archivos pdf

   $nombreArchivo = $_FILES['cotizacion']['name'];
   $tipoArchivo = $_FILES['cotizacion']['type'];
   $sizeArchivo = $_FILES['cotizacion']['size'];
   $rutaArchivo = $_FILES['cotizacion']['tmp_name'];
   $nombreCotizacion = $fechaArchivo."_".$usuario."_".$nombreArchivo;
   $destino = "documents/".$nombreCotizacion;

   

   if($nombreArchivo != "" && $sizeArchivo <= 5500000) {
       if(copy($rutaArchivo, $destino)){
            $insertarProveedor = "INSERT INTO proveedores(nombre, proveedor, productos, estado, archivo, ruta,fecha) VALUES('$usuario','$nombre','$producto', '$estado','$nombreCotizacion','$destino', '$fecha')";
            $resultadoProveedor = $conexion->query($insertarProveedor); 
       } else {
           echo 'Posibles errores al subir tu archivo: El archivo no tiene nombre, el archivo es demasiado pesado o no incluiste un archivo permitido';
       }
   }
                    
        if($resultadoProveedor > 0){
            echo "<script>  window.location = 'proveedores';</script>";
        }else {
            echo "<script> alert('Error al registar'); window.location = 'proveedores';</script>";
        }
    }

    /* 
    } */

    // mostrar los resultados de la base de datos

    if($_SESSION['tipousuario'] == 2) {
        $tablaProveedores = "SELECT * FROM proveedores WHERE nombre = '$usuario'";
        $resultadoProveedor = $conexion->query($tablaProveedores);
    } else if ($_SESSION['tipousuario'] == 1) {
        $tablaProveedores = "SELECT * FROM proveedores WHERE nombre = '$usuario'";
        $resultadoProveedor = $conexion->query($tablaProveedores);
    } else if ($_SESSION['tipousuario'] == 3) {
        $tablaProveedores = "SELECT * FROM proveedores WHERE nombre = '$usuario'";
        $resultadoProveedor = $conexion->query($tablaProveedores);
    }
    

    

?>

    <div class="main-content">
        <div class="section__content section__content--p30">                
            <div class="container">
                <div class="row">
                    <div class="col-12">  
                        <h2 class="pb-3">Mis proveedores</h2>                          
                        <table class="table table-hover table-dark" id="misproveedores">
                            <thead class="thead-dark">
                                <?php
                                    if($_SESSION['tipousuario'] == 2){
                                        echo "<tr>
                                            <th>Folio</th>
                                            <th>Nombre</th>
                                            <th>Proveedor</th>
                                            <th>Producto</th>
                                            <th>Fecha</th>  
                                            <th>Estado</th>
                                            <th>Archivo</th>                                
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                        </tr>";
                                        } else {
                                            echo "<tr>
                                            <th>Folio</th>
                                            <th>Nombre</th>
                                            <th>Proveedor</th>
                                            <th>Producto</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                        </tr>";
                                        }                                             
                                    ?>

                                </thead>
                                <tbody>
                                    <?php 
                                        if($_SESSION['tipousuario'] == 2){                                            
                                            while($filasProveedor = $resultadoProveedor->fetch_array(MYSQLI_BOTH)){

                                                // color de los estados

                                                switch ($filasProveedor['estado']) {
                                                    case 'En revisión':
                                                        $color = '#FFC107';
                                                    break;
                                                    
                                                    case 'Cancelado':
                                                        $color = '#DC3545';
                                                    break;
            
                                                    case 'Aprobado':
                                                        $color = '#28A745';
                                                    break;
            
                                                    default:
                                                        $color = '#FFC107';
                                                        break;
                                                }

                                                echo "<tr>
                                                    <td>".$filasProveedor['idproveedor']."</td>
                                                    
                                                    <td>".$filasProveedor['nombre']."</td>

                                                    <td>".$filasProveedor['proveedor']."</td>

                                                    <td>".$filasProveedor['productos']."</td>

                                                    <td>".$filasProveedor['fecha']."</td>

                                                    <td style='color: ".$color."'>".$filasProveedor['estado']."</td>

                                                    <td><a href='".$filasProveedor['ruta']."' target='_blank'><i class='far fa-file-alt'></i> Archivo Adjunto</a></td>
                                                    
                                                    <td><a href='controller/Editarproveedor.php?id=".$filasProveedor["idproveedor"]."'><button class='btn btn-warning btn-block'><i class='fas fa-edit'> Editar</i></button></a></td>
                                                    
                                                    <td><a href='controller/eliminarproveedor.php?id=".$filasProveedor["idproveedor"]."'><button class='btn btn-danger btn-block'>
                                                    <i class='fas fa-trash'></i> Eliminar</button></a></td>
                                                </tr>";
                                            }                                                                                   
                                        } else {
                                            while($filasProveedor = $resultadoProveedor->fetch_array(MYSQLI_BOTH)){

                                                switch ($filasProveedor['estado']) {
                                                    case 'En revisión':
                                                        $color = '#FFC107';
                                                    break;
                                                    
                                                    case 'Cancelado':
                                                        $color = '#DC3545';
                                                    break;
            
                                                    case 'Aprobado':
                                                        $color = '#28A745';
                                                    break;
            
                                                    default:
                                                        $color = '#FFC107';
                                                        break;
                                                }

                                                echo "<tr>
                                                    <td>".$filasProveedor['idproveedor']."</td>
                                                    <td>".$filasProveedor['nombre']."</td>
                                                    <td>".$filasProveedor['proveedor']."</td>
                                                    <td>".$filasProveedor['productos']."</td>
                                                    <td>".$filasProveedor['fecha']."</td>                     
                                                    <td style='color: ".$color."'>".$filasProveedor['estado']."</td>
                                                </tr>";
                                            }
                                        }                                                   
                                    ?>
                                </tbody>
                            </table>                        
                        </div>
                    </div>
                </div>

                <div class="container">
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

<?php include 'layout/footer.php';?>    