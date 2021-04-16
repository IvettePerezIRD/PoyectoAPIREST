<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background:url(<?=base_url();?>assets/img/login.jpg"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">NUEVA CONTRASEÑA</h1>
                            </div>
                            <?php
                            if(isset($msg)){
                                echo $msg;
                            }
                            ?>
                            <form class="user" action="<?=base_url();?>Login/enviar" method="post" id="formulario" name="formulario">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="hash" name="hash" value="<?php echo $_GET["hash"]?>">
                                    <input type="hidden" class="form-control" id="email" name="email" value="<?php echo $_GET["email"]?>">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="repeatpassword" name="repeatpassword" placeholder="Repita la contraseña" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">CONFIRMAR</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>