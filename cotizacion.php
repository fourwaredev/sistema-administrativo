<?php include 'layout/header.php'; ?>

<?php
    $consultaTotal = "SELECT idpersonal, SUM(importe) AS TotalPrecios FROM cotizacion WHERE idpersonal = '$idusuario'";

    $resultadoTotal=$conexion->query($consultaTotal);
    $fila=$resultadoTotal->fetch_assoc();

    $total=$fila['TotalPrecios'];

    if(!empty($_POST)){  
        $descripcion = mysqli_real_escape_string($conexion, $_POST["descripcion"]);
        $unidades = mysqli_real_escape_string($conexion, $_POST["unidades"]);
        $cantidad = mysqli_real_escape_string($conexion, $_POST["cantidad"]);
        $precio = mysqli_real_escape_string($conexion, $_POST["precio"]);
        $importe = ($cantidad * $precio);


        $sqlcotizacion = "INSERT INTO cotizacion(descripcion, cantidad, unidades, precio, importe, idpersonal) VALUES('$descripcion','$cantidad','$unidades','$precio', '$importe', '$idusuario')";

        $resultadocotizacion = $conexion->query($sqlcotizacion);

        if ($resultadocotizacion > 0) {
            echo "<script> window.location='cotizacion.php'; </script>";
        } else {
            echo "<script> alert('Error al registrar'); </script>";
        }

    }

        $cotizacion = "SELECT u.idusuario, m.idclave, m.descripcion, m.cantidad, m.unidades, m.precio, m.importe FROM usuarios AS u INNER JOIN cotizacion AS m ON u.idusuario = m.idpersonal WHERE u.idusuario = '$idusuario'";
        $resultadocotizacion = $conexion->query($cotizacion);

?>

    <div class="main-content">
        <div class="section__content section__content--p30">

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">                                               
                        <div class="card bg-dark" style="border-radius: 10px">
                            <div class="card-body">

                                <h1 class="pb-3 text-light">Cotización</h1> 
                                <p class="pb-2 text-light font-weight-bold">* Llena el formulario con los productos a cotizar</p>

                                <form class="text-light" action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">

                                    <div class="form-row pb-2">
                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 pb-2">
                                            <label for="">Producto: </label>
                                            <input type="text" class="form-control" placeholder="Ingresa el producto" name="descripcion" required>
                                        </div>

                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 pb-2">
                                            <label for="">Cantidad: </label>
                                            <input type="number" class="form-control" placeholder="Ingresa la cantidad" name="cantidad" required step="any"> 
                                        </div>

                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                            <label for="">Unidades: </label>
                                            <select class="form-control" name="unidades">
                                                <option value="unidades"> Unidades</option>
                                                <option value="piezas"> Piezas</option>
                                                <option value="metros"> Metros</option>
                                                <option value="kilogramos"> Kilogramos</option>
                                                <option value="toneladas"> Toneladas</option>
                                            </select>
                                        </div>

                                    </div>                                    

                                    <div class="form-row pb-3">
                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                            <label for="">Precio: </label>
                                            <input type="number" class="form-control" placeholder="Ingresa el precio" name="precio" required step="any">
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 pb-1">
                                            <button type="submit" class="btn mb-2 btn-lg btn-block btn-success" name="guardar" id="btnsuma"><i class="fas fa-plus-square"></i> Registrar</button>                                            
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 pb-1">
                                            <a href="pdf.php" target="_blank" class="btn mb-2 btn-lg btn-block btn-primary" name="generar" target="_blank"><i class="fas fa-print"></i> Generar PDF</a>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-xl-12 col-sm-12 col-12">                            
                        <table class="table table-hover table-dark" id="cotizacion">

                            <thead class="thead-dark">                            
                                <tr>                                    
                                    <th>Productos</th>
                                    <th>Cantidad</th>                                        
                                    <th>Precio</th>
                                    <th>Importe</th>                                
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>                                                                        
                            </thead>

                            <tbody>
                                <?php                                     
                                    while ($regcotizacion = $resultadocotizacion->fetch_array(MYSQLI_BOTH)) {
                                        echo "<tr>                                            
                                                <td>".$regcotizacion['descripcion']."</td>
                                                <td>".$regcotizacion['cantidad']. " " . $regcotizacion['unidades']."</td>
                                                <td> $".$regcotizacion['precio']." MXN</td>
                                                <td> $".$regcotizacion['importe']." MXN</td>
                                                <td><a class='btn btn-warning' href='controller/editar_cotizacion.php?id=".$regcotizacion['idclave']."'><i class='fas fa-edit'></i> Editar</a></td>
                                                <td><a  class='btn btn-danger' href='controller/eliminar_cotizacion.php?id=".$regcotizacion['idclave']."'><i class='fas fa-trash'></i> Eliminar</a></td>
                                            </tr>"; ?>        
                                    <?php } ?>                                    

                            </tbody>

                            <tfoot class="">
                                <tr>
                                    <td style="font-size:20px" class="font-weight-bold" colspan=7>
                                        <?php if ($total > 0) {
                                                echo 'Total: $'.$total.' MXN';
                                             } else {
                                                echo 'Aqui se mostrarán los resultados';
                                            } ?>
                                    </td>                                    
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>    

        </div>
    </div>



<?php include 'layout/footer.php'; ?>

