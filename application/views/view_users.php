<script src="<?=base_url();?>assets/js/jquery-3.4.1.min.js"></script>
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
                                    <h1 class="h4 text-gray-900 mb-4">Usuarios</h1>
                                </div>
                                <form class="user" action="" method="post" id="formulario" name="formulario">
                                    <div class="form-group row">
                                        <input type="hidden" id="id" name="id">
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
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <select class="form-control" id="type" name="type">
                                                <option value="user" selected>Usuario</option>
                                                <option value="admin">Administrador</option>
                                                <option value="disab">Deshabilitar</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="button" class="btn btn-success btn-block" onclick="enviar('agregar')">Agregar</button>
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="button" class="btn btn-info btn-block" onclick="enviar('actualizar')">Actualizar</button>
                                        </div> 
                                        <div class="col-sm-3">
                                            <button type="button" class="btn btn-danger btn-block" onclick="enviar('eliminar')">Eliminar</button>
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

<script>
    function enviar(valor){
        switch(valor){
            case "agregar":
                document.formulario.action="<?=base_url()?>Users/agregar";
                document.formulario.submit();
                break;
            case "actualizar":
                document.formulario.action="<?=base_url()?>Users/actualizar";
                document.formulario.submit();
                break;
            case 'eliminar':
                document.formulario.action="<?=base_url()?>Users/eliminar";
                document.formulario.submit();
                break;
        }
    }
</script>

<script>
    $(function () {
        $('#users tr>*').click(function (e) {
            var id = $(this).parents("tr").find("td")[0].innerHTML;
            $('#id').val(id);
            var name = $(this).parents("tr").find("td")[1].innerHTML;
            $('#name').val(name);
            var lastname = $(this).parents("tr").find("td")[2].innerHTML;
            $('#lastname').val(lastname);
            var email = $(this).parents("tr").find("td")[3].innerHTML;
            $('#email').val(email);
            /*var password = $(this).parents("tr").find("td")[4].innerHTML;
            $('#password').val(password);
            $('#repeatpassword').val(password);*/
            var type = $(this).parents("tr").find("td")[5].innerHTML;
            $('#type').val(type);
        });
    });
</script>