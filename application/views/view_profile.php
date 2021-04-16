<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <!--AQUI-->
            <div class="card o-hidden border-0 shadow-lg my-5">
            <?php
            if(isset($msg)){
                echo $msg;
            }
            ?>
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Datos de perfil</h1>
                                </div>
                                <form class="user" action="<?=base_url();?>Users/perfil" method="post" id="formulario" name="formulario">
                                    <div class="form-group row">
                                        <input type="hidden" id="id" name="id" value="<?php echo $_SESSION['id']?>">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre(s)" value="<?php echo $_SESSION['name']?>" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Apellido(s)" value="<?php echo $_SESSION['lastname'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Correo" value="<?php echo $_SESSION['email']?>" required>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control" id="password" name="password" placeholder="Contraseña">
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="repeatpassword" name="repeatpassword" placeholder="Repita la contraseña">
                                        </div>
                                    </div>
                                    <div class="form-group row" style="justify-content: center;">
                                        <div class="col-sm-3" >
                                            <button type="submit" class="btn btn-info btn-block">Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--AQUI-->
            <?php
            if(isset($tabla)){
                echo $tabla;
            }
            ?>
        </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; HomeWeather 2020</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>