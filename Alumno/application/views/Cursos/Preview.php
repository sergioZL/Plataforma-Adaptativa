<?php
    $curso = $_GET['curso'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- ARCHIVO BOOTSTRAP 4 CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/bootstrap.min.css">
    <!--Estilos personalizados-->
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/estilos.css">   
    <!--Iconos-->
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'> 
    <title>preview</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">    
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>          
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
      <?php
      $Con = mysqli_connect('localhost','root','','plataforma');
      $consulta = "SELECT * FROM `Cursos` WHERE clave = '$curso'";
      $rs = $Con->query($consulta);
      if($row = $rs ->fetch_assoc())
      ?>
    <section class="seccion-superior py-4 mt-5 ">     
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-6">
                <div class="card">
                    <img class="card-img-top h-100" style="min-height: 250px;"  src="data:image/jpg;base64,<?php echo $row['foto']; ?>" alt="Proyecto 1" style="width: 100%; /*252px; height: 447px;*/">
                    <div class="card-body">
                      <h5 class="card-title  text-center">Este curso contiene</h5>
                      <p class="card-text">
                            <i class='far fa-file-video fa-2x'></i> 10 videos acerca de los temas tratados en las lecciones <br>
                            <i class='far fa-file-audio fa-2x'></i> 10 audios acerca de los temas tratados en las lecciones <br>
                            <i class='far fa-file-pdf fa-2x'></i> 10 documentos pdf acerca de los temas tratados en las lecciones <br>
                            <i class='far fa-check-square fa-2x'></i> una evaluacion por cada una de las lecciones tomadas en el curso <br>
                      </p>
                      <a href="Pregunta?curso=<?php echo $curso ?>" class="btn btn-primary btn-superior">!Inscribete!</a>
                    </div>
                  </div>
            </div>
            <div class="col-12 col-md-6 text-center text-md-left align-self-md-center text-white ">
              <h1 class="display-4 font-weight-bold text-primary"><?php echo $row['nombre']; ?></h1> 
              <p><?php echo $row['descripcion']; ?></p> 
              <p>Creado por: Autor del curso <br> fecha de ultima actualización dom: 10 de febrero</p>
              <a href="#descripciones" class="btn btn-primary btn-lg btn-superior">Leér más</a> 
            </div>
          </div>
        </div>
      </section>

      <div class="container">
          <!--Esta seccion servira para agregar descripciones hacerca del conosimiento que el usuario obtendra-->
            <div class="card py-4 ">
              <div id="descripciones" class="card-body row" >
                  <h4 class="card-title col-12">Lo que aprenderas</h4>
                  <div class="col-md-6">
                        <i class='fas fa-check'></i> <span> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vitae saepe dolorem dolorum ratione nobis distinctio, nisi cupiditate,</span><br><br>
                  </div>
                  <div class="col-md-6">
                        <i class='fas fa-check'></i> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vitae saepe dolorem dolorum ratione nobis distinctio, nisi cupiditate,<br><br>
                  </div>
                  <div class="col-md-6">
                        <i class='fas fa-check'></i> <span> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vitae saepe dolorem dolorum ratione nobis distinctio, nisi cupiditate,</span><br><br>
                  </div>
                  <div class="col-md-6">
                        <i class='fas fa-check'></i> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vitae saepe dolorem dolorum ratione nobis distinctio, nisi cupiditate, Lorem ipsum dolor sit, amet consectetur adipisicing elit. Numquam esse odio vitae, soluta repellat voluptas maiores odit corrupti ullam labore accusamus eaque ipsa cumque quasi eveniet error officia aspernatur omnis! <br><br>
                  </div>
                  <div class="col-md-6">
                        <i class='fas fa-check'></i> <span> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vitae saepe dolorem dolorum ratione nobis distinctio, nisi cupiditate,</span><br><br>
                  </div>
                  <div class="col-md-6">
                        <i class='fas fa-check'></i> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vitae saepe dolorem dolorum ratione nobis distinctio, nisi cupiditate,<br><br>
                  </div>
                  <div class="col-md-6">
                        <i class='fas fa-check'></i> <span> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vitae saepe dolorem dolorum ratione nobis distinctio, nisi cupiditate,</span><br><br>
                  </div>
                  <div class="col-md-6">
                        <i class='fas fa-check'></i> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vitae saepe dolorem dolorum ratione nobis distinctio, nisi cupiditate,<br><br>
                  </div>
              </div>
            </div>
        <!--Contenido del curso-->
        <br>
        <div class="contenido">
            <h4>Contenido del curso</h4>
             









            <div id="main" class="row">
                <!--Menu desplegable-->
                <div id="accordion" role="tablist" aria-multiselectable="true" class="container t-2 pt-5 col-md-11">
                    <!--Leccion uno-->
                    <div class="card leccion shadow-sm mb-3 rounded-0">
                        <h5 class="card-header">
                            <!--Cabecera del menu desplegable-->
                            <a data-toggle="collapse" href="#contenidoUno" aria-expanded="true" aria-controls="contenidoUno"
                                id="leccionUno" class="d-block">
                                <i class="fa fa-chevron-down pull-right"></i>
                                Leccion #1
                            </a>
                        </h5>
                        <div id="contenidoUno" class="collapse" aria-labelledby="leccionUno">
                            <!--Contenido del menu desplegable-->
                            <div class="card-body">
                                <h6>Este es el contenido de la leccion</h6>
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim nesciunt
                                    debitis labore quae vero. Labore deleniti, maiores veritatis sapiente reiciendis
                                    possimus.Ratione enim dignissimos facilis. Magnam id molestias aspernatur dolor.</p>
                            </div>
                            <!--Tema-->
                            <div class="card rounded-0">
                                <h5 class="card-header">
                                    <a data-toggle="collapse" href="#contenidoUno-temaUno" aria-expanded="true"
                                        aria-controls="contenidoUno-temaUno" id="leccionUno-temaUno" class="d-block">
                                        <i class="fa fa-chevron-down pull-right"></i>
                                        Tema #1
                                    </a>
                                </h5>
                                <div id="contenidoUno-temaUno" class="collapse" aria-labelledby="leccionUno-temaUno">
                                    <div class="card-body">
                                        <h6>Este es el contenido del Tema</h6>
                                        <a href=""><span class="fas fa-play-circle"></span> video sobre algun tema</a><br>
                                        <a href=""><span class="fas as fa-file-audio"></span> video sobre algun tema</a><br>
                                        <a href=""><span class="fas far fa-file-pdf"></span> video sobre algun tema</a><br>
                                    </div>
                                </div>
                            </div>
                            <!--Tema-->
                            <div class="card rounded-0">
                                <h5 class="card-header">
                                    <a data-toggle="collapse" href="#contenidoUno-temaDos" aria-expanded="true"
                                        aria-controls="contenidoUno-temaDos" id="leccionUno-temaDos" class="d-block">
                                        <i class="fa fa-chevron-down pull-right"></i>
                                        Tema #2
                                    </a>
                                </h5>
                                <div id="contenidoUno-temaDos" class="collapse" aria-labelledby="leccionUno-temaDos">
                                <div class="card-body">
                                        <h6>Este es el contenido del Tema</h6>
                                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim nesciunt
                                            debitis labore quae vero. Labore deleniti, maiores veritatis sapiente reiciendis
                                            possimus.Ratione enim dignissimos facilis. Magnam id molestias aspernatur dolor.</p>
                                    </div>
                                </div>
                            </div>
                            <!--Tema-->
                            <div class="card rounded-0">
                                <h5 class="card-header">
                                    <a data-toggle="collapse" href="#contenidoUno-temaTres" aria-expanded="true"
                                        aria-controls="contenidoUno-temaTres" id="leccionUno-temaTres" class="d-block">
                                        <i class="fa fa-chevron-down pull-right"></i>
                                        Tema #3
                                    </a>
                                </h5>
                                <div id="contenidoUno-temaTres" class="collapse" aria-labelledby="leccionUno-temaTres">
                                    <div class="card-body">
                                        <h6>Este es el contenido del Tema</h6>
                                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim nesciunt
                                            debitis labore quae vero. Labore deleniti, maiores veritatis sapiente reiciendis
                                            possimus.Ratione enim dignissimos facilis. Magnam id molestias aspernatur dolor.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Leccion Dos-->
                    <div class="card leccion shadow-sm mb-3 rounded-0">
                        <h5 class="card-header">
                            <!--Cabecera del menu desplegable-->
                            <a data-toggle="collapse" href="#contenidoDos" aria-expanded="true" aria-controls="contenidoDos"
                            id="leccionDos" class="d-block">
                                <i class="fa fa-chevron-down pull-right"></i>
                                Leccion #2
                            </a>
                        </h5>
                        <div id="contenidoDos" class="collapse" aria-labelledby="leccionDos">
                            <!--Contenido del menu desplegable-->
                            <div class="card-body">
                                <h6>Este es el contenido de la leccion</h6>
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim nesciunt
                                    debitis labore quae vero. Labore deleniti, maiores veritatis sapiente reiciendis
                                    possimus.Ratione enim dignissimos facilis. Magnam id molestias aspernatur dolor.</p>
                            </div>
                            <!--Tema-->
                            <div class="card rounded-0">
                            <h5 class="card-header">
                                    <a data-toggle="collapse" href="#contenidoDos-temaUno" aria-expanded="true"
                                        aria-controls="contenidoDos-temaUno" id="leccionDos-temaUno" class="d-block">
                                        <i class="fa fa-chevron-down pull-right"></i>
                                        Tema #1
                                    </a>
                                </h5>
                                <div id="contenidoDos-temaUno" class="collapse" aria-labelledby="leccionDos-temaUno">
                                    <div class="card-body">
                                        <h6>Este es el contenido del Tema</h6>
                                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim nesciunt
                                            debitis labore quae vero. Labore deleniti, maiores veritatis sapiente reiciendis
                                            possimus.Ratione enim dignissimos facilis. Magnam id molestias aspernatur dolor.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-0">
                                <h5 class="card-header">
                                    <a data-toggle="collapse" href="#contenidoTres-temaDos" aria-expanded="true"
                                        aria-controls="contenidoTres-temaDos" id="leccionTres-temaDos" class="d-block">
                                        <i class="fa fa-chevron-down pull-right"></i>
                                        Tema #2
                                    </a>
                                </h5>
                                <div id="contenidoTres-temaDos" class="collapse" aria-labelledby="leccionTres-temaDos">
                                    <div class="card-body">
                                        <h6>Este es el contenido del Tema</h6>
                                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim nesciunt
                                            debitis labore quae vero. Labore deleniti, maiores veritatis sapiente reiciendis
                                            possimus.Ratione enim dignissimos facilis. Magnam id molestias aspernatur dolor.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-0">
                                <h5 class="card-header">
                                    <a data-toggle="collapse" href="#contenidoDos-temaTres" aria-expanded="true"
                                        aria-controls="contenidoDos-temaTres" id="leccionDos-temaTres" class="d-block">
                                        <i class="fa fa-chevron-down pull-right"></i>
                                        Tema #3
                                    </a>
                                </h5>
                                <div id="contenidoDos-temaTres" class="collapse" aria-labelledby="leccionDos-temaTres">
                                    <div class="card-body">
                                        <h6>Este es el contenido del Tema</h6>
                                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim nesciunt
                                            debitis labore quae vero. Labore deleniti, maiores veritatis sapiente reiciendis
                                            possimus.Ratione enim dignissimos facilis. Magnam id molestias aspernatur dolor.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Leccion tres-->
                    <div class="card leccion shadow-lg mb-3 rounded-0">
                        <h5 class="card-header">
                            <!--Cabecera del menu desplegable-->
                            <a data-toggle="collapse" href="#contenidoTres" aria-expanded="true" aria-controls="contenidoTres"
                                id="leccionTres" class="d-block">
                                <i class="fa fa-chevron-down pull-right"></i>
                                Leccion #3
                            </a>
                        </h5>
                        <div id="contenidoTres" class="collapse" aria-labelledby="leccionTres">
                            <!--Contenido del menu desplegable-->
                            <div class="card-body">
                                <h6>Este es el contenido de la leccion</h6>
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim nesciunt
                                    debitis labore quae vero. Labore deleniti, maiores veritatis sapiente reiciendis
                                    possimus.Ratione enim dignissimos facilis. Magnam id molestias aspernatur dolor.</p>
                            </div>
                            <!--Tema-->
                            <div class="card rounded-0">
                                <h5 class="card-header">
                                    <a data-toggle="collapse" href="#contenidoTres-temaUno" aria-expanded="true"
                                        aria-controls="contenidoTres-temaUno" id="leccionTres-temaUno" class="d-block">
                                        <i class="fa fa-chevron-down pull-right"></i>
                                        Tema #1
                                    </a>
                                </h5>
                                <div id="contenidoTres-temaUno" class="collapse" aria-labelledby="leccionTres-temaUno">
                                    <div class="card-body">
                                        <h6>Este es el contenido del Tema</h6>
                                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim nesciunt
                                            debitis labore quae vero. Labore deleniti, maiores veritatis sapiente reiciendis
                                            possimus.Ratione enim dignissimos facilis. Magnam id molestias aspernatur dolor.</p>
                                    </div>
                                </div>
                            </div>
                            <!--Tema-->
                            <div class="card rounded-0">
                                <h5 class="card-header">
                                    <a data-toggle="collapse" href="#contenidoTres-temaDos" aria-expanded="true"
                                        aria-controls="contenidoTres-temaDos" id="leccionTres-temaDos" class="d-block">
                                        <i class="fa fa-chevron-down pull-right"></i>
                                        Tema #2
                                    </a>
                                </h5>
                                <div id="contenidoTres-temaDos" class="collapse" aria-labelledby="leccionTres-temaDos">
                                    <div class="card-body">
                                        <h6>Este es el contenido del Tema</h6>
                                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim nesciunt
                                            debitis labore quae vero. Labore deleniti, maiores veritatis sapiente reiciendis
                                            possimus.Ratione enim dignissimos facilis. Magnam id molestias aspernatur dolor.</p>
                                    </div>
                                </div>
                            </div>
                            <!--Tema-->
                            <div class="card rounded-0">
                                <h5 class="card-header">
                                    <a data-toggle="collapse" href="#contenidoTres-temaTres" aria-expanded="true"
                                        aria-controls="contenidoTres-temaTres" id="leccionTres-temaTres" class="d-block">
                                        <i class="fa fa-chevron-down pull-right"></i>
                                        Tema #3
                                    </a>
                                </h5>
                                <div id="contenidoTres-temaTres" class="collapse" aria-labelledby="leccionTres-temaTres">
                                    <div class="card-body">
                                        <h6>Este es el contenido del Tema</h6>
                                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim nesciunt
                                            debitis labore quae vero. Labore deleniti, maiores veritatis sapiente reiciendis
                                            possimus.Ratione enim dignissimos facilis. Magnam id molestias aspernatur dolor.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>








        </div>
      </div>

    <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/myjs.js"></script>

</body>
</html>