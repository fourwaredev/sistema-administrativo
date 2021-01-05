<?php include 'layout/header.php'; ?>

<?php

    if($_SESSION['tipousuario'] == 1 || $_SESSION['tipousuario'] == 3){
        echo "<script>window.location='index';</script>";
    }

	if(!empty($_POST)){
		$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
		$usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
		$tipouser = $_POST['tipo_user'];
		$email = mysqli_real_escape_string($conexion, $_POST['email']);
		$password = mysqli_real_escape_string($conexion, $_POST['password']);        
        
		$sqluser = "SELECT idusuario FROM usuarios WHERE usuario = '$usuario'";
		$resultadouser = $conexion->query($sqluser);

		$filas = $resultadouser->num_rows;
		if ($filas > 0) {
			echo "<script> alert('El nombre de usuario ya existe'); window.location = 'usuarios';</script>";
		}else{
			$sqlempleado = "INSERT INTO personal(nombre, correo) VALUES('$nombre', '$email')";
			$resultadoempleado = $conexion->query($sqlempleado);
			$idempleado = $conexion->insert_id;

			$sqlusuario = "INSERT INTO usuarios(usuario,password,idnombre,idtipousuario) VALUES('$usuario','$password','$idempleado','$tipouser')";

			$resultadousuario = $conexion->query($sqlusuario);

			if ($resultadousuario>0) {
				echo "<script>window.location = 'usuarios';</script>"; 
			}else {
				echo "<script> alert('Error al registrar'); window.location = 'usuarios';</script>"; 
			}
		}
    }
    
    $sql = "SELECT idtipousuario, tipousuario FROM tipousuario";
	$resultado = $conexion->query($sql);

    $usuarios = "SELECT * FROM usuarios";
    $resultadousuarios = $conexion->query($usuarios);

    $verEmpleado = "SELECT * FROM personal";
    $resultadoVerEmpleado = $conexion->query($verEmpleado);


?>

<!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">                            
                            <div class="card bg-dark text-light">
                                <div class="card-body">
                                    <h2 class="text-light pb-3">Administrar Usuarios</h2>
                                    <p class="pb-2 font-weight-bold">* Completa los campos para registrar un usuario</p>
                                    <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post">
                                        <div class="form-row">
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 pb-2">
                                                <label for="">Nombre :</label>
                                                <input type="text" class="form-control" placeholder="Ingresa su nombre y apellido" name="nombre" required>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 pb-2">
                                                <label for="">Nombre de usuario :</label>
                                                <input type="text" class="form-control" placeholder="Ingresa su nombre de usuario" name="usuario" required>
                                            </div>
                                        </div>

                                        <div class="form-row pb-4">
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 pb-2">
                                                <label for="">Tipo de usuario :</label>
                                                <select name="tipo_user" class="form-control">					
                                                    <?php 
                                                        while($fila = $resultado->fetch_assoc()){	?>
                                                            <option value="<?php echo $fila['idtipousuario']; ?>"><?php echo $fila['tipousuario']; ?></option>							
                                                    <?php
                                                        }							
                                                    ?>	
                                                </select>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 pb-2">
                                                <label for="">Contraseña :</label>
                                                <input type="text" class="form-control" placeholder="Ingresa la contraseña" name="password" required>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 pb-2">
                                                <label for="">Correo :</label>
                                                <input type="text" class="form-control" placeholder="Ingresa el correo electrónico" name="email" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 pb-2">
                                                <button type="submit" class="btn btn-block btn-lg" name="guardar" style="background: #3F9A7A; color: white;"><i class="fas fa-user-plus"></i> Registrar usuario</button> 
                                            </div>                                            
                                        </div>
                                    </form>                                  
                                </div>
                            </div>                                                        
                        </div>
                    </div>   

                    <div class="container">
                        <div class="row">
                            <div class="col-12">                            
                                <table class="table table-hover table-dark" id="usuarios">
                                    <thead>                            
                                        <tr>
                                            <th>Folio</th>                                    
                                            <th>Nombre</th>
                                            <th>Usuario</th>                                        
                                            <th>Correo</th>
                                            <th>Tipo de usuario</th>     
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                        </tr>                                                                        
                                    </thead>
                                    <tbody>
                                    <?php                                     
                                        while($regusuario = $resultadousuarios->fetch_array(MYSQLI_BOTH) and $regempleado = $resultadoVerEmpleado -> fetch_array(MYSQLI_BOTH)){
                                            if ($regusuario['idtipousuario'] == 1) {
                                                $regusuario['idtipousuario'] = 'Usuario';
                                            } else if ($regusuario['idtipousuario'] == 2){
                                                $regusuario['idtipousuario'] = 'Administrador';
                                            } else if ($regusuario['idtipousuario' == 3]){
                                                $regusuario['idtipousuario'] = 'Usuario Restringido';
                                            }
                                            echo "<tr>
                                                    <td>".$regusuario['idusuario']."</td>                               
                                                    <td>".$regempleado['nombre']."</td>                               
                                                    <td>".$regusuario['usuario']."</td>
                                                    <td>".$regempleado['correo']."</td>
                                                    <td>".$regusuario['idtipousuario']."</td>
                                                    <td><a class='btn btn-warning' href='controller/editarUsuario.php?id=".$regusuario['idusuario']."'><i class='fas fa-user-edit'></i> Editar</button></a></td>
                                                    <td><a class='btn btn-danger' href='controller/eliminarUsuario.php?id=".$regusuario['idusuario']."'><i class='fas fa-user-times'></i> Eliminar</button></a></td> 
                                                </tr>"; 
                                            } ?>                                                                                                           
                                    </tbody>                            
                                </table>
                            </div>
                        </div>
                    </div> 

                </div>
            </div>
        </div>        
    </div>
</div>

<?php include 'layout/footer.php';?>    