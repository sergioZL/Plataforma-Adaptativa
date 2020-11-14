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
                    
                    <li>
                        <a  data-toggle="modal" data-target="#modalConfiguracion"><button class="btn btn-light col-12 text-left" ><span class="fas fa-cog pull-left" style="color: #07ad90;"></span> &nbsp; Configuración  </button></a>
                    </li>

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


        <!-- Aquí va el modal para cofiguracion -->
        <div class="modal fade" id="modalConfiguracion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-200 font-weight-bold">Congiruación</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                    </button>
                </div>
                <br/>
                <div id="formulario" class="container">
                    <form id="formularito" action="<?php echo site_url('ConfiguracionController/ActualizarNumPreguntas')?>" method="post" role="form">
                        <div class="modal-body mx-3">   
                            <div class="md-form mb-3">
                                <input type="text" class="form-control" id="rutaSubida" name="ruta"  disabled> 
                            </div>                   
                            <div class="md-form mb-3">
                                <select class="browser-default custom-select " id="select_tipo" name="tipo_materia" >
                                    <option id="tipo_material" value="0">Evaluación diagnóstica</option>
                                    <option id="tipo_material" value="1">Evaluación por tema</option>
                                    <option id="tipo_material" value="2">Evaluación global</option>
                                </select>
                                <!-- <input type="text" id="nombre_leccion" name="nombre_leccion" class="form-control"> -->
                            </div>
                            <div class="md-form mb-3">
                                <input type="number" class="form-control" id="cantidadPreguntas" name="cantidad_preguntas" placeholder="Numero de preguntas"> 
                            </div>

                            <div id="AlertaNum" class="alert alert-warning d-none" role="alert">
                              Necesitas agregar un numero de preguntas.
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div style="margin-bottom: 10px; color:white;">
                                
                                <input id="botonModificarNumpreguntas" type="submit" class="btn btn-primary" value="Aplicar cambios"  data-dismiss="modal" aria-label="Close">
                                
                            </div>
                        </div>
                    </form>      
                </div>
            </div>
        </div>
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

        $.get( '<?php echo site_url();?>/ConfiguracionController/CargarNumPreguntas', function( data ) {
                    if ( data != null){
                        numpreguntas = JSON.parse(data);
                        $('#cantidadPreguntas').val( numpreguntas.numpregunta );
                    }

        });

        $.get( '<?php echo site_url();?>/ConfiguracionController/CargarRuta',
                    function ( data ) {
                        if( data != null ) {
                            Subida = JSON.parse( data );
                            $('#rutaSubida').val( Subida.ruta );
                        }
                    }
                );

    });

    $('#select_tipo').change(function (e) { 
        
        let tipoEvaluacion = parseInt($('#select_tipo').val());

        switch (tipoEvaluacion) {
            case 0:
                
                $.get( '<?php echo site_url();?>/ConfiguracionController/CargarNumPreguntas', function( data ) {
                    if ( data != null){
                        numpreguntas = JSON.parse(data);
                        $('#cantidadPreguntas').val( numpreguntas.numpregunta );
                    }

                });

                break;
        
            case 1:

                $.get( '<?php echo site_url();?>/ConfiguracionController/CargarNumPreguntasTema', function( data ) {
                    if ( data != null){
                        let numpreguntas = JSON.parse(data);
                        $('#cantidadPreguntas').val( numpreguntas.numpreguntaTema );
                    }
                    
                });

                break;
            case 2: 

                $.get( '<?php echo site_url();?>/ConfiguracionController/CargarNumPreguntasGlobal', function( data ) {
                    if ( data != null){
                        let numpreguntas = JSON.parse(data);
                        $('#cantidadPreguntas').val( numpreguntas.numpreguntaGlobal );
                    }
                    
                });

                break;
        }
        
    });


    $('#botonModificarNumpreguntas').click(function (e) { 
            e.preventDefault();
            
            let cantidad =  $('#cantidadPreguntas').val() || 0;

            if( cantidad > 0 ){

                $('#botonModificarNumpreguntas').attr('data-dismiss', 'modal');
                $('#botonModificarNumpreguntas').attr('aria-label', 'Close');
                $('#AlertaNum').addClass('d-none');
                let seleccionado = parseInt($('#select_tipo').val());

                switch (seleccionado) {
                    case 0:
                        
                        $.post( '<?php echo site_url();?>/ConfiguracionController/ActualizarNumPreguntas', {numpreguntas: cantidad},
                            function (data) {
                             console.log(data);   
                            }
                        );

                        break;
                    case 1:
                        
                        $.post( '<?php echo site_url();?>/ConfiguracionController/ActualizarNumPreguntasTema', {numpreguntas: cantidad},
                            function (data) {
                             console.log(data);   
                            }
                        );

                        break;
                    case 2:
                        
                        $.post( '<?php echo site_url();?>/ConfiguracionController/ActualizarNumPreguntasGlobal', {numpreguntas: cantidad},
                            function (data) {
                             console.log(data);   
                            }
                        );
                        
                        break;
                
                    default:
                        console.log('Algo salio mal');
                        break;
                }
            } else {
                $('#AlertaNum').removeClass('d-none');
                $('#botonModificarNumpreguntas').removeAttr('data-dismiss');
                $('#botonModificarNumpreguntas').removeAttr('aria-label');
            }

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