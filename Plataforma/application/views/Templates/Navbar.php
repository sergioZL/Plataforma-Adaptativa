<div id="mySidenav" class="elsidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="row ">
        <div class="row col-12">
            <div class="col-3">
                    <a href="/../Login.html"> <span class="fas fa-user-circle fa-5x" style="color: #66ccff;"></span></a>
            </div>
            <div class="col-9 text-left" style="color: #1381b8;">
                    <h4>Nombre de usuario</h4>
                    <h5>correo electronico</h5>
            </div>
        </div>
        <hr>
        <hr>
        <button class="btn btn-light col-12 text-left"> <a href="<?php echo site_url();?>/alumno/MisCursos"><span class="far fa-folder fa-2x pull-left offset-4" style="color: white;"></span> <h4>Mis cursos </h4></a></button>
        <button class="btn btn-light col-12 text-left"> <a href="Cursos.php"><span class="fas fa-folder-plus fa-2x pull-left offset-4" style="color: white;"></span> <h4>Nuevo curso </h4> </a> </button>
        <button class="btn btn-light col-12 text-left"> <a href=""><span class="fas fa-bell fa-2x pull-left offset-4" style="color: white;"></span> <h4>Notificación </h4></a></button>
        <button class="btn btn-light col-12 text-left"> <a href=""><span class="fas  fa-info-circle fa-2x pull-left offset-4" style="color: white;"></span> <h4>Ayuda </h4></a></button>
        <button class="btn btn-light col-12 text-left"> <a href="CerrarSesion.php"><span class="fas fas fa-sign-out-alt fa-2x pull-left offset-4" style="color: white;"></span> <h4>Salir </h4></a></button>
    </div>
</div>

<div class="shadow rounded">
 <nav class="navbar navbar-expand-lg navbar-light bg-light" >
         <button class="navbar-toggler" type="button" data-toggle="collapse" onclick="openNav()" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon" style="color:white;"></span>
         </button>
         <a class="navbar-brand" href="<?php echo site_url();?>/alumno/MisCursos">
             <img class="login-img text-left" src="<?php echo base_url();?>app-assets/imagenes/logo.png" style="width: 50%; margin: 0;">
         </a>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
           <form class="form-inline my-2 my-lg-0">
             <div class="input-group">
               <input type="search" class="buscar form-control" placeholder="Buscar">
               <div class="input-group-append">
                 <button class="bustcar btn btn-outline-info" type="button">
                   <span class="fa fa-search form-control-feedback"></span>
                 </button>
               </div>
           </div>
           </form>
           <ul class="navbar-nav offset-lg-1 offset-xl-3">
             <li class="nav-item">
                <a class="nav-link" style="color: #07ad90;" href="Cursos.php">Nuevos cursos</a>
             </li>
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
                                Nombre de usuario
                           </a>
                       </li>
                       <li>
                           <button class="btn btn-light col-12 text-left"> <a href="MisCursos.php"> <span class="far fa-folder pull-left " style="color: #07ad90;font-size: 16px;"></span><pre>  Mis cursos</pre></a></button>
                       </li>
                       <li>
                            <button class="btn btn-light col-12 text-left"> <a href="Cursos.php"><span class="fas fa-folder-plus pull-left " style="color: #07ad90;"></span> <pre>  Nuevo curso</pre>   </a> </button>
                       </li>
                       <li>
                           <button class="btn btn-light col-12 text-left"> <a href=""><span class="fas  fa-info-circle  pull-left" style="color: #07ad90;"></span><pre>  Ayuda</pre>  </a></button>
                       </li>
                       <li>
                           <button class="btn btn-light col-12 text-left"> <a href="CerrarSesion.php"><span class=" fas fa-sign-out-alt  pull-left" style="color: #07ad90;"></span><pre>  Salir</pre>  </a></button>
                       </li>
                   </ul>
               </li>
           </ul>
       </div>
  </nav>
</div>
