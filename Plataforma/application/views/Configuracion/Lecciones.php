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
    <title>Configuración curso</title>
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/diseñoMicurso.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/jquery-ui.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/bootstrap.css"/>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>       
    <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>    
    <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/myjs.js"></script>  
    <script src="<?php echo base_url();?>app-assets/js/jquery-ui.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.11.2/js/all.js"></script> <!-- nuevo font awesome -->
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

        .escondido {
            display: none;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container row">
  <a class="navbar-brand text-left" href="<?php echo site_url();?>/cursos/todos">
    <img class="login-img text-left" src="<?php echo base_url();?>app-assets/imagenes/logo.png" style="width: 80%; margin: 0;">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
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
  <div class="collapse navbar-collapse col justify-content-end" id="navbarNavAltMarkup">
    <div class="navbar-nav">
        <ul class="navbar-nav ">
               <!-- <li class="dropdown">
                <a href="" class="btn" data-toggle="dropdown" >
                    <span class="far fa-bell fa-2x" style="color: #07ad90;" title="Notificaciones"></span>
                </a>
                <ul class="dropdown-menu">

                </ul>
            </li> -->
            <li>
                <a href="<?php echo site_url();?>/cursos/nuevo_curso"><button class="btn btn-light col-12 text-center m-2"> <pre class="font-weight-bold">Nuevo curso</pre></button></a>
            </li>
            <li class="text-center" >
                <a   href="<?php echo site_url();?>/cursos/todos"> <button style="border-left: 1px solid grey; border-radius: 0px;" class="btn btn-light col-12 text-center m-2"><pre class="font-weight-bold"> Mis cursos</pre></button></a>
            </li>
 
            <li class="dropdown ">
                <a href="" class="btn " data-toggle="dropdown" >
                    <!-- <span class="fas fa-circle fa-2x" style="color: #07ad90;"  title="Perfil"></span> -->
                    <span class="fa-layers fa-3x" style="color:#07ad90;" >
                        <i class="fas fa-circle" ></i>
                        <span id="inicial" class="fa-layers-text fa-inverse"  data-fa-transform="shrink-12.5 " style="font-weight:900">PROFE</span>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#">
                            <span class="fas fa-user-circle fa-2x" style="color: #07ad90;" title="Perfil"></span>
                            <span id="userName">
                                <?php 
                                    echo $varsesion;
                                ?>
                            </span>
                        </a>
                    </li>
                    <!-- <li>
                        <a href=""><button class="btn btn-light col-12 text-left"><span class="fas  fa-info-circle  pull-left" style="color: #07ad90;"></span><pre>  Ayuda</pre>  </button></a>
                    </li> -->
                    <li>
                        <a href="../../../CerrarSesion.php"><button class="btn btn-light col-12 text-left"> <span class=" fas fa-sign-out-alt  pull-left" style="color: #07ad90;"></span><pre> Cerrar sesión</pre></button> </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
  </div>
  </div>
</nav>

    <div class="row" style="margin-top: 10px;">
        <div class="col-md-4"> 
            <h2><b><?php echo $_GET['nombre'];?></b></h2>
        </div>
    </div>
    <div id="botones">
        <div class="col-md-7 text-right">
            <a class="btn btn-primary mb-4" data-toggle="modal" data-target="#modalNuevaLeccion">Agregar lección</a>
        </div>
    </div>

    <ul id="contenedorLecciones" class="container-fluid">
        
    </ul>

    <div class="modal fade" id="modalNuevaLeccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-200 font-weight-bold">Nueva lección</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <br/>
                <div id="formulario" class="container">
                    <form id="formularito" action="<?php echo site_url('ConfiguracionController/agregarLeccion')?>" method="post" role="form">
                        <div class="modal-body mx-3">                 
                            <div class="md-form mb-5">
                                <label data-error="wrong" data-success="right" for="nombre_leccion">Nombre</label>
                                <input type="text" id="nombre_leccion" name="nombre_leccion" class="form-control">
                            </div>
                            <div class="md-form mb-5">
                                <label data-error="wrong" data-success="right" for="descripcion_leccion">Descripción</label>
                                <input type="text" class="form-control" id="descripcion_leccion" name="descripcion_leccion"> 
                            </div>
                            <div id="contenedorTotalLecciones" class="escondido">
                                 
                            </div>
                            <div class="escondido">
                                <input type="text" class="form-control" id="clave_curso" name="clave_curso" value="<?php echo $_GET['clave_curso']; ?>"> 
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div style="margin-bottom: 10px; color:white;">
                                <input id="inputAgregar" type="submit" class="btn btn-primary" value="Agregar lección">
                            </div>
                        </div>
                    </form>      
                </div>
            </div>
        </div>
    </div>

    <div id="contenedorModales" class="container-fluid">
        <div class="container row">
                    <div class="modal fade" id="modalNuevoTema" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h4 class="modal-title w-200 font-weight-bold">Nuevo tema</h4>
                                    <button type="button" class="close" aria-label="Close"></button>
                                </div>
                                <br/>
                                <div id="formularioTema" class="container">
                                    <form id="formularitoTema" action="<?php echo site_url('ConfiguracionController/agregarTema')?>" method="post" role="form">
                                        <div class="modal-body mx-3">
                                            <div class="md-form mb-5">
                                                <label data-error="wrong" data-success="right" for="nombre_tema">Nombre</label>
                                                <input type="text" id="nombre_tema" name="nombre_tema" class="form-control">
                                            </div>
                                            <div class="md-form mb-5">
                                                <label data-error="wrong" data-success="right" for="descripcion_tema">Descripción</label>
                                                <input type="text" class="form-control" id="descripcion_tema" name="descripcion_tema">
                                            </div>
                                            <div id="contenedorTotalTemas" class="escondido">

                                            </div>
                                            <div id="contenedorLeccion" class="escondido">

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div style="margin-bottom: 10px;">
                                                <input id="inputAgregarTema" type="submit" class="btn btn-primary" value="Agregar tema">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>

    <script>
        
        var totalLecciones = 0;

        $(function() {

        var clave = '<?php echo $_GET['clave_curso']; ?>';
        var clave_curso = clave;

        showLecciones();
        getTotalLecciones();

        function showLecciones() {

            $.ajax({
                type: 'POST',
                url: '<?php echo site_url()?>/ConfiguracionController/getLeccionesPorCurso?clave_curso='+clave_curso,
                dataType: 'json',
                success: function(data) {
                    //console.log(data);

                    var lecciones = '';
                    var modales = '';
                    var i;

                    if(data.length == 0 || data == null) {
                        lecciones = '<div>No hay lecciones. Agregue una.</div>';
                    }
                    else {
                        for(i = 0; i < data.length; i++) {
                            lecciones +=    '<div id="'+data[i].clave+'" class="row justify-content-md-center col-lg-9 btn btn-default" class="leccion">' +
                                                    '<div class="list-group-item list-group-item-action bg-light" data-toggle="collapse" href="#collapsed'+i+'" id="collapser'+i+'">' +
                                                        '<h4 id="collapserTitle'+i+'" class="title">' +
                                                            '<div>'+data[i].nombre+'</div>' +
                                                        '</h4>' +
                                                    '</div>' + 
                                                    '<div id="collapsed'+i+'" class="collapse">' +
                                                        '<ul value="'+data[i].clave+'" id="contenedorTemas'+i+'" class="list-group">' +
    
                                                        '</ul>' +
                                                    '</div>' +
                                                '</div>'; 
                            var total_temas = getTotalTemas(data[i].clave);
                            getTemasPorLeccion(data[i].clave, i, total_temas);
                        } 
                    } 
                    $('#contenedorLecciones').html(lecciones);
                },
                error: function() {
                    console.log('hubo un pedo en el showLecciones');
                }
            });  
        }     

        function getTemasPorLeccion(id_leccion, contenedor, totalTemas) {
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url()?>/ConfiguracionController/getTemasPorLeccion?id_leccion='+id_leccion,
                dataType: 'json',
                success: function(data) {
                    //console.log(data);

                    var temas = '';
                    var total = totalTemas + 1;

                    if(data.length == 0 || data == null) {
                        temas = '<a class="list-group-item"><h5>No hay temas</h5></a>';
                    }
                    else {
                        for(var j = 0; j < data.length; j++) {
                            console.log(data);
                            
                            temas +=  '<a href="<?php echo site_url()?>/ConfiguracionController/getArbolData?id_tema='+data[j].id+'" class="list-group-item list-group-item-action">' +
                                        '<h5>'+data[j].nombre+'</h5>'+
                                      '</a>';  
                        }
                    }
                    temas += '<li class="list-group-item"><button onClick="putData('+id_leccion+', '+total+')" id="btnAgregarTemaLeccion" class="btn btn-primary" data-toggle="modal" data-target="#modalNuevoTema">Agregar tema</button></li>';

                    $('#contenedorTemas'+contenedor).html(temas);
                },
                error: function() {
                    console.log('hubo un pedo en el getTemasPorLeccion');
                }
            });  
        }

        function getTotalLecciones() {

            $.ajax({
                type: 'POST',
                url: '<?php echo site_url()?>/ConfiguracionController/getLeccionesCount?clave_curso='+clave_curso,
                dataType: 'json',
                success: function(data) {
                    //console.log(data);

                    var numero = parseInt(data);
                    var secuencia = '';

                    secuencia = '<input type="text" class="form-control" id="secuencia_leccion" name="secuencia_leccion" value="'+(numero+1)+'">';

                    $('#contenedorTotalLecciones').html(secuencia);
                },
                error: function() {
                    console.log('hubo un pedo en el getTotalLecciones');
                }
            });
        }

        function getTotalTemas(id_leccion) {

            var valor_retornado = 0;

            $.ajax({
                type: 'POST',
                url: '<?php echo site_url()?>/ConfiguracionController/getTemasCount?id_leccion='+id_leccion,
                dataType: 'json',
                async: false,
                success: function(data) {
                    //alert(data);
                    valor_retornado = parseInt(data);
                    //alert(valor_retornado);
                },
                error: function() {
                    console.log('hubo un pedo en el getTotalTemas');
                }
            });

            return valor_retornado;
        }        
    });

    function putData(id_leccion, totalTemas) {
        
        var leccion = '<input type="text" class="form-control" id="id_leccion" name="id_leccion" value="'+id_leccion+'">';
        var num_secuencia = '<input type="text" class="form-control" id="secuencia_tema" name="secuencia_tema" value="'+totalTemas+'">';

       // alert('id_leccion: '+id_leccion+'   totalTemas: '+totalTemas);

        $('#contenedorTotalTemas').html(leccion);
        $('#contenedorLeccion').html(num_secuencia);
    }

    function getArbolData(id_tema) {

        $.ajax({
                type: 'POST',
                url: '<?php echo site_url();?>/ConfiguracionController/getArbolData?id_tema='+id_tema,
                dataType: 'json',
                async: false,
                success: function(data) {
                    //console.log(data);
                },
                error: function() {
                    console.log('hubo un pedo en el getArbolData');
                }
            });
    }

    $(document).ready(function() {

        $('#contenedorLecciones').sortable({
            opacity: 0.6,
            cursor: 'move',

            update: function(event, ui){                

                var order = $('#contenedorLecciones').sortable('toArray');

                $.ajax({
                    url: '<?php echo site_url();?>/ConfiguracionController/actualizarLecciones',
                    data: {'order': order},
                    type: 'POST',
                    success: function (data) {
                        alert('se ha hecho la actualización correctamente');
                    },
                    error: function(xhr, thrownError) {
                        console.log(xhr.status);
                        console.log(thrownError);
                    }
                });
            }
        });
        $('#contenedorLecciones').disableSelection();
        $('#contenedorLecciones').on('sortstop', function(event, ui) {
            
        });

        $('#contenedorTemas0').sortable({
            opacity: 0.6,
            cursor: 'move',

            
        });
        $('#contenedorTemas0').disableSelection();
        $('#contenedorTemas0').on('sortstop', function(event, ui) {
            
        });
    });

    $('#buscar').click(function()
    {
        if( $("#textBuscar").val() != "")
            window.location.href="<?php echo site_url();?>/Cursos/Buscar?nombre="+ $("#textBuscar").val();
    });
    </script>

</body>
</html>