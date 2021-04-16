<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <?php
                            if(isset($msg)){
                                echo $msg;
                            }
                            ?>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?=base_url();?>Login/loguear">Iniciar sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>