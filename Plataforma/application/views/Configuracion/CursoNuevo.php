<?php
    error_reporting(0);
    session_start();
    $varsesion = $_SESSION['usuario'];
    if($varsesion == null|| $varsesion == '')
    {
        header("location:../../../index.php");
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nuevo curso</title>
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/diseñoMicurso.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/bootstrap.css"/>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    
    <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>    
    <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/myjs.js"></script>  

    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>       

    <style>
        * {
            text-decoration: none;
            color: black;
        }

        .filterDiv {
            float: left;
            display: none;
        }

        .show {
            display: block;
        }
        
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand text-left" href="<?php echo site_url();?>/cursos/todos">
    <img class="login-img text-left" src="<?php echo base_url();?>app-assets/imagenes/logo.png" style="width: 50%; margin: 0;">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">

    <form class="form-inline my-2 my-lg-0">
        <div class="input-group">
           <input id="textBuscar" type="search" class="buscar form-control" placeholder="Buscar">
           <div class="input-group-append">
                <button id="buscar" class="bustcar btn btn-outline-info" type="button">
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
                        <button class="btn btn-light col-12 text-left"> <a href="<?php echo site_url();?>/cursos/todos"> <span class="far fa-folder pull-left " style="color: #07ad90;font-size: 16px;"></span><pre>  Mis cursos</pre></a></button>
                    </li>
                    <li>
                         <button class="btn btn-light col-12 text-left"> <a href="<?php echo site_url();?>/cursos/nuevo_curso"><span class="fas fa-folder-plus pull-left " style="color: #07ad90;"></span> <pre>  Nuevo curso</pre>   </a> </button>
                    </li>
                    <li>
                        <button class="btn btn-light col-12 text-left"> <a href=""><span class="fas  fa-info-circle  pull-left" style="color: #07ad90;"></span><pre>  Ayuda</pre>  </a></button>
                    </li>
                    <li>
                        <button class="btn btn-light col-12 text-left"> <a href="../../../CerrarSesion.php"><span class=" fas fa-sign-out-alt  pull-left" style="color: #07ad90;"></span><pre>  Salir</pre>  </a></button>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
  </div>
</nav>
 
    <div style="margin-top: 20px;"> 
        <h3>Configuración del curso</h3>
    </div>

    <br><br>

    <div id="formulario" class="container col-lg-7">
        <form action="<?php echo site_url('ConfiguracionController/agregarCurso')?>" method="post"  enctype="multipart/form-data" role="form">
            <div class="row">
                <div class="form-group col-lg-6 col-sm-4 col-md-4 col-lg-4 text-left">
                    <label for="clave">Clave</label>
                    <input type="text" class="form-control text-left" id="clave" name="clave" placeholder="Ingresa la clave del curso">
                </div>
                <div class="form-group col-lg-6 col-sm-4 col-md-4 col-lg-4 text-left">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control text-left" id="nombre" name="nombre" placeholder="Ingresa el nombre del curso">
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="form-group col-lg-6 col-sm-4 col-md-4 col-lg-4 text-left">
                    <div class="text-left">
                        <label for="carrera">Carrera</label>
                    </div>
                    <select class="custom-select" id="carrera" name="carrera">
                    
                    </select>   
                </div>
                <div class="form-group col-lg-6 col-sm-4 col-md-4 col-lg-4 text-left">
                    <div class="text-left">
                        <label for="categoria">Categoría</label>
                    </div>
                    <select class="custom-select" id="categoria" name="categoria">
                    
                    </select>   
                </div>
            </div>
                <div class="clearfix"></div>
                <div class="form-group text-left">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control text-left" id ="descripcion" name="descripcion" placeholder="Ingresa una descripción del curso"></textarea> 
                </div>
            <div class="row">
                <div class="form-group col-xs-10 col-sm-10 col-md-4 col-lg-4 text-left">
                    <label class="col-form-label" for="foto">Agregar una imagen al curso</label>
                    <input id="foto" name="foto" type="file">
                </div>
            </div>
            <div>
                <input id="agregar" type="submit" class="btn btn-primary text-left" value="Agregar curso">
            </div>
        </form>
    </div>

    <script>        

    $(function() {
        showCarreras();

        function showCarreras() {
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('ConfiguracionController/getCarreras')?>',
                dataType: 'json',
                success: function(data) {
                    var carreras = '';
                    var i;
                    carreras = '<option value="0">Selecciona una carrera...</option>';

                    for(i = 0; i < data.length; i++) {
                        carreras += '<option value="'+data[i].clave+'">'+data[i].nombre+'</option>';
                    }
                    $('#carrera').html(carreras);
                },
                error: function() {
                    console.log('hubo un pedo');
                }
            });
        }

        
        $('#buscar').click(function() {
            if( $("#textBuscar").val() != "")
                window.location.href="<?php echo site_url();?>/Cursos/Buscar?nombre="+ $("#textBuscar").val();
        });
    });      

    $('#carrera').change(function() {
        var carreraSeleccionada = document.getElementById('carrera');
        var clave_carrera = carreraSeleccionada.value;

        $.ajax({
                type: 'POST',
                url: '<?php echo site_url();?>/ConfiguracionController/getCategoriasPorCarrera?clave_carrera='+clave_carrera,
                dataType: 'json',
                success: function(data) {                   
                    var categorias = '';
                    var i;

                    categorias = '<option value="0">Selecciona una categoría...</option>';

                    for(i = 0; i < data.length; i++) {
                        categorias += '<option value="'+data[i].id+'">'+data[i].descripcion+'</option>';
                    }
                    $('#categoria').html(categorias);
                },
                error: function() {
                    console.log('hubo un pedo');
                }
            });
    });

    </script>

</body>      
</html>