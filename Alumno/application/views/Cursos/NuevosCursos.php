<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nuevos Cursos</title>
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/diseño.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/bootstrap.css"/>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">    
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>       
    <style>
        a:link {
            text-decoration: none;
        }

        a {
           color: black;
        }
    </style>

</head>
<body>


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
           <input type="search" class="buscar form-control" placeholder="Buscar">
           <div class="input-group-append">
                <button class="bustcar btn btn-outline-info" type="button">
                    <span class="fa fa-search form-control-feedback"></span>
                </button>
           </div>
        </div>    
    </form>
        <ul class="navbar-nav offset-lg-1 offset-xl-3">
            <!--<li class="nav-item">
                <a class="nav-link" style="color: #07ad90;" href="<?php echo site_url();?>/Cursos/NuevosCursos">Nuevos cursos</a>
            </li>-->
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
                        <button class="btn btn-light col-12 text-left"> <a href="<?php echo site_url();?>/alumno/MisCursos"> <span class="far fa-folder pull-left " style="color: #07ad90;font-size: 16px;"></span><pre>  Mis cursos</pre></a></button>
                    </li>
                    <li>
                         <button class="btn btn-light col-12 text-left"> <a href="<?php echo site_url();?>/Cursos/NuevosCursos"><span class="fas fa-folder-plus pull-left " style="color: #07ad90;"></span> <pre>  Nuevo curso</pre>   </a> </button>
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
  </div>
</nav>

<h3>Cursos Recomendados</h3>

    <div class="ContenedorCursos">
        <?php
      
        $Con = mysqli_connect('localhost','root','','plataforma');
    	$consulta = "SELECT * FROM `Cursos`;";
    
    	$rs = $Con->query($consulta);
        while($row = $rs ->fetch_assoc())
        {
        
        ?>

        <a href="Preview?curso=<?php echo $row['clave'] ?>">
        <div class="card" style="width: 250px; height:400px; margin-left: 20px;">
            <div class="Img">
                <img class="card-img-top" style="width: 250px; height:250px;" id="IMGCurso" src="data:image/jpg;base64,<?php echo ($row['foto']); ?>" alt="Card image cap">
            </div>
            <div class="card-body ">
                <h5 class="card-title text-center"><?php echo $row['nombre']?></h5>
                <p class="card-text text-center"><?php echo $row['descripcion']?></p>
            </div>
        </div>
        </a>

        <?php
        }
	
        ?>
    </div>

    <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/myjs.js"></script>
</body>
</html>