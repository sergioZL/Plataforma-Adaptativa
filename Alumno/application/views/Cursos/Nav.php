
<!-- nav -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand text-left" href="<?php echo site_url();?>/alumno/MisCursos">
    <img class="login-img text-left" src="<?php echo base_url();?>app-assets/imagenes/logo.png" style="width: 50%; margin: 0;">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">

    <form class="form-inline my-2 my-lg-0">
        <div class="input-group">
           <input id="textBuscar" type="text" class="buscar form-control" placeholder="Buscar">
           <div class="input-group-append">
                <button id="buscar" class="bustcar btn btn-outline-info" type="button">
                    <span class="fa fa-search form-control-feedback"></span>
                </button>
           </div>
        </div>    
    </form>
        <ul class="navbar-nav offset-lg-1 offset-xl-3">
               <li class="dropdown">
                <a href="" class="btn" data-toggle="dropdown" >
                    <span class="far fa-bell fa-2x" style="color: #07ad90;" title="Notificaciones"></span>
                </a>
                <ul class="dropdown-menu">

                </ul>
            </li>
            <li class="dropdown">
                <a href="" class="btn" data-toggle="dropdown" >
                    <span class="far fa-user fa-2x" style="color: #07ad90;"  title="Perfil"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#">
                            <span class="fas fa-user-circle fa-2x" style="color: #07ad90;" title="Perfil"></span>
                            <?php 
                                echo $varsesion;
                            ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url();?>/alumno/MisCursos"> <button class="btn btn-light col-12 text-left"> <span class="far fa-folder pull-left " style="color: #07ad90;font-size: 16px;"></span><pre>  Mis cursos</pre></button></a>
                    </li>
                    <li>
                        <a href="<?php echo site_url();?>/Cursos/NuevosCursos"><button class="btn btn-light col-12 text-left"><span class="fas fa-folder-plus pull-left " style="color: #07ad90;"></span> <pre>  Nuevo curso</pre></button></a>
                    </li>
                    <li>
                        <a href=""><button class="btn btn-light col-12 text-left"><span class="fas  fa-info-circle  pull-left" style="color: #07ad90;"></span><pre>  Ayuda</pre>  </button></a>
                    </li>
                    <li>
                        <a href="../../../../CerrarSesion.php"><button class="btn btn-light col-12 text-left"> <span class=" fas fa-sign-out-alt  pull-left" style="color: #07ad90;"></span><pre>  Salir</pre></button> </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
  </div>
</nav>
