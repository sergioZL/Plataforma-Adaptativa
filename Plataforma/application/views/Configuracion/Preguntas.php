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
        <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/bootstrap.css"/>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>       
        <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>    
        <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>
        <script src="<?php echo base_url();?>app-assets/js/popper.min.js"></script>
        <script src="<?php echo base_url();?>app-assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>app-assets/js/myjs.js"></script>  
        <script src="<?php echo base_url();?>app-assets/js/ckeditor/ckeditor.js"></script>  

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
                                 <button class="btn btn-light col-12 text-left"> <a href="<?php echo site_url();?>/cursos/nuevo-curso"><span class="fas fa-folder-plus pull-left " style="color: #07ad90;"></span> <pre>  Nuevo curso</pre>   </a> </button>
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
            <nav aria-label="breadcrumb" >
                <ol class="breadcrumb" id="contenedorNombres">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="#">Library</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Data</li>
                </ol>
            </nav>
        
            <div id="botones">
                <div class="col-md-12 text-right">
                    <a class="btn btn-primary mb-4 text-light" data-toggle="modal" data-target="#modalNuevaLeccion" onclick="NuevaPregunta()">Nueva pregunta</a>
                </div>
            </div>
            <ul id="contenedorPreguntas" class="container-fluid">
        
            </ul>

        <div class="modal fade bd-example-modal-lg" id="modalNuevaLeccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-200 font-weight-bold" id="chan">Nueva pregunta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <br/>
                <div id="formularioP" class="container">
                </div>
                </div>
            </div>
        </div>
        <script>
            
            var id_tema = '<?php echo $id_tema;?>';
            var id_leccion = '<?php echo $id_leccion;?>';
            var clave_curso = '<?php echo $id_curso;?>';

            getNombres(id_tema, id_leccion, clave_curso);
            showPreguntas(id_tema);

            function getNombres(id_tema, id_leccion, clave_curso) {

                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url();?>/ConfiguracionController/getNombres?id_tema='+id_tema+'&id_leccion='+id_leccion+'&clave_curso='+clave_curso,
                    dataType: 'json',
                    async: false,
                    success: function(data) {
                        //console.log(data);
                        var titulos = '';
                    
                        titulos += '<li class="breadcrumb-item"><a href="<?php echo site_url();?>/cursos/nuevo_curso/lecciones?nombre=Mysql&clave_curso='+clave_curso+'">'+data.nombre_curso+'</a></li>'
                        titulos += '<li class="breadcrumb-item"><a href="<?php echo site_url();?>/ConfiguracionController/getArbolData?id_tema='+id_tema+'">'+data.nombre_tema+'</a></li>'
                        titulos += '<li class="breadcrumb-item active" aria-current="page">Preguntas</li>'
                    
                         $('#contenedorNombres').html(titulos);
                    },
                    error: function() {
                        console.log('hubo un pedo en el getNombres');
                    }
                });
            }

            function showPreguntas(id_tema){
                
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url()?>/ConfiguracionController/getPreguntasTema?id_tema='+id_tema,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);

                         var preguntas = '';
                         var modales = '';
                         var imagen = '';
                         var i;
                         if(data.length == 0 || data == null) {
                             preguntas = '<div>No hay preguntas. Agregue una.</div>';
                         }
                         else {
                             for(i = 0; i < data.length; i++) {
                                 if(data[i].imagen) imagen = '<img class="card-img-top" style="width: 200px; height:200px;" id="imgcurso" src="data:image/jpg;base64,'+data[i].imagen+'" alt="Card image cap">';
                                 preguntas +=    '<div id="'+data[i].id+'" class="row col-lg-9 btn btn-default" class="leccion">' +
                                                         '<div class="list-group-item list-group-item-action bg-white border-primary border-right-0 border-left-0 border-top-0" data-toggle="collapse" href="#collapsed'+i+'" id="collapser'+i+'">' +
                                                             '<h4 id="collapserTitle'+i+'" class="title">' + 
                                                                 '<div class="text-left"><span class="text-left">'+data[i].enunciado+'</span><span id="aviso'+data[i].id+'" class="pull-right"></span></div>' +
                                                                 imagen+
                                                             '</h4>' +
                                                         '</div>' + 
                                                         '<div id="collapsed'+i+'" class="collapse ">' +
                                                             '<ol type="a" value="'+data[i].id+'" id="contenedorOpciones'+i+'" class=" list-group">' +
                          
                                                             '</ol>' +
                                                         '</div>' +
                                                     '</div>'; 
                                  getOpciones(data[i].id, i);
                             } 
                         } 
                         $('#contenedorPreguntas').html(preguntas);
                    },
                    error: function() {
                        console.log('hubo un pedo en el showLecciones');
                    }
                });
            }

            function getOpciones(dat, contenedor){
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url()?>/ConfiguracionController/geOpcionesPorPregunta?id='+dat,
                    datatype:'Json',
                    success: function(data) {
                        if(data){
                            
                            var obj = JSON.parse(data);
                            var porcentaje = 0;
                            var temas = '';
                            var total = 1;
                            if(obj.length == 0 || obj == null) {
                                temas = '<a class="list-group-item"><h5>No hay opciones</h5></a>';
                            }
                            else {
                                for(var j = 0; j < obj.length; j++) {
                                    var imagen = '';
                                    if(obj[j].imagen) imagen = '<img class="card-img-top" style="width: 200px; height:200px;" id="imgcurso" src="data:image/jpg;base64,'+obj[i].imagen+'" alt="Card image cap">';
                                    temas +=  '<a href="<?php echo site_url()?>/ConfiguracionController/getArbolData?id_tema='+data[j].id_opciones+'" class="list-group-item list-group-item-action border-right-0 border-left-0 border-top-0">' +
                                                '<li class=" text-left border-right-0 border-left-0 border-top-0">) &nbsp; &nbsp;'+obj[j].enunciado+
                                                '<span class="pull-right badge badge-primary badge-pill">'+obj[j].porcentaje+'%</span>'+
                                                '<span>'+imagen+'</span>'+
                                                '</li>'+
                                              '</a>';  
                                    porcentaje = porcentaje+ parseInt(obj[j].porcentaje,10);
                                }
                                if (porcentaje != 100) {
                                    $('#aviso'+dat).html('<span style="color:yellow;" class="fas fa-warning text-right alert alert-info" title="Faltan opciones correctas para completar el 100% de acciertos">'
                                                        +'</span>');
                                }
                            }
                        }else temas = '<a class="list-group-item"><h5>No hay opciones</h5></a>';
                        temas += '<li class="list-group-item border-right-0 border-left-0 border-top-0"><button onClick="AgregarOpciones('+dat+')" id="btnAgregarTemaLeccion" class="btn btn-primary" data-toggle="modal" data-target="#modalNuevaLeccion">Agregar opción</button></li>';
                        
                        $('#contenedorOpciones'+contenedor).html(temas);
                    },
                    error: function() {
                        console.log('hubo un pedo en el geOpcionesPorPregunta  <?php echo site_url()?>/ConfiguracionController/geOpcionesPorPregunta');
                    }
                });
            }
            function NuevaPregunta(pregun = null){
                if(pregun == null) pregun = ''; 
                console.log(pregun);
                
                $.ajax({
                    type: "post",
                    url: "<?php echo site_url();?>/ConfiguracionController/cargarModal",
                    data: {tema:id_tema,pregunta:pregun },
                    success: function (response) {
                        //console.log(response);
                        
                        $('#formularioP').html(response);
                    }
                });   
            }
            function AgregarOpciones(pre = null){
                $('#chan').html('Nueva opción');
                NuevaPregunta(pre);
            }
        </script>
    </body>
</html>