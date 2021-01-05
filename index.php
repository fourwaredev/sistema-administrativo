<?php include 'layout/header.php'; ?>

<!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="overview-wrap">
                                <h2 class="text-center">Perfil de <?php echo $nombre; ?></h2>                                    
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                            <a href="proveedores">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-handshake"></i>
                                            </div>
                                            <div class="text">
                                                <h1>Proveedores</h1>
                                            </div>                                         
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                            <a href="reportes">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-clipboard-list"></i>
                                            </div>
                                            <div class="text">
                                                <h1>Reportes</h1>
                                            </div>                                      
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                            <a href="documentos">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-copy"></i>
                                            </div> 
                                            <div class="text">
                                                <h1>Formatos</h1>
                                            </div>                                           
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <?php 
                        
                            if($_SESSION['tipousuario'] == 2){
                                echo '<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                <a href="usuarios">
                                    <div class="overview-item overview-item--c1">
                                        <div class="overview__inner">
                                            <div class="overview-box clearfix">
                                                <div class="icon">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                                <div class="text">
                                                    <h1>Usuarios</h1>
                                                </div>                                           
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>';
                            } else {
                                echo '<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                <a href="perfil">
                                    <div class="overview-item overview-item--c1">
                                        <div class="overview__inner">
                                            <div class="overview-box clearfix">
                                                <div class="icon">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                                <div class="text">
                                                    <h1>Perfil</h1>
                                                </div>                                           
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>';
                            }
                        
                        ?>
                        
<!-- 
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                            <a href="soporte">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-question-circle"></i>
                                            </div>
                                            <div class="text">
                                                <h1>Soporte</h1>
                                            </div>                                                                                  
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div> -->                        

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
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

</div>

<?php include 'layout/footer.php';?>    