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
    <title>Todos los cursos</title>
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

    <div style="margin-top: 20px;"> 
        <h3>Todos los cursos</h3>
    </div>

    <div>
        <div id="contenedorCursos" class="container row" style="margin-top: 20px;">                 

        </div>            
    </div>
 
<script>

    $(function() {
        showCursos();

        function showCursos() {
            $.ajax({
                type: 'POST',
                
                url: '<?php echo site_url();?>/ConfiguracionController/getCursos',
                success: function(data) {
                    //data = JSON.parse(data);
                    //console.log(data);
                    MostrarCursos(data);
                },
                error: function(thrownError) {
                    console.log(thrownError);
                }
            });
        }
    });      

    $('#buscar').click(function()
    {
        if( $("#textBuscar").val() != "")
            window.location.href="<?php echo site_url();?>/Cursos/Buscar?nombre="+ $("#textBuscar").val();
    });
    function MostrarCursos(d){
        data = JSON.parse(d);
        console.log(data);
    
        var cursos = '';
        var i;
        
        for(i = 0; i < data.length; i++) {
            cursos +=
            '<div class="card" style="width: 250px; height:400px; margin-left: 20px; margin-bottom: 40px;">' +
		        /*'<a href="Cursos/Preview?curso='+data[i].nombre +'">'*/
                '<a href="nuevo_curso/lecciones?nombre='+data[i].nombre+'&clave_curso='+data[i].clave+'">'
                 +
		        '<div class="img">' +
			        '<img class="card-img-top" style="width: 250px; height:250px;" id="imgcurso" src="data:image/jpg;base64,'+data[i].foto+'" alt="Card image cap">' +
		    '</div>' +
		    '<div class="card-body ">' +
			    '<h5 class="card-title text-center">'+data[i].nombre+'</h5>' +
			    '<p class="card-text text-center">'+data[i].descripcion+'</p>' +
		    '</div>' +
		        '</a>' +
		    '</div>';
        }
        $('#contenedorCursos').html(cursos);
    }
</script>

<?php /*var cursos = '';
                    var i;
                    
                    for(i = 0; i < data.length; i++) {
                        '<div class="card" style="width: 250px; height:400px; margin-left: 20px;">' +
				            '<a href="Cursos/Preview?curso='+data[i].nombre +'">' +
					        '<div class="img">' +
						        '<img class="card-img-top" style="width: 250px; height:250px;" id="imgcurso" src="'.$row['foto'].'" alt="Card image cap">' +
					    '</div>' +
					    '<div class="card-body ">' +
						    '<h5 class="card-title text-center">'.$row['nombre'].'</h5>' +
						    '<p class="card-text text-center">'.$row['descripcion'].'</p>' +
					    '</div>' +
				            '</a>' +
			            '</div>';
                    }
                    $('#contenedorCursos').html(carreras);*/?>

</body>
</html>

