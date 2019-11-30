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

    <div class="row" style="margin-top: 20px;">
        <div id="contenedorNombres" class="col-md-4"> 
            
        </div>
    </div>
    
    <div id="contenidoTema" class="container-fluid">
        <div >
            <div class="col-md-7 text-right">
                <a class="btn btn-primary mb-4" style="color:white;" data-toggle="modal" data-target="#modalNuevoMaterial">Agregar material</a>
                <a class="btn btn-primary mb-4" style="color:white;" data-toggle="modal" href="<?php echo site_url()?>/ConfiguracionController/Preguntas?id_tema=<?php echo $id_tema?>">Agregar Preguntas</a>
            </div>
        </div>
    </div>

    <div id="contenedorMaterial">
        
    </div>

    <div class="modal fade" id="modalNuevoMaterial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-200 font-weight-bold">Nuevo material</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <br/>
                <?php 
                    echo $error;
                    echo form_open_multipart('ConfiguracionController/do_upload');
                    echo '<div class="modal_body mx-3">';
                        echo '<div class="md-form mb-5">';
                            echo '<label data-error="wrong" data-success="right" for="tipo_material">Tipo de material</label></br>';
                            echo form_input(array('type' => 'hide', 'name' => 'tipo_material', 'id' => 'tipo_material', 'class' => 'escondido form_control', 'size' => 40));
                            echo '<select class="form_control" id="select_material" name="tipo_materia" onchange="cambiarValor()">';
                            echo '<option id="tipo_material" value="0">Selecciona un tipo de material...</option>';
                            echo '<option id="tipo_material" value="1">Video</option>';
                            echo '<option id="tipo_material" value="2">Audio</option>';
                            echo '<option id="tipo_material" value="3">Documento PDF</option>';
                            echo  '</select>';
                            echo '</div>';
                        echo '<div class="md-form mb-5">';
                            echo '<label data-error="wrong" data-success="right" for="descripcion_material">Descripción de material</label></br>';
                            echo form_input(array('type' => 'text', 'name' => 'descripcion_material', 'id' => 'descripcion_material', 'class' => 'form_control', 'size' => 40));
                        echo '</div>';
                        echo '<div class="md-form mb-5">';
                            echo '<label data-error="wrong" data-success="right" for="userfile">Seleccione un archivo</label>';
                            echo form_input(array('type' => 'file','name' => 'userfile', 'class' => 'form_control'));
                        echo '</div>';
                        echo '<div class="escondido">';
                            echo form_input(array('type' => 'text','name' => 'id_tema', 'id' => 'id_tema', 'value' => $_GET['id_tema']));
                            echo form_input(array('type' => 'text','name' => 'id_leccion', 'id' => 'id_leccion', 'value' => $id_leccion));
                            echo form_input(array('type' => 'text','name' => 'clave_curso', 'id' => 'clave_curso', 'value' => $id_curso));
                        echo '</div>';
                        echo '<div class="modal-footer">';
                            echo '<div style="margin-bottom: 10px;">';
                                echo '<button type="sumbit" id="submit" name="submit" class="btn btn-primary" value="upload">Agregar material</button>';
                            echo '</div>';
                        '</div>';
                    echo '</div>';
                    echo form_close(); 
                ?>
            </div>
        </div>
    </div>

    <script>

        var id_tema = '<?php echo $_GET['id_tema'];?>';
        var id_leccion = '<?php echo $id_leccion;?>';
        var clave_curso = '<?php echo $id_curso;?>';

        getNombres(id_tema, id_leccion, clave_curso);

        function getNombres(id_tema, id_leccion, clave_curso) {

            $.ajax({
                type: 'POST',
                url: '<?php echo site_url();?>/ConfiguracionController/getNombres?id_tema='+id_tema+'&id_leccion='+id_leccion+'&clave_curso='+clave_curso,
                dataType: 'json',
                async: false,
                success: function(data) {
                    // console.log(data);
                    var titulos = '';

                    titulos += '<h6>Curso: '+data.nombre_curso+'</h6>';
                    titulos += '<h6>Lección: '+data.nombre_leccion+'</h6>';
                    titulos += '<h6>Tema: '+data.nombre_tema+'</h6>';

                    $('#contenedorNombres').html(titulos);
                },
                error: function() {
                    console.log('hubo un pedo en el getNombres');
                }
            });
        }

        function cambiarValor(){
            let valor = $('#select_material').val();
            $('#tipo_material').val(valor);
        }

        $(function(){

            var id_tema = '<?php echo $_GET['id_tema'];?>';

            showMaterial();

            function showMaterial() {

                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url();?>/ConfiguracionController/getMaterialPorTema?id_tema='+id_tema,
                    dataType: 'json',
                    success: function(data) {

                        var materiales = '';

                        if(data == null || data.length == 0) {
                            materiales = '<div>No hay material. Agregue.</div>';
                        }
                        else {
                            for(var i = 0; i < data.length; i++) {
                                materiales += '<div class="row justify-content-md-center col-lg-9 btn btn-default">' +
                                                '<div class="list-group-item list-group-item-action bg-light" data-toggle="collapse" href="#collapsed'+i+'" id="collapser'+i+'">' +
                                                    '<h6 id="collapserTitle'+i+'" class="title">' +
                                                        '<div>'+data[i].descripcion_material+'</div>' +
                                                    '</h6>' +
                                                    '<div>'+data[i].tipo_material+'</div>' + 
                                                '</div>' + 
                                            '</div>';
                            }
                        } 
                        $('#contenedorMaterial').html(materiales);
                    },
                    error: function() {
                        console.log('hubo un pedo en el showMaterial');
                    }
                });  
            }  

        });

       
    </script>

</body>
</html>