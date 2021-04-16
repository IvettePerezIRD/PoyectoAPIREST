<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background:url(<?=base_url();?>assets/img/login.jpg"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">RECUPERAR CONTRASEÑA</h1>
                            </div>
                            <?php
                            if(isset($msg)){
                                echo $msg;
                            }
                            ?>
                            <form class="user" action="<?=base_url();?>Login/correo" method="post" id="formulario" name="formulario">
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Correo" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Enviar correo</button>
                            </form>
                            <br>
                            <div class="text-center">
                                <a class="small" href="<?=base_url();?>Login/loguear">¿Ya tiene una cuenta? Ingrese</a>
                            </div>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?=base_url();?>Login/registrar">¿No tiene una cuenta? Creela</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>