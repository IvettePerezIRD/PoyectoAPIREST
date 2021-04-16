<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>HomeWeather</title>
        <link rel="shortcut icon" href="<?=base_url();?>assets/img/logo.png"/>
        <link href="<?=base_url();?>assets/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="<?=base_url();?>assets/js/jquery-3.4.1.min.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <!--Navbar-->
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="<?=base_url();?>Dashboard">HomeWeather</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></form>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?=base_url();?>Dashboard/perfil">Perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?=base_url();?>Login/cerrar">Salir</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!--Navbar-->
        <!--Navbar horizontal-->
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Nucleo</div>
                            <a class="nav-link" href="<?=base_url();?>Dashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Panel
                            </a>
                            <a class="nav-link" href="<?=base_url();?>Dashboard/graficas">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Gráficos
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logueado como:</div>
                        <?php echo $_SESSION['name']." ".$_SESSION['lastname'];?>
                    </div>
                </nav>
            </div>
            <!--Navbar horizontal-->
            <!--Contenido-->
            <?php $this->load->view($content);?>
            <!--Contenido-->
        </div>
        <script src="<?=base_url();?>assets/js/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?=base_url();?>assets/js/scripts.js"></script>
    </body>
</html>