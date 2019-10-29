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
     <script defer src="https://use.fontawesome.com/releases/v5.11.2/js/all.js"></script> <!-- nuevo font awesome -->
</head> 
<body>  
<?php
        $this->load->view('Cursos/Nav');
?>

<!-- nav -->

<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
            </li>--><!--
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
</nav> -->

<?php //echo $curso =$_GET['curso']; ?>


<section class="seccion-superior"><!--Esta es la parte superior del temario-->
    <div class="row pt-4 py-4 offset-1">
        <div class="panelImagen col-lg-3 ">
            <div id="imagen">


            </div>
        </div>
        <div class="col-lg-8 ">
            <div >
                
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
    var but = 'Comenzar desde el principio'; //Este mensaje se mostrara al usuario por default si este no ha revisado algun material antes
    $(document).ready(function () {
        var clave = '<?php echo $_GET['curso'];?>'; //Almacena la clave de curso al que pertenece los temas
        var Ultimo = window.localStorage.getItem(clave); //Se optiene el ultimo material visitado por medio del local storage
        if(Ultimo != null){ //Si ya se tenia guardado el ultimo material visitdo en el localstorage  se obtienen los datos de este objeto
            ult = JSON.parse(Ultimo);
            but = ult.nombre.split(".");
            ruta = ult.url.substring(50);
            uta = ruta.split(".");
            ava = ult.avance;
            idmat = ult.material;
            //Los datos obtenidos se guardan en el boton que muestra el ultimo material visitado de este curso
            $('#boton').append('<button type="button" style="background-color:#07ad90;" class="btn btn-success" onclick="mostrar( &quot '+uta[0]+'&quot,'+ult.tipo+','+ava+','+idmat+');"> <h2 id="bot">'+but[0]+'</h2></button>');
        }

        //optiene la clave de usuario actual
        let usuario = '<?php echo $varsesion; ?>';
        
        /**
         * Optiene los datos de alumno relacionados con este usuario
         */
        $.get( '<?php echo site_url();?>/Cursos/EncuestaController/obtenerAlumno', { varusuario: usuario} )
            .done(function( data ) {
                let obj = JSON.parse( data );// convierte los datos optenidos a un objeto de tipo json
                actualizarHeader(obj[0]);
            });
    });

        function actualizarHeader(data){
            $('#userName').html('<br>'+data.nombre+' '+data.app); // Coloca el nombre de usuario y apellido paterno en el navbar
            console.log(data);
            let inN = data.nombre.split( "", 1 );
            let inA = data.app.split( "", 1 );
            $('#inicial').html(inN+inA);
        }
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

                    temas(resp);

                    // for(var i = 0; i < n; i++)
                    // {
                    //     temas(resp,i);
                    // }
                }
            });
        }

        function temas(data)
        {
            $.ajax
            ({
                type:'post',
                url:'<?php echo site_url();?>/Cursos/PreviewController/ConsultarTemasCursos?IdLeccion='+data[0].clave,
                data:{Curso:'<?php echo $curso; ?>', Usuario: '<?php echo $varsesion; ?>'},
                success :function(resp)
                {
                    $("#Leccion").append(
                        '<div class="card leccion shadow-sm mb-3 rounded-0" style="background-color:#07ad90;">'+
                            '<h5 class="card-header">'+
                                '<!--Cabecera del menu desplegable-->'+
                                '<a data-toggle="collapse" href="#contenido' + data[0].secuencia+ '" aria-expanded="true" aria-controls="contenidoUno"'+
                                    'id="leccion' + data[0].secuencia+ '" class="d-block">'+
                                    '<i class="fa fa-chevron-down pull-right"></i>'
                                    + data[0].nombre +' '+ data[0].secuencia +
                                '</a>'+
                            '</h5>'+
                        '<div id="contenido' + data[0].secuencia+ '" class="collapse" aria-labelledby="leccionUno">'+
                            '<!--Contenido del menu desplegable-->'+
                            '<div class="card-body">'+
                                '<h6>Este es el contenido de la leccion</h6>'+
                                '<p>' + data[0].descripcion+ '</p>'+
                            '</div>'+resp
                    );
                    if(data.length > 1) temas(data.slice(1,data.length));
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
                        '<img class="card-img-top h-75 w-75" src="data:image/jpg;base64,'+ resp[0].foto+'" alt="Proyecto 1">'
                    );

                    $("#info").append(

                        '<h2 class="text-white">' + resp[0].nombre +'</h2>'+
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
                        '<div id="boton"></div>'
                        
                    );                    
                }
            });
        }
        /**
         * Esta funcion sirve para enviar datos a la vista de materiales los cuales sirven para mostrar
         * Los ultimos materiales visitados en el curso 
         */
        function mostrar(data,tipo,ava = null,claveMaterial = null){
            var url = '<?php echo site_url('/Material?curso='.$curso);?>';// almacena la la url de la vista material
            if(claveMaterial) claveMat = claveMaterial;
            var form = $('<form action="' + url + '" method="post">' + // contiene un string con los datos de un formulario
              '<input type="text" name="materialSend" value="' + data + '" />' +
              '<input type="text" name="tipo" value="' + tipo + '" />'+
              '<input type="text" name="avance" value="'+ava+'" />'+
              '<input type="text" name="claveMat" value="'+claveMat+'" />'+
              '</form>');
            $('body').append(form);//se agrega el formulario al html de la pagina 
            form.submit();//se realiza el submit del formulario
        }
    </script>  

     
    <script src="<?php echo base_url();?>app-assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/myjs.js"></script>
</body>
</html>