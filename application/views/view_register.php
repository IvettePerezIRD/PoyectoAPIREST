<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image" style="background:url(<?=base_url();?>assets/img/registro.png"></div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Cree una cuenta</h1>
                    </div>
                    <?php
                    if(isset($msg)){
                        echo $msg;
                    }
                    ?>
                    <form class="user" action="<?=base_url()?>Login/registrar" method="post" id="formulario" name="formulario">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre(s)" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Apellido(s)" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Correo" required>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="repeatpassword" name="repeatpassword" placeholder="Repita la contraseña" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Registrar cuenta</button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="<?=base_url();?>Login/loguear">¿Ya tiene una cuenta? Ingrese</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>