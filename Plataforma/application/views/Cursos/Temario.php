<?php
    error_reporting(0);
    session_start();
    $varsesion = $_SESSION['usuario'];
    if($varsesion == null|| $varsesion == '')
    {
        header("location:../../../index.php");
    }/*.site_url('alumno/MisCursos') */
?> 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenido del curso</title>
    
    <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>
    <!--estilos bootstrap-->
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/bootstrap.css">
    <!--Estilos personalizados-->
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/estilos.css">
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/estilosTemario.css">
    <!--iconos-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">    
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>                            
</head> 
<body>  


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
                        <a href="../../../CerrarSesion.php"><button class="btn btn-light col-12 text-left"> <span class=" fas fa-sign-out-alt  pull-left" style="color: #07ad90;"></span><pre>  Salir</pre></button> </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
  </div>
</nav>

<?php //echo $curso =$_GET['curso']; ?>


<section class="seccion-superior"><!--Esta es la parte superior del temario-->
    <div class="row pt-4 py-4 offset-1">
        <div class="panelImagen col-lg-4 ">
            <div id="imagen">


            </div>
        </div>
        <div class="row col-lg-8 ">
            <div class="offset-1">
                
                <div id="info">
                
                </div>

                        
            </div>
        </div>
    </div>
</section>
    <div id="main" class="row">
        <!--Menu desplegable-->
        <div id="accordion" role="tablist" aria-multiselectable="true" class="container t-2 pt-5 col-md-11">
            <!--Leccion uno-->
            <div  id="Leccion">
                        
                <div id="Temas">
                            <!--Tema-->
                </div>
                            
            </div>
        </div>
    </div>
</div>

    <script>
    CargarInfoCursos();
    CargarLecciones();
        $('#buscar').click(function()
        {
            if( $("#textBuscar").val() != "")
                window.location.href="<?php echo site_url();?>/Cursos/Buscar?nombre="+ $("#textBuscar").val();
        });

        function CargarLecciones()
        {
            $.ajax
            ({
                type:'post',
                url:'<?php echo site_url();?>/Cursos/PreviewController/ConsultarTodosLeccionPorIDCursos?IdCurso=<?php echo $curso = $_GET['curso'];?>',    
                dataType:"json",
                success:function(resp)
                {
                    var n = resp.length;
                    //var data = JSON.parse(resp);

                    for(var i = 0; i < n; i++)
                    {
                        temas(resp,i);
                    }
                }
            });
        }

        function temas(data,i)
        {
            $.ajax
            ({
                type:'post',
                url:'<?php echo site_url();?>/Cursos/PreviewController/ConsultarTemasCursos?IdLeccion='+data[i].clave,
                success :function(resp)
                {
                    $("#Leccion").append(
                        '<div class="card leccion shadow-sm mb-3 rounded-0">'+
                            '<h5 class="card-header">'+
                                '<!--Cabecera del menu desplegable-->'+
                                '<a data-toggle="collapse" href="#contenido' + data[i].secuencia+ '" aria-expanded="true" aria-controls="contenidoUno"'+
                                    'id="leccion' + data[i].secuencia+ '" class="d-block">'+
                                    '<i class="fa fa-chevron-down pull-right"></i>'
                                    + data[i].nombre +' '+ data[i].secuencia +
                                '</a>'+
                            '</h5>'+
                        '<div id="contenido' + data[i].secuencia+ '" class="collapse" aria-labelledby="leccionUno">'+
                            '<!--Contenido del menu desplegable-->'+
                            '<div class="card-body">'+
                                '<h6>Este es el contenido de la leccion</h6>'+
                                '<p>' + data[i].descripcion+ '</p>'+
                            '</div>'+resp
                    );
                }                    
            });
        }


        function CargarInfoCursos()
        {
            $.ajax
            ({
                type:'post',
                url:'<?php echo site_url();?>/Cursos/TemarioController/ConsultarPorIDCursos?IdCurso=<?php echo $curso = $_GET['curso'];?>',    
                dataType:"json",
                success:function(resp)
                {
                    $("#imagen").append(
                        '<img class="card-img-top h-100" src="data:image/jpg;base64,'+ resp[0].foto+'" alt="Proyecto 1">'
                    );

                    $("#info").append(

                        '<h2 class="text-white">' + resp[0].nombre +'</h2>'+
                        '<br>'+
                        '<h4 class="text-white">has completado: 1 leccion de 5</h4>'+
                        '<div class="popup" onclick="myFunction()">'+
                            '<div class="progress">'+
                                '<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"'+
                                'aria-valuemin="0" aria-valuemax="100" style="width:' + resp[0].avance +'%">'+
                                    resp[0].avance +'% de progreso'+
                                '</div>'+
                            '</div>'+
                            '<span class="popuptext" id="myPopup"> Segun el examen diagnostico este es el progreso que tienes del curso</span>'+
                        '</div>'+
                        '<br>'+
                        '<br>'+
                        '<a href="<?php echo site_url('Material?curso='.$curso)?>"> <button type="button" class="btn btn-success"> <h2>Continuar desde: tema-2.2</h2></button></a>'
                        
                    );                    
                }
            });
        }
    </script>  

     
    <script src="<?php echo base_url();?>app-assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/myjs.js"></script>
</body>
</html>